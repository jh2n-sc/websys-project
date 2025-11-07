<?php
require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Utils.php';

class Auth {
    private $db;
    
    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }
    
    // Register a new account (uses 'accounts' table)
    public function register($username, $email, $password, $userData = []) {
        // Validate input
        if (empty($username) || empty($password)) {
            throw new Exception("Username and password are required");
        }
        if (!empty($email) && !Utils::validateEmail($email)) {
            throw new Exception("Invalid email format");
        }
        if (strlen($password) < 8) {
            throw new Exception("Password must be at least 8 characters long");
        }
        
        // Check if username or email already exists
        $stmt = $this->db->prepare("SELECT account_id FROM accounts WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->rowCount() > 0) {
            throw new Exception("Username or email already exists");
        }
        
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        // Base insert
        $stmt = $this->db->prepare("INSERT INTO accounts (username, account_password, email, firstname, lastname, birthdate, gender, phone_number, photo, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $firstname = $userData['firstname'] ?? null;
        $lastname = $userData['lastname'] ?? null;
        $birthdate = $userData['birthdate'] ?? null;
        $gender = $userData['gender'] ?? null;
        $phone = $userData['phone_number'] ?? null;
        $photo = $userData['photo'] ?? null;
        $stmt->execute([$username, $hashedPassword, $email, $firstname, $lastname, $birthdate, $gender, $phone, $photo]);
        
        return (int)$this->db->lastInsertId();
    }
    
    // Login by username or email
    public function login($identifier, $password) {
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE username = ? OR email = ? LIMIT 1");
        $stmt->execute([$identifier, $identifier]);
        $user = $stmt->fetch();
        
        if (!$user) {
            throw new Exception("Invalid credentials");
        }
        
        $stored = $user['account_password'];
        $ok = false;
        if (password_get_info($stored)['algo'] !== 0) {
            // Stored is a hash
            $ok = password_verify($password, $stored);
        } else {
            // Legacy plain text fallback
            $ok = hash_equals($stored, $password);
            if ($ok) {
                // Upgrade to hash
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $up = $this->db->prepare("UPDATE accounts SET account_password = ? WHERE account_id = ?");
                $up->execute([$newHash, $user['account_id']]);
                $stored = $newHash;
            }
        }
        
        if (!$ok) {
            throw new Exception("Invalid credentials");
        }
        
        // Regenerate session ID to prevent session fixation
        session_regenerate_id(true);
        
        // Set session variables
        $_SESSION['user_id'] = (int)$user['account_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['logged_in'] = true;
        
        // Update last login time
        $this->updateLastLogin((int)$user['account_id']);
        
        return true;
    }
    
    public function logout() {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }
        session_destroy();
        return true;
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    }
    
    public function getCurrentUser() {
        if (!$this->isLoggedIn()) return null;
        $stmt = $this->db->prepare("SELECT * FROM accounts WHERE account_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
        return $stmt->fetch();
    }
    
    public function updateUserProfile($userId, $userData) {
        $allowed = ['firstname','lastname','phone_number','email','photo'];
        $updates = [];
        $params = [];
        foreach ($userData as $k=>$v) {
            if (in_array($k, $allowed, true)) {
                $updates[] = "$k = ?";
                $params[] = $v;
            }
        }
        if (!$updates) return false;
        $params[] = $userId;
        $sql = "UPDATE accounts SET ".implode(', ', $updates)." WHERE account_id = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($params);
    }
    
    private function updateLastLogin($userId) {
        $stmt = $this->db->prepare("UPDATE accounts SET last_login = NOW() WHERE account_id = ?");
        return $stmt->execute([$userId]);
    }
    
    public function isAdmin($userId) {
        $stmt = $this->db->prepare("SELECT is_admin FROM accounts WHERE account_id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch();
        return $user && (int)$user['is_admin'] === 1;
    }
}
