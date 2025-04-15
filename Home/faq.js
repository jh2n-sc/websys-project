const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
item.querySelector('.faq-question').addEventListener('click', () => {
item.classList.toggle('active');

faqItems.forEach(otherItem => {
    if (otherItem !== item) {
    otherItem.classList.remove('active');
    }
});
});
});