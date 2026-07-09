<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo1.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Waygo</title>
     @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/location.js',
        'resources/js/date.js',
        'resources/css/category.css',
        'resources/js/category.js',
        'resources/css/card.css',
        'resources/js/travel.js',
        ])
</head>
<body>
    @include('Component.navbar')
    <section class="relative pt-20 sm:pt-20 md:pt-50 lg:pt-55">
        <div class="flex justify-center px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-5xl mt-10 md:-mt-20">
                <h1 class="font-bold leading-tight text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
                    <span class="text-[#034A7D]">{{ __('messages.startplan') }}</span><span class="text-[#F79204]"> {{ __('messages.journey') }}</span>
                    <br>
                    <span class="text-black sm:text-lg md:text-xl lg:text-3xl">
                        {{ __('messages.descplan') }}
                    </span>
                </h1>
                <div class="relative mt-8 md:mt-12 w-full max-w-3xl mx-auto">
                    <div class="relative rounded-2xl 
                        p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 text-left">
                            <div class="relative w-full">
                                <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                    {{ __('messages.location') }}
                                </h3>

                                <div class="h-10 flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-1">
                                    <span>
                                        <img src="{{ asset('assets/location.svg') }}" class="w-5 h-5 shrink-0">
                                    </span>

                                    <input
                                        id="locationSearch"
                                        name="location"
                                        value="{{ request('location') }}"
                                        type="text"
                                        placeholder="{{ __('messages.plocation') }}"
                                        class="outline-none bg-transparent w-full">
                                        
                                </div>
                                <div
                                    id="locationResults"
                                    class="hidden absolute top-full left-0 mt-3 bg-white shadow-xl rounded-xl w-80 z-50 max-h-60 overflow-auto"
                                >
                                </div>

                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                    {{ __('messages.date') }}
                                </h3>

                                <div class="h-10 flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-1">
                                    <span>
                                        <img src="{{ asset('assets/calendar.svg') }}" class="w-5 h-5 shrink-0">
                                    </span>

                                    <input
                                        id="dateRange"
                                        name="date"
                                        value="{{ request('date') }}"
                                        type="text"
                                        placeholder="{{ __('messages.pdate') }}"
                                        readonly
                                        class="outline-none bg-transparent w-full">
                                </div>
                            </div>
                                <div class="relative ">
                                    <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                        {{ __('messages.traveler') }}
                                    </h3>
                                    <button
                                        id="travelerBtn"
                                        class="w-full h-10 flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-1"
                                        type="button"
                                        
                                        >
                                        <span>
                                            <img src="{{ asset('assets/trip.svg') }}">
                                        </span>

                                        <span class="text-gray-500">
                                            {{ __('messages.adults') }} :
                                            <span id="adultCount">
                                                {{ request('adults',0) }}
                                            </span>
                                            {{ __('messages.kids') }} :
                                            <span id="kidCount">
                                                {{ request('kids',0) }}
                                            </span>
                                        </span>
                                    </button>
                            <div id="travelerPopup" class="hidden absolute top-full left-0 mt-4 bg-white rounded-xl shadow-xl p-5 w-64 z-50">
                                <div class="flex items-center justify-between mb-5">
                                    <span class="font-medium">
                                        {{ __('messages.adults') }}
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <button id="adultMinus" class="w-8 h-8 border rounded-full">
                                            -
                                        </button>
                                        <span id="adultNumber">
                                            0
                                        </span>
                                        <button id="adultPlus" class="w-8 h-8 border rounded-full">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-medium">
                                        {{ __('messages.kids') }}
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <button id="kidMinus" class="w-8 h-8 border rounded-full">
                                            -
                                        </button>
                                        <span id="kidNumber">
                                            0
                                        </span>
                                        <button id="kidPlus" class="w-8 h-8 border rounded-full">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <span class="text-black font-semibold sm:text-lg md:text-xl lg:text-2xl text-center mt-10 block">
        {{ __('messages.select') }}
    </span>

    <section>
        <div class="testcontainer">
            <main class="grid-cardd">
                <article class="kard" data-category="culture">
                        <img src="{{ asset('assets/jakarta.jpg') }}" alt="">
                        <div class="text-penjelasan">
                            <h3>Culture</h3>
                            <hr>
                            <p>Experience the rich culture and traditions of every destination. Visit historical landmarks, traditional villages, and learn about local heritage and customs.</p>
                        </div>
                </article>
                <article class="kard" data-category="nature">
                        <img src="{{ asset('assets/hutan.jpeg') }}" alt="">
                        <div class="text-penjelasan">
                            <h3>Nature</h3>
                             <hr>
                            <p>Discover stunning beaches, lush forests, majestic mountains, and breathtaking natural landscapes.</p>
                        </div>
                </article>
                <article class="kard" data-category="culinary">
                        <img src="{{ asset('assets/kuliner.png') }}" alt="">
                        <div class="text-penjelasan">
                            <h3>Culinary</h3>
                             <hr>
                            <p>Discover the unique flavors of Indonesian cuisine.Enjoy authentic local dishes, street food, and traditional culinary experiences from different regions.</p>
                        </div>
                </article>
                <article class="kard" data-category="adventure">
                        <img src="{{ asset('assets/rinjani.jpg') }}" alt="">
                        <div class="text-penjelasan">
                            <h3>Adventure</h3>
                             <hr>
                            <p>Feel the thrill of exciting outdoor adventures. From hiking mountains and diving in crystal waters to surfing and exploring hidden natural spots.</p>
                        </div>
                </article>
            </main>
        </div>
    </section>

    <input
        type="hidden"
        name="categories"
        id="selectedCategories"
    >

    <div class="flex items-center justify-center mt-6">
        <a href="{{ route('itinerary-detail') }}" class="btn md:block px-30 py-4 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold mb-10">
            {{ __('messages.submit') }}
        </a>
    </div>


    @include('Component.footer')
</body>

</html>