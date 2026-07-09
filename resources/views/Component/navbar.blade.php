<nav 
    x-data="{ open:false, scrolled:false, transparent: @json($transparentNavbar ?? false), get darkNavbar(){return !this.transparent || this.scrolled} }" 
    x-init="if(transparent){
              window.addEventListener('scroll', () => {
                  scrolled = window.scrollY > 50
              })
            } else {
              scrolled = true
            }" 
    :class="darkNavbar ? 'fixed top-0 bg-white shadow-md' : 'absolute top-0 bg-transparent'"
    class="w-full z-50 transition-all duration-300"
    >
    <div class="max-w-7xl mx-auto px-6">
      <div class="h-20 flex items-center justify-between">
        <div class="flex items-center">
          <a href="{{ route('home') }}">
            <img src="{{ asset('assets/logo.png') }}" class="w-30 h-auto" alt="logo">
          </a>
        </div>

  <div class="hidden md:flex absolute left-1/2 -translate-x-1/2 space-x-8">
    <a href="{{ route('itinerary') }}" :class="darkNavbar ? 'text-gray-800' : 'text-white'" class="font-bold">
        {{ __('messages.Itinerary') }}
    </a>

    <a href="{{ route('trips') }}" :class="darkNavbar ? 'text-gray-800' : 'text-white'" class="font-bold">
        {{ __('messages.Saved') }}
    </a>

    <a href="{{ route('blog') }}" :class="darkNavbar ? 'text-gray-800' : 'text-white'" class="font-bold">
      {{ __('messages.blog') }}
    </a>

    <a href="{{ route('about') }}" :class="darkNavbar ? 'text-gray-800' : 'text-white'" class="font-bold">
      {{ __('messages.about_us') }}
    </a>
  </div>

  <div class="flex items-center gap-4">

    @auth
        <a href="{{ route('profile') }}"
           class="hidden md:flex items-center gap-3">
            <img
                src="{{ auth()->user()->avatar }}"
                alt="profile"
                class="w-10 h-10 rounded-full object-cover"
                referrerpolicy="no-referrer">
            <span :class="darkNavbar ? 'text-black' : 'text-white'" class="font-medium">
              {{ auth()->user()->name }}
            </span>

        </a>
    @else
        <a href="{{ route('login') }}">
          <button class="hidden md:block px-5 py-2 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold">
            Log In
          </button>
        </a>
    @endauth

    <button
        @click="open = !open"
        class="md:hidden"
        aria-label="Toggle navigation menu"
    >
        <svg
            x-show="!open"
            x-cloak
            class="w-8 h-8 opacity-90"
            :class="darkNavbar ? 'text-gray-800' : 'text-white'"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
            />
        </svg>

        <svg
            x-show="open"
            x-cloak
            class="w-8 h-8 opacity-90"
            :class="darkNavbar ? 'text-gray-800' : 'text-white'"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
            />
        </svg>
    </button>
  </div>
  </div>
</div>

  <div x-show="open" x-transition class="md:hidden bg-white shadow-lg">
    <div class="px-6 py-5 space-y-4">
      @auth
          <a href="{{ route('profile') }}"
            class="flex items-center gap-3 w-full
                    text-black rounded-xl py-3 mt-4">

              <img
                  src="{{ auth()->user()->avatar }}"
                  alt="profile"
                  class="w-10 h-10 rounded-full object-cover"
                  referrerpolicy="no-referrer">

              <span class="font-medium truncate">
                  {{ auth()->user()->name }}
              </span>
          </a>
      @else
      @endauth
      <a href="{{ route('itinerary') }}" class="block text-gray-800">
        Itinerary Planner
      </a>
      <a href="{{ route('trips') }}" class="block text-gray-800">
        Save Trips
      </a>
      <a href="{{ route('blog') }}" class="block text-gray-800">
        Blog
      </a>
      <a href="{{ route('about') }}" class="block text-gray-800">
        About Us
      </a>
      @auth
          <a href="{{ route('profile') }}"
            class="block text-gray-800">
              Account Setting
          </a>
      @else
          <a href="{{ route('login') }}"
            class="block w-full text-center
                    bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A]
                    text-white rounded-xl py-3 mt-4">
              Log In
          </a>
      @endauth
    </div>
  </div>

</nav>