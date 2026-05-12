    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/x-icon" href="assets/Logo1.png" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <title>WayGo</title>
        @vite([
        'resources/css/app.css',
        'resources/js/app.js', 
        'resources/css/maps.css',
        'resources/js/location.js',
        'resources/js/date.js',
        'resources/js/travel.js',
        'resources/js/maps.js',
        'resources/js/carousel.js',
        'resources/css/carousel.css',
        ])
    </head>
    <body>
        @include('Component.navbar')

        <section class="relative min-h-screen">
            @include('Section.landing')
        </section>

        <section class="bg-gradient-to-b from-[#002423] via-[#085073] to-[#0B5F8D] py-10">
            @include('Section.header')
        </section>

        <section class="w-full overflow-hidden">
            @include('Section.maps')
        </section>
        <div id="popup" class="popup hidden">
            <img id="popup-img" src="" alt="">
            <h3 class="font-extrabold" id="popup-title"></h3>
            <p id="popup-desc"></p>
        </div>
        <div id="tooltip" class="tooltip hidden"></div>

        <section>
            @include('Section.carousel')
        </section>

        @include('Component.footer')
    </body>
</html>