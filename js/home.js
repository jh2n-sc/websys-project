// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize FAQ functionality
    initFAQ();
    
    // Initialize navigation highlighting
    initNavHighlighting();
    
    // Initialize form submission handling
    initFormHandling();
});

// Nav
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
handleResize();



// Initialize FAQ functionality
function initFAQ() {
    // Handle FAQ item clicks
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
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
        }
    });

    // Handle category switching
    const categories = document.querySelectorAll('.faq-category');
    categories.forEach(category => {
        category.addEventListener('click', () => {
            // Remove active class from all categories
            categories.forEach(cat => cat.classList.remove('active'));
            
            // Add active class to clicked category
            category.classList.add('active');
            
            // Logic to show/hide questions based on selected category
            const categoryName = category.getAttribute('data-category');
            console.log(`Category selected: ${categoryName}`);
            // For a complete implementation, you would fetch or display
            // questions related to the selected category
        });
    });

    // Handle search functionality
    const searchInput = document.getElementById('faqSearch');
    if (searchInput) {
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
    }
}

// Initialize navigation highlighting
function initNavHighlighting() {
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop(); 

    links.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();

        if (href === currentPath || (href === '' && currentPath === 'home.html')) {
            link.classList.add('active');
        }
    });
}


// Initialize form handling
function initFormHandling() {
    const inquiryForm = document.getElementById('inquiry-form');
    
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', handleMessageSent);
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize popover as hidden
    const messageSentPopover = document.getElementById('messageSentPopover');
    if (messageSentPopover) {
        messageSentPopover.style.display = 'none';
    }
    
    // Add form submission handler
    const inquiryForm = document.getElementById('inquiry-form');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', handleMessageSent);
    }
});

function handleMessageSent(event) {
    event.preventDefault(); // Prevent actual form submission
    
    const messageSentPopover = document.getElementById('messageSentPopover');
    
    if (messageSentPopover) {
        // Show the popover with flex display and centered items
        messageSentPopover.style.display = 'flex';
        messageSentPopover.style.alignItems = 'center';
        messageSentPopover.style.animation = 'slideInDown 0.3s ease-out';
        
        // Hide after 3 seconds with slide-out animation
        setTimeout(() => {
            messageSentPopover.style.animation = 'slideOutUp 0.3s ease-out';
            
            // Wait for animation to complete before hiding
            setTimeout(() => {
                messageSentPopover.style.display = 'none';
                
                // Reset the form
                event.target.reset();
            }, 300);
        }, 3000);
    }
}