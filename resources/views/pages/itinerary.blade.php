<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>Waygo</title>
     @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/location.js',
        'resources/js/date.js',
        'resources/css/category.css'
        ])
</head>
<body>
    @include('Component.navbar')
    <section class="relative pt-20 sm:pt-20 md:pt-50 lg:pt-55">
        <div class="flex justify-center px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-5xl mt-10 md:-mt-20">
                <h1 class="font-bold leading-tight text-2xl sm:text-3xl md:text-4xl lg:text-5xl">
                    <span class="text-[#034A7D]">Start Planning</span><span class="text-[#F79204]"> Your Journey!</span>
                    <br>
                    <span class="text-black sm:text-lg md:text-xl lg:text-3xl">
                        Discover amazing places, unforgettable experiences, and create memories that last a lifetime.
                    </span>
                </h1>
                <div class="relative mt-8 md:mt-12 w-full max-w-3xl mx-auto">
                    <div class="relative rounded-2xl 
                        p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 text-left">
                            <div class="relative w-full">
                                <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                    Location
                                </h3>

                                <div class="flex items-center gap-2">
                                    <span>
                                        <img src="assets/location.svg">
                                    </span>

                                    <input
                                        id="locationSearch"
                                        type="text"
                                        placeholder="City, Province"
                                        class="outline-none bg-transparent w-full"
                                        autocomplete="off"
                                    >
                                </div>
                                <div
                                    id="locationResults"
                                    class="hidden absolute top-full left-0 mt-3 bg-white shadow-xl rounded-xl w-80 z-50 max-h-60 overflow-auto"
                                >
                                </div>

                            </div>
                            <div>
                                <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                    Date
                                </h3>

                                <div class="flex items-center gap-2">
                                    <span>
                                        <img src="assets/calendar.svg">
                                    </span>

                                    <input
                                        id="dateRange"
                                        type="text"
                                        placeholder="Start Date - End Date"
                                        readonly
                                        class="outline-none bg-transparent cursor-pointer w-full"
                                    >
                                </div>
                            </div>
                                <div class="relative">
                                    <h3 class="font-extrabold text-lg md:text-xl mb-2">
                                        Traveler
                                    </h3>
                                    <button
                                        id="travelerBtn"
                                        class="flex items-center gap-2"
                                        type="button"
                                        >
                                        <span>
                                            <img src="assets/trip.svg">
                                        </span>

                                        <span class="text-gray-500">
                                            Adults :
                                            <span id="adultCount">
                                                0
                                            </span>
                                            Kids :
                                            <span id="kidCount">
                                                0
                                            </span>
                                        </span>
                                    </button>
                            <div id="travelerPopup" class="hidden absolute top-full left-0 mt-4 bg-white rounded-xl shadow-xl p-5 w-64 z-50">
                                <div class="flex items-center justify-between mb-5">
                                    <span class="font-medium">
                                        Adults
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
                                        Kids
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

    <section>
        <div class="wrapper">
            <div class="container">
                <input class="inputW" type="radio" name="slide" id="c1" checked>
                <label for="c1" class="card">
                    <div class="row">
                        <div class="description">
                            <h4 class="text-black font-extrabold">Culture</h4>
                            <p>Experience the rich culture and traditions of every destination. Visit historical landmarks, traditional villages, and learn about local heritage and customs.</p>
                        </div>
                    </div>
                </label>
                <input class="inputW" type="radio" name="slide" id="c2" >
                <label for="c2" class="card">
                    <div class="row">
                        <div class="description">
                            <h4 class="text-black font-extrabold">Nature</h4>
                            <p>Discover stunning beaches, lush forests, majestic mountains, and breathtaking natural landscapes.</p>
                        </div>
                    </div>
                </label>
                <input class="inputW" type="radio" name="slide" id="c3" >
                <label for="c3" class="card">
                    <div class="row">
                        <div class="description">
                            <h4 class="font-extrabold">Culinary</h4>
                            <p>Discover the unique flavors of Indonesian cuisine.Enjoy authentic local dishes, street food, and traditional culinary experiences from different regions.</p>
                        </div>
                    </div>
                </label>
                <input class="inputW" type="radio" name="slide" id="c4" >
                <label for="c4" class="card">
                    <div class="row">
                        <div class="description">
                            <h4 class="text-black font-extrabold">Adventure</h4>
                            <p>Feel the thrill of exciting outdoor adventures. From hiking mountains and diving in crystal waters to surfing and exploring hidden natural spots.</p>
                        </div>
                    </div>
                </label>
            </div>
        </div>

    </section>

    <div class="flex items-center justify-center">
        <button class="md:block px-30 py-4 rounded-xl bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] text-[#F5F0EC] font-extrabold mb-10">
            Submit
        </button>
    </div>


    @include('Component.footer')
</body>
</html>