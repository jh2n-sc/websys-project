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