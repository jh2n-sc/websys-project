<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../php/db_conn.php';

session_start();
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");  // Redirect if not 
    die();
}

$userId =(int) $_SESSION['user_id']; 

try {
    $user = [
        'account' => $_SESSION['username'],
        'photo' => $_SESSION['photo'] ?? '',
        'phone_number' => $_SESSION['phone_number'] ?? '',
    ];

    // Get user listings (relationship between the listings table and the accounts table)
    $listingsStmt = $conn->prepare("SELECT * FROM listings WHERE seller_account_id = ? ORDER BY listing_date DESC");
   $listingsStmt->bind_param('i', $userId);
    $listingsStmt->execute();

    $result = $listingsStmt->get_result();
} catch (mysqli_sql_exception $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PROFILE - <?php echo htmlspecialchars($user['account']); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../styles/profile.css">
</head>

<!-- Loader -->
<?php include '../Includes/loader.php'; ?>
<!-- Navbar -->
<?php include '../Includes/navbar.php'; ?>

<body>
    <div class="container">
        <!-- Profile Header Section -->
        <div class="profile-header">
            <div class="profile-image">
                <?php if (!empty($user['photo'])): ?>
                    <img src="../php/profile_image.php?account_id=<?php echo $userId?>" alt="Profile Image" class="profile-image">
                <?php else: ?>
                    <!-- Display initials or default image if no pic -->
                    <div class="profile-image" style="display: flex; align-items: center; justify-content: center; background-color:rgb(2, 2, 2); color: white; font-size: 40px;">
                        <?php echo htmlspecialchars(strtoupper(substr($_SESSION['username'], 0, 1))); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="profile-info">
                <h1><?php echo htmlspecialchars($_SESSION['username']); ?></h1>
                <div class="profile-details">
                    <p>Email: <?php echo htmlspecialchars($_SESSION['email']);?></p>
                    <?php if (!empty($user['phone_number'])): ?>
                        <p>Phone: <?php echo htmlspecialchars($user['phone_number']); ?></p>
                    <?php endif; ?>
                    <?php if (!empty($user['location'])): ?>
                        <p>Location: <?php echo htmlspecialchars($_SESSION['location']); ?></p>
                    <?php endif; ?>
                </div>
                <div class="profile-actions">
                    <a href="edit_profile.php">Edit Profile</a>
                    <a href="settings.php">Settings</a>
                    <a href="logout.php?logout=1">Logout</a>
                </div>
            </div>
        </div>

        <!-- Listings Section -->
        <div class="listings-header">
            <h2>My Listings</h2>
        </div>

        <?php if ($result->num_rows > 0): ?>
            <div class="listings-container">
                <?php while ($listing = $result->fetch_assoc()): ?>
                    <div class="listing-card">
                        <?php if (!empty($listing['property_photo'])): ?>
                            <img src="../php/image.php?listing_id=<?php echo $listing['listing_id']?>" alt="<?php echo htmlspecialchars($listing['property_name']); ?>" class="listing-image">
                        <?php else: ?>
                            <div class="listing-image" style="background-color: #ddd; display: flex; align-items: center; justify-content: center;">
                                <span>No Image</span>
                            </div>
                        <?php endif; ?>
                        <div class="listing-details">
                            <h3 class="listing-title"><?php echo htmlspecialchars($listing['property_name']); ?></h3>
                            <p class="listing-type"><?php echo htmlspecialchars($listing['property_type']); ?> | Size: <?php echo htmlspecialchars($listing['property_dimension']); ?> sqft</p>
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

    <?php include '../Includes/footer.php'; ?>


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