<?php
include "../php/db_conn.php";

$sql = "SELECT * FROM listings l  JOIN property_more_details prm ON prm.ref_listing_id = l.listing_id 
WHERE l.property_status != 'sold'
ORDER BY listing_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['buy'])) {
        $id = (int) $_POST['property_ID'];
        $sql = "UPDATE listings SET property_status = 'sold' WHERE listing_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        // 👇 Force full reload to refresh updated data (clears POST + avoids cache)
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
    <title>BUY</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="buy.css">
    <link rel="stylesheet" href="buy-listing.css">
    <link rel="stylesheet" href="popover.css">
    <link rel="stylesheet" href="buy-filter.css">
    <link rel="stylesheet" href="testimonials.css">
</head>

<body>

    <!-- Loading Screen -->
    <div id="page-loader">
        <div class="loader-content">
            <div class="loader-spinner"></div>
        </div>
    </div>

    <!-- NAV -->
    <header>
        <div class="logo">
            <!-- <img src="/mnt/data/LANDINGPAGE.webp" alt="logo" style="height:40px;"> LOGO TO BE UPLOADED -->
            NAME
        </div>

        <nav id="navbar" class="navbar">
            <ul>
                <li>
                    <button id="close-sidebar-button" aria-label="close sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                            fill="#c9c9c9">
                            <path
                                d="m480-444.62-209.69 209.7q-7.23 7.23-17.5 7.42-10.27.19-17.89-7.42-7.61-7.62-7.61-17.7 0-10.07 7.61-17.69L444.62-480l-209.7-209.69q-7.23-7.23-7.42-17.5-.19-10.27 7.42-17.89 7.62-7.61 17.7-7.61 10.07 0 17.69 7.61L480-515.38l209.69-209.7q7.23-7.23 17.5-7.42 10.27-.19 17.89 7.42 7.61 7.62 7.61 17.7 0 10.07-7.61 17.69L515.38-480l209.7 209.69q7.23 7.23 7.42 17.5.19 10.27-7.42 17.89-7.62 7.61-17.7 7.61-10.07 0-17.69-7.61L480-444.62Z" />
                        </svg>
                    </button>
                </li>
                <li><a href="../Home/home.html">Home</a></li>
                <li><a href="../Buy/buy.php">Buy</a></li>
                <li><a href="../Sell/sell.php"">Sell</a></li>
                <li><a href=" ../About/about.html">About Us</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="../Profile/Profile.php">Profile</a>
            <button id="open-sidebar-button" aria-label="open sidebar" aria-expanded="false"
                aria-controls="navbar">
                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                    fill="#c9c9c9">
                    <path
                        d="M165.13-254.62q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.86q7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.87q-7.22 7.12-17.9 7.12H165.13Zm0-200.25q-10.68 0-17.9-7.27-7.23-7.26-7.23-17.99 0-10.74 7.23-17.87 7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.27 7.23 7.26 7.23 17.99 0 10.74-7.23 17.87-7.22 7.13-17.9 7.13H165.13Zm0-200.26q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.87q7.22-7.12 17.9-7.12h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.86q-7.22 7.13-17.9 7.13H165.13Z" />
                </svg>
            </button>
        </div>
    </header>


    BANNER
    <!-- BANNER -->
    <section class="banner">
        <div class="banner-content">
            <h1 class="banner-title">
                <span class="white-text">FIND YOUR DREAM</span> <span class="yellow-text">PROPERTY IN //NAME//</span>
            </h1>
            <p class="banner-subtitle">Explore the best homes, apartments, and properties tailored to your needs in PILIPINS!</p>
            <a href="#property-listings" class="cta-button">Explore Listings</a>
        </div>
    </section>



    LISTINGS TITLE
    <!-- LISTINGS TITLE -->
    <section class="listing-title">
        <h2 class="section-heading">Discover Your Ideal Property</h2>
        <p class="section-description">From luxury apartments to cozy homes, browse our diverse listings that cater to all your needs and preferences. Your perfect property is just a few clicks away.</p>
    </section>


    LISTINGS
    <!-- LISTINGS -->
    <div class="page-container">
        <!-- New filter sidebar -->
        <aside class="filters-sidebar">
            <div class="filters-header">
                <h3>Filter Properties</h3>
                <button id="clear-filters" class="clear-filters-btn">Clear All</button>
            </div>

            <!-- Search Box -->
            <div class="filter-section">
                <div class="search-container">
                    <input type="text" id="property-search" placeholder="Search locations, addresses...">
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <!-- Price Range -->
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

            <!-- Property Type -->
            <div class="filter-section">
                <h4 class="filter-title">Property Type</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="house">
                        <span class="checkbox-custom"></span>
                        Houses
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="condo">
                        <span class="checkbox-custom"></span>
                        Condos
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="townhouse">
                        <span class="checkbox-custom"></span>
                        Townhouses
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="property-type" value="land">
                        <span class="checkbox-custom"></span>
                        Land
                    </label>
                </div>
            </div>

            <!-- Bedrooms -->
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

            <!-- Bathrooms -->
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

            <!-- Home Features -->
            <div class="filter-section">
                <h4 class="filter-title">Home Features</h4>
                <div class="checkbox-group">
                    <label class="checkbox-label">
                        <input type="checkbox" name="features" value="pool">
                        <span class="checkbox-custom"></span>
                        Swimming Pool
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="features" value="garage">
                        <span class="checkbox-custom"></span>
                        Garage
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="features" value="garden">
                        <span class="checkbox-custom"></span>
                        Garden
                    </label>
                    <label class="checkbox-label">
                        <input type="checkbox" name="features" value="aircon">
                        <span class="checkbox-custom"></span>
                        Air Conditioning
                    </label>
                </div>
            </div>

            <!-- Apply Filters Button -->
            <button class="apply-filters-btn">Apply Filters</button>
        </aside>










        <main class="container">
            <section>
                <div class="section-header">
                    <h2>Homes around ₱resyong pang masa</h2>
                    <a href="#" class="view-all">View all in San Antonio, TX</a>
                </div>
                <div class="property-grid">

<?php
if ($result->num_rows > 0) {
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
}
?>
                    <div class="property-card" onclick="showPropertyDetails(
                    '0',
        '10434 Sun Ml',
        '330000',
        '4',
        '2.5',
        '2,545',
        'San Antonio, TX 78254',
        '3 hours ago',
        'Single-Family Home',
        'https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=1950&q=80'
        )">

                        <div class="property-image">
                            <img src="https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=1950&q=80" alt="House in San Antonio">
                            <div class="new-badge">New - 3 hours ago</div>
                            <button class="favorite-btn" aria-label="Add to favorites">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                        <div class="property-details">
                            <div class="property-type">
                                <div class="property-type-indicator"></div>
                                <span>Single-Family Home</span>
                            </div>
                            <div class="property-price">₱3,330,000</div>
                            <div class="property-specs">
                                <span>4 bed</span>
                                <span>2.5 bath</span>
                                <span>2,545 sqft</span>
                            </div>
                            <div class="property-address">10434 Sun Ml</div>
                            <div class="property-location">San Antonio, TX 78254</div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <!-- Property Popover  -->
        <div id="property-popover" class="popover-overlay">

            <div class="popover-content">
            <button class="close-popover">&times;</button>                <div class="popover-header">
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
                        <div class="listing-date">Listed on: <span id="popover-listing-date"></span></div>

                        <form action="" method="POST" class>
                            <input type="text" name="property_ID" style="display: none; visibility: hidden;" id="property-ID" value="100">
                            <div class="property-actions">
                                <button class="wishlist-btn" onclick="handleFakeAction('wishlist', this)">
                                    <i class="fa-regular fa-heart heart-icon"></i> Add to Wishlist
                                </button>
                                <button type="submit" name="buy" class="buy-btn" onclick="handleBuyAction(this)"">
                                    <i class="fa-solid fa-cart-shopping"></i> Buy
                                </button>
                            </div>
                        </form>


                        <div class="fake-message-form">
                            <textarea placeholder="Your message"></textarea>
                            <button onclick="handleFakeAction('message')">Send Message</button>
                        </div>



                        <div id="wishlist-confirmation" class="mini-popover">
                            <i class="fa-solid fa-heart wishlist-popover-icon"></i>
                            <p>Added to your wishlist!</p>
                        </div>


                        <div id="buy-confirmation" class="mini-popover">
                            <i class="fa-solid fa-circle-check"></i>
                            <p>Thank you! We'll contact you shortly to proceed with your purchase.</p>
                        </div>

                        <div class="mini-popover" id="messageSentPopover">
                            <i class="fas fa-check-circle wishlist-popover-icon"></i>
                            <p>Message sent!</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    CONTACT FORM
    <!-- CONTACT SECTION -->
    <section class="contact-section">
        <div class="contact-info">
            <h2>Still haven't found what you're looking for?</h2>
            <p>Let us know your preferences, and we'll help you find the perfect home.</p>
        </div>
        <form class="contact-form">
            <div class="form-row">
                <input type="text" placeholder="First Name" required />
                <input type="text" placeholder="Last Name" required />
            </div>
            <div class="form-row">
                <input type="text" placeholder="What are you looking for?" required />
            </div>
            <div class="form-row">
                <textarea placeholder="Notes"></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </section>




    TESTIMONIALS
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
                                <img src="/api/placeholder/100/100" alt="Alexandra Rivera">
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
                                <img src="/api/placeholder/100/100" alt="Marcus Johnson">
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
                                <img src="/api/placeholder/100/100" alt="Sophia Chen">
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
                                <img src="/api/placeholder/100/100" alt="Robert & Elizabeth Davis">
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
                                <img src="/api/placeholder/100/100" alt="James Wilson">
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

                <!-- Prev Button -->
                <div class="testimonial-navigation">
                    <div class="testimonial-nav-btn prev" id="prevBtn" aria-label="Previous testimonial">
                        <button">
                            <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
                            </button>
                    </div>

                    <!-- Next Button -->
                    <div class="testimonial-nav-btn next" id="nextBtn" aria-label="Next testimonial">
                        <button">
                            <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">©2024 //NAME// RESIDENCE. ALL RIGHTS RESERVED</div>
            <div class="footer-center">
                <a href="../Home/home.html">Home</a>
                <a href="../Buy/buy.php">Buy</a>
                <a href="../Sell/sell.php">Sell</a>
                <a href="../About/about.html">About Us</a>
            </div>
            <div class="footer-right">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>



    <script src="buy.js"></script>
    <script src="popover.js"></script>
    <script src="buy-filter.js"></script>
    <script src="testimonials.js"></script>

</body>

</html>