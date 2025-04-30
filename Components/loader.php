<div id="page-loader">
    <div class="loader-content">
        <div class="loader-spinner"></div>
    </div>
</div>

<script>
    // Handle page loader
window.addEventListener('load', () => {
    const loader = document.getElementById('page-loader');
    setTimeout(() => {
        loader.classList.add('fade-out');
    }, 500);
});
</script>