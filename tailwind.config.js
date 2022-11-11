const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    // mode: 'jit',
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            container:{
                center: true,
                padding: '1rem',
            },
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': '#003A79',
                'primary-light': '#AFB1CE',
                'darkgray': '#707173',
                'gray': '#C6C7C8',
                'lightgray': '#EDEFF0',
                'red' : '#FF0000',
                'lightred': '#F05555',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
