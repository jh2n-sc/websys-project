<div id="page-loader">
    <div class="loader-content">
        <div class="loader-spinner"></div>
    </div>
</div>


<style>
    
#page-loader {
position: fixed;
top: 0;
left: 0;
width: 100vw;
height: 100vh;
background: #f9f9f9;
display: flex;
align-items: center;
justify-content: center;
z-index: 9999;
transition: opacity 0.1s ease, visibility 1s;
}

#page-loader.fade-out {
opacity: 0;
visibility: hidden;
pointer-events: none;
}

.loader-spinner {
width: 48px;
height: 48px;
border: 4px solid #ccc;
border-top-color: black;
border-radius: 50%;
animation: spin 0.3s linear infinite;
box-shadow: 0 3px 8px rgba(0,0,0,0.15);
}

/* Spinner Animation */
@keyframes spin {
to {
    transform: rotate(360deg);
}
}
</style>


<script>
    // Handle page loader
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 500);
});
</script>
