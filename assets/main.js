const header = document.querySelector('.site-header');
if (header) {
    window.addEventListener('scroll', () => {
        header.classList.toggle('scrolled', window.scrollY > 20);
    });
}

const menuToggle = document.querySelector('.menu-toggle');
const mainNav = document.querySelector('.main-nav');
const navOverlay = document.querySelector('.nav-overlay');
const menuClose = document.querySelector('.menu-close');

function closeMobileMenu() {
    mainNav?.classList.remove('open');
    menuToggle?.classList.remove('active');
    navOverlay?.classList.remove('active');
    document.body.classList.remove('menu-open');
    if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'false');
    }
}

function openMobileMenu() {
    mainNav?.classList.add('open');
    menuToggle?.classList.add('active');
    navOverlay?.classList.add('active');
    document.body.classList.add('menu-open');
    if (menuToggle) {
        menuToggle.setAttribute('aria-expanded', 'true');
    }
}

if (menuToggle && mainNav) {
    menuToggle.addEventListener('click', (event) => {
        event.stopPropagation();
        const isOpen = mainNav.classList.contains('open');
        if (isOpen) {
            closeMobileMenu();
        } else {
            openMobileMenu();
        }
    });

    menuClose?.addEventListener('click', closeMobileMenu);
    navOverlay?.addEventListener('click', closeMobileMenu);
    document.addEventListener('click', (event) => {
        if (!mainNav.contains(event.target) && !menuToggle.contains(event.target) && mainNav.classList.contains('open')) {
            closeMobileMenu();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') {
            closeMobileMenu();
        }
    });

    mainNav.querySelectorAll('a').forEach((link) => {
        link.addEventListener('click', closeMobileMenu);
    });
}

const searchInput = document.getElementById('destinationSearch');
const categorySelect = document.getElementById('destinationFilter');
const cards = document.querySelectorAll('.destination-card');

function applyDestinationFilter() {
    const query = (searchInput?.value || '').toLowerCase().trim();
    const category = categorySelect?.value || 'all';

    cards.forEach((card) => {
        const text = card.dataset.search || '';
        const cardCategory = card.dataset.category || 'all';
        const matchesQuery = text.includes(query);
        const matchesCategory = category === 'all' || cardCategory === category;
        card.style.display = matchesQuery && matchesCategory ? 'block' : 'none';
    });
}

if (searchInput || categorySelect) {
    [searchInput, categorySelect].forEach((element) => {
        element?.addEventListener('input', applyDestinationFilter);
        element?.addEventListener('change', applyDestinationFilter);
    });
}
