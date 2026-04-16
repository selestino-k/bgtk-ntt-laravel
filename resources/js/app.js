import './bootstrap';

// Dark mode toggle
const DARK_THEME = 'mytheme-dark';
const LIGHT_THEME = 'mytheme';
const htmlEl = document.documentElement;

document.addEventListener('DOMContentLoaded', () => {
    const toggle = document.querySelector('#dark-mode-toggle input[type="checkbox"]');
    if (!toggle) return;

    // checked = dark (sun), unchecked = light (moon)
    toggle.checked = htmlEl.getAttribute('data-theme') === DARK_THEME;

    toggle.addEventListener('change', () => {
        const newTheme = toggle.checked ? DARK_THEME : LIGHT_THEME;
        htmlEl.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
    });
});
