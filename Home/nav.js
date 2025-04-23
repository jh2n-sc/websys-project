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
            void popover.offsetWidth; // reflow trick to restart animation
            popover.classList.add('show');
    
            // Hide after 3 seconds
            setTimeout(function() {
                popover.style.display = 'none';
                popover.style.opacity = '0';
            }, 3000);
        });
    });
    