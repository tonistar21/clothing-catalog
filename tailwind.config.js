import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import aspectRatio from '@tailwindcss/aspect-ratio';
import containerQueries from '@tailwindcss/container-queries';

export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/breeze/**/*.blade.php',
    ],

    theme: {
        container: {
            center: true,
            padding: '1rem',
            screens: {
                lg: '1024px',
                xl: '1280px',
            },
        },

        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },

            colors: {
                primary: {
                    DEFAULT: '#2563eb',
                    light: '#3b82f6',
                    dark: '#1e40af',
                },
                secondary: {
                    DEFAULT: '#10b981',
                    light: '#34d399',
                    dark: '#047857',
                },
                dark: '#111827',
                light: '#f9fafb',
            },

            boxShadow: {
                soft: '0 4px 12px rgba(0,0,0,0.08)',
            },

            borderRadius: {
                xl: '1rem',
            },

            animation: {
                fade: 'fadeIn .4s ease-in-out',
            },

            keyframes: {
                fadeIn: {
                    from: { opacity: 0 },
                    to: { opacity: 1 }
                },
            },
        },
    },

    plugins: [
        forms,
        typography,
        aspectRatio,
        containerQueries
    ],
};
