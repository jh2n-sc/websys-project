<style>
.back-to-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background-color: black;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.5s ease, visibility 0.5s ease, background-color 0.3s ease, color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    z-index: 999;
}

.back-to-top.visible {
    opacity: 0.5; 
    visibility: visible;
}

.back-to-top.active {
    opacity: 1; 
}

.back-to-top:hover {
    background-color: white;
    color: black;
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    opacity: 1 !important;
}

.back-to-top i {
    font-size: 20px;
}

@media screen and (max-width: 768px) {
    .back-to-top {
        bottom: 20px;
        right: 20px;
        width: 45px;
        height: 45px;
    }
}

@media screen and (max-width: 480px) {
    .back-to-top {
        bottom: 15px;
        right: 15px;
        width: 40px;
        height: 40px;
    }

    .back-to-top i {
        font-size: 18px;
    }
}
</style>


<button class="back-to-top" id="backToTop" aria-label="Back to top">
    <i class="fa-solid fa-angle-up"></i>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('backToTop');
    let isIdle = false;
    let idleTimer;

    // Function to check scroll position and show/hide button
    function toggleBackToTopButton() {
        if (window.scrollY > 300) {
            backToTopButton.classList.add('visible');
            backToTopButton.classList.add('active'); // Initially set to active
        } else {
            backToTopButton.classList.remove('visible');
            backToTopButton.classList.remove('active');
            clearIdleTimer(); // Clear timer if button is hidden
        }
    }

    // Function to set the button to idle state (transparent)
    function setIdle() {
        isIdle = true;
        backToTopButton.classList.remove('active');
    }

    // Function to clear the idle timer
    function clearIdleTimer() {
        clearTimeout(idleTimer);
        isIdle = false;
        backToTopButton.classList.add('active');
    }

    // Event listeners to detect activity
    window.addEventListener('scroll', () => {
        toggleBackToTopButton();
        clearIdleTimer();
        idleTimer = setTimeout(setIdle, 2000);
    });

    window.addEventListener('mousemove', clearIdleTimer);
    window.addEventListener('keydown', clearIdleTimer);
    window.addEventListener('touchstart', clearIdleTimer);
    window.addEventListener('wheel', clearIdleTimer); 

    backToTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
        clearIdleTimer(); 
    });

    toggleBackToTopButton();
    setTimeout(setIdle, 2000);
});
</script>