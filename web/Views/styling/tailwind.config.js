/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [".././*.tpl.php",".././*.class.php","../../Controllers/./*.class.php","./*.js",
  "../../Ajax/./*.php"],
  theme: {
    extend: {},
    fontFamily: {
      roboto: ['Roboto','sans-serif'],
      montserrat: ['Montserrat','sans-serif']
    }
  },
  plugins: [],
}

