<?php
include "../php/db_conn.php";

$sql = "SELECT * FROM listings l JOIN property_more_details prm ON prm.ref_listing_id = l.listing_id ORDER BY listing_id DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>//NAME// Property</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="buy.css">
    <link rel="stylesheet" href="buy-listing.css">
    <link rel="stylesheet" href="popover.css">
</head>

<body>

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
                <li><a href="/Home/home.html">Home</a></li>
                <li><a href="/Buy/listing.html">Buy</a></li>
                <li><a href="/Sell/sell.html"">Sell</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </nav>

        <div class="header-actions">
            <a href="#">Contact Us</a>
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


<!-- BANNER -->
<section class="banner">BANNER
    </section>
    
LISTINGS TITLE
    <!-- LISTINGS TITLE -->
    <section class="property-listings">
    <h2>Discover //NAME// Property</h2>
    <p>Whether you're looking for a modern apartment in the city or a peaceful home in the suburbs, our listings offer something for everyone.</p> 
    

LISTINGS
    <!-- LISTINGS -->
    <div class="property-cards">
    </div>
    </section>

    <main class="container">
        <!-- Properties around $288,700 -->
        <section>
            <div class="section-header">
                <h2>Homes around $288,700</h2>
                <a href="#" class="view-all">View all in San Antonio, TX</a>
            </div>
            <div class="property-grid"> 
                    
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
    ?>
        <div class="property-card" onclick="showPropertyDetails(
            '<?php echo $row["property_name"]; ?>',
            '<?php echo $row["price"]; ?>',
            '<?php echo $row["bed_no"]; ?>',
            '<?php echo $row["baths_no"]; ?>',
            '<?php echo $row["dimensions"]; ?>',
            '<?php echo $row["property_location"]; ?>',
            '<?php echo date("F j, Y", strtotime($row["listing_date"])); ?>',
            '<?php echo $row["property_description"]; ?>',
            '../php/image.php?listing_id=<?php echo $row["listing_id"]; ?>'
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
                    <span><?php echo $row["baths_no"]; ?> bath</span>
                    <span><?php echo $row["dimensions"]; ?> m²</span>
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
                    <div class="property-price">$330,000</div>
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
                        <button class="close-popover" onclick="hidePropertyDetails()">&times;</button>
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
                                <div class="listing-date">Listed on: <span id="popover-listing-date"></span></div>


                    <div class="property-actions">
                    <button class="wishlist-btn" onclick="handleFakeAction('wishlist', this)">
                        <i class="fa-regular fa-heart heart-icon"></i> Add to Wishlist
                    </button>

                    <button class="buy-btn" onclick="handleFakeAction('buy')">
                        <i class="fa-solid fa-cart-shopping"></i> Buy
                    </button>
                </div>

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
    
FAQ
    <!-- FAQ SECTION -->
    <section class="faq-section">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-item">
        <h3>How do I start the process of buying a property with //NAME//?</h3>
        <p>At //NAME//, we make it simple for you to find your dream home...</p>
    </div>
    <div class="faq-item">
        <h3>What types of properties does //NAME// offer?</h3>
    </div>
    <div class="faq-item">
        <h3>Can //NAME// assist with property financing or mortgages?</h3>
    </div>
    <div class="faq-item">
        <h3>Does //NAME// provide property management services?</h3>
    </div>
    <div class="faq-item">
        <h3>Are there any fees involved in working with //NAME//?</h3>
    </div>
    </section>
    





    <!-- FOOTER -->
    <footer class="footer">
    <div class="footer-container">
        <div class="footer-left">©2024 //NAME// RESIDENCE. ALL RIGHTS RESERVED</div>
        <div class="footer-center">
        <a href="#">Home</a>
        <a href="#">Properties</a>
        <a href="#">Our Projects</a>
        <a href="#">FAQs</a>
        <a href="#">About Us</a>
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









</body>

</html>