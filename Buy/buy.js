document.addEventListener('DOMContentLoaded', function () {
  // Navigation functionality
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
  handleResize(); // Call on load

  // Attach event listeners
  openButton.addEventListener('click', openSidebar);
  closeButton.addEventListener('click', closeSidebar);

  // Favorite buttons functionality
  const favoriteButtons = document.querySelectorAll('.favorite-btn');
  favoriteButtons.forEach(button => {
      button.addEventListener('click', function() {
          this.classList.toggle('active');
          const icon = this.querySelector('i');
          if (this.classList.contains('active')) {
              icon.classList.remove('far');
              icon.classList.add('fas');
          } else {
              icon.classList.remove('fas');
              icon.classList.add('far');
          }
      });
  });
});