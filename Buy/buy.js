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
});























const cards = document.querySelectorAll('.card');
const leftBtn = document.querySelector('.left-btn');
const rightBtn = document.querySelector('.right-btn');

let current = 0;

function updateCarousel() {
  cards.forEach((card, index) => {
    card.classList.remove('active');
    if (index === current) {
      card.classList.add('active');
    }
  });

  const offset = current * (cards[0].offsetWidth + 20); // adjust for gap
  document.querySelector('.carousel').style.transform = `translateX(-${offset}px)`;
}

leftBtn.addEventListener('click', () => {
  current = (current - 1 + cards.length) % cards.length;
  updateCarousel();
});

rightBtn.addEventListener('click', () => {
  current = (current + 1) % cards.length;
  updateCarousel();
});

updateCarousel();
