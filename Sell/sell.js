document.addEventListener('DOMContentLoaded', () => {
  // -------------------- Active Nav Link --------------------
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop();
  
    links.forEach(link => {
      const href = link.getAttribute('href').split('/').pop();
      if (href === currentPath || (href === '' && currentPath === 'sell.php')) {
        link.classList.add('active');
      }
    });
  });

  // -------------------- Loader --------------------
  window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 100);
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