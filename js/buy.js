document.addEventListener('DOMContentLoaded', function () {
    // -------------------- Active Nav Link --------------------
    const links = document.querySelectorAll('nav ul li a');
    const currentPath = window.location.pathname.split('/').pop();

    links.forEach(link => {
        const href = link.getAttribute('href').split('/').pop();
        if (href === currentPath || (href === '' && currentPath === 'buy.php')) {
            link.classList.add('active');
        }
    });

    // -------------------- Favorite Buttons --------------------
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    favoriteButtons.forEach(button => {
        button.addEventListener('click', function () {
            this.classList.toggle('active');
            const icon = this.querySelector('i');
            icon.classList.toggle('fas', this.classList.contains('active'));
            icon.classList.toggle('far', !this.classList.contains('active'));
        });
    });
});
