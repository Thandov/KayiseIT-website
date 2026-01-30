const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        //"./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                kb: {
                    50: '#f0f4ff',
                    100: '#183ea4',
                    200: '#0086c9',
                    300: '#0070b6',
                    400: '#0064ad',
                    500: '#1d53a0',
                    600: '#274698',
                    700: '#263a57',
                },
                kg: {
                    50: '#f0fdf4',
                    100: '#c7e0c2',
                    200: '#a2cfa8',
                    300: '#7cbd81',
                    400: '#3fab5f',
                    500: '#368e4f',
                    600: '#28663d',
                    700: '#22C55E',
                    800: '#1a5a2f',
                    900: '#0f3421',
                }
            },
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
