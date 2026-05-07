@extends('layouts.about')

@section('title', 'About Us - WayGo')

@section('content')

{{-- ── HERO ── --}}
<section class="hero-section">
    <img src="{{ asset('assets/About/bromo.jpg') }}" class="hero-bg" id="heroBg" alt="Bromo">
    <div class="hero-overlay">
        <span class="hero-eyebrow">Discover the world</span>
        <h1 class="hero-title">
            <span class="hero-title-word">THE</span>
            <span class="hero-title-word">JOURNEY</span>
        </h1>
        <div class="hero-line"></div>
        <p class="hero-sub">You'll always remember</p>
        <a href="#services" class="hero-cta">Explore More <span>↓</span></a>
    </div>
    <div class="hero-scroll-indicator">
        <div class="scroll-dot"></div>
    </div>
</section>

{{-- ── SERVICES ── --}}
<section class="services-section" id="services">
    <div class="services-inner">
        <div class="section-header">
            <span class="section-tag">What we offer</span>
            <h2 class="section-title">Our <em>Service</em></h2>
            <div class="section-divider"></div>
        </div>
        <div class="services-grid">
            @foreach([
                ['img' => 'service1.png', 'title' => 'Trip Planning',          'icon' => '🗺️', 'desc' => 'Plan your perfect journey step by step'],
                ['img' => 'service2.png', 'title' => 'Travel Blog',             'icon' => '✍️', 'desc' => 'Stories and tips from fellow travelers'],
                ['img' => 'service3.png', 'title' => 'Budget & Collaboration',  'icon' => '💰', 'desc' => 'Split costs and collaborate with friends'],
                ['img' => 'service4.png', 'title' => 'Saved Trip',              'icon' => '🔖', 'desc' => 'Bookmark your dream destinations'],
            ] as $i => $service)
            <div class="service-card" style="--i: {{ $i }}">
                <div class="service-img-wrapper">
                    <img src="{{ asset('assets/About/' . $service['img']) }}" alt="{{ $service['title'] }}">
                    <div class="service-img-shine"></div>
                </div>
                <div class="service-body">
                    <span class="service-icon">{{ $service['icon'] }}</span>
                    <h3 class="service-label">{{ $service['title'] }}</h3>
                    <p class="service-desc">{{ $service['desc'] }}</p>
                </div>
                <div class="service-hover-bar"></div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ── CAROUSEL ── --}}
<section class="carousel-section">
    <div class="carousel-inner">
        <div class="section-header light">
            <span class="section-tag">Gallery</span>
            <h2 class="section-title">Make your <em>Trip</em> more<br>Memorable</h2>
            <div class="section-divider"></div>
        </div>
    </div>
    <div class="carousel-track-wrapper">
        <div class="carousel-track" id="carouselTrack">
            @foreach(['pantai.png','kidzania.png','dufan.png','tsm.png','pantai.png','kidzania.png','dufan.png','tsm.png'] as $img)
            <div class="carousel-slide">
                <img src="{{ asset('assets/About/' . $img) }}" alt="Gallery">
                <div class="carousel-slide-overlay">
                    <span class="slide-zoom">⤢</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="carousel-controls">
        <button class="carousel-btn" id="prevBtn">←</button>
        <div class="carousel-dots" id="carouselDots"></div>
        <button class="carousel-btn" id="nextBtn">→</button>
    </div>
</section>

{{-- ── TESTIMONIALS ── --}}
<section class="testimonials-section">
    <div class="testimonials-inner">
        <div class="section-header">
            <span class="section-tag">Reviews</span>
            <h2 class="section-title">What they <em>say</em> about us</h2>
            <div class="section-divider"></div>
        </div>
        <div class="testimonials-grid">
            @foreach([
                ["text" => "Keren njir websitenya",              "name" => "Kimi",            "location" => "Semarang, Indonesia",     "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Kimi&backgroundColor=b6e3f4",           "stars" => 5],
                ["text" => "Website nya sangat ngebantu",        "name" => "Gabriel Martun",  "location" => "Palangkaraya, Indonesia", "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Gabriel&backgroundColor=ffd5dc",         "stars" => 5],
                ["text" => "Ini oke sih",                        "name" => "Sam Growtop",     "location" => "Pontianak, Indonesia",    "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Sam&backgroundColor=d1f4cc",             "stars" => 4],
            ] as $i => $item)
            <div class="testimonial-card" style="--i: {{ $i }}">
                <div class="tcard-top">
                    <div class="tcard-avatar">
                        <img src="{{ $item['avatar'] }}" alt="{{ $item['name'] }}">
                    </div>
                    <div class="tcard-meta">
                        <p class="tcard-name">{{ $item['name'] }}</p>
                        <p class="tcard-location">📍 {{ $item['location'] }}</p>
                        <div class="tcard-stars">
                            @for($s = 0; $s < $item['stars']; $s++)<span>★</span>@endfor
                            @for($s = $item['stars']; $s < 5; $s++)<span class="empty">★</span>@endfor
                        </div>
                    </div>
                </div>
                <div class="tcard-quote">❝</div>
                <p class="tcard-text">{{ $item['text'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection