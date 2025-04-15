<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to login if not logged in
    exit();
}

// Database connection
$host = "localhost";
$dbname = "project_db"; // Your database name
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$userId = $_SESSION['user_id'];  // Get the logged-in user's ID

try {
    // Fetch user profile data from the accounts table using the logged-in user_id
    $user = [
        'username' => $_SESSION['username'],
        'photo' => $_SESSION['photo'] ?? '',
        'phone_number' => $_SESSION['phone_number'] ?? '',
        'location' => $_SESSION['location'] ?? '',
    ];
    

    // Get user listings (assuming there's a relationship between the listings table and the accounts table)
    $listingsStmt = $pdo->prepare("SELECT * FROM listings WHERE seller_account_id = :userId ORDER BY listing_date DESC");
    $listingsStmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $listingsStmt->execute();
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?php echo htmlspecialchars($user['username']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <!-- Profile Header Section -->
        <div class="profile-header">
            <div class="profile-image">
                <?php if (!empty($user['photo'])): ?>
                    <img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Profile Image" class="profile-image">
                <?php else: ?>
                    <!-- Display initials or default image if no profile image -->
                    <div class="profile-image" style="display: flex; align-items: center; justify-content: center; background-color:rgb(2, 2, 2); color: white; font-size: 40px;">
                        <?php echo htmlspecialchars(strtoupper(substr($user['username'], 0, 1))); ?>
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
                    <?php if (!empty($user['location'])): ?>
                        <p>Location: <?php echo htmlspecialchars($user['location']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="profile-actions">
                    <a href="edit_profile.php">Edit Profile</a>
                    <a href="settings.php">Settings</a>
                </div>
            </div>
        </div>

        <!-- Listings Section -->
        <div class="listings-header">
            <h2>My Listings</h2>
            <a href="create_listing.php" class="btn">Create New Listing</a>
        </div>

        <?php if ($listingsStmt->rowCount() > 0): ?>
            <div class="listings-container">
                <?php while ($listing = $listingsStmt->fetch()): ?>
                    <div class="listing-card">
                        <?php if (!empty($listing['property_photo'])): ?>
                            <img src="<?php echo htmlspecialchars($listing['property_photo']); ?>" alt="<?php echo htmlspecialchars($listing['property_name']); ?>" class="listing-image">
                        <?php else: ?>
                            <div class="listing-image" style="background-color: #ddd; display: flex; align-items: center; justify-content: center;">
                                <span>No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="listing-details">
                            <h3 class="listing-title"><?php echo htmlspecialchars($listing['property_name']); ?></h3>
                            <p class="listing-type"><?php echo htmlspecialchars($listing['property_type']); ?> | Size: <?php echo htmlspecialchars($listing['property_size']); ?> sqft</p>
                            <p class="listing-price">$<?php echo number_format($listing['price'], 2); ?></p>
                            <p class="listing-location"><?php echo htmlspecialchars($listing['property_location']); ?></p>
                            <?php if (isset($listing['property_description'])): ?>
                                <p class="listing-description"><?php echo htmlspecialchars($listing['property_description']); ?></p>
                            <?php endif; ?>
                            <div class="listing-actions">
                                <a href="edit_listing.php?id=<?php echo $listing['listing_id']; ?>" class="btn">Edit</a>
                                <a href="view_listing.php?id=<?php echo $listing['listing_id']; ?>" class="btn">View</a>
                            </div>
                        </div>
                        <div class="listing-footer">
                            <span>Posted: <?php echo date('M d, Y', strtotime($listing['listing_date'])); ?></span>
                            <?php if (isset($listing['property_status'])): ?>
                                <span>Status: <?php echo htmlspecialchars($listing['property_status']); ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="no-listings">
                <h3>You haven't posted any listings yet</h3>
                <p>Create your first listing to start selling!</p>
                <a href="create_listing.php" class="btn">Create Listing</a>
            </div>
        <?php endif; ?>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-listing');
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
