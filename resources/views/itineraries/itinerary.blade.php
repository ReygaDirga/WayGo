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

    <form action="{{ route('itinerary-detail') }}" method="post" id="itineraryForm">
        @csrf
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
                <div class="relative mt-8 md:mt-12 w-full max-w-5xl mx-auto">
                    <div class="relative rounded-2xl p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 text-left">
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
                                        <button type="button" id="adultMinus" class="w-8 h-8 border rounded-full">
                                            -
                                        </button>
                                        <span id="adultNumber">
                                            0
                                        </span>
                                        <button type="button" id="adultPlus" class="w-8 h-8 border rounded-full">
                                            +
                                        </button>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="font-medium">
                                        {{ __('messages.kids') }}
                                    </span>
                                    <div class="flex items-center gap-3">
                                        <button type="button" id="kidMinus" class="w-8 h-8 border rounded-full">
                                            -
                                        </button>
                                        <span id="kidNumber">
                                            0
                                        </span>
                                        <button type="button" id="kidPlus" class="w-8 h-8 border rounded-full">
                                            +
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div>
                                <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                    Budget
                                </h3>

                                <div class="h-10 flex items-center gap-2 border border-gray-300 rounded-lg px-3 py-1">
                                    <span>
                                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </span>

                                    <input
                                        id="budgetDisplay"
                                        type="text"
                                        placeholder="Rp 1.000.000"
                                        onkeyup="formatRupiah(this)"
                                        class="outline-none bg-transparent w-full">

                                    <input 
                                        type="hidden" 
                                        id="budget" 
                                        name="budget" 
                                        value="{{ request('budget') }}">
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
                    @foreach ($category as $cat)
                    <article class="kard" data-category="{{ $cat->id }}">
                        <img src="{{ $cat->image }}" alt="{{ $cat->name }}">
                        <div class="text-penjelasan">
                            <h3>{{ $cat->name }}</h3>
                            <hr>
                            <p>{{ $cat->description }}</p>
                        </div>
                    </article>
                    @endforeach
                </main>
            </div>
        </section>
        
        <input type="hidden" id="categories" name="categories">
        <input type="hidden" name="adults" id="adultInput" value="0">
        <input type="hidden" name="kids" id="kidInput" value="0">

        <div class="flex items-center justify-center mt-6">
            @auth
                <button
                    type="submit"
                    class="btn md:block px-30 py-4 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold mb-10">
                    {{ __('messages.submit') }}
                </button>
            @else
                <a href="{{ route('login') }}"
                    class="btn md:block px-30 py-4 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold mb-10">
                    Log In
                </a>
            @endauth
            
        </div>
    </form>
    @include('Component.footer')

<div id="loadingOverlay"
     class="fixed inset-0 bg-black/70 backdrop-blur-md hidden flex justify-center items-center z-[9999]">
    <div class="text-center">
        <div class="mx-auto w-20 h-20 border-4 border-white/20 border-t-[#FA9009] rounded-full animate-spin"></div>
        <h2 class="text-white text-3xl font-bold mt-8">
            Creating Your Itinerary...
        </h2>
        <p id="loadingText" class="text-gray-300 mt-3">
            Finding the best destinations...
        </p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function formatRupiah(element) {
    let rawValue = element.value.replace(/[^0-9]/g, '');
    document.getElementById('budget').value = rawValue;

    if (rawValue) {
        let formatted = new Intl.NumberFormat('id-ID').format(rawValue);
        element.value = 'Rp ' + formatted;
    } else {
        element.value = '';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    let hiddenBudget = document.getElementById('budget');
    let displayBudget = document.getElementById('budgetDisplay');
    if (hiddenBudget && hiddenBudget.value) {
        formatRupiah({ value: hiddenBudget.value });
    }
});
</script>
</body>
</html>