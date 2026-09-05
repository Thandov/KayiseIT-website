const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            spacing: {
                control: 'var(--ki-space-control)',
                cluster: 'var(--ki-space-cluster)',
                card: 'var(--ki-space-card)',
                stack: 'var(--ki-space-stack)',
                page: 'var(--ki-space-page)',
            },
            colors: {
                border: 'hsl(var(--border))',
                input: 'hsl(var(--input))',
                ring: 'hsl(var(--ring))',
                background: 'hsl(var(--background))',
                foreground: 'hsl(var(--foreground))',
                primary: {
                    DEFAULT: 'hsl(var(--primary))',
                    foreground: 'hsl(var(--primary-foreground))',
                },
                secondary: {
                    DEFAULT: 'hsl(var(--secondary))',
                    foreground: 'hsl(var(--secondary-foreground))',
                },
                destructive: {
                    DEFAULT: 'hsl(var(--destructive))',
                    foreground: 'hsl(var(--destructive-foreground))',
                },
                muted: {
                    DEFAULT: 'hsl(var(--muted))',
                    foreground: 'hsl(var(--muted-foreground))',
                },
                accent: {
                    DEFAULT: 'hsl(var(--accent))',
                    foreground: 'hsl(var(--accent-foreground))',
                },
                popover: {
                    DEFAULT: 'hsl(var(--popover))',
                    foreground: 'hsl(var(--popover-foreground))',
                },
                card: {
                    DEFAULT: 'hsl(var(--card))',
                    foreground: 'hsl(var(--card-foreground))',
                },
                kb: {
                    50: 'var(--ki-blue-50)',
                    100: 'var(--ki-blue)',
                    200: 'var(--ki-blue-200)',
                    300: 'var(--ki-blue-300)',
                    400: 'var(--ki-blue-400)',
                    500: 'var(--ki-blue-500)',
                    600: 'var(--ki-blue-600)',
                    700: 'var(--ki-blue-700)',
                },
                kg: {
                    50: 'var(--ki-green-50)',
                    100: 'var(--ki-green-100)',
                    200: 'var(--ki-green-200)',
                    300: 'var(--ki-green-300)',
                    400: 'var(--ki-green-400)',
                    500: 'var(--ki-green-500)',
                    600: 'var(--ki-green)',
                    700: 'var(--ki-green-bright)',
                    800: 'var(--ki-green-800)',
                    900: 'var(--ki-green-900)',
                }
            },
        },
    },
    plugins: [require('@tailwindcss/forms'), require('tailwindcss-animate')],
};
