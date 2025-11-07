<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';

$pdo = Database::getInstance()->getConnection();

$sqlStatements = [
    // Accounts table
    "CREATE TABLE IF NOT EXISTS accounts (
        account_id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        account_password VARCHAR(255) NOT NULL,
        firstname VARCHAR(100) NULL,
        lastname VARCHAR(100) NULL,
        birthdate DATE NULL,
        gender VARCHAR(20) NULL,
        email VARCHAR(150) NULL,
        phone_number VARCHAR(20) NULL,
        photo VARCHAR(255) NULL,
        is_admin TINYINT(1) NOT NULL DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login DATETIME NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // Ensure useful indexes
    "CREATE INDEX IF NOT EXISTS idx_accounts_username ON accounts(username);",
    "CREATE INDEX IF NOT EXISTS idx_accounts_email ON accounts(email);",

    // Example listings table (if not present). If you already have one, this will be skipped.
    "CREATE TABLE IF NOT EXISTS listings (
        listing_id INT AUTO_INCREMENT PRIMARY KEY,
        seller_account_id INT NOT NULL,
        property_name VARCHAR(255) NOT NULL,
        property_type VARCHAR(50) NOT NULL,
        property_dimension DECIMAL(10,2) NULL,
        price DECIMAL(12,2) NOT NULL,
        property_description TEXT NULL,
        property_status VARCHAR(50) NULL,
        property_photo LONGBLOB NULL,
        listing_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_listings_seller FOREIGN KEY (seller_account_id) REFERENCES accounts(account_id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
];

// Execute statements
foreach ($sqlStatements as $sql) {
    try {
        $pdo->exec($sql);
    } catch (Throwable $e) {
        // Some MySQL versions do not support IF NOT EXISTS for indexes; fallback
        if (strpos($sql, 'CREATE INDEX IF NOT EXISTS') !== false) {
            if (preg_match('/CREATE INDEX IF NOT EXISTS (\w+) ON (\w+)\((\w+)\)/i', $sql, $m)) {
                [$full, $indexName, $tableName, $col] = $m;
                $has = $pdo->prepare("SELECT COUNT(1) as ct FROM information_schema.statistics WHERE table_schema = DATABASE() AND table_name = ? AND index_name = ?");
                $has->execute([$tableName, $indexName]);
                $row = $has->fetch();
                if (empty($row['ct'])) {
                    $pdo->exec("CREATE INDEX {$indexName} ON {$tableName}({$col})");
                }
            }
        } else {
            throw $e;
        }
    }
}

echo "Migration completed successfully\n";
