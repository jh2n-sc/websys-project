// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize FAQ functionality
    initFAQ();
    
    // Initialize navigation highlighting
    initNavHighlighting();
    
    // Initialize form submission handling
    initFormHandling();
    
    // Initialize sidebar functionality
    initSidebar();
});

// Sidebar functionality
function initSidebar() {
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

    // Add click event to open button if it exists
    if (openButton) {
        openButton.addEventListener('click', openSidebar);
    }
}

// FAQ functionality
function initFAQ() {
    // Initially hide all question containers
    const allQuestionsContainers = document.querySelectorAll('.faq-questions');
    allQuestionsContainers.forEach(container => {
        container.style.display = 'none';
    });

    // Activate the "Buying Property" category by default
    const buyingCategory = document.querySelector('.faq-category[data-category="buying"]');
    if (buyingCategory) {
        buyingCategory.classList.add('active');
        const buyingQuestions = document.getElementById('buyingQuestions');
        if (buyingQuestions) {
            buyingQuestions.style.display = 'block';
            buyingQuestions.classList.add('active');
        }
    }

    // Handle FAQ item clicks
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        if (question) {
            question.addEventListener('click', () => {
                item.classList.toggle('active');

                const parentQuestions = item.closest('.faq-questions');
                parentQuestions.querySelectorAll('.faq-item').forEach(otherItem => {
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
            
            // Hide all question containers
            allQuestionsContainers.forEach(q => {
                q.style.display = 'none';
                q.classList.remove('active');
            });
            
            // Show questions for selected category
            const categoryName = category.getAttribute('data-category');
            const targetQuestions = document.getElementById(`${categoryName}Questions`);
            if (targetQuestions) {
                targetQuestions.style.display = 'block';
                targetQuestions.classList.add('active');
            }
        });
    });

    // Handle search functionality
    const searchInput = document.getElementById('faqSearch');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            let anyMatches = false;

            // Get the currently active questions container
            const activeContainer = document.querySelector('.faq-questions.active');
            
            if (activeContainer) {
                const items = activeContainer.querySelectorAll('.faq-item');
                items.forEach(item => {
                    const questionText = item.querySelector('.faq-question').textContent.toLowerCase();
                    const answerText = item.querySelector('.faq-answer').textContent.toLowerCase();
                    
                    if (questionText.includes(searchTerm) || answerText.includes(searchTerm)) {
                        item.style.display = 'block';
                        anyMatches = true;
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Show no results message if needed
                const noResults = document.getElementById('noResults');
                if (!anyMatches) {
                    if (!noResults) {
                        const noResultsMsg = document.createElement('div');
                        noResultsMsg.id = 'noResults';
                        noResultsMsg.textContent = 'No matching questions found.';
                        activeContainer.appendChild(noResultsMsg);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
            }
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
        inquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            handleMessageSent();
        });
    }
}

 // Initialize popovers when DOM is loaded  
    // Hide all popovers initially
    document.querySelectorAll('.cta-sent-popover').forEach(popover => {
        popover.style.display = 'none';
    });

    // Close popover when clicking outside content
    document.querySelectorAll('.cta-sent-popover').forEach(popover => {
        popover.addEventListener('click', function(e) {
            if (e.target === this) {
                closePopover(this.id);
            }
        });
    });

// Show Contact Expert popover
function showContactPopover() {
    const popover = document.getElementById('contactExpertPopover');
    if (popover) {
        popover.style.display = 'flex';
        setTimeout(() => {
            popover.classList.add('active');
        }, 10);
    }
}

// Show Schedule Consultation popover
function showSchedulePopover() {
    const popover = document.getElementById('scheduleConsultationPopover');
    if (popover) {
        popover.style.display = 'flex';
        setTimeout(() => {
            popover.classList.add('active');
        }, 10);
    }
}

// Close popover
function closePopover(popoverId) {
    const popover = document.getElementById(popoverId);
    if (popover) {
        popover.classList.remove('active');
        setTimeout(() => {
            popover.style.display = 'none';
        }, 300); // Match with CSS transition duration
    }
}