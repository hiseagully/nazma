<!-- filepath: resources/views/components/whatsapp.blade.php -->
<style>
@keyframes wa-zoom {
  0%, 100% { transform: scale(1);}
  50% { transform: scale(1.15);}
}
.wa-zoom-anim {
  animation: wa-zoom 1.2s infinite;
}
</style>
<a
  href="https://wa.me/6281391503645?text=Hallo%20Admin%20Nazmalogy%2C%20I%20Need%20Help"
  class="fixed z-50 bottom-6 right-6 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-lg flex items-center justify-center w-11 h-11 wa-zoom-anim transition-all"
  target="_blank"
  rel="noopener"
  aria-label="Chat WhatsApp"
  style="box-shadow: 0 4px 16px rgba(0,0,0,0.15);"
>
  <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="22" height="22" viewBox="0 0 24 24">
    <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12a11.93 11.93 0 0 0 1.64 6.06L0 24l6.31-1.65A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22a9.93 9.93 0 0 1-5.13-1.42l-.37-.22-3.75.98.99-3.65-.24-.38A9.93 9.93 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.13-.13.28-.34.42-.51.14-.17.18-.29.28-.48.09-.18.05-.36-.02-.5-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.35-.01-.54-.01s-.5.07-.76.36c-.26.29-1 1.01-1 2.46s1.02 2.85 1.16 3.05c.14.2 2.01 3.07 4.88 4.19.68.29 1.21.46 1.62.59.68.22 1.3.19 1.79.12.55-.08 1.65-.67 1.89-1.32.23-.65.23-1.21.16-1.32-.07-.11-.25-.18-.53-.32z"/>
  </svg>
</a>