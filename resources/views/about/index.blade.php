@extends('layouts.about')

@section('title', 'About Us - WayGo')

@section('content')

{{-- ── HERO ── --}}
<section class="hero-section">
    <img src="{{ asset('assets/About/bromo.jpg') }}" class="hero-bg" id="heroBg" alt="Bromo">
    <div class="hero-overlay">
        <span class="hero-eyebrow">{{ __('messages.discover') }}</span>
        <h1 class="hero-title">
            <span class="hero-title-word">{{ __('messages.the') }}</span>
            <span class="hero-title-word">{{ __('messages.jr') }}</span>
        </h1>
        <div class="hero-line"></div>
        <p class="hero-sub">{{ __('messages.descjr') }}</p>
        <a href="#services" class="hero-cta">{{ __('messages.em') }} <span>↓</span></a>
    </div>
    <div class="hero-scroll-indicator">
        <div class="scroll-dot"></div>
    </div>
</section>

{{-- ── SERVICES ── --}}
<section class="services-section" id="services">
    <div class="services-inner">
        <div class="section-header">
            <span class="section-tag">{{ __('messages.wwo') }}</span>
            <h2 class="section-title">{{ __('messages.our') }} <em>{{ __('messages.service') }}</em></h2>
            <div class="section-divider"></div>
        </div>
        <div class="services-grid">
            @foreach([
                ['img' => 'service1.png', 'title' => __('messages.tp'),          'icon' => '🗺️', 'desc' => __('messages.desctp')],
                ['img' => 'service2.png', 'title' => __('messages.tb'),             'icon' => '✍️', 'desc' => __('messages.desctb')],
                ['img' => 'service3.png', 'title' => __('messages.bc'),  'icon' => '💰', 'desc' => __('messages.descbc')],
                ['img' => 'service4.png', 'title' => __('messages.st'),              'icon' => '🔖', 'desc' => __('messages.descst')],
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
            <span class="section-tag">{{ __('messages.galeri') }}</span>
            <h2 class="section-title">{{ __('messages.my') }} <em>{{ __('messages.trip') }}</em> {{ __('messages.more') }}<br>{{ __('messages.mmb') }}</h2>
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
            <span class="section-tag">{{ __('messages.rev') }}</span>
            <h2 class="section-title">{{ __('messages.wt') }} <em>{{ __('messages.say') }}</em> {{ __('messages.about') }}</h2>
            <div class="section-divider"></div>
        </div>
        <div class="testimonials-grid">
            @foreach([
                ["text" => __('messages.kimidesc'),              "name" => "Kimi",            "location" => "Semarang, Indonesia",     "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Kimi&backgroundColor=b6e3f4",           "stars" => 5],
                ["text" => __('messages.mardesc'),        "name" => "Gabriel Martun",  "location" => "Palangkaraya, Indonesia", "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Gabriel&backgroundColor=ffd5dc",         "stars" => 5],
                ["text" => __('messages.samdesc'),                        "name" => "Sam Growtop",     "location" => "Pontianak, Indonesia",    "avatar" => "https://api.dicebear.com/9.x/notionists/svg?seed=Sam&backgroundColor=d1f4cc",             "stars" => 4],
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