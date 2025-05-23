<?php
include "../php/db_conn.php";

// Initialize $result to null
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) {
    // Filtering logic
    $sql = "SELECT l.*, p.bed_no, p.bath_no
            FROM listings l
            LEFT JOIN property_more_details p ON l.listing_id = p.ref_listing_id
            WHERE 1=1 "; // Start with a condition that is always true

    $types = "";
    $params = [];

    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $searchStr = $_GET['search'];
        $sql .= " AND (l.property_name LIKE ? OR l.property_location LIKE ? OR l.property_description LIKE ?)";
        $types .= "sss";
        $params[] = "%" . $searchStr . "%";
        $params[] = "%" . $searchStr . "%";
        $params[] = "%" . $searchStr . "%";
    }

    if (isset($_GET['price_min']) && !empty($_GET['price_min']) && isset($_GET['price_max']) && !empty($_GET['price_max'])) {
        $priceMin = $_GET['price_min'];
        $priceMax = $_GET['price_max'];
        $sql .= " AND l.price BETWEEN ? AND ?";
        $types .= "dd";
        $params[] = $priceMin;
        $params[] = $priceMax;
    }

    if (isset($_GET['property_type']) && is_array($_GET['property_type']) && !empty($_GET['property_type'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['property_type']), '?'));
        $sql .= " AND l.property_description IN (" . $placeholders . ")";
        $types .= str_repeat('s', count($_GET['property_type']));
        $params = array_merge($params, $_GET['property_type']);
    }

    if (isset($_GET['features']) && is_array($_GET['features']) && !empty($_GET['features'])) {
        $placeholders = implode(',', array_fill(0, count($_GET['features']), '?'));
        $sql .= " AND p.property_details IN (" . $placeholders . ")";
        $types .= str_repeat('s', count($_GET['features']));
        $params = array_merge($params, $_GET['features']);
    }

    if (isset($_GET['bedrooms']) && !empty($_GET['bedrooms']) && $_GET['bedrooms'] != 'Any') {
        $bedrooms = $_GET['bedrooms'];
        $sql .= " AND p.bed_no >= ?";
        $types .= "i";
        $params[] = intval(str_replace('+', '', $bedrooms));
    }

    if (isset($_GET['bathrooms']) && !empty($_GET['bathrooms']) && $_GET['bathrooms'] != 'Any') {
        $bathrooms = $_GET['bathrooms'];
        $sql .= " AND p.bath_no >= ?";
        $types .= "i";
        $params[] = intval(str_replace('+', '', $bathrooms));
    }

    $sql .= " AND l.property_status != 'sold'"; // Ensure we only get non-sold properties for filtering

    $stmt = $conn->prepare($sql);
    if (!empty($types)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // Fetch all non-'sold' properties for initial display
    $sql_initial = "SELECT l.*, p.bed_no, p.bath_no
                    FROM listings l
                    LEFT JOIN property_more_details p ON l.listing_id = p.ref_listing_id
                    WHERE l.property_status != 'sold'
                    ORDER BY l.listing_date DESC";
    $result = $conn->query($sql_initial);
    if (!$result) {
        die("Error fetching initial listings: " . $conn->error);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buy'])) {
        $id = (int) $_POST['property_ID'];
        $sql = "UPDATE listings SET property_status = 'sold' WHERE listing_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabalayan - Buy </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../styles/buy.css">
    <link rel="stylesheet" href="../styles/buy-listing.css">
    <link rel="stylesheet" href="../styles/popover.css">
    <link rel="stylesheet" href="../styles/buy-filter.css">
    <link rel="stylesheet" href="../styles/testimonials.css">
</head>

<body>
    <!-- LOADER -->
    <?php include '../Includes/loader.php'; ?>
    <!-- NAVBAR -->
    <?php include '../Includes/navbar.php'; ?>

    <!-- BANNER -->
    <section class="intro-image">
        <div class="overlay"></div>
        <div class="header-container">
            <span class="pre-heading">Exclusive Listings</span>
            <h1 class="banner-title">
                FIND YOUR<br>DREAM <span class="highlight">PROPERTY</span>
            </h1>
        </div>
        <div class="info-container">
            <div class="intro-content">
                <p>Explore the finest selection of premium homes, apartments, and properties tailored to exceed your expectations in the Philippines.</p>
                <a href="#property-listings" class="cta-button">Discover Properties</a>
            </div>
        </div>
    </section>

    <!-- LISTINGS TITLE -->
    <section id="property-listings" class="listing-title">
        <h2 class="section-heading">Discover Your Ideal Property</h2>
        <p class="section-description">From luxury apartments to cozy homes, browse our diverse listings that cater to all your needs and preferences. Your perfect property is just a few clicks away.</p>
    </section>
    <!-- LISTINGS -->
    <div class="page-container">
        <aside class="filters-sidebar">
            <div class="filters-header">
                <h3>Filter Properties</h3>
                <button id="clear-filters" class="clear-filters-btn">Clear All</button>
            </div>

            <div class="filter-section">
                <div class="search-container">
                    <input type="text" id="property-search" placeholder="Search locations, addresses...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <div class="filter-section">
                <h4 class="filter-title">Price Range</h4>
                <div class="price-inputs">
                    <div class="price-input">
                        <label for="min-price">Min</label>
                        <input type="text" id="min-price" placeholder="₱0">
                    </div>
                    <div class="price-input">
                        <label for="max-price">Max</label>
                        <input type="text" id="max-price" placeholder="No Max">
                    </div>
                </div>
                <div class="range-slider">
                    <input type="range" id="price-range" min="0" max="1000000" step="10000" value="500000">
                </div>
            </div>

            <div class="filter-section">
                <h4 class="filter-title">Property Type</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="House">
                        <span class="checkbox-custom"></span>
                        Houses
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="Condo">
                        <span class="checkbox-custom"></span>
                        Condos
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="Townhouse">
                        <span class="checkbox-custom"></span>
                        Townhouses
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="Land">
                        <span class="checkbox-custom"></span>
                        Land
                    </label>
                </div>
            </div>

            <div class="filter-section">
                <h4 class="filter-title">Bedrooms</h4>
                <div class="button-group">
                    <button class="filter-btn">Any</button>
                    <button class="filter-btn">1+</button>
                    <button class="filter-btn">2+</button>
                    <button class="filter-btn">3+</button>
                    <button class="filter-btn">4+</button>
                    <button class="filter-btn">5+</button>
                </div>
            </div>

            <div class="filter-section">
                <h4 class="filter-title">Bathrooms</h4>
                <div class="button-group">
                    <button class="filter-btn">Any</button>
                    <button class="filter-btn">1+</button>
                    <button class="filter-btn">2+</button>
                    <button class="filter-btn">3+</button>
                    <button class="filter-btn">4+</button>
                </div>
            </div>

            <button class="apply-filters-btn">Apply Filters</button>

        </aside>



        <main class="container">
            <section>
                <div class="section-header">
                    <h2>Properties in Albay</h2>
                    <a href="#" class="view-all">Discover your dream home in Bicol's most beautiful province! </a>
                </div>

                <div class="property-grid">
                    <?php
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="property-card" onclick="showPropertyDetails(
                '<?php echo $row['listing_id']; ?>',
                '<?php echo addslashes($row['property_name']); ?>',
                '<?php echo $row['price']; ?>',
                '<?php echo $row['bed_no']; ?>',
                '<?php echo $row['bath_no']; ?>',
                '<?php echo addslashes($row['property_dimension']); ?>',
                '<?php echo addslashes($row['property_location']); ?>',
                '<?php echo addslashes(date('F j, Y', strtotime($row['listing_date']))); ?>',
                '<?php echo addslashes($row['property_description']); ?>',
                '<?php echo addslashes($row['property_type']); ?>', 
                '../php/image.php?listing_id=<?php echo $row['listing_id']; ?>'
                )">

                                <div class="property-image">
                                    <img src="../php/image.php?listing_id=<?php echo $row["listing_id"]; ?>" alt="<?php echo $row["property_name"]; ?>">
                                    <div class="new-badge">Listed on <?php echo date("F j, Y", strtotime($row["listing_date"])); ?></div>
                                    <button class="favorite-btn" aria-label="Add to favorites">
                                        <i class="far fa-heart"></i>
                                    </button>
                                </div>
                                <div class="property-details">
                                    <div class="property-type">
                                        <div class="property-type-indicator"></div>
                                        <span><?php echo $row["property_description"]; ?></span>
                                    </div>
                                    <div class="property-price">₱<?php echo number_format($row["price"], 2); ?></div>
                                    <div class="property-specs">
                                        <span><?php echo $row["bed_no"]; ?> bed</span>
                                        <span><?php echo $row["bath_no"]; ?> bath</span>
                                        <span><?php echo $row["property_dimension"]; ?> m²</span>
                                    </div>
                                    <div class="property-address"><?php echo $row["property_name"]; ?></div>
                                    <div class="property-location"><?php echo $row["property_location"]; ?></div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<p>No properties found.</p>";
                    }
                    ?>
                </div>
            </section>
        </main>

        <!-- PROPERTY POPOVER  -->
        <div id="property-popover" class="popover-overlay">
            <div class="popover-content">
                <button class="close-popover">&times;</button>
                <div class="popover-header">
                    <h2>Property Details</h2>
                </div>
                <div class="popover-body">
                    <div class="popover-image">
                        <img id="popover-property-image" src="" alt="Property Image">
                    </div>
                    <div class="popover-details">
                        <div class="property-type">
                            <span id="popover-property-type"></span>
                        </div>
                        <div class="property-price" id="popover-property-price"></div>
                        <div class="property-specs">
                            <span id="popover-property-beds"></span>
                            <span id="popover-property-baths"></span>
                            <span id="popover-property-size"></span>
                        </div>
                        <div class="property-address" id="popover-property-address"></div>
                        <div class="property-location" id="popover-property-location"></div>

                        <div class="property-description" id="popover-property-details-description"></div>

                        <div class="listing-date">Listed on: <span id="popover-listing-date"></span></div>

                        <form action="" method="POST" class>
                            <input type="text" name="property_ID" style="display: none; visibility: hidden;" id="property-ID" value="100">
                            <div class="property-actions">
                                <button type="submit" name="buy" class="buy-btn" onclick="handleBuyAction(this)">
                                    <i class="fa-solid fa-cart-shopping"></i> Buy
                                </button>
                            </div>
                        </form>

                        <div class="property-actions">
                            <button type="button" class="wishlist-btn" onclick="handleFakeAction('wishlist', this)">
                                <i class="fa-regular fa-heart heart-icon"></i> Add to Wishlist
                            </button>
                        </div>

                        <div class="fake-message-form">
                            <textarea placeholder="Your message"></textarea>
                            <button type="button" onclick="handleFakeAction('message')">Send Message</button>
                        </div>

                        <div id="wishlist-confirmation" class="mini-popover">
                            <i class="fa-solid fa-heart wishlist-popover-icon"></i>
                            <p>Added to your wishlist!</p>
                        </div>

                        <div id="buy-confirmation" class="mini-popover"></div>

                        <div class="mini-popover" id="messageSentPopover">
                            <i class="fas fa-check-circle wishlist-popover-icon"></i>
                            <p>Message sent!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CONTACT -->
    <?php include '../Includes/contact.php'; ?>

    <!-- TESTIMONIAL -->
    <section class="testimonial-section" id="testimonialSection">
        <div class="testimonial-bg-pattern"></div>


        <div class="testimonial-container">
            <div class="testimonial-header">
                <div class="testimonial-title-wrapper">
                    <span class="testimonial-eyebrow">Client Experiences</span>
                    <h2 class="testimonial-heading">What our clients say about their journey with us</h2>
                    <p class="testimonial-description">Discover the real stories behind our success. Our clients share their experiences and how we've helped them find their perfect properties.</p>
                </div>

                <div class="testimonial-controls-header">
                    <div class="testimonial-counter">
                        <span class="testimonial-counter-current" id="currentSlide">01</span>
                        <span>/</span>
                        <span id="totalSlides">05</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-gallery" id="testimonialGallery">
                <div class="testimonial-item active" data-index="1">

                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <div class="testimonial-quote-mark">"</div>
                            <p class="testimonial-text">The entire process was seamless from start to finish. Their attention to detail and understanding of my needs made finding my dream home feel effortless. I couldn't be happier with the result.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <img src="../Assets/images/alexandrar.jpg" alt="Alexandra Rivera">
                            </div>
                            <div class="testimonial-info">
                                <div class="testimonial-name">Alexandra Rivera</div>
                                <div class="testimonial-position">First-time Homeowner</div>
                                <div class="testimonial-rating">
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-index="2">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <div class="testimonial-quote-mark">"</div>
                            <p class="testimonial-text">As an investor with a portfolio spanning multiple cities, I needed a partner who understood market trends across regions. Their data-driven approach and market intelligence gave me the edge I needed.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <img src="../Assets/images/marcusj.jpg" alt="Marcus Johnson">
                            </div>
                            <div class="testimonial-info">
                                <div class="testimonial-name">Marcus Johnson</div>
                                <div class="testimonial-position">Property Investor</div>
                                <div class="testimonial-rating">
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-index="3">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <div class="testimonial-quote-mark">"</div>
                            <p class="testimonial-text">The virtual tours feature saved me countless hours. Being able to explore properties in detail remotely meant I only visited homes that truly matched my criteria. This technology is game-changing.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <img src="../Assets/images/sophiachen.jpg" alt="Sophia Chen">
                            </div>
                            <div class="testimonial-info">
                                <div class="testimonial-name">Sophia Chen</div>
                                <div class="testimonial-position">Tech Executive</div>
                                <div class="testimonial-rating">
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-index="4">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <div class="testimonial-quote-mark">"</div>
                            <p class="testimonial-text">We were nervous about selling our family home of 25 years, but their compassionate approach made the transition smooth. They found buyers who appreciated the home's history as much as we did.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <img src="../Assets/images/robert.jpg" alt="Robert & Elizabeth Davis">
                            </div>
                            <div class="testimonial-info">
                                <div class="testimonial-name">Robert & Elizabeth Davis</div>
                                <div class="testimonial-position">Home Sellers</div>
                                <div class="testimonial-rating">
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-item" data-index="5">
                    <div class="testimonial-content">
                        <div class="testimonial-quote">
                            <div class="testimonial-quote-mark">"</div>
                            <p class="testimonial-text">Finding commercial property that aligned with our brand values and growth trajectory seemed impossible until we connected with this team. Their commercial insights transformed our business location strategy.</p>
                        </div>
                        <div class="testimonial-author">
                            <div class="testimonial-avatar">
                                <img src="../Assets/images/james.jpg" alt="James Wilson">
                            </div>
                            <div class="testimonial-info">
                                <div class="testimonial-name">James Wilson</div>
                                <div class="testimonial-position">Business Owner</div>
                                <div class="testimonial-rating">
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                    <span class="testimonial-star filled">★</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="testimonial-bottom">
                <div class="testimonial-progress">
                    <div class="testimonial-progress-bar" id="progressBar"></div>
                </div>

                <div class="testimonial-navigation">
                    <div class="testimonial-nav-btn prev" id="prevBtn" aria-label="Previous testimonial">
                        <button">
                            <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                            </button>
                    </div>

                    <div class="testimonial-nav-btn next" id="nextBtn" aria-label="Next testimonial">
                        <button">
                            <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- TOP-BUTTON -->
    <?php include '../Includes/top-button.php'; ?>

    <!-- FOOTER -->
    <?php include '../Includes/footer.php'; ?>

    <script src="../js/buy.js"></script>
    <script src="../js/popover.js"></script>
    <script src="../js/buy-filter.js"></script>
    <script src="../js/testimonials.js"></script>

</body>

</html>