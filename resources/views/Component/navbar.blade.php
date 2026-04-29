<nav 
    x-data="{ open:false, scrolled:false }" 
    x-init="window.addEventListener('scroll', () => {scrolled = window.scrollY > 50})" 
    :class="scrolled ? 'fixed top-0 bg-white shadow-md':'absolute top-0 bg-transparent'"
    class="w-full z-50 transition-all duration-300"
    >
    <div class="max-w-7xl mx-auto px-6">
      <div class="h-20 flex items-center justify-between">
        <div class="flex items-center">
          <img src="assets/logo.png" class="w-30 h-auto" alt="logo">
    </div>

  <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 space-x-8">
    <a href="#" :class="scrolled ? 'text-gray-800' : 'text-[#F5F0EC]'" class="font-bold">
        Itinerary Planner
    </a>

    <a href="#" :class="scrolled ? 'text-gray-800' : 'text-[#F5F0EC]'" class="font-bold">
        Save Trips
    </a>

    <a href="#" :class="scrolled ? 'text-gray-800' : 'text-[#F5F0EC]'" class="font-bold">
      Blog
    </a>

    <a href="#" :class="scrolled ? 'text-gray-800' : 'text-[#F5F0EC]'" class="font-bold">
      About Us
    </a>
  </div>

  <div class="flex items-center gap-4">
    <button class="hidden md:block px-5 py-2 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold">
      Log In
    </button>
    <button @click="open=!open" class="md:hidden">
      <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" :class="scrolled ? 'text-black':'text-white'"viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
          <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" :class="scrolled ? 'text-black':'text-white'"viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
  </div>
  </div>
</div>

  <div x-show="open" x-transition class="md:hidden bg-white shadow-lg">
    <div class="px-6 py-5 space-y-4">
      <a href="#" class="block text-gray-800">
        Itinerary Planner
      </a>
      <a href="#" class="block text-gray-800">
        Save Trips
      </a>
      <a href="#" class="block text-gray-800">
        Blog
      </a>
      <a href="#" class="block text-gray-800">
        About Us
      </a>
      <button class="w-full bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-white rounded-xl py-3 mt-4">
        Log In
      </button>
    </div>
  </div>

</nav>