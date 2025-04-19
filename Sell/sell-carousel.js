
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.sold-carousel');
    const cards = document.querySelectorAll('.sold-card');
    const prevBtn = document.querySelector('.sold-prev');
    const nextBtn = document.querySelector('.sold-next');
    const progressBar = document.querySelector('.sold-progress-bar');
    
    if (!carousel || !prevBtn || !nextBtn) return;
    
    let scrollAmount = 0;
    const cardWidth = cards[0].offsetWidth + 32; // card width + gap
    const maxScroll = carousel.scrollWidth - carousel.clientWidth;
    
    function updateProgressBar() {
      const scrollPercentage = (carousel.scrollLeft / maxScroll) * 100;
      progressBar.style.width = `${scrollPercentage}%`;
    }
    
    prevBtn.addEventListener('click', function() {
      carousel.scrollBy({left: -cardWidth * 2, behavior: 'smooth'});
    });
    
    nextBtn.addEventListener('click', function() {
      carousel.scrollBy({left: cardWidth * 2, behavior: 'smooth'});
    });
    
    carousel.addEventListener('scroll', function() {
      updateProgressBar();
    });
    
    // Initialize progress bar
    updateProgressBar();
  });