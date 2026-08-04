<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo1.png') }}" />
    <title>Blog-WayGo</title>
    @vite([
    'resources/css/app.css',
    'resources/js/app.js', 
    'resources/js/blog_hero.js',
    'resources/js/blog_filterPosts.js',
    'resources/js/imaps.js',
    'resources/js/accordion.js',
    'resources/js/modal.js'
    ])
</head>
<body class="min-h-screen">
    @include('Component.navbar')
    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-12 pb-8 pt-60 w-full max-w-6xl mx-auto mt-24">
        <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/720x0/webp/photo/2022/02/07/3234837550.jpg"
            class="absolute inset-0 h-full w-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>

        
        <h3 class="z-10 mt-3 text-4xl font-bold text-white">
            {{ explode(',', $json['trip_details']['location'])[0] }} Itinerary
        </h3>
        <div class="flex z-10">
            <div class="text-gray-300">
                Enjoy a memorable travel experience on your own. Discover a variety of unique destinations, from charming cafés to exciting attractions, all offering delightful moments and a captivating atmosphere that will make your journey truly unforgettable.
            </div>
        </div>
    </article>
    @php
        $totalBudget = 0;
        $totalDestination = 0;
        $totalRating = 0;
        $ratingCount = 0;

        foreach ($json['itinerary'] as $day) {
            foreach ($day['activities'] as $activity) {
                $totalBudget += $activity['estimated_cost'];
                $totalDestination++;
                $totalRating += $activity['google_maps_rating'];
                $ratingCount++;
            }
        }

        $averageRating = $ratingCount ? round($totalRating / $ratingCount, 1) : 0;

        $totalTravelers = max(1, (int) $json['trip_details']['adults'] + (int) $json['trip_details']['children']);
        $budgetPerPerson = $totalBudget / $totalTravelers;
    @endphp

    <section class="max-w-7xl mx-auto px-6 lg:px-12 mt-10 mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-8">

            <div class="space-y-4 max-h-[700px] overflow-y-auto pr-2 overflow-y-auto">

                @foreach ($json['itinerary'] as $day)
                    <div class="flex items-center gap-4 mb-4">
                        <div class="h-[1px] flex-1 bg-gray-300"></div>
                        <span class="font-bold text-[#FA9009]">
                            Day {{ $day['day'] }}
                        </span>
                        <div class="h-[1px] flex-1 bg-gray-300"></div>
                    </div>
                    @foreach ($day['activities'] as $activity)
                        <div class="bg-white rounded-xl border p-5 shadow-sm">
                            <div class="flex justify-between">
                                <div>
                                    <h4 class="font-bold text-lg">
                                        {{ $activity['destination_name'] }}
                                    </h4>

                                    <p class="text-gray-500 text-sm">
                                        {{ $activity['address'] }}
                                    </p>
                                </div>

                                <span class="text-orange-500">
                                    ⭐{{ $activity['google_maps_rating'] }}
                                </span>

                            </div>
                            <div class="flex justify-between mt-5">
                                <div class="text-md text-gray-500">
                                    Rp {{ number_format($activity['estimated_cost'],0,',','.') }}
                                </div>
                                <button class="detail-btn text-sm font-semibold cursor-pointer"
                                    data-name="{{ $activity['destination_name'] }}"
                                    data-address="{{ $activity['address'] }}"
                                    data-cost="{{ number_format($activity['estimated_cost'],0,',','.') }}"
                                    data-rating="{{ $activity['google_maps_rating'] }}"
                                    data-description="{{ $activity['description'] }}"
                                    data-map="https://www.google.com/maps/search/?api=1&query={{ urlencode($activity['destination_name']) }}">
                                    See Details
                                </button>
                            </div>

                        </div>

                        @if(!$loop->last)
                            <div class="flex justify-center items-center my-3">
                                <div class="flex gap-2 px-3 py-1">
                                    <img src="{{ asset('assets/distance.png') }}" class="w-5 h-5" alt="distance">
                                    <span class="text-sm font-semibold text-gray-700">
                                        {{ $activity['distance_to_next'] }}
                                    </span>
                                </div>
                                <div class="flex-1 h-px bg-gray-200"></div>
                            </div>
                        @endif
                    @endforeach
                @endforeach

            </div>

            <div class="sticky top-24">
                <div class="bg-white rounded-2xl shadow-lg border p-6">
                        <h2 class="text-2xl font-bold mb-6">
                            Trip Summary
                        </h2>
                        <div class="space-y-5">
                            <div>
                                <p class="text-sm text-gray-500">
                                    Destination
                                </p>

                                <h3 class="font-semibold text-lg">
                                    {{ explode(',', $json['trip_details']['location'])[0] }}
                                </h3>
                            </div>

                            <hr>

                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">
                                        Start Date
                                    </p>
                                    <p class="font-semibold">
                                        {{ $json['trip_details']['start_date'] }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">
                                        End Date
                                    </p>
                                    <p class="font-semibold">
                                        {{ $json['trip_details']['end_date'] }}
                                    </p>
                                </div>
                            </div>

                            <hr>

                            <div class="grid grid-cols-2 gap-4">
                                <div class=" rounded-xl p-4">
                                    <p class="text-gray-500 text-sm">
                                        Total Duration
                                    </p>
                                    <h3 class="text-xl font-bold">
                                        {{ count($json['itinerary']) }} Days
                                    </h3>
                                </div>

                                <div class=" rounded-xl p-4">
                                    <p class="text-gray-500 text-sm">
                                        Total Destinations
                                    </p>
                                    <h3 class="text-xl font-bold">
                                        {{ $totalDestination }}
                                    </h3>
                                </div>

                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div class=" rounded-xl p-4">
                                    <p class="text-gray-500 text-sm">
                                        Travelers
                                    </p>
                                    <h3 class="text-xl font-bold">
                                        {{ $json['trip_details']['adults'] }}
                                        Adult
                                        @if($json['trip_details']['children'] > 0)
                                            + {{ $json['trip_details']['children'] }} Kids
                                        @endif
                                    </h3>
                                </div>

                                <div class=" rounded-xl p-4">
                                    <p class="text-gray-500 text-sm">
                                        Category
                                    </p>
                                    <h3 class="text-xl font-bold">
                                        {{ implode(', ', $json['trip_details']['categories']) }}
                                    </h3>
                                </div>

                            </div>

                            <hr>

                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-[#0b5f8d] text-white rounded-xl p-5">
                                    <p class="text-sm opacity-80">
                                        Total Estimated Budget
                                    </p>

                                    <h2 class="text-2xl font-bold mt-2">
                                        Rp {{ number_format($totalBudget,0,',','.') }}
                                    </h2>
                                </div>

                                <div class="bg-[#F79204] text-white rounded-xl p-5">
                                    <p class="text-sm opacity-80">
                                        Budget per Person
                                    </p>

                                    <h2 class="text-2xl font-bold mt-2">
                                        Rp {{ number_format($budgetPerPerson,0,',','.') }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    @include('Component.footer')
    <div id="detailModal" class="fixed inset-0 bg-black/50 hidden justify-center items-center z-50">
        <div class="bg-white rounded-2xl w-full max-w-xl p-8 relative">
            <button id="closeModal" class="absolute top-5 right-5 text-2xl cursor-pointer">
                ✕
            </button>
            <h2 id="modalName" class="text-3xl font-bold mb-3"></h2>
            <p id="modalAddress" class="text-gray-600 mb-5"></p>
            <div id="modalRating" class="text-orange-500 mb-4"></div>
            <div class="mb-5"><p class="text-gray-500">Estimated Cost</p>
                <h3 id="modalCost" class="text-xl font-bold"></h3>
            </div>
            <div class="mb-8">
                <p class="text-gray-500 mb-2">
                    Description
                </p>
                <p
                    id="modalDescription">
                </p>
            </div>
            <a
                id="modalMap"
                target="_blank"
                class="w-full block text-center
                    bg-[#FA9009]
                    hover:bg-[#F6B83A]
                    text-white
                    font-semibold
                    py-3
                    rounded-xl">
                Open in Google Maps
            </a>
        </div>
    </div>
</body>