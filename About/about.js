// -------------------- Page Loader --------------------
window.addEventListener('load', () => {
const loader = document.getElementById('page-loader');
setTimeout(() => {
    loader.classList.add('fade-out');
}, 500);
});

// -------------------- Navigation --------------------
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

// Initialize nav behavior
window.addEventListener('resize', handleResize);
handleResize();

// -------------------- Active Nav Link --------------------
document.addEventListener('DOMContentLoaded', () => {
const links = document.querySelectorAll('nav ul li a');
const currentPath = window.location.pathname.split('/').pop();

links.forEach(link => {
    const href = link.getAttribute('href').split('/').pop();
    if (href === currentPath || (href === '' && currentPath === 'buy.php')) {
    link.classList.add('active');
    }
});
});
