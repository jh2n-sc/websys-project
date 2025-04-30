document.addEventListener('DOMContentLoaded', function () {
  // -------------------- Active Nav Link --------------------
  const links = document.querySelectorAll('nav ul li a');
  const currentPath = window.location.pathname.split('/').pop() || 'index.php';

  links.forEach(link => {
      const href = link.getAttribute('href').split('/').pop() || 'index.php';
      if (href === currentPath) {
          link.classList.add('active');
      }
  });
});
