<?php

include_once '../php/db_conn.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
   // header("Location: ../Login_Page/index.php");  // Redirect if not logged in
    //exit();
}
$stmt = $conn->prepare("SELECT * from listings WHERE property_status = 'sold'");
$stmt->execute();
$result = $stmt->get_result();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>//NAME// Sell</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>
  <link rel="stylesheet" href="sell.css" />
  <link rel="stylesheet" href="sell-carousel.css">
  <link rel="stylesheet" href="sell-form.css">
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
  <div class="logo">NAME</div>
  <nav id="navbar" class="navbar">
    <ul>
      <li>
        <button id="close-sidebar-button" aria-label="close sidebar">
          <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#c9c9c9">
            <path d="m480-444.62-209.69 209.7q-7.23 7.23-17.5 7.42-10.27.19-17.89-7.42-7.61-7.62-7.61-17.7 0-10.07 7.61-17.69L444.62-480l-209.7-209.69q-7.23-7.23-7.42-17.5-.19-10.27 7.42-17.89 7.62-7.61 17.7-7.61 10.07 0 17.69 7.61L480-515.38l209.69-209.7q7.23-7.23 17.5-7.42 10.27-.19 17.89 7.42 7.61 7.62 7.61 17.7 0 10.07-7.61 17.69L515.38-480l209.7 209.69q7.23 7.23 7.42 17.5.19 10.27-7.42 17.89-7.62 7.61-17.7 7.61-10.07 0-17.69-7.61L480-444.62Z"/>
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
    <a href="/Profile/profile.html">Profile</a>
    <button id="open-sidebar-button" aria-label="open sidebar" aria-expanded="false" aria-controls="navbar">
      <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#c9c9c9">
        <path d="M165.13-254.62q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.86q7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.87q-7.22 7.12-17.9 7.12H165.13Zm0-200.25q-10.68 0-17.9-7.27-7.23-7.26-7.23-17.99 0-10.74 7.23-17.87 7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.27 7.23 7.26 7.23 17.99 0 10.74-7.23 17.87-7.22 7.13-17.9 7.13H165.13Zm0-200.26q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.87q7.22-7.12 17.9-7.12h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.86q-7.22 7.13-17.9 7.13H165.13Z"/>
      </svg>
    </button>
  </div>
</header>
<!-- NAV -->

<!-- SELL BANNER -->
BANNER
<section class="banner">

</section>

SELL
<div class="container">
  <div class="page-title">
    <h1>List Your Property</h1>
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
        <h3>Why Sell With Us</h3>
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
    <section class="listing-form-section">
      <div class="form-header">
        <h2>List Your Property</h2>
        <p>Fill out the form below to get started</p>
      </div>
      
      <form class="contact-form" id="propertyForm">
        <div class="form-row double">
          <div class="form-group">
            <label class="required-label">Full Name</label>
            <input type="text" id="fullName" name="fullName" required>
            <div class="error-message" id="fullNameError"></div>
          </div>
          <div class="form-group">
            <label class="required-label">Contact Number</label>
            <input type="tel" id="contactNumber" name="contactNumber" required>
            <div class="error-message" id="contactNumberError"></div>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="email" name="email">
            <div class="error-message" id="emailError"></div>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label class="required-label">Property Location</label>
            <input type="text" id="propertyLocation" name="location" placeholder="Street address, City, State, ZIP" required>
            <div class="error-message" id="locationError"></div>
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
            <input type="hidden" id="propertyType" name="propertyType" value="House">
          </div>
        </div>
        
        <div class="form-row triple">
          <div class="form-group">
            <label class="required-label">Bedrooms</label>
            <select id="bedrooms" name="bed_no" required>
              <option value="">Select</option>
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
            <label class="required-label">Square Feet</label>
            <input type="number" id="squareFeet" name="dimensions" placeholder="Total square footage" required>
            <div class="error-message" id="dimensionsError"></div>
          </div>
          <div class="form-group">
            <label>Asking Price ($)</label>
            <input type="number" id="price" name="price" placeholder="Your expected selling price">
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label>Property Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Share special features, renovations, or other details that make your property stand out"></textarea>
          </div>
        </div>
        
        <div class="form-row">
          <div class="form-group">
            <label>Property Photos</label>
            <div class="upload-area" id="uploadArea">
              <div class="upload-icon">📷</div>
              <p class="upload-text">Drag & drop photos here or <span>browse files</span></p>
              <p class="upload-text" style="font-size: 0.8rem; margin-top: 0.5rem;">Add up to 10 high-quality photos (Max 5MB each)</p>
              <input type="file" id="propertyPhotos" name="photos" accept="image/*" multiple style="display: none;">
            </div>
            <div class="thumbnails" id="thumbnailsContainer"></div>
          </div>
        </div>
        
        <button type="submit" id="submitButton">Submit Property Listing</button>
      </form>
    </section>
  </div>
