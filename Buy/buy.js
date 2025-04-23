document.addEventListener('DOMContentLoaded', function () {
    // -------------------- Active Nav Link --------------------
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop();

    links.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();
        if (href === currentPath || (href === '' && currentPath === 'buy.php')) {
            link.classList.add('active');
        }
    });

    // -------------------- Sidebar --------------------
    const openButton = document.getElementById('open-sidebar-button');
    const closeButton = document.getElementById('close-sidebar-button');
    const navbar = document.getElementById('navbar');

    function handleResize() {
        if (window.innerWidth <= 768) {
            navbar.classList.remove('show');
            openButton.setAttribute('aria-expanded', 'false');
            if (!navbar.hasAttribute('inert')) {
                navbar.setAttribute('inert', '');
            }
        } else {
            navbar.removeAttribute('inert');
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

    window.addEventListener('resize', handleResize);
    handleResize();

    openButton.addEventListener('click', openSidebar);
    closeButton.addEventListener('click', closeSidebar);

    // -------------------- Favorite Buttons --------------------
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function () {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('fas', this.classList.contains('active'));
            icon.classList.toggle('far', !this.classList.contains('active'));
        });
    });
});

// -------------------- Page Loader --------------------
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 500); // Keep this consistent with home.js
});
