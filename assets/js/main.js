'use strict';

const menuButton = document.querySelector('.menu-toggle');
const menu = document.querySelector('#main-menu');
if (menuButton && menu) {
    menuButton.addEventListener('click', () => {
        const expanded = menuButton.getAttribute('aria-expanded') === 'true';
        menuButton.setAttribute('aria-expanded', String(!expanded));
        menu.classList.toggle('open');
    });
}

document.querySelectorAll('[data-current-year]').forEach((element) => {
    element.textContent = new Date().getFullYear();
});

const tickerText = document.querySelector('[data-scrolling-text]');
if (tickerText && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    let position = window.innerWidth;
    const moveTicker = () => {
        position -= 1;
        if (position < -tickerText.offsetWidth) position = window.innerWidth;
        tickerText.style.transform = `translateX(${position}px)`;
        window.requestAnimationFrame(moveTicker);
    };
    window.requestAnimationFrame(moveTicker);
}

const slider = document.querySelector('[data-slider]');
if (slider) {
    const image = slider.querySelector('[data-slide]');
    const count = slider.querySelector('[data-slide-count]');
    const caption = slider.querySelector('[data-slide-caption]');
    const slides = [
        ['assets/images/slide-1.svg', 'Business intelligence that turns activity into insight.', 'Abstract illustration of business analytics'],
        ['assets/images/slide-2.svg', 'Connected teams working from one reliable source of truth.', 'Abstract illustration of connected teams'],
        ['assets/images/slide-3.svg', 'Secure records designed for confident everyday decisions.', 'Abstract illustration of secure records'],
        ['assets/images/slide-4.svg', 'Practical digital support whenever the work demands it.', 'Abstract illustration of digital support'],
        ['assets/images/slide-5.svg', 'Clear direction for the next stage of your organisation.', 'Abstract illustration of business growth']
    ];
    let current = 0;
    let timer;
    const showSlide = (index) => {
        current = (index + slides.length) % slides.length;
        image.classList.add('changing');
        window.setTimeout(() => {
            image.src = slides[current][0];
            image.alt = slides[current][2];
            count.textContent = `${String(current + 1).padStart(2, '0')} / 05`;
            caption.textContent = slides[current][1];
            image.classList.remove('changing');
        }, 180);
    };
    const startTimer = () => {
        window.clearInterval(timer);
        timer = window.setInterval(() => showSlide(current + 1), 5000);
    };
    slider.querySelector('[data-slide-prev]').addEventListener('click', () => { showSlide(current - 1); startTimer(); });
    slider.querySelector('[data-slide-next]').addEventListener('click', () => { showSlide(current + 1); startTimer(); });
    startTimer();
}

const popupResult = document.querySelector('[data-popup-result]');
document.querySelectorAll('[data-popup]').forEach((button) => {
    button.addEventListener('click', () => {
        const type = button.dataset.popup;
        if (type === 'alert') {
            window.alert('Welcome to Awesome Group Company!');
            popupResult.textContent = 'Alert result: the visitor acknowledged the message.';
        } else if (type === 'confirm') {
            const accepted = window.confirm('Would you like Awesome Group to contact you?');
            popupResult.textContent = `Confirm result: the visitor selected ${accepted ? 'OK' : 'Cancel'}.`;
        } else {
            const name = window.prompt('What is your name?', 'UCC Student');
            popupResult.textContent = name === null ? 'Prompt result: the visitor selected Cancel.' : `Prompt result: Hello, ${name || 'visitor'}!`;
        }
    });
});

const tableSearch = document.querySelector('[data-table-search]');
if (tableSearch) {
    tableSearch.addEventListener('input', () => {
        const query = tableSearch.value.toLowerCase();
        document.querySelectorAll('[data-record-table] tbody tr').forEach((row) => {
            row.hidden = !row.textContent.toLowerCase().includes(query);
        });
    });
}

document.querySelectorAll('[data-delete-form]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm('Delete this client record? This action cannot be undone.')) event.preventDefault();
    });
});
