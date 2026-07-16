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
    'resources/js/imaps.js'
    ])
</head>
<body class="min-h-screen">
    @include('Component.navbar')
    <article class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl px-12 pb-8 pt-60 w-full max-w-6xl mx-auto mt-24">
        <img src="https://assets.pikiran-rakyat.com/crop/0x0:0x0/720x0/webp/photo/2022/02/07/3234837550.jpg"
            class="absolute inset-0 h-full w-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>

        <h3 class="z-10 mt-3 text-4xl font-bold text-white">
        Yogyakarta Itinerary
        </h3>

        <div class="z-10 text-sm leading-6 text-gray-300">
        Enjoy a memorable travel experience on your own. Discover a variety of unique destinations, from charming cafés to exciting attractions, all offering delightful moments and a captivating atmosphere that will make your journey truly unforgettable.
        </div>
    </article>

    <section class="max-w-7xl mx-auto px-6 lg:px-12 mt-10 mb-10">
        <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr] gap-8">

            <div class="space-y-4 max-h-[700px] overflow-y-auto pr-2 overflow-y-auto">

                <div class="flex items-center gap-4 mb-4">
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                    <span class="font-semibold">Day 1</span>
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                </div>

                <!-- CARD -->
                @for($i=0;$i<2;$i++)
                    <div class="bg-white rounded-xl border p-5 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between">
                            <div>
                                <h4 class="font-bold text-lg">
                                    Novotel Suites Yogyakarta Malioboro
                                </h4>
                                <p class="text-gray-500 text-sm mt-1">
                                    Jl. Perwakilan No.1, Suryatmajan, Kec. Danurejan, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55213
                                </p>
                                <p class="text-sm mt-3">
                                    Cost Rp 1.500.000 - 1.800.000
                                </p>
                            </div>
                            <span class="text-orange-500">
                                ★ 4.8
                            </span>
                        </div>

                        <div class="flex justify-between mt-5">
                            <div class="text-sm text-gray-500">
                                ⏱ 18 min • 5.4 km
                            </div>
                            <button class="text-sm font-semibold">
                                See Detail
                            </button>
                        </div>
                    </div>
                @endfor

                <div class="flex items-center gap-4 mb-4">
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                    <span class="font-semibold">HASIL GENERATE</span>
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                </div>

                <div class="flex items-center gap-4 mb-4">
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                    <span class="font-semibold">{{ $hasil }}</span>
                    <div class="h-[1px] flex-1 bg-gray-300"></div>
                </div>

            </div>

            <div class="sticky top-24 h-[700px]">
                <div id="map" class="overflow-hidden rounded-2xl shadow border h-full w-full">
        
                </div>
            </div>
        </div>
    </section>

    @include('Component.footer')
</body>