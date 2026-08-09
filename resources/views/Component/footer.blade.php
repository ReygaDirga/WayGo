<footer class="bg-[#06233F] text-white px-6 py-8 md:px-12">
  <div class="flex flex-col items-center gap-6 ">
    <nav>
      <div class="flex gap-6 md:gap-10">
        <a href="#">
          <img src="{{ asset('assets/email.png') }}" class="w-6 md:w-7" alt="Email">
        </a>

        <a href="#">
          <img src="{{ asset('assets/X.png') }}" class="w-6 md:w-7" alt="X">
        </a>

        <a href="#">
          <img src="{{ asset('assets/instagram.png') }}" class="w-6 md:w-7" alt="Instagram">
        </a>
      </div>
    </nav>
    <nav class="w-full">
      <div class="flex flex-col sm:flex-row flex-wrap justify-center items-center gap-4 sm:gap-8 md:gap-12 text-center">
        <a href="{{ route('itinerary') }}" class="link link-hover">{{ __('messages.Itinerary') }}</a>
        <a href="{{ route('trips') }}" class="link link-hover">{{ __('messages.Saved') }}</a>
        <a href="{{ route('blog') }}" class="link link-hover">{{ __('messages.blog') }}</a>
        <a href="{{ route('about') }}" class="link link-hover">{{ __('messages.about_us') }}</a>
      </div>
    </nav>

    <section>
      <img 
        src="{{ asset('assets/logo.png') }}" 
        class="w-28 sm:w-32 md:w-40"
        alt="WayGo Logo"
      >
    </section>

    <aside class="text-sm text-center">
      <p>Copyright © 2025 WayGo</p>
    </aside>

  </div>

</footer>