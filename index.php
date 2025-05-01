<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="./styles/property-listings.css">
    <link rel="stylesheet" href="./styles/faq.css">
</head>

<body>
    <!-- Loader -->
    <?php include './Includes/loader.php'; ?>
    <!-- Navbar -->
    <header>
    <div class="logo">
        <!-- <img src="/mnt/data/LANDINGPAGE.webp" alt="logo" style="height:40px;"> -->
        KABALAYAN
    </div>

    <nav id="navbar" class="navbar">
        <ul>
            <li>
                <button id="close-sidebar-button" onclick="closeSidebar()" aria-label="close sidebar">
                    <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                        fill="#c9c9c9">
                        <path
                            d="m480-444.62-209.69 209.7q-7.23 7.23-17.5 7.42-10.27.19-17.89-7.42-7.61-7.62-7.61-17.7 0-10.07 7.61-17.69L444.62-480l-209.7-209.69q-7.23-7.23-7.42-17.5-.19-10.27 7.42-17.89 7.62-7.61 17.7-7.61 10.07 0 17.69 7.61L480-515.38l209.69-209.7q7.23-7.23 17.5-7.42 10.27-.19 17.89 7.42 7.61 7.62 7.61 17.7 0 10.07-7.61 17.69L515.38-480l209.7 209.69q7.23 7.23 7.42 17.5.19 10.27-7.42 17.89-7.62 7.61-17.7 7.61-10.07 0-17.69-7.61L480-444.62Z" />
                    </svg>
                </button>
            </li>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./pages/buy.php">Buy</a></li>
            <li><a href="./pages/sell.php">Sell</a></li>
            <li><a href="./pages/about.php">About Us</a></li>
        </ul>
    </nav>

    <div class="header-actions">
        <a href="./pages/profile.php">Profile</a>
        <button id="open-sidebar-button" onclick="openSidebar()" aria-label="open sidebar" aria-expanded="false"
            aria-controls="navbar">
            <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px"
                fill="#c9c9c9">
                <path
                    d="M165.13-254.62q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.86q7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.87q-7.22 7.12-17.9 7.12H165.13Zm0-200.25q-10.68 0-17.9-7.27-7.23-7.26-7.23-17.99 0-10.74 7.23-17.87 7.22-7.13 17.9-7.13h629.74q10.68 0 17.9 7.27 7.23 7.26 7.23 17.99 0 10.74-7.23 17.87-7.22 7.13-17.9 7.13H165.13Zm0-200.26q-10.68 0-17.9-7.26-7.23-7.26-7.23-18t7.23-17.87q7.22-7.12 17.9-7.12h629.74q10.68 0 17.9 7.26 7.23 7.26 7.23 18t-7.23 17.86q-7.22 7.13-17.9 7.13H165.13Z" />
            </svg>
        </button>
    </div>
</header>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-text">
            <h1>Guiding your path <br> to a new home in Albay.</h1>
        </div>
        <div class="hero-info">
            <p>©2025 KABALAYAN. ALL RIGHTS RESERVED</p>
            <p>With expert guidance and a deep understanding of Albay!'s real estate landscape, we make your
                journey to a new home seamless and stress-free.</p>
        </div>
    </section>

    <!-- BANNER -->
    <div class="image-banner"
        style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1950&q=80');">
        <div class="search-bar">
            <div class="input-group">
                <input type="text" id="search-input" placeholder="What to look for?"/>
            </div>

            <div class="input-group">
                <select id="property-type">
                    <option>Property Type</option>
                    <option>House</option>
                    <option>Apartment</option>
                    <option>Villa</option>
                </select>
            </div>

            <div class="input-group">
                <select id="price">
                    <option>Price</option>
                    <option>₱100K - ₱200K</option>
                    <option>₱200K - ₱500K</option>
                    <option>₱500K+</option>
                </select>
            </div>

            <div class="input-group">
                <select id="cities">
                    <option>All Cities</option>
                    <option>Kanto 10</option>
                    <option>Baranggay Lovestories</option>
                    <option>Sitio Pa</option>
                </select>
            </div>

            <button>Search</button>
        </div>
    </div>

    <!-- INTRO -->
<section class="intro-image">
    <div class="overlay"></div>
    
    <div class="header-container">
        <span class="pre-heading">Welcome to</span>
        <h1>KABALAYAN</h1>
    </div>
    
    <div class="info-container">
        <div class="intro-content">
            <p>Discover the lifestyle and luxury that we offer, with bespoke properties designed for comfort,
                elegance, and modern living in Albay's prime locations.</p>
            <a href="#listings" class="cta-button">Explore Our Properties</a>
        </div>
    </div>
