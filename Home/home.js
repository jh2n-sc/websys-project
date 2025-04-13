const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
item.querySelector('.faq-question').addEventListener('click', () => {
item.classList.toggle('active');

faqItems.forEach(otherItem => {
    if (otherItem !== item) {
    otherItem.classList.remove('active');
    }
});
});
});

    // Navigation functionality
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
    handleResize(); // Call on load
    


















    document.addEventListener('DOMContentLoaded', () => {
        const listingsContainer = document.querySelector('.listings');
        const items = document.querySelectorAll('.listing-item');
        const prevBtn = document.getElementById('prev');
        const nextBtn = document.getElementById('next');
        const carouselWrapper = document.querySelector('.carousel-wrapper');
        const indicatorsContainer = document.createElement('div');
        indicatorsContainer.className = 'carousel-indicators';
        carouselWrapper.appendChild(indicatorsContainer);
      
        // Create indicators
        items.forEach((_, index) => {
          const indicator = document.createElement('div');
          indicator.className = 'indicator';
          indicator.addEventListener('click', () => {
            currentIndex = index;
            updateCarousel();
          });
          indicatorsContainer.appendChild(indicator);
        });
      
        const indicators = document.querySelectorAll('.indicator');
        // Set currentIndex to the middle item instead of 0:
        let currentIndex = Math.floor(items.length / 2);
        let startX, moveX;
        let isAnimating = false;
      
        // Center the initial carousel
        function centerCarousel() {
          const carouselWidth = carouselWrapper.offsetWidth;
          const itemWidth = items[0].offsetWidth; // fixed typo: items[] -> items[0]
          const totalGap = 100; // gap between items
          
          // Calculate offset to center the active item
          const offset = (carouselWidth - itemWidth) / 2;
          return offset;
        }
      
        function updateCarousel() {
          if (isAnimating) return;
          isAnimating = true;
          
          // Remove active class from all items and indicators
          items.forEach(item => item.classList.remove('active'));
          indicators.forEach(indicator => indicator.classList.remove('active'));
          
          // Calculate the appropriate translation
          const itemWidth = items[0].offsetWidth + 100; // width + gap
          const offset = centerCarousel();
          const translateX = offset - (currentIndex * itemWidth) - (itemWidth / 2) + (items[0].offsetWidth / 2);
          
          // Apply transform
          listingsContainer.style.transform = `translateX(${translateX}px)`;
          
          // Add active class to current item and indicator
          items[currentIndex].classList.add('active');
          indicators[currentIndex].classList.add('active');
          
          // Reset animation flag after transition completes
          setTimeout(() => {
            isAnimating = false;
          }, 500);
        }
      
        // Event listeners for buttons
        prevBtn.addEventListener('click', () => {
          if (isAnimating) return;
          currentIndex = (currentIndex - 1 + items.length) % items.length;
          updateCarousel();
        });
      
        nextBtn.addEventListener('click', () => {
          if (isAnimating) return;
          currentIndex = (currentIndex + 1) % items.length;
          updateCarousel();
        });
      
        // Touch events for swiping on mobile
        listingsContainer.addEventListener('touchstart', (e) => {
          startX = e.touches[0].clientX;
        });
      
        listingsContainer.addEventListener('touchmove', (e) => {
          if (!startX) return;
          moveX = e.touches[0].clientX;
        });
      
        listingsContainer.addEventListener('touchend', () => {
          if (!startX || !moveX) return;
          
          const diff = startX - moveX;
          const threshold = 50; // Minimum swipe distance
          
          if (Math.abs(diff) > threshold) {
            if (diff > 0) {
              // Swipe left - go next
              currentIndex = (currentIndex + 1) % items.length;
            } else {
              // Swipe right - go prev
              currentIndex = (currentIndex - 1 + items.length) % items.length;
            }
            updateCarousel();
          }
          
          // Reset
          startX = null;
          moveX = null;
        });
      
        // Auto-play
        let autoPlayInterval;
        
        function startAutoPlay() {
          stopAutoPlay();
          autoPlayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % items.length;
            updateCarousel();
          }, 5000);
        }
        
        function stopAutoPlay() {
          if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
          }
        }
        
        // Pause auto-play on hover
        carouselWrapper.addEventListener('mouseenter', stopAutoPlay);
        carouselWrapper.addEventListener('mouseleave', startAutoPlay);
      
        // Handle window resize
        window.addEventListener('resize', () => {
          updateCarousel();
        });
      
        // Initialize
        updateCarousel();
        startAutoPlay();
      });
      