/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "index.php",
    "./src/**/*.{html, js}",
    "./admin/**/*.{html, js, php}",
    "./admin/banner/*.{html, js, php}",
    "./admin/mapel/*.{html, js, php}",
    "./admin/pengurus/*.{html, js, php}",
  ],
  theme: {
    container: {
      center: true,
      padding: "16px",
    },
    extend: {
      screens: {
        "2xl": "1300px",
      },
    },
    fontFamily: {
      jkt: ["Plus Jakarta Sans", "sans-serif"],
    },
  },
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
  plugins: [require("daisyui")],
};
