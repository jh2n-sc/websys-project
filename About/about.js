// -------------------- Page Loader --------------------
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
      loader.classList.add('fade-out');
    }, 500);
  });
  
  // -------------------- Navigation --------------------
  document.addEventListener('DOMContentLoaded', () => {
    const openBtn = document.getElementById('open-sidebar-button');
    const closeBtn = document.getElementById('close-sidebar-button');
    const navbar = document.getElementById('navbar');
  
    // Open sidebar
    openBtn.addEventListener('click', () => {
      navbar.classList.add('show');
      openBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden'; // Prevent background scrolling
    });
  
    // Close sidebar
    closeBtn.addEventListener('click', () => {
      navbar.classList.remove('show');
      openBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = ''; // Restore scrolling
    });
  
    // Close sidebar when clicking outside
    document.addEventListener('click', (e) => {
      if (navbar.classList.contains('show') && 
          !navbar.contains(e.target) && 
          !openBtn.contains(e.target)) {
        navbar.classList.remove('show');
        openBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  
    // Handle window resize
    window.addEventListener('resize', () => {
      if (window.innerWidth > 768 && navbar.classList.contains('show')) {
        navbar.classList.remove('show');
        openBtn.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  
    // Mark active nav item
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop();
  
    links.forEach(link => {
      const href = link.getAttribute('href').split('/').pop();
      if (href === currentPath || 
          (currentPath === 'about.html' && href.includes('about.html'))) {
        link.classList.add('active');
      }
    });
  });
  
  // Fix Safari mobile vh units bug (if any)
  window.addEventListener('resize', () => {
    let vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', `${vh}px`);
  });