</div>

















  <!-- Recently Sold Section -->
  <section class="sold-section">
    <div class="sold-container">
      <div class="sold-header">
        <div class="sold-title-container">
          <div class="sold-subtitle">Real Estate Success</div>
          <h2>Recently Sold Properties</h2>
        </div>
        <a href="#" class="sold-view-all">View full archive</a>
      </div>
      
      <div class="sold-carousel-container">
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
        
        <div class="sold-carousel">
          <!-- Sold Property 1 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱2,450,000 <span class="sold-price-highlight">20% Above Market</span></div>
              <div class="sold-address">2911 Quiet Plain Dr, San Antonio</div>
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
                  <div class="sold-detail-value">1,450</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Sold Property 2 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱3,100,000 <span class="sold-price-highlight">15% Above Market</span></div>
              <div class="sold-address">1234 Oak Street, San Antonio</div>
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
                  <div class="sold-detail-value">2,100</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 3 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱4,750,000 <span class="sold-price-highlight">30% Above Market</span></div>
              <div class="sold-address">578 Pine Valley Road, San Antonio</div>
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
                  <div class="sold-detail-value">3,200</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 4 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱1,875,000 <span class="sold-price-highlight">Fast Sale</span></div>
              <div class="sold-address">123 Meadow Lane, San Antonio</div>
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
                  <div class="sold-detail-value">980</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 5 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱5,200,000 <span class="sold-price-highlight">Luxury Home</span></div>
              <div class="sold-address">427 Highland Avenue, San Antonio</div>
              <div class="sold-details">
                <div class="sold-detail">
                  <div class="sold-detail-value">6</div>
                  <div class="sold-detail-label">Beds</div>
                </div>
                <div class="sold-detail">
                  <div class="sold-detail-value">5</div>
                  <div class="sold-detail-label">Baths</div>
                </div>
                <div class="sold-detail">
                  <div class="sold-detail-value">4,350</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 6 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱2,960,000 <span class="sold-price-highlight">10% Above Market</span></div>
              <div class="sold-address">815 Sunshine Road, San Antonio</div>
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
                  <div class="sold-detail-value">2,100</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 7 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1576941089067-2de3c901e126?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱1,650,000 <span class="sold-price-highlight">Townhouse</span></div>
              <div class="sold-address">942 Central Avenue, San Antonio</div>
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
                  <div class="sold-detail-value">1,340</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 8 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱3,400,000 <span class="sold-price-highlight">Waterfront</span></div>
              <div class="sold-address">76 Lake View Drive, San Antonio</div>
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
                  <div class="sold-detail-value">2,780</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 9 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1513584684374-8bab748fbf90?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱1,290,000 <span class="sold-price-highlight">First-time Buyer</span></div>
              <div class="sold-address">534 Maple Court, San Antonio</div>
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
                  <div class="sold-detail-value">925</div>
                  <div class="sold-detail-label">Sq Ft</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Sold Property 10 -->
          <div class="sold-card">
            <div class="sold-image-container">
              <div class="sold-tag">Sold</div>
              <img src="https://images.unsplash.com/photo-1505843513577-22bb7d21e455?auto=format&fit=crop&w=800&q=80" alt="Sold Home">
            </div>
            <div class="sold-info">
              <div class="sold-price">₱7,250,000 <span class="sold-price-highlight">Estate</span></div>
              <div class="sold-address">1290 Hilltop Road, San Antonio</div>
              <div class="sold-details">
                <div class="sold-detail">
                  <div class="sold-detail-value">7</div>
                  <div class="sold-detail-label">Beds</div>
                </div>
                <div class="sold-detail">
                  <div class="sold-detail-value">6</div>
                  <div class="sold-detail-label">Baths</div>
                </div>
                <div class="sold-detail">
                  <div class="sold-detail-value">5,800</div>
                  <div class="sold-detail-label">Sq Ft</div>
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












FAQ
<!-- SELL FAQ -->
<section class="faq-section">
  <h2>Frequently Asked Questions</h2>
  <div class="faq-item">
    <h3>Is there a fee to list my property?</h3>
    <p>Listing your property with us is free. We only charge a small commission once your property is sold.</p>
  </div>
  <div class="faq-item">
    <h3>How do I know if my property is eligible?</h3>
    <p>We accept residential, commercial, and rental properties. Submit the form and we’ll review your info.</p>
  </div>
  <div class="faq-item">
    <h3>How long does it take to sell?</h3>
    <p>It depends on your location, pricing, and demand. Most sellers get serious inquiries within a few days.</p>
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

<script>
    window.addEventListener('load', () => {
      const loader = document.getElementById('page-loader');
      loader.classList.add('fade-out');
    });
</script>

<script src="sell.js"></script>
<script src="sell-form.js"></script>
<script src="sell-carousel.js"></script>
</body>
</html>
