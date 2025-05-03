<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kabalayan - Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./styles/home.css">
    <link rel="stylesheet" href="./styles/property-listings.css">
    <link rel="stylesheet" href="./styles/faq.css">
</head>

<body>
    <!-- LOADER -->
    <?php include './Includes/loader.php'; ?>
    <!-- NAVBAR -->
    <header>
        <div class="logo">
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

    <section class="hero">
        <div class="hero-text">
            <h1>Guiding your path <br> to a new home in Albay.</h1>
        </div>
        <div class="hero-info">
            <p>©2025 KABALAYAN. ALL RIGHTS RESERVED</p>
            <p>With expert guidance and a deep understanding of Albay's real estate landscape, we make your
                journey to a new home seamless and stress-free.</p>
        </div>
    </section>

    <div class="image-banner"
        style="background-image: url('https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?q=80&w=2075&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
        <div class="search-bar">
            <div class="input-group">
                <input type="text" id="search-input" placeholder="What to look for?" />
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

            <button onclick="window.location.href='./pages/buy.php'">Search</button>
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
            <p>Bicol, Albay</p>
        </div>

        <div class="carousel-wrapper">
            <div class="listings" role="list">
                <div class="listing-item" role="listitem">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1950&q=80" alt="Modern house with garden in Legazpi City">
                    <div class="listing-details">
                        <h3 class="listing-name">Casa de Legazpi</h3>
                        <div class="listing-location">
                            <i class="fas fa-location-dot" aria-hidden="true"></i>
                            <p>Legazpi City, Albay</p>
                        </div>
                    </div>
                </div>
                <div class="listing-item" role="listitem">
                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1950&q=80" alt="Contemporary home with large windows in Daraga Heights">
                    <div class="listing-details">
                        <h3 class="listing-name">Daraga Heights Residence</h3>
                        <div class="listing-location">
                            <i class="fas fa-location-dot" aria-hidden="true"></i>
                            <p>Daraga, Albay</p>
                        </div>
                    </div>
                </div>
                <div class="listing-item" role="listitem">
                    <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1950&q=80" alt="Elegant luxury home in Ligao Estates">
                    <div class="listing-details">
                        <h3 class="listing-name">Ligao Estates</h3>
                        <div class="listing-location">
                            <i class="fas fa-location-dot" aria-hidden="true"></i>
                            <p>Ligao City, Albay</p>
                        </div>
                    </div>
                </div>
                <div class="listing-item" role="listitem">
                    <img src="https://images.unsplash.com/photo-1600607688969-a5bfcd646154?auto=format&fit=crop&w=1950&q=80" alt="Luxury apartment in Tabaco Bayview Condos">
                    <div class="listing-details">
                        <h3 class="listing-name">Tabaco Bayview Condos</h3>
                        <div class="listing-location">
                            <i class="fas fa-location-dot" aria-hidden="true"></i>
                            <p>Tabaco City, Albay</p>
                        </div>
                    </div>
                </div>
                <div class="listing-item" role="listitem">
                    <img src="https://images.unsplash.com/photo-1600566753104-685f4f24cb4d?auto=format&fit=crop&w=1950&q=80" alt="Beautiful beachfront villa in Sto. Domingo Shores">
                    <div class="listing-details">
                        <h3 class="listing-name">Sto. Domingo Shores</h3>
                        <div class="listing-location">
                            <i class="fas fa-location-dot" aria-hidden="true"></i>
                            <p>Sto. Domingo, Albay</p>
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

    <!-- CONTACT -->
    <?php include './Includes/contact.php'; ?>

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
                <div class="faq-categories">
                    <div class="faq-category" data-category="buying">
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

                <div class="faq-questions-container">
                    <div class="faq-questions" id="buyingQuestions">
                        <div class="faq-item">
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
                                    <li><strong>Home inspection:</strong> ₱15,000-₱25,000 depending on property size and location</li>
                                    <li><strong>Property taxes:</strong> Varies by location, often prorated at closing</li>
                                    <li><strong>Homeowners insurance:</strong> Average annual premium ranges from ₱40,000-₱75,000</li>
                                    <li><strong>Moving expenses:</strong> ₱50,000-₱250,000 depending on distance and volume</li>
                                    <li><strong>Home repairs/improvements:</strong> Budget 1-3% of home value annually</li>
                                    <li><strong>HOA fees:</strong> If applicable, can range from ₱5,000-₱35,000+ monthly</li>
                                    <li><strong>Utilities setup:</strong> Deposits and transfer fees may apply</li>
                                </ul>
                                <p>We recommend setting aside 1-3% of your home's value in an emergency fund for unexpected repairs or maintenance needs. Our team can help you create a comprehensive budget tailored to your specific property.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-questions" id="sellingQuestions">
                        <div class="faq-item">
                            <button class="faq-question">How do I prepare my home for sale?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>To prepare your home for sale:</strong></p>
                                <ul>
                                    <li>Declutter and depersonalize rooms</li>
                                    <li>Make minor repairs and improvements</li>
                                    <li>Enhance curb appeal with landscaping</li>
                                    <li>Deep clean the entire home</li>
                                    <li>Stage key areas to highlight potential</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">What are the costs involved in selling a property?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>Common selling costs include:</strong></p>
                                <ul>
                                    <li>Agent commission (typically 5-6%)</li>
                                    <li>Closing costs and legal fees</li>
                                    <li>Repairs and staging expenses</li>
                                    <li>Outstanding property taxes</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How is the listing price determined?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>We assess:</strong></p>
                                <ul>
                                    <li>Recent comparable sales</li>
                                    <li>Current market trends</li>
                                    <li>Property condition and features</li>
                                    <li>Location and neighborhood demand</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How long will it take to sell my home?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>The average time to sell depends on:</strong></p>
                                <ul>
                                    <li>Pricing and market conditions</li>
                                    <li>Buyer demand and seasonality</li>
                                    <li>Marketing strategy</li>
                                </ul>
                                <p>We provide a tailored timeline estimate.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-questions" id="financingQuestions">
                        <div class="faq-item">
                            <button class="faq-question">What types of home loans are available?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <ul>
                                    <li>Fixed-rate and adjustable-rate mortgages (ARM)</li>
                                    <li>FHA, VA, and USDA loans</li>
                                    <li>Jumbo loans for high-value properties</li>
                                    <li>First-time buyer assistance programs</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How do I get pre-approved for a mortgage?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p>Submit financial documents (income, assets, debts) to a lender, who will assess your creditworthiness and provide a pre-approval letter indicating your borrowing power.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">What credit score is needed to buy a home?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>Minimum credit scores vary:</strong></p>
                                <ul>
                                    <li>620+ for conventional loans</li>
                                    <li>580+ for FHA loans (3.5% down)</li>
                                    <li>No minimum for VA loans, but 620 is typical</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Can I buy a home with no down payment?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p>Yes. VA and USDA loans offer 0% down payment options for qualified buyers. Some state programs may also assist with down payments.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-questions" id="managementQuestions">
                        <div class="faq-item">
                            <button class="faq-question">What services do property managers provide?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <ul>
                                    <li>Tenant screening and leasing</li>
                                    <li>Rent collection and financial reporting</li>
                                    <li>Maintenance and repairs</li>
                                    <li>Legal compliance and evictions</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How are maintenance issues handled?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p>We coordinate with trusted vendors to respond quickly to maintenance requests and ensure cost-effective, high-quality service for repairs.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How much does property management cost?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>Fees vary by service level, but typically include:</strong></p>
                                <ul>
                                    <li>Monthly management fee (6-10% of rent)</li>
                                    <li>Leasing and renewal fees</li>
                                    <li>Maintenance surcharges, if applicable</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Can I monitor my property remotely?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p>Yes, we offer digital owner portals for real-time access to reports, tenant updates, and financial statements.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-questions" id="investmentQuestions">
                        <div class="faq-item">
                            <button class="faq-question">What types of real estate investments exist?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <ul>
                                    <li>Rental properties (residential/commercial)</li>
                                    <li>Flipping properties</li>
                                    <li>Real Estate Investment Trusts (REITs)</li>
                                    <li>Vacation rentals or Airbnbs</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">How do I know if a property is a good investment?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p><strong>Analyze:</strong></p>
                                <ul>
                                    <li>Cash flow and ROI</li>
                                    <li>Rental demand and vacancy rates</li>
                                    <li>Location trends and appreciation</li>
                                    <li>Maintenance and management costs</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">What are the risks of investing in real estate?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <ul>
                                    <li>Market volatility</li>
                                    <li>Property damage and tenant issues</li>
                                    <li>Unexpected repair or legal costs</li>
                                    <li>Low liquidity compared to stocks</li>
                                </ul>
                            </div>
                        </div>
                        <div class="faq-item">
                            <button class="faq-question">Should I invest locally or out-of-state?<span class="faq-indicator"><i class="fa-solid fa-angle-down"></i></span></button>
                            <div class="faq-answer">
                                <p>Local investments offer easier oversight. Out-of-state properties may offer better ROI but require more research and professional property management.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="faq-cta">
                <h3>Still Have Questions?</h3>
                <p>Our real estate experts are ready to provide personalized answers to your specific questions and guide you through every step of your property journey.</p>
                <div class="faq-cta-buttons">
                    <a href="#contact" class="btn btn-primary" onclick="showContactPopover(); return false;">Contact an Expert</a>
                    <a href="#schedule" class="btn btn-outline" onclick="showSchedulePopover(); return false;">Schedule a Consultation</a>
                </div>
            </div>

            <!-- Popover for Contact Expert -->
            <div id="contactExpertPopover" class="cta-sent-popover">
                <div class="popover-content">
                    <div class="success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                    </div>
                    <h3>Message Sent!</h3>
                    <p>Your contact request has been received. One of our experts will get back to you within 24 hours.</p>
                    <button class="popover-close-btn" onclick="closePopover('contactExpertPopover')">Got It</button>
                </div>
            </div>

            <!-- Popover for Schedule Consultation -->
            <div id="scheduleConsultationPopover" class="cta-sent-popover">
                <div class="popover-content">
                    <div class="success-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3>Consultation Scheduled!</h3>
                    <p>We've received your request. You'll receive a confirmation email with available time slots shortly.</p>
                    <button class="popover-close-btn" onclick="closePopover('scheduleConsultationPopover')">Got It</button>
                </div>
            </div>
        </div>
    </section>


    <?php include './Includes/top-button.php'; ?>

    <footer class="footer">
        <div class="footer-container">
            <div class="footer-left">©2025 KABALAYAN. ALL RIGHTS RESERVED</div>
            <div class="footer-center">
                <a href="./index.php">Home</a>
                <a href="./pages/buy.php">Buy</a>
                <a href="./pages/sell.php">Sell</a>
                <a href="./pages/about.php">About Us</a>
            </div>
            <div class="footer-right">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>

    <script src="./js/home.js"></script>
    <script src="./js/nav.js"></script>
    <script src="./js/property-listings.js"></script>

</body>

</html>