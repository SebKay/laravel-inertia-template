/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                'brand': {
                    '50': '#f3f6fb',
                    '100': '#e5e9f4',
                    '200': '#d0d9ed',
                    '300': '#b0c0e0',
                    '400': '#8a9fd0',
                    '500': '#6a7fc1',
                    '600': '#5b6bb5',
                    '700': '#505aa5',
                    '800': '#464c87',
                    '900': '#3c416c',
                    '950': '#282a43',
                },
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
    ],
}
