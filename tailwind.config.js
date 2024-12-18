const { colors } = require('laravel-mix/src/Log');
const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    mode: 'jit',
    purge: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php'],

    darkMode: 'selector',

    theme: {
        extend: {
            colors: {
                blauw: {
                    DEFAULT: '#222B60',
                    donker: '#000734',
                },
                groen: {
                    DEFAULT: '#14B1A2',
                },
                magenta: {
                    DEFAULT: '#9A1766',
                    donker: '#520034',
                },
                oranje: {
                    DEFAULT: '#F39321',
                },
                wit: {
                    DEFAULT: '#FFFFFF',
                    donker: '#F9F9F9',
                },
            },
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
                web: ['Heebo', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
