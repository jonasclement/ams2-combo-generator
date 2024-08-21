import 'bootstrap';

import './bootstrap';

const theme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
document.documentElement.setAttribute('data-bs-theme', theme);
