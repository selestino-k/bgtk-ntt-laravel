import './bootstrap';

// Dark mode toggle
const DARK_THEME = 'mytheme-dark';
const LIGHT_THEME = 'mytheme';
const htmlEl = document.documentElement;

document.addEventListener('DOMContentLoaded', () => {
    const toggles = document.querySelectorAll('#dark-mode-toggle input[type="checkbox"]');
    if (!toggles.length) return;

    const isDark = htmlEl.getAttribute('data-theme') === DARK_THEME;

    // checked = dark (sun), unchecked = light (moon)
    toggles.forEach(toggle => {
        toggle.checked = isDark;

        toggle.addEventListener('change', () => {
            const newTheme = toggle.checked ? DARK_THEME : LIGHT_THEME;
            htmlEl.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            // Sync all other toggles
            toggles.forEach(t => { if (t !== toggle) t.checked = toggle.checked; });
        });
    });
});
