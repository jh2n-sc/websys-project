// FAQ section
        document.addEventListener('DOMContentLoaded', function() {
            // Handle FAQ item clicks
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                question.addEventListener('click', () => {
                    // Toggle active class for clicked item
                    item.classList.toggle('active');
                    
                    // Close other items
                    faqItems.forEach(otherItem => {
                        if (otherItem !== item && otherItem.classList.contains('active')) {
                            otherItem.classList.remove('active');
                        }
                    });
                });
            });

            // Handle category switching
            const categories = document.querySelectorAll('.faq-category');
            categories.forEach(category => {
                category.addEventListener('click', () => {
                    // Remove active class from all categories
                    categories.forEach(cat => cat.classList.remove('active'));
                    
                    // Add active class to clicked category
                    category.classList.add('active');
                    
                    // Here you would typically implement logic to show/hide questions
                    // based on selected category
                    const categoryName = category.getAttribute('data-category');
                    console.log(`Category selected: ${categoryName}`);
                    // For a complete implementation, you would fetch or display
                    // questions related to the selected category
                });
            });

            // Handle search functionality
            const searchInput = document.getElementById('faqSearch');
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                
                faqItems.forEach(item => {
                    const questionText = item.querySelector('.faq-question').textContent.toLowerCase();
                    const answerText = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });

window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 500);
});

document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop(); 

    links.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();

        if (href === currentPath || (href === '' && currentPath === 'home.html')) {
            link.classList.add('active');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('inquiryForm');
    const popover = document.getElementById('messageSentPopover');

    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Prevent page reload
        
        // Make sure popover is visible
        popover.style.display = 'block';
        popover.style.opacity = '1';

        // Re-trigger animation
        popover.classList.remove('show');
        void popover.offsetWidth; 
        popover.classList.add('show');

        setTimeout(function() {
            popover.style.display = 'none';
            popover.style.opacity = '0';
        }, 3000);
    });
});
