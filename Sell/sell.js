document.addEventListener('DOMContentLoaded', () => {
  const links = document.querySelectorAll('nav ul li a');
  const currentPath = window.location.pathname;

  links.forEach(link => {
      const href = link.getAttribute('href');
      if (href === currentPath) {
          link.classList.add('active');
      }
  });
});

  window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 100);
  });
  

const openButton = document.getElementById('open-sidebar-button');
const navbar = document.getElementById('navbar');

function handleResize() {
  if (window.innerWidth <= 768) {
    navbar.classList.remove('show');
    openButton.setAttribute('aria-expanded', 'false');
    navbar.setAttribute('inert', '');
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