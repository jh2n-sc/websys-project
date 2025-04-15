<?php

include "../php/db_conn.php";

$sql = "SELECT listing_id, property_name, seller_account_id, price, property_type, property_size, property_description, property_location, listing_date, CONCAT(firstname, ' ', lastname) as fullname FROM listings JOIN accounts ON accounts.account_id = listings.seller_account_id ORDER BY listing_id DESC ";
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
<!-- NAV -->


BANNER LISTING/HEADER
<!-- BANNER -->
<section class="banner">
    </section>
    


    LISTINGS TITLE
    <!-- PROPERTY LISTINGS -->
    <section class="property-listings">
    <h2>Discover //NAME// Property</h2>
    <p>Whether you're looking for a modern apartment in the city or a peaceful home in the suburbs, our listings offer something for everyone.</p>
    

    LISTINGS
    <div class="property-cards">

    

<?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
    <div class="card">
        <img src="../php/image.php?listing_id=<?php echo $row["listing_id"];?>">
        <h2><?php echo "{$row['property_name']}"; ?></h2>
            <div class="card-content">
            <h3><?php echo "{$row['property_description']}"; ?></h3>
            <p>📍 <?php echo "{$row['property_location']}"; ?></p>
            <div class="property-info">
            <span>4 Beds</span>
            <span>2 Baths</span>
            <span>40 m²</span>
            </div>
        </div>
        </div>
		
<?php
    }
}
    ?>
        <!-- Card 1 SAMPLE -->

    </div>
    </section>
    


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
</body>

</html>