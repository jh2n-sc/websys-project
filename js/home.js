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

function initSidebar() {

    const openButton = document.getElementById('open-sidebar-button');
    const navbar = document.getElementById('navbar');
    const closeButton = document.getElementById('close-sidebar-button');
    const body = document.body;


    function openSidebar() {
        if (navbar) {
            navbar.classList.add('show');
            navbar.removeAttribute('inert');
        }
        if (body) {
            body.classList.add('sidebar-open');
        }
        if (openButton) {
            openButton.setAttribute('aria-expanded', 'true');
        }
    }

    function closeSidebar() {
        if (navbar) {
            navbar.classList.remove('show');
            navbar.setAttribute('inert', '');
        }
        if (body) {
            body.classList.remove('sidebar-open');
        }
        if (openButton) {
            openButton.setAttribute('aria-expanded', 'false');
        }
    }

    // Add click event listeners with null checks
    if (openButton) {
        openButton.addEventListener('click', function(e) { 
            e.preventDefault();
            e.stopPropagation();
            openSidebar();
        });
    } else {
        console.error("Open button not found for event listener");
    }

    if (closeButton) {
        closeButton.addEventListener('click', function(e) { 
            e.preventDefault();
            e.stopPropagation();
            closeSidebar();
        });
    } else {
        console.error("Close button not found for event listener");
    }

    // Close when clicking outside - 
    document.addEventListener('click', function(e) {
        if (!navbar || !navbar.classList.contains('show')) return; // Exit if nav

        const isClickInsideNavbar = navbar.contains(e.target);
        const isClickOnOpenButton = e.target === openButton;
        const isClickInsideSidebarToggle = isClickInsideNavbar || isClickOnOpenButton;


        if (!isClickInsideSidebarToggle) {
            closeSidebar();
        }
    });

    // Handle window resize 
    function handleResize() {
        if (window.innerWidth <= 768) {
            closeSidebar();
        } else {
            openSidebar();
        }
    }

    // Initialize resize event listener
    window.addEventListener('resize', handleResize);
    handleResize(); // Initial check on load
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