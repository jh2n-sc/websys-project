    <!-- NAVBAR -->
    <header>
    <div class="logo">
        KABALAYAN
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
            <li><a href="../index.php">Home</a></li>
            <li><a href="./buy.php">Buy</a></li>
            <li><a href="./sell.php">Sell</a></li>
            <li><a href="./about.php">About Us</a></li>
        </ul>
    </nav>

    <div class="header-actions">
        <a href="./profile.php">Profile</a>
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
   // Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

    // Initialize navigation highlighting
    initNavHighlighting();

    // Initialize sidebar functionality
    initSidebar();
});

function initSidebar() {

    const openButton = document.getElementById('open-sidebar-button');
    const navbar = document.getElementById('navbar');
    const closeButton = document.getElementById('close-sidebar-button');
    const body = document.body;


    function openSidebar() {
        if (navbar) {
            navbar.classList.add('show');
            navbar.removeAttribute('inert');
        }
        if (body) {
            body.classList.add('sidebar-open');
        }
        if (openButton) {
            openButton.setAttribute('aria-expanded', 'true');
        }
    }

    function closeSidebar() {
        if (navbar) {
            navbar.classList.remove('show');
            navbar.setAttribute('inert', '');
        }
        if (body) {
            body.classList.remove('sidebar-open');
        }
        if (openButton) {
            openButton.setAttribute('aria-expanded', 'false');
        }
    }

    // Add click event listeners with null checks
    if (openButton) {
        openButton.addEventListener('click', function(e) { 
            e.preventDefault();
            e.stopPropagation();
            openSidebar();
        });
    } else {
        console.error("Open button not found for event listener");
    }

    if (closeButton) {
        closeButton.addEventListener('click', function(e) { 
            e.preventDefault();
            e.stopPropagation();
            closeSidebar();
        });
    } else {
        console.error("Close button not found for event listener");
    }

    // Close when clicking outside 
    document.addEventListener('click', function(e) {
        if (!navbar || !navbar.classList.contains('show')) return; // Exit if navbar doesn't exist or isn't shown

        const isClickInsideNavbar = navbar.contains(e.target);
        const isClickOnOpenButton = e.target === openButton;
        const isClickInsideSidebarToggle = isClickInsideNavbar || isClickOnOpenButton;


        if (!isClickInsideSidebarToggle) {
            closeSidebar();
        }
    });

    // Handle window resize
    function handleResize() {
        if (window.innerWidth <= 768) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    // Initialize resize event listener
    window.addEventListener('resize', handleResize);
    handleResize(); // Initial check on load
}

// FAQ functionality
function initFAQ() {
    // Initially hide all question containers
    const allQuestionsContainers = document.querySelectorAll('.faq-questions');
    allQuestionsContainers.forEach(container => {
        container.style.display = 'none';
    });

    // Buy Category
    const buyingCategory = document.querySelector('.faq-category[data-category="buying"]');
    if (buyingCategory) {
        buyingCategory.classList.add('active');
        const buyingQuestions = document.getElementById('buyingQuestions');
        if (buyingQuestions) {
            buyingQuestions.style.display = 'block';
            buyingQuestions.classList.add('active');
        }
    }

    // Handle FAQ item 
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', () => {
                item.classList.toggle('active');

                const parentQuestions = item.closest('.faq-questions');
                parentQuestions.querySelectorAll('.faq-item').forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
            });
        }
    });

    // Handle category switching
    const categories = document.querySelectorAll('.faq-category');
    
    categories.forEach(category => {
        category.addEventListener('click', () => {
            categories.forEach(cat => cat.classList.remove('active'));
            
            category.classList.add('active');
            
            allQuestionsContainers.forEach(q => {
                q.style.display = 'none';
                q.classList.remove('active');
            });
            
            const categoryName = category.getAttribute('data-category');
            const targetQuestions = document.getElementById(`${categoryName}Questions`);
            if (targetQuestions) {
                targetQuestions.style.display = 'block';
                targetQuestions.classList.add('active');
            }
        });
    });

    // Handle search functionality
    const searchInput = document.getElementById('faqSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let anyMatches = false;

            const activeContainer = document.querySelector('.faq-questions.active');
            
            if (activeContainer) {
                const items = activeContainer.querySelectorAll('.faq-item');
                items.forEach(item => {
                    const questionText = item.querySelector('.faq-question').textContent.toLowerCase();
                    const answerText = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        item.style.display = 'block';
                        anyMatches = true;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                const noResults = document.getElementById('noResults');
                if (!anyMatches) {
                    if (!noResults) {
                        const noResultsMsg = document.createElement('div');
                        noResultsMsg.id = 'noResults';
                        noResultsMsg.textContent = 'No matching questions found.';
                        activeContainer.appendChild(noResultsMsg);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            }
        });
    }
}

// Initialize navigation highlighting
function initNavHighlighting() {
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop(); 

    links.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();

        if (href === currentPath || (href === '' && currentPath === 'home.html')) {
            link.classList.add('active');
        }
    });
}
</script>