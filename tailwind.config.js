/** @type {import('tailwindcss').Config} */
import preset from './vendor/filament/support/tailwind.config.preset'

module.exports = {
    presets: [preset],
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/lunarphp/**/*.blade.php",
        "./vendor/lunarphp/**/*.vue",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/palette/resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                secondary: {
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
                primary: {
                    DEFAULT: '#333', // Base gray
                    50:  '#f9f9f9',      // Lightest
                    100: '#e6e6e6',
                    200: '#cccccc',
                    300: '#b3b3b3',
                    400: '#999999',
                    500: '#333',      // Base
                    600: '#666666',      // Darker
                    700: '#4d4d4d',
                    800: '#333333',
                    900: '#1a1a1a',      // Darkest
                },
            },
        },
    },
    plugins: [],
};
