<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo1.png" />
    <title>Blog-WayGo</title>
    @vite([
    'resources/css/app.css',
    'resources/js/app.js', 
    'resources/js/blog_hero.js',
    'resources/js/blog_filterPosts.js'
    ])
</head>
<body class="bg-gradient-to-b from-[#0B5F8D] to-[#55B0CC] min-h-screen">
    @include('Component.navbar')
    
    <section class="w-full overflow-hidden pt-12 pb-15">
        @include('Section.blog_hero')
    </section>

    <section class="w-full overflow-hidden">
        @include('Section.blog_recentPost')
    </section>

    <section class="w-full overflow-hidden">
        @include('Section.blog_allPosts')
    </section>

@include('Component.footer')
</body>