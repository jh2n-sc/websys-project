const faqItems = document.querySelectorAll('.faq-item');

faqItems.forEach(item => {
  const question = item.querySelector('.faq-question');
  question.addEventListener('click', () => {
    item.classList.toggle('active');
    faqItems.forEach(otherItem => {
      if (otherItem !== item) {
        otherItem.classList.remove('active');
      }
    });
  });
});

const openButton = document.getElementById('open-sidebar-button');
const navbar = document.getElementById('navbar');

function handleResize() {
  if (window.innerWidth <= 768) {
    navbar.classList.remove('show');
    openButton.setAttribute('aria-expanded', 'false');
    navbar.setAttribute('inert', '');
  } else {
    navbar.removeAttribute('inert');
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



