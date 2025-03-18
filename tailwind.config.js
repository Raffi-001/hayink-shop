/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/lunarphp/**/*.blade.php",
        "./vendor/lunarphp/**/*.vue"
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    DEFAULT: '#00aea8', // Base color
                    50: '#e0f8f8', // Lightest
                    100: '#b3eded',
                    200: '#80e2e2',
                    300: '#4dd7d7',
                    400: '#26cbcb',
                    500: '#00aea8', // Base
                    600: '#009997', // Darker
                    700: '#007a76',
                    800: '#005b57',
                    900: '#003d3b', // Darkest
                },
                secondary: {
                    DEFAULT: '#dc163e', // Base color
                    50: '#fde7ec', // Lightest
                    100: '#f9beca',
                    200: '#f4939e',
                    300: '#ef6873',
                    400: '#eb3e51',
                    500: '#dc163e', // Base
                    600: '#b21031', // Darker
                    700: '#880b24',
                    800: '#5e0618',
                    900: '#35030e', // Darkest
                },
            },
        },
    },
    plugins: [],
};
