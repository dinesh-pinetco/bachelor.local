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
                'secondary': '#E4E4E7',
                'secondary-light': '#D4D4D8',
                'lightgray': '#EDEFF0',
                'gray': '#C6C7C8',
                'darkgray': '#707173',
                'red' : '#FF0000',
                'lightred': '#F05555',
                'darkgreen':'#059669',
            }
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
