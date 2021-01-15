const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.postCss('style.css', 'css/style_tailwindcss.css', [
    tailwindcss('tailwind.config.js')
]).options({
    processCssUrls: false
});