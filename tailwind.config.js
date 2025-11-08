module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./app/Livewire/**/*.php", 
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require('daisyui'),
  ],
}