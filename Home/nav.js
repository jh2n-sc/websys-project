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
    