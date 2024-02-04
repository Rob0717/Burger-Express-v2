/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [".././*.tpl.php",".././*.class.php","../../Controllers/./*.class.php","./*.js"],
  theme: {
    extend: {},
    fontFamily: {
      roboto: ['Roboto','sans-serif'],
      montserrat: ['Montserrat','sans-serif']
    }
  },
  plugins: [],
}

