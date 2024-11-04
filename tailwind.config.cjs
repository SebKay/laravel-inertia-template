/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        fontFamily: {
            'text': ['Arial', 'sans-serif'],
            'heading': ['Arial', 'sans-serif'],
        },

        extend: {
            screens: {
                'xs': '321px',
                'sm': '451px',
                'md': '671px',
                'lg': '769px',
                'xl': '1025px',
                '2xl': '1281px',
                '3xl': '1441px',
                '4xl': '1901px',
            },

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
        require('@tailwindcss/typography'),
    ],
}
