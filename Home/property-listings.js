document.addEventListener('DOMContentLoaded', () => {
  const wrapper = document.querySelector('.carousel-wrapper');
  const listings = document.querySelector('.listings');
  const items = document.querySelectorAll('.listing-item');
  const prevBtn = document.getElementById('prev');
  const nextBtn = document.getElementById('next');
  const indicatorsContainer = document.querySelector('.carousel-indicators');
  
  // Create indicators
  items.forEach((_, index) => {
    const indicator = document.createElement('div');
    indicator.classList.add('indicator');
    indicator.setAttribute('aria-label', `Go to slide ${index + 1}`);
    indicator.dataset.index = index;
    indicatorsContainer.appendChild(indicator);
  });
  
  const indicators = document.querySelectorAll('.indicator');
  
  let currentIndex = 0;
  let startX = 0;
  let isDragging = false;
  let startScrollPosition = 0;
  let autoPlayTimer;
  
  function getItemWidthWithGap() {
    const itemStyle = window.getComputedStyle(items[0]);
    const itemWidth = items[0].offsetWidth;
    const gap = parseInt(getComputedStyle(listings).gap) || 30;
    return itemWidth + gap;
  }
  
  function centerOffset() {
    const wrapperWidth = wrapper.offsetWidth;
    const itemWidth = items[0].offsetWidth;
    return (wrapperWidth - itemWidth) / 2;
  }
  
  function updateCarousel(animate = true) {
    const offset = centerOffset();
    const itemWidthWithGap = getItemWidthWithGap();
    const translateX = offset - currentIndex * itemWidthWithGap;
    
    if (!animate) {
      listings.style.transition = 'none';
    } else {
      listings.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
    }
    
    listings.style.transform = `translateX(${translateX}px)`;
    
    if (!animate) {
      listings.offsetHeight;
    }
    

    items.forEach((item, i) => {
      item.classList.toggle('active', i === currentIndex);
      item.setAttribute('aria-current', i === currentIndex ? 'true' : 'false');
    });
    
    indicators.forEach((indicator, i) => {
      indicator.classList.toggle('active', i === currentIndex);
    });
    
    listings.setAttribute('aria-live', 'polite');
    items.forEach((item, i) => {
      const isVisible = i === currentIndex;
      item.setAttribute('aria-hidden', !isVisible);
    });
  }
  
  function goToSlide(index) {
    currentIndex = Math.max(0, Math.min(index, items.length - 1));
    updateCarousel();
  }
  
  function goNext() {
    currentIndex = (currentIndex + 1) % items.length;
    updateCarousel();
  }
  
  function goPrev() {
    currentIndex = (currentIndex - 1 + items.length) % items.length;
    updateCarousel();
  }
  
  nextBtn.addEventListener('click', () => {
    stopAutoPlay();
    goNext();
    startAutoPlay();
  });
  
  prevBtn.addEventListener('click', () => {
    stopAutoPlay();
    goPrev();
    startAutoPlay();
  });
  
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      stopAutoPlay();
      goToSlide(index);
      startAutoPlay();
    });
  });
  
  listings.addEventListener('touchstart', (e) => {
    stopAutoPlay();
    startX = e.touches[0].clientX;
    e.preventDefault();
  }, { passive: false });
  
  listings.addEventListener('touchmove', (e) => {
    const currentX = e.touches[0].clientX;
    const diff = startX - currentX;
    const offset = centerOffset();
    const itemWidthWithGap = getItemWidthWithGap();
    const baseTranslateX = offset - currentIndex * itemWidthWithGap;
    
    listings.style.transform = `translateX(${baseTranslateX - diff}px)`;
  });
  
  listings.addEventListener('touchend', (e) => {
    const endX = e.changedTouches[0].clientX;
    const diff = startX - endX;
    
    if (Math.abs(diff) > 50) {
      if (diff > 0) goNext();
      else goPrev();
    } else {
      updateCarousel();
    }
    
    startAutoPlay();
  });
  
  listings.addEventListener('mousedown', (e) => {
    stopAutoPlay();
    isDragging = true;
    startX = e.clientX;
    startScrollPosition = currentIndex;
    listings.style.cursor = 'grabbing';
    e.preventDefault();
  });
  
  window.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    
    const currentX = e.clientX;
    const diff = startX - currentX;
    const offset = centerOffset();
    const itemWidthWithGap = getItemWidthWithGap();
    const baseTranslateX = offset - currentIndex * itemWidthWithGap;
    
    listings.style.transform = `translateX(${baseTranslateX - diff}px)`;
  });
  
  window.addEventListener('mouseup', (e) => {
    if (!isDragging) return;
    
    const endX = e.clientX;
    const diff = startX - endX;
    
    listings.style.cursor = '';
    isDragging = false;
    
    if (Math.abs(diff) > 50) {
      if (diff > 0) goNext();
      else goPrev();
    } else {
      updateCarousel();
    }
    
    startAutoPlay();
  });
  
  items.forEach(item => {
    item.addEventListener('focus', stopAutoPlay);
    item.addEventListener('blur', startAutoPlay);
  });
  
  wrapper.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowRight' || e.key === 'Right') {
      stopAutoPlay();
      goNext();
      startAutoPlay();
    } else if (e.key === 'ArrowLeft' || e.key === 'Left') {
      stopAutoPlay();
      goPrev();
      startAutoPlay();
    }
  });
  
  function startAutoPlay() {
    stopAutoPlay();
    autoPlayTimer = setInterval(goNext, 5000);
  }
  
  function stopAutoPlay() {
    clearInterval(autoPlayTimer);
  }
  
  wrapper.addEventListener('mouseenter', stopAutoPlay);
  wrapper.addEventListener('mouseleave', startAutoPlay);
  wrapper.addEventListener('focus', stopAutoPlay, true);
  wrapper.addEventListener('blur', startAutoPlay, true);
  
  let resizeTimer;
  window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      updateCarousel(false);
    }, 250);
  });
  
  items.forEach((item, i) => {
    item.setAttribute('aria-hidden', i !== 0);
    item.setAttribute('tabindex', i === 0 ? '0' : '-1');
  });
  
  updateCarousel(false);
  startAutoPlay();
});

