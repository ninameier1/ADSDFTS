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
                    primary: '#500724', // Primary colour
                    secondary: '#0284c7', // Secondary colour
                    neutral: '#e2e8f0', // Neutral background colour
                    dark: '#0f172a', // Dark mode primary colour
                    darkneutral: '#1e293b', // Dark mode neutral background colour
                    darktext: '#94a3b8' // Dark mode text colour
                },
            },
        },

        plugins: [forms],
    };

