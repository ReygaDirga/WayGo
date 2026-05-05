<img src="/assets/homepage.png" 
    alt="" 
    class="w-full h-full absolute inset-0 object-cover">

<div class="absolute inset-0 flex items-center justify-center px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-5xl mt-10 md:-mt-20">
        <h1 class="font-bold leading-tight text-3xl sm:text-3xl md:text-4xl lg:text-5xl">
            <span class="text-[#034A7D]">Way</span><span class="text-[#F79204]">Go</span>
            <br>
            <span class="text-[#F5F0EC] sm:text-3xl md:text-4xl lg:text-5xl">
                Pack your bags,
            </span>
            <span class="text-[#F79204] sm:text-3xl md:text-4xl lg:text-5xl">
                let's go!
            </span>
        </h1>
        <div class="relative mt-8 md:mt-12 w-full max-w-3xl mx-auto">
            <div class="absolute -inset-2 md:-inset-4
                bg-white/20 backdrop-blur-md rounded-3xl">
            </div>
            <div class="relative bg-white/90 rounded-2xl shadow-xl 
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
                <a href="{{ route('start-itinerary') }}">
                    <button class="mt-6 md:mt-8 w-full md:w-auto bg-gradient-to-b from-[#FA9009] via-[#F8A321] to-[#F6B83A] px-8 py-3
                                rounded-full text-white font-semibold hover:scale-105 transition">
                        Start Planning Now
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>