module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      backgroundImage: {
        'logo': "url('./assets/logo_plan.png')",
        'edit': "url('./assets/edit.png')",
        'delete': "url('./assets/delete.png')",
      },
      container: {
        center: true,
      },
    },
  },
  plugins: [],
}