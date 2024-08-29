import 'bootstrap';

import './bootstrap';

const media = window.matchMedia('(prefers-color-scheme: dark)');
const theme = media.matches ? 'dark' : 'light';
document.documentElement.setAttribute('data-bs-theme', theme);

media.addEventListener('change', (e) => {
    document.documentElement.setAttribute('data-bs-theme', e.matches ? 'dark' : 'light');
});
