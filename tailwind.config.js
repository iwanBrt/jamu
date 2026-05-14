/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./index.html", "./src/js/**/*.js"],
  theme: {
    extend: {
      colors: {
        brand: {
          pink: '#DB6B8B',
          'pink-light': '#F7A7B9',
          'pink-soft': '#FFE5E9',
          red: '#FA4D4D',
          cream: '#FFF1F3',
          brown: '#5C3224',
          dark: '#2D1610',
          accent: '#B14161',
        }
      },
      fontFamily: {
        display: ['Baloo 2', 'Nunito', 'sans-serif'],
        serif: ['Fraunces', 'serif'],
        sans: ['Nunito', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