</section>


    <!-- LISTINGS -->
    <section id="listings" class="property-listings" aria-label="Property listings carousel">
        <h1>Explore Our Property Listings</h1>
        <p class="subtitle">From cozy apartments to spacious family homes, our diverse listings cater to various needs and preferences.</p>

    <div class="location-selector" role="button" tabindex="0">
        <i class="fas fa-location-dot" aria-hidden="true"></i>
        <p>Albay, basta</p>
    </div>

    <div class="carousel-wrapper">
        <div class="listings" role="list">
        <div class="listing-item" role="listitem">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1950&q=80" alt="Modern house with garden in Griya Tamansari">
            <div class="listing-details">
            <h3 class="listing-name">Griya Tamansari</h3>
            <div class="listing-location">
                <i class="fas fa-location-dot" aria-hidden="true"></i>
                <p>Jan Lang, Albay</p>
            </div>
            </div>
        </div>
        <div class="listing-item" role="listitem">
            <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1950&q=80" alt="Contemporary home with large windows in Griya Asri Tamansari">
            <div class="listing-details">
            <h3 class="listing-name">Griya Asri Tamansari</h3>
            <div class="listing-location">
                <i class="fas fa-location-dot" aria-hidden="true"></i>
                <p>Sa May, Albay</p>
            </div>
            </div>
        </div>
        <div class="listing-item" role="listitem">
            <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1950&q=80" alt="Elegant luxury home in Permata Indah Residence">
            <div class="listing-details">
            <h3 class="listing-name">Permata Indah Residence</h3>
            <div class="listing-location">
                <i class="fas fa-location-dot" aria-hidden="true"></i>
                <p>Bago Mag, Albay</p>
            </div>
            </div>
        </div>
        <div class="listing-item" role="listitem">
            <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1950&q=80" alt="Luxury apartment in Paradise Residence">
            <div class="listing-details">
            <h3 class="listing-name">Paradise Residence</h3>
            <div class="listing-location">
                <i class="fas fa-location-dot" aria-hidden="true"></i>
                <p>Lagpas, Albay</p>
            </div>
            </div>
        </div>
        <div class="listing-item" role="listitem">
            <img src="https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=1950&q=80" alt="Beautiful beachfront villa in Sunset Villa">
            <div class="listing-details">
            <h3 class="listing-name">Sunset Villa</h3>
            <div class="listing-location">
                <i class="fas fa-location-dot" aria-hidden="true"></i>
                <p>Mejo Sa, Albay</p>
            </div>
            </div>
        </div>
        </div>

        <div class="carousel-controls">
        <button id="prev" class="nav-btn" aria-label="Previous slide">
            <span aria-hidden="true"><i class="fa-solid fa-angle-left"></i></span>
        </button>
        
        <div class="carousel-indicators" aria-hidden="true">
        </div>
        
        <button id="next" class="nav-btn" aria-label="Next slide">
            <span aria-hidden="true"><i class="fa-solid fa-angle-right"></i></span>
        </button>
        </div>
    </section>

    <?php include './Includes/contact.php'; ?>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="faq-container">
            <div class="faq-header">
                <div class="faq-subtitle">Knowledge Base</div>
                <h2 class="faq-title">Frequently Asked Questions</h2>
                <p class="faq-description">Get answers to the most common questions about our real estate services, property buying process, and investment opportunities.</p>
            </div>

            <div class="faq-search">
                <div class="faq-search-icon"><i class="fa-solid fa-magnifying-glass"></i></div>
                <input type="text" placeholder="Search for questions or keywords..." id="faqSearch">
            </div>

            <div class="faq-layout">
                <!-- FAQ Categories -->
                <div class="faq-categories">
                    <div class="faq-category active" data-category="buying">
                        <div class="faq-category-icon"><i class="fa-solid fa-house"></i></div>
                        <span class="faq-category-text">Buying Property</span>
                    </div>
                    <div class="faq-category" data-category="selling">
                        <div class="faq-category-icon"><i class="fa-solid fa-peso-sign"></i></div>
                        <span class="faq-category-text">Selling Property</span>
                    </div>
                    <div class="faq-category" data-category="financing">
                        <div class="faq-category-icon"><i class="fa-solid fa-credit-card"></i></div>
                        <span class="faq-category-text">Financing Options</span>
                    </div>
                    <div class="faq-category" data-category="management">
                        <div class="faq-category-icon"><i class="fa-solid fa-wrench"></i></div>
                        <span class="faq-category-text">Property Management</span>
                    </div>
                    <div class="faq-category" data-category="investment">
                        <div class="faq-category-icon"><i class="fa-solid fa-piggy-bank"></i></div>
                        <span class="faq-category-text">Investment Advice</span>
                    </div>
                </div>

                <!-- FAQ Questions -->
                <div class="faq-questions" id="buyingQuestions">
                    <div class="faq-item active">
                        <button class="faq-question">
                            How do I start the process of buying a property?
                            <span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            <p>The home buying process typically follows these key steps:</p>
                            <ul>
                                <li><strong>Define your needs:</strong> Determine your budget, preferred locations, and must-have features.</li>
                                <li><strong>Get pre-approved for financing:</strong> Speak with lenders to understand how much you can borrow.</li>
                                <li><strong>Work with an agent:</strong> Our expert agents will help you find properties that match your criteria.</li>
                                <li><strong>View properties:</strong> We'll arrange personalized tours of homes that meet your requirements.</li>
                                <li><strong>Make an offer:</strong> Once you find the right property, we'll help you prepare and submit a compelling offer.</li>
                                <li><strong>Complete due diligence:</strong> Conduct inspections and review all property documents.</li>
                                <li><strong>Close the deal:</strong> Finalize paperwork, secure financing, and receive the keys to your new home!</li>
                            </ul>
                            <p>Our dedicated team will guide you through each step to ensure a smooth and successful purchase.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            What should I look for when viewing a property?
                            <span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            <p>When viewing a property, pay attention to these important factors:</p>
                            <ul>
                                <li><strong>Location and neighborhood:</strong> Assess the surrounding area, proximity to amenities, schools, transportation, and safety.</li>
                                <li><strong>Structural integrity:</strong> Check for signs of damage, water issues, or foundation problems.</li>
                                <li><strong>Space and layout:</strong> Consider if the floor plan meets your needs and lifestyle requirements.</li>
                                <li><strong>Natural light and orientation:</strong> Notice how light enters the property throughout the day.</li>
                                <li><strong>Systems and appliances:</strong> Examine the condition of HVAC, electrical, plumbing, and included appliances.</li>
                                <li><strong>Storage space:</strong> Evaluate if there's sufficient storage for your belongings.</li>
                                <li><strong>Noise levels:</strong> Pay attention to sounds from neighbors, streets, or other potential disturbances.</li>
                                <li><strong>Future potential:</strong> Consider possibilities for renovation or expansion if relevant to your plans.</li>
                            </ul>
                            <p>Our agents accompany you during viewings to help identify important features and potential concerns that might not be immediately obvious.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            How much do I need for a down payment?
                            <span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            <p>Down payment requirements vary based on several factors:</p>
                            <ul>
                                <li><strong>Conventional loans:</strong> Typically require 5-20% of the purchase price</li>
                                <li><strong>FHA loans:</strong> May allow down payments as low as 3.5%</li>
                                <li><strong>VA loans:</strong> Often require no down payment for eligible veterans</li>
                                <li><strong>USDA loans:</strong> May offer 0% down payment options in eligible rural areas</li>
                                <li><strong>First-time homebuyer programs:</strong> Special programs may offer down payment assistance</li>
                            </ul>
                            <p>The ideal down payment amount depends on your financial situation, available cash reserves, and long-term goals. A larger down payment generally means a lower monthly mortgage payment and better loan terms. Our financial advisors can help you determine the best approach for your specific circumstances.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            How long does the buying process typically take?
                            <span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            <p>The timeline for buying a property typically ranges from 30-90 days from offer acceptance to closing, though this can vary based on several factors:</p>
                            <ul>
                                <li><strong>Financing type:</strong> Cash purchases can close faster than mortgaged transactions</li>
                                <li><strong>Property type:</strong> Single-family homes often process quicker than condos or co-ops</li>
                                <li><strong>Market conditions:</strong> Hot markets may create backlogs with lenders and inspectors</li>
                                <li><strong>Inspection findings:</strong> Issues requiring repairs can extend timelines</li>
                                <li><strong>Title issues:</strong> Resolving unexpected liens or claims can cause delays</li>
                            </ul>
                            <p>Our experienced team works diligently to expedite the process while ensuring all necessary steps are properly completed. We'll provide you with a realistic timeline based on your specific situation and keep you informed throughout the entire journey.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question">
                            What additional costs should I budget for beyond the purchase price?
                            <span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span>
                        </button>
                        <div class="faq-answer">
                            <p>When buying a property, it's important to budget for these additional costs:</p>
                            <ul>
                                <li><strong>Closing costs:</strong> Typically 2-5% of the loan amount, including loan origination fees, appraisal fees, title insurance, and legal fees</li>
                                <li><strong>Home inspection:</strong> 300-500 depending on property size and location</li>
                                <li><strong>Property taxes:</strong> Varies by location, often prorated at closing</li>
                                <li><strong>Homeowners insurance:</strong> Average annual premium ranges from 800-1,500</li>
                                <li><strong>Moving expenses:</strong> 1,000-5,000 depending on distance and volume</li>
                                <li><strong>Home repairs/improvements:</strong> Budget 1-3% of home value annually</li>
                                <li><strong>HOA fees:</strong> If applicable, can range from 100-700+ monthly</li>
                                <li><strong>Utilities setup:</strong> Deposits and transfer fees may apply</li>
                            </ul>
                            <p>We recommend setting aside 1-3% of your home's value in an emergency fund for unexpected repairs or maintenance needs. Our team can help you create a comprehensive budget tailored to your specific property.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-cta">
                <h3>Still Have Questions?</h3>
                <p>Our real estate experts are ready to provide personalized answers to your specific questions and guide you through every step of your property journey.</p>
                <div class="faq-cta-buttons">
                    <a href="#contact" class="btn btn-primary">Contact an Expert</a>
                    <a href="#schedule" class="btn btn-outline">Schedule a Consultation</a>
                </div>
            </div>
        </div>
    </section>

    <?php include './Includes/footer.php'; ?>
    
    <script src="./js/home.js"></script>
    <script src="./js/nav.js"></script>
    <script src="./js/property-listings.js"></script>
    
</body>
</html>