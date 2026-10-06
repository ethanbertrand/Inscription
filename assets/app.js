import './stimulus_bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

const themeInputs = document.querySelectorAll('input[name="theme"]');
const savedTheme = localStorage.getItem('theme');
const theme = savedTheme === 'dark' ? 'dark' : 'light';

document.documentElement.dataset.frScheme = theme;

themeInputs.forEach((input) => {
    input.checked = input.value === theme;
    input.addEventListener('change', () => {
        if (input.value !== 'light' && input.value !== 'dark') {
            return;
        }

        document.documentElement.dataset.frScheme = input.value;
        localStorage.setItem('theme', input.value);
    });
});
