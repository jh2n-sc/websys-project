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
            <li><a href="../index.php">Home</a></li>
            <li><a href="./buy.php">Buy</a></li>
            <li><a href="./sell.php">Sell</a></li>
            <li><a href="./about.php">About Us</a></li>
        </ul>
    </nav>

    <div class="header-actions">
        <a href="./profile.php">Profile</a>
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

<style>
    /* NAV */
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
    }

    .logo {
        margin-left: 50px;
        font-weight: 600;
        font-size: 20px;
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
        color: black;
        font-size: 14px;
        padding: 1em 2em;
        transition: background-color 150ms ease;
    }

    nav ul li a:hover {
        background-color: #000;
        color: white;
    }

    nav ul li a.active {
        background-color: black;
        color: white;
    }

    .header-actions {
        margin-right: 50px;
        display: flex;
        font-size: 14px;
        align-items: center;
    }

    .header-actions a {
        color: #000;
        text-decoration: none;
        padding: 1em;
    }

    #open-sidebar-button {
        display: none;
        background: none;
        border: none;
        padding: 1em;
        cursor: pointer;
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
            margin-left: 20px;
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
            z-index: 10;
            border-left: 1px solid black;
            background-color: white;
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


<script>
    // Nav
    const openButton = document.getElementById('open-sidebar-button');
    const navbar = document.getElementById('navbar');

    function handleResize() {
        if (window.innerWidth <= 768) {
            navbar.classList.remove('show');
            openButton.setAttribute('aria-expanded', 'false');
            if (!navbar.hasAttribute('inert')) {
                navbar.setAttribute('inert', '');
            }
        } else {
            if (navbar.hasAttribute('inert')) {
                navbar.removeAttribute('inert');
            }
        }
    }

    function openSidebar() {
        navbar.classList.add('show');
        openButton.setAttribute('aria-expanded', 'true');
        navbar.removeAttribute('inert');
    }

    function closeSidebar() {
        navbar.classList.remove('show');
        openButton.setAttribute('aria-expanded', 'false');
        navbar.setAttribute('inert', '');
    }

    // Initialize
    window.addEventListener('resize', handleResize);
    handleResize();
</script>