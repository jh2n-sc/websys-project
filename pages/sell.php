<?php
include_once '../php/db_conn.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
  header("Location: ./login.php");  // Redirect if not logged in
  exit();
}
$stmt = $conn->prepare("SELECT * from listings WHERE property_status = 'sold'");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kabalayan - Sell </title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../styles/sell.css" />
  <link rel="stylesheet" href="../styles/sell-carousel.css">
  <link rel="stylesheet" href="../styles/sell-form.css">
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
      <span class="pre-heading">Maximum Value</span>
      <h1 class="banner-title">
        SELL YOUR<br>HOME <span class="highlight">SMARTER</span>
      </h1>
    </div>
    <div class="info-container">
      <div class="intro-content">
        <p>Turn your property into profit with our expert team. We deliver superior market exposure and negotiation strategies to maximize your selling price in the Philippines.</p>
        <a href="#listing-form-section" class="cta-button">Start Selling</a>
      </div>
    </div>
  </section>

  <!-- SELL  -->
  <div class="container">
    <div class="page-title">
      <h1>Showcase Your Property Today</h1>
      <p>Connect with verified buyers and sell your property faster with our streamlined process</p>
    </div>

    <div class="content-wrapper">
      <!-- How to Sell Section -->
      <section class="how-to-sell">
        <div class="how-to-sell-header">
          <h2>How Selling Works</h2>
          <p>From listing your home to closing the deal, we guide you through each step with ease.</p>
        </div>

        <div class="sell-steps">
          <div class="step-card">
            <div class="step-number">1</div>
            <div class="step-content">
              <h3>Submit Your Property</h3>
              <p>Use our form to provide your property details, photos, and price. Our team will review and publish your listing within 24 hours.</p>
            </div>
          </div>

          <div class="step-card">
            <div class="step-number">2</div>
            <div class="step-content">
              <h3>We Promote It</h3>
              <p>We publish your listing to our growing audience of verified buyers and actively market your property through our network and advertising channels.</p>
            </div>
          </div>

          <div class="step-card">
            <div class="step-number">3</div>
            <div class="step-content">
              <h3>Get Offers</h3>
              <p>Receive inquiries and offers directly through our platform. Negotiate with potential buyers and close on your terms with our support.</p>
            </div>
          </div>
        </div>

        <div class="benefits">
          <div class="benefits-list">
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>No upfront fees</p>
            </div>
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>24/7 support team</p>
            </div>
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>Verified buyers only</p>
            </div>
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>Professional photography</p>
            </div>
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>Smart matching algorithm</p>
            </div>
            <div class="benefit-item">
              <div class="benefit-icon">✓</div>
              <p>Secure transaction process</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Listing Form Section -->
      <section id="listing-form-section" class="listing-form-section">
        <div class="form-header">
          <h2>List Your Property</h2>
          <p>Fill out the form below to get started</p>
        </div>

        <form class="contact-form" id="propertyForm" method="POST" action="../php/upload.php" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group">
              <label class="required-label">Property Location</label>
              <input type="text" id="propertyLocation" name="location" placeholder="Street address, City, ZIP" required>
              <div class="error-message" id="locationError"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="required-label">Property Name</label>
              <input type="text" id="propertyName" name="name" placeholder="Example Property" required>
              <div class="error-message" id=""></div>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Property Type</label>
              <div class="property-type-options">
                <div class="property-type-option selected" data-type="House">House</div>
                <div class="property-type-option" data-type="Apartment">Apartment</div>
                <div class="property-type-option" data-type="Condo">Condo</div>
                <div class="property-type-option" data-type="Land">Land</div>
              </div>
              <input type="hidden" id="propertyType" name="property_description" value="House">
            </div>
          </div>

          <div class="form-row triple">
            <div class="form-group">
              <label class="required-label">Bedrooms</label>
              <select id="bedrooms" name="bed_no" required>
                <option value="">Select</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5+</option>
              </select>
              <div class="error-message" id="bedroomsError"></div>
            </div>
            <div class="form-group">
              <label class="required-label">Total Rooms</label>
              <select id="rooms" name="room_no" required>
                <option value="">Select</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8+</option>
              </select>
              <div class="error-message" id="roomsError"></div>
            </div>
            <div class="form-group">
              <label class="required-label">Bathrooms</label>
              <select id="bathrooms" name="baths_no" required>
                <option value="">Select</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="1.5">1.5</option>
                <option value="2">2</option>
                <option value="2.5">2.5</option>
                <option value="3">3</option>
                <option value="3.5">3.5+</option>
              </select>
              <div class="error-message" id="bathroomsError"></div>
            </div>
          </div>
          <div class="form-row double">
            <div class="form-group">
              <label class="required-label">Size (m²) </label>
              <input type="number" id="size1M" name="size1M" placeholder="" required>
              <div class="error-message" id="dimensionsError"></div>
            </div>
          </div>

          <div class="form-group">
            <label>Asking Price (₱)</label>
            <input type="number" id="price" name="price" placeholder="Your expected selling price">
          </div>


          <div class="form-row">
            <div class="form-group">
              <label>Property Description</label>
              <textarea id="description" name="property_type" rows="4" placeholder="Share special features, renovations, or other details that make your property stand out"></textarea>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label>Property Photos</label>
              <div class="upload-area" id="uploadArea">
                <div class="upload-icon">📷</div>
                <p class="upload-text">Drag & drop photos here or <span>browse files</span></p>
                <p class="upload-text" style="font-size: 0.8rem; margin-top: 0.5rem;">Add up to 10 high-quality photos (Max 5MB each)</p>
                <input type="file" id="propertyPhotos" name="propertyPhotos" accept="image/*" style="display: none;">
              </div>
              <div class="thumbnails" id="thumbnailsContainer"></div>
            </div>
          </div>

          <button type="submit" id="submitButton">Submit Property Listing</button>
        </form>

        <div class="mini-popover" id="messageSentPopover">
          <i class="fas fa-check-circle wishlist-popover-icon"></i>
          <p>Property listing submitted!</p>
        </div>

      </section>
    </div>
  </div>


  <!-- SELLER BENEFITS  -->
  <section class="seller-benefits">
    <div class="benefits-header">
      <h2>Why Sell With Us</h2>
      <p class="subtitle">Get the best results for your property with our proven selling process</p>
    </div>

    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 15L8.5 8L15.5 8L12 15Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M19 6.5L19 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M5 6.5L5 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          </svg>
        </div>
        <h3>Premium Exposure</h3>
        <p>We list your property on 15+ top real estate platforms including our exclusive network of international buyers.</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M21 21H3V3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M19 5L13 11L9 7L3 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <h3>Smart Pricing</h3>
        <p>Our AI-powered valuation tool helps you price competitively while maximizing your return.</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="12" cy="12" r="3.25" stroke="currentColor" stroke-width="1.5" />
            <path d="M12 5V3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M12 21V19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M5 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M21 12H19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
          </svg>
        </div>
        <h3>Professional Media</h3>
        <p>Free professional photography, 3D tours, and video walkthroughs included with every listing.</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.5 6L12.875 2.375C12.375 1.875 11.625 1.875 11.125 2.375L7.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M20 9V17.8C20 18.9201 20 19.4802 19.782 19.908C19.5903 20.2843 19.2843 20.5903 18.908 20.782C18.4802 21 17.9201 21 16.8 21H7.2C6.0799 21 5.51984 21 5.09202 20.782C4.71569 20.5903 4.40973 20.2843 4.21799 19.908C4 19.4802 4 18.9201 4 17.8V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <h3>Dedicated Agent</h3>
        <p>Your personal selling specialist handles everything from showings to negotiations.</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <h3>Fast Closings</h3>
        <p>Average 28-day closing timeline with our streamlined paperwork process.</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3V21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
            <path d="M16.5 7.5C16.5 7.5 15 9 12 9C9 9 7.5 7.5 7.5 7.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M7.5 16.5C7.5 16.5 9 15 12 15C15 15 16.5 16.5 16.5 16.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </div>
        <h3>Competitive Fees</h3>
        <p>Only 1.5% commission - significantly lower than traditional brokerages.</p>
      </div>
    </div>

    <div class="cta-container">
      <a href="#recently-sold" class="cta-button">
        <span>View Recently Sold</span>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M5 12H19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <path d="M12 5L19 12L12 19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </a>
    </div>
  </section>

  <!-- RECENTLEY SOLD -->
  <section id="recently-sold" class="sold-section">
    <div class="sold-container">
      <div class="sold-header">
        <div class="sold-title-container">
          <div class="sold-subtitle">Bicol Real Estate Success</div>
          <h2>Recently Sold in Albay</h2>
        </div>

        <div class="sold-controls">
          <button class="sold-arrow sold-prev">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
          </button>
          <button class="sold-arrow sold-next">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>

      <div class="sold-carousel">
        <!-- Sold Property 1 - Daraga -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=800&q=80" alt="Daraga Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱5,200,000 <span class="sold-price-highlight">15% Above Market</span></div>
            <div class="sold-address">123 Rizal Street, Daraga, Albay</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">4</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">3</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">220</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 2 - Legazpi -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80" alt="Legazpi Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱3,750,000 <span class="sold-price-highlight">Mayon View</span></div>
            <div class="sold-address">45 Peñaranda Street, Legazpi City</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">3</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">2</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">180</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 3 - Salvacion -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" alt="Salvacion Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱2,100,000 <span class="sold-price-highlight">Fast Sale</span></div>
            <div class="sold-address">78 Coconut Lane, Salvacion, Albay</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">2</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">1</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">120</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 4 - Camalig -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80" alt="Camalig Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱4,500,000 <span class="sold-price-highlight">Farmhouse</span></div>
            <div class="sold-address">12 Volcano Road, Camalig, Albay</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">3</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">2</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">250</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 5 - Tabaco -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1605276374104-dee2a0ed3cd6?auto=format&fit=crop&w=800&q=80" alt="Tabaco Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱6,800,000 <span class="sold-price-highlight">Waterfront</span></div>
            <div class="sold-address">34 Seaside Drive, Tabaco City</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">5</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">4</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">350</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 6 - Guinobatan -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=800&q=80" alt="Guinobatan Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱3,200,000 <span class="sold-price-highlight">Heritage Home</span></div>
            <div class="sold-address">91 Old Town Road, Guinobatan</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">4</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">3</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">200</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 7 - Malilipot -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1513584684374-8bab748fbf90?auto=format&fit=crop&w=800&q=80" alt="Malilipot Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱2,800,000 <span class="sold-price-highlight">Hilltop View</span></div>
            <div class="sold-address">56 Sunset Boulevard, Malilipot</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">3</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">2</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">170</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Sold Property 8 - Polangui -->
        <div class="sold-card">
          <div class="sold-image-container">
            <div class="sold-tag">Sold</div>
            <img src="https://images.unsplash.com/photo-1505843513577-22bb7d21e455?auto=format&fit=crop&w=800&q=80" alt="Polangui Home">
          </div>
          <div class="sold-info">
            <div class="sold-price">₱1,950,000 <span class="sold-price-highlight">Starter Home</span></div>
            <div class="sold-address">23 Magsaysay Avenue, Polangui</div>
            <div class="sold-details">
              <div class="sold-detail">
                <div class="sold-detail-value">2</div>
                <div class="sold-detail-label">Beds</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">1</div>
                <div class="sold-detail-label">Baths</div>
              </div>
              <div class="sold-detail">
                <div class="sold-detail-value">110</div>
                <div class="sold-detail-label">m2</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="sold-progress">
        <div class="sold-progress-bar" style="width: 20%;"></div>
      </div>
    </div>
    </div>
  </section>

  <!-- TOP-BUTTON -->
  <?php include '../Includes/top-button.php'; ?>

  <!-- FOOTER -->
  <?php include '../Includes/footer.php'; ?>


  <script src="../js/sell.js"></script>
  <script src="../js/sell-form.js"></script>
  <script src="../js/sell-carousel.js"></script>

</body>

</html>