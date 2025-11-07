    <!-- NAVBAR -->
    <header style="max-width: 1000px;">
    <a href="/kabalayan/index.php" class="logo-link nav-icon" aria-label="Home">
        <div class="logo">
            <img src="/kabalayan/assets/logolightmode.png" alt="Kabalayan Logo" class="logo-image light-logo">
            <img src="/kabalayan/assets/logodarkmode.png" alt="Kabalayan Logo" class="logo-image dark-logo" style="display: none;">
        </div>
    </a>

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
            <li>
                <a href="/kabalayan/pages/buy.php" class="nav-icon" aria-label="Buy">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <span class="tooltip">Buy</span>
                </a>
            </li>
            <li>
                <a href="/kabalayan/pages/sell.php" class="nav-icon" aria-label="Sell">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2v20"></path>
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                    <span class="tooltip">Sell</span>
                </a>
            </li>
            <li>
                <a href="/kabalayan/pages/about.php" class="nav-icon" aria-label="About Us">
                    <i class="fa-solid fa-question" style="font-size: 18px;"></i>
                    <span class="tooltip">About Us</span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="header-actions">
        <div class="nav-tooltip-container">
            <button id="theme-toggle" class="nav-icon-button" aria-label="Toggle color theme">
                <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v1"/><path d="M12 20v1"/><path d="M3 12h1"/><path d="M20 12h1"/><path d="M5.6 5.6l.7.7"/><path d="M18.4 18.4l.7.7"/><path d="M5.6 18.4l.7-.7"/><path d="M18.4 5.6l.7-.7"/><circle cx="12" cy="12" r="4"/></svg>
                <span class="tooltip" id="theme-tooltip">Dark Mode</span>
            </button>
        </div>
        <div class="nav-tooltip-container">
            <a href="/kabalayan/pages/profile.php" class="nav-icon-button profile-icon" aria-label="Profile">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                <span class="tooltip">Profile</span>
            </a>
        </div>
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

