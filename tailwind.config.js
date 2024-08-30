/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './**/*.php',              // すべてのPHPファイル
    './src/css/**/*.css',      // src/cssフォルダ内のすべてのCSSファイル
    './public/**/*.html',      // publicフォルダ内のすべてのHTMLファイル
    './public/**/*.js',        // publicフォルダ内のすべてのJSファイル
  ],
  theme: {
    extend: {
      fontFamily: {
        maruminya: ['Maruminya', 'sans-serif'],
      }
    },
  },
  plugins: [],
}
