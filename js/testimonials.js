  // -------------------- Testimonials --------------------
document.addEventListener('DOMContentLoaded', function() {
    // Elements
    const testimonialSection = document.getElementById('testimonialSection');
    const testimonialItems = document.querySelectorAll('.testimonial-item');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const currentSlideEl = document.getElementById('currentSlide');
    const progressBar = document.getElementById('progressBar');
    
    let currentIndex = 0;
    const totalItems = testimonialItems.length;
    let autoplayInterval;
    let isAnimating = false;
    
    updateCounter();
    updateProgressBar();
    startAutoplay();
    
    // Navigation
    prevBtn.addEventListener('click', () => {
        if (isAnimating) return;
        stopAutoplay();
        navigateTestimonial('prev');
        startAutoplay();
    });
    
    nextBtn.addEventListener('click', () => {
        if (isAnimating) return;
        stopAutoplay();
        navigateTestimonial('next');
        startAutoplay();
    });
    
    // testimonial 
    testimonialItems.forEach((item, index) => {
        item.addEventListener('click', () => {
            if (isAnimating || index === currentIndex) return;
            stopAutoplay();
            goToSlide(index);
            startAutoplay();
        });
    });
    
    // Pause autoplay on hover
    testimonialSection.addEventListener('mouseenter', () => {
        stopAutoplay();
    });
    
    testimonialSection.addEventListener('mouseleave', () => {
        startAutoplay();
    });
    
    // Handle visibility change
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    });
    

    function navigateTestimonial(direction) {
        isAnimating = true;
        
        let nextIndex;
        if (direction === 'next') {
            nextIndex = (currentIndex + 1) % totalItems;
        } else {
            nextIndex = (currentIndex - 1 + totalItems) % totalItems;
        }
        
        goToSlide(nextIndex);
    }
    
    function goToSlide(index) {
        if (index === currentIndex) return;
        
        isAnimating = true;
        
        testimonialItems[currentIndex].classList.remove('active');
        
        setTimeout(() => {
            // Activate
            testimonialItems[index].classList.add('active');
            
            // Update 
            currentIndex = index;
            
            updateCounter();
            updateProgressBar();
            
            // Re-enable navigation after animation completes
            setTimeout(() => {
                isAnimating = false;
            }, 300);
        }, 100);
    }
    
    function updateCounter() {
        // Format with leading zero
        const formattedIndex = String(currentIndex + 1).padStart(2, '0');
        currentSlideEl.textContent = formattedIndex;
    }
    
    function updateProgressBar() {
        const progressPercentage = ((currentIndex + 1) / totalItems) * 100;
        progressBar.style.width = `${progressPercentage}%`;
    }
    
    function startAutoplay() {
        stopAutoplay(); // Clear any existing interval
        autoplayInterval = setInterval(() => {
            navigateTestimonial('next');
        }, 3000);
    }
    
    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
        }
    }
    
    // touch for mobile devices
    let touchStartX = 0;
    let touchEndX = 0;
    
    testimonialSection.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    testimonialSection.addEventListener('touchend', (e) => {
        if (isAnimating) return;
        
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        
        if (touchEndX < touchStartX - swipeThreshold) {
            // Swipe left
            stopAutoplay();
            navigateTestimonial('next');
            startAutoplay();
        }
        
        if (touchEndX > touchStartX + swipeThreshold) {
            // Swipe right
            stopAutoplay();
            navigateTestimonial('prev');
            startAutoplay();
        }
    }
});