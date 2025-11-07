<div id="page-loader">
    <div class="loader-content">
        <!-- Simple pulsing house -->
        <div class="house-pulse">
            <div class="roof-line"></div>
            <div class="wall-line"></div>
        </div>

        <!-- Moving progress line -->
        <div class="scan-progress"></div>
    </div>
</div>

<style>
    #page-loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: white;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 1;
        transition: opacity 300ms ease;
    }

    /* Hidden state: visually invisible and non-interactive */
    #page-loader.hidden {
        opacity: 0;
        pointer-events: none;
    }

    .loader-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
    }

    /* Entire house pulsing together */
    .house-pulse {
        position: relative;
        width: 80px;
        height: 60px;
        animation: pulse 1.5s infinite ease-in-out;
    }

    .roof-line {
        width: 0;
        height: 0;
        border-left: 40px solid transparent;
        border-right: 40px solid transparent;
        border-bottom: 30px solid black;
        margin: 0 auto;
    }

    .wall-line {
        width: 60px;
        height: 30px;
        background: black;
        margin: -3px auto 0;
        border-radius: 0 0 3px 3px;
    }

    /* Scanner animation */
    .scan-progress {
        width: 100px;
        height: 2px;
        background: black;
        position: relative;
        overflow: hidden;
    }

    .scan-progress::after {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        width: 30px;
        height: 100%;
        background: white;
        animation: scan 1.8s infinite linear;
    }

    /* Text styling */
    .loader-text {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: 500;
        color: black;
        letter-spacing: 1px;
    }

    /* Animations */
    @keyframes pulse {

        0%,
        100% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.1);
        }
    }

    @keyframes scan {
        0% {
            transform: translateX(-30px);
        }

        100% {
            transform: translateX(130px);
        }
    }

    /* Responsive */
    @media (max-width: 600px) {
        .house-pulse {
            transform: scale(0.8);
        }

        .loader-text {
            font-size: 12px;
        }
    }
</style>

<script>
    (function(){
        var loader = document.getElementById('page-loader');
        if (!loader) return;

        function hideLoader() {
            if (!loader || loader.classList.contains('hidden')) return;
            // Make it non-interactive immediately
            loader.classList.add('hidden');
            // Remove from flow after transition
            setTimeout(function(){
                if (loader) loader.style.display = 'none';
            }, 400);
        }

        // Hide as soon as DOM is interactive to avoid blocking clicks
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function(){
                // small delay for nicer fade
                setTimeout(hideLoader, 200);
            });
        } else {
            setTimeout(hideLoader, 200);
        }

        // Also hide on full load (in case DOMContentLoaded was missed)
        window.addEventListener('load', function(){
            hideLoader();
        });

        // Hard fallback: ensure it's gone after 3 seconds regardless
        setTimeout(hideLoader, 3000);
    })();
</script>