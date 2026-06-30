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
    'resources/js/blog_create_button.js'
    ])
</head>
<body class="bg-white min-h-screen flex flex-col">
    @include('Component.navbar')
    
    @auth
    <div id="floating-wrapper" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-50">
        <a href="{{ route('create-blog') }}" class="bg-[#F59E0B] hover:bg-orange-600 text-white px-6 py-3.5 rounded-full flex items-center gap-2.5 shadow-2xl hover:scale-105 active:scale-95 transition-all duration-300 group cursor-pointer">
            <svg class="w-5 h-5 transition-transform duration-300 group-hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"></path></svg>
            <span class="text-sm font-bold tracking-wide">Create Blog</span>
        </a>
    </div>
    @endauth
    
    <section class="w-full overflow-hidden pt-12 pb-15">
        @include('blogs.blog_hero')
    </section>

    <section class="w-full overflow-hidden">
        @include('blogs.blog_recentPost')
    </section>

    <section class="w-full overflow-hidden">
        @include('blogs.blog_allPosts')
    </section>

@include('Component.footer')
</body>