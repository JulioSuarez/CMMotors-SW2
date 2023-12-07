/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        fontFamily: {
            'Carter': ['Carter One'],
        },
        extend: {
            animation: {
                wiggle: 'wiggle 1s ease-in-out infinite',
            }
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