<style>
    /* Logo Styling */
    .logo-link {
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        height: 100%;
        position: relative;
        padding: 0 8px;
    }
    
    .logo {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        font-weight: 600;
        font-size: 18px;
        position: relative;
        width: 100%;
    }
    
    .logo-image {
        height: 24px;
        width: auto;
        transition: opacity 0.3s ease;
        position: relative;
        display: inline-block;
    }
    
    [data-theme="dark"] .light-logo {
        display: none;
    }
    
    [data-theme="dark"] .dark-logo {
        display: block !important;
    }
    
    [data-theme="light"] .light-logo {
        display: block !important;
    }
    
    [data-theme="light"] .dark-logo {
        display: none !important;
    }
    
    /* NAV - Floating liquid-glass pill */
    header {
        position: sticky;
        top: 8px;
        z-index: 2000;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 400px;
        max-width: 400px;
        min-width: 400px;
        padding: 6px 15px;
        margin: 8px auto;
        border: 2px solid #000000;
        border-radius: 9999px;
        background-color: var(--surface-color);
        backdrop-filter: saturate(180%) blur(10px);
        -webkit-backdrop-filter: saturate(180%) blur(10px);
        box-shadow: 0 6px 20px rgba(var(--shadow-color), 0.1);
        height: 48px;
    }

    /* Dark mode: white outline */
    [data-theme="dark"] header {
        border-color: #ffffff;
    }

    /* Ensure nav sits above any page overlays and remains clickable */
    nav {
        position: relative;
        z-index: 3000;
    }

    nav ul {
        display: flex;
        list-style: none;
    }

    nav li {
        display: flex;
    }

    nav ul li a {
        text-decoration: none;
        color: var(--text-color);
        font-size: 14px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 36px;
        width: 36px;
        border-radius: 9999px;
        transition: all 200ms ease;
        pointer-events: auto;
        position: relative;
        z-index: 3001;
    }
    
    /* Tooltip container */
    .nav-tooltip-container {
        position: relative;
        display: inline-block;
    }
    
    /* Tooltip styles */
    .tooltip {
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%) scale(0.9);
        background-color: var(--accent-color);
        color: var(--on-accent-color);
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        opacity: 0;
        visibility: hidden;
        transition: all 0.2s ease;
        z-index: 1000;
        pointer-events: none;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    
    .tooltip::after {
        content: '';
        position: absolute;
        top: -4px;
        left: 50%;
        transform: translateX(-50%) rotate(45deg);
        width: 8px;
        height: 8px;
        background-color: var(--accent-color);
    }
    
    /* Show tooltip on hover */
    .nav-icon:hover .tooltip,
    .nav-icon-button:hover .tooltip,
    .nav-tooltip-container:hover .tooltip {
        opacity: 1;
        visibility: visible;
        transform: translateX(-50%) scale(1);
    }
    
    /* Hide default title tooltip */
    .nav-icon[title] {
        position: relative;
    }
    
    .nav-icon[title]:hover::after,
    .nav-icon[title]:focus::after {
        display: none;
    }
    
    /* Logo tooltip positioning */
    .logo-link .tooltip {
        left: 60px;
        bottom: 50%;
        transform: translateY(50%) scale(0.9);
    }
    
    .logo-link:hover .tooltip {
        transform: translateY(50%) scale(1);
    }
    
    /* Adjust icon size and centering */
    .nav-icon svg {
        width: 20px;
        height: 20px;
        transition: transform 0.2s ease;
    }
    
    .nav-icon:hover svg {
        transform: scale(1.1);
    }

    nav ul li a:hover {
        background-color: var(--accent-color);
        color: var(--on-accent-color);
    }
    
    /* Ensure tooltip stays visible on hover */
    .nav-icon:hover .tooltip {
        opacity: 1 !important;
        visibility: visible !important;
    }

    nav ul li a.active {
        /* Light mode default: black bg, white text */
        background-color: #0b0b0b;
        color: #ffffff;
        border-color: #0b0b0b;
    }

    /* Dark mode: invert (white bg, black text) */
    [data-theme="dark"] nav ul li a.active {
        background-color: #ffffff !important;
        color: #0b0b0b !important;
        border-color: #ffffff !important;
    }

    .header-actions {
        margin-right: 0;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-right: 10px;
    }

    /* Style for both theme toggle and profile icon buttons */
    .header-actions button,
    .header-actions .profile-icon {
        color: var(--text-color);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        transition: all 0.2s ease;
        width: 36px;
        height: 36px;
        padding: 0;
        border: none;
        background: none;
        cursor: pointer;
    }
    
    /* Hover effect for both buttons */
    .header-actions button:hover,
    .header-actions .profile-icon:hover {
        background-color: var(--accent-color);
        color: var(--on-accent-color);
        transform: translateY(-1px);
    }
    
    /* Active state for better feedback */
    .header-actions button:active,
    .header-actions .profile-icon:active {
        transform: translateY(0);
    }

    #open-sidebar-button {
        display: none;
        background: none;
        border: none;
        padding: 0.5em; /* Reduced from 1em */
        cursor: pointer;
        margin-left: 4px; /* Add some space between profile and menu button */
    }

    #close-sidebar-button {
        display: none;
        background: none;
        border: none;
        padding: 1em;
        cursor: pointer;
    }

    @media screen and (max-width: 768px) {
        .logo {
            margin-left: 8px;
        }

        .header-actions {
            margin-right: 0;
        }

        #open-sidebar-button {
            display: block;
        }

        #close-sidebar-button {
            display: block;
        }

        nav {
            position: fixed;
            top: 0;
            right: -100%;
            height: 100vh;
            width: min(15rem, 100%);
            z-index: 1100;
            border-left: 1px solid var(--border-color);
            background-color: var(--bg-color);
            transition: right 300ms ease-out;
        }

        nav.show {
            right: 0;
        }

        nav ul {
            width: 100%;
            flex-direction: column;
            padding-top: 20px;
        }

        nav a {
            width: 100%;
            display: block;
        }
    }
</style>


<script src="/kabalayan/js/navbar.js"></script>