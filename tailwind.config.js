import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default
    {
        darkMode: 'class', // This enables dark mode using a class so I can build a toggle for it

        content:
        [
            './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
            './storage/framework/views/*.php',
            './resources/views/**/*.blade.php',
        ],

        theme:
        {
            extend:
            {
                fontFamily:
                {
                    sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                },
                colors:
                {
                    primary: '#500724', // Primary color
                    secondary: '#0284c7', // Secondary color
                    neutral: '#e2e8f0', // Neutral background
                    dark: '#0f172a', // Dark mode
                    darkneutral: '#1e293b',
                    darktext: '#94a3b8'
                },
            },
        },

        plugins: [forms],
    };

