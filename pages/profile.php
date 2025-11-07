<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Database.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit;
}

$userId = (int)$_SESSION['user_id'];

$pdo = Database::getInstance()->getConnection();
try {
    // Fetch complete user data including firstname/lastname and photo path
    $userStmt = $pdo->prepare("SELECT username, email, phone_number, firstname, lastname, photo FROM accounts WHERE account_id = ?");
    $userStmt->execute([$userId]);
    $user = $userStmt->fetch();

    if (!$user) {
        throw new Exception('User not found');
    }

    // Update session with fresh data
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['phone_number'] = $user['phone_number'];
    $_SESSION['photo'] = $user['photo'];

    // Get user listings
    $listingsStmt = $pdo->prepare("SELECT * FROM listings WHERE seller_account_id = ? ORDER BY listing_date DESC");
    $listingsStmt->execute([$userId]);
    $listings = $listingsStmt->fetchAll();
} catch (Throwable $e) {
    http_response_code(500);
    die("An error occurred.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabalayan - <?php echo htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" href="../styles/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/profile.css">

</head>

<!-- LOADER -->
<?php include '../Includes/loader.php'; ?>
<!-- NAVBAR -->
<?php include '../Includes/navbar.php'; ?>

<body>
    <div class="container">
        <!-- Profile Header Section -->
        <div class="profile-header">
            <div class="profile-image-container">
                <?php if (!empty($user['photo'])): ?>
                    <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Image" class="profile-image">
                <?php else: ?>
                    <!-- Display initials if no picture -->
                    <div class="initials-circle">
                        <?php
                        $initials = '';
                        if (!empty($user['firstname'])) $initials .= strtoupper(substr($user['firstname'], 0, 1));
                        if (!empty($user['lastname'])) $initials .= strtoupper(substr($user['lastname'], 0, 1));
                        echo htmlspecialchars($initials ?: strtoupper(substr($user['username'], 0, 1)));
                        ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($user['username']); ?></h1>
                <div class="profile-details">
                    <p>Email: <?php echo htmlspecialchars($user['email']); ?></p>
                    <?php if (!empty($user['phone_number'])): ?>
                        <p>Phone: <?php echo htmlspecialchars($user['phone_number']); ?></p>
                    <?php endif; ?>

                </div>
                <div class="profile-actions">
                    <a href="./profile_edit.php" class="btn">Edit Profile</a>
                    <a href="../php/logout.php?logout=1" class="logout-btn">Logout</a>
                </div>
            </div>
        </div>

        <!-- LISTINGS -->
        <div class="listings-header">
            <h2>My Listings</h2>
        </div>

        <?php if (!empty($listings)): ?>
            <div class="listings-container">
                <?php foreach ($listings as $listing): ?>
                    <div class="listing-card">
                        <?php if (!empty($listing['property_photo'])): ?>
                            <img src="../php/image.php?listing_id=<?php echo $listing['listing_id'] ?>" alt="<?php echo htmlspecialchars($listing['property_name']); ?>" class="listing-image">
                        <?php else: ?>
                            <div class="listing-image" style="background-color: #ddd; display: flex; align-items: center; justify-content: center;">
                                <span>No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="listing-details">
                            <h3 class="listing-title"><?php echo htmlspecialchars($listing['property_name']); ?></h3>
                            <p class="listing-type"><?php echo htmlspecialchars($listing['property_type']); ?> | Size: <?php echo htmlspecialchars($listing['property_dimension']); ?> m²</p>
                            <p class="listing-price">₱<?php echo number_format($listing['price'], 2); ?></p>
                            <?php if (isset($listing['property_description'])): ?>
                                <p class="listing-description"><?php echo htmlspecialchars($listing['property_description']); ?></p>
                            <?php endif; ?>
                            <div class="listing-actions">
                            </div>
                        </div>
                        <div class="listing-footer">
                            <span>Posted: <?php echo date('M d, Y', strtotime($listing['listing_date'])); ?></span>
                            <?php if (isset($listing['property_status'])): ?>
                                <span>Status: <?php echo htmlspecialchars($listing['property_status']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-listings">
                <h3>You haven't posted any listings yet</h3>
                <p>Create your first listing to start selling!</p>
                <a href="../pages/sell.php" class="btn">Create Listing</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- TOP-BUTTON -->
    <?php include '../Includes/top-button.php'; ?>

    <!-- FOOTER -->
    <?php include '../Includes/footer.php'; ?>

    <script src="../js/theme.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');
            if (deleteButtons) {
                deleteButtons.forEach(button => {
                    button.addEventListener('click', function(e) {
                        if (!confirm('Are you sure you want to delete this listing?')) {
                            e.preventDefault();
                        }
                    });
                });
            }
        });
    </script>
</body>

</html>