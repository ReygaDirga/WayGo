<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - WayGo</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Mulish:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset('assets/logo1.png')}}" >
    @vite(['resources/css/app.css', 'resources/css/login.css'])
</head>
<body>
<div class="login-page">
    <div class="right-panel">
        <div class="form-card">

            <div class="form-header">
                <h2 class="form-title">Welcome back!</h2>
                <p class="form-sub">Login or Sign Up with Google to continue your journey</p>
            </div>

            {{-- Google Button --}}
            <a href="{{ route('auth.google') }}" class="google-btn">
                <svg class="google-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>

            <div class="divider">
                <span>or continue with email</span>
            </div>

            {{-- Email Form --}}
            <form method="POST" action="{{ route('login') }}" class="login-form">
                @csrf

                <div class="field-group">
                    <label class="field-label" for="email">Email</label>
                    <div class="field-wrapper">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            class="field-input @error('email') is-error @enderror"
                            placeholder="you@example.com"
                            value="{{ old('email') }}"
                            autocomplete="email"
                        >
                    </div>
                    @error('email')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="field-group">
                    <div class="field-label-row">
                        <label class="field-label" for="password">Password</label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    <div class="field-wrapper">
                        <svg class="field-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="field-input @error('password') is-error @enderror"
                            placeholder="••••••••"
                            autocomplete="current-password"
                        >
                        <button type="button" class="toggle-pass" id="togglePass" tabindex="-1">
                            <svg id="eyeIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="field-error">{{ $message }}</p>
                    @enderror
                </div>

                <div class="remember-row">
                    <label class="remember-label">
                        <input type="checkbox" name="remember" class="remember-check">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="submit-btn">
                    <span>Login</span>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </button>
            </form>

            <p class="signup-prompt">
                Don't have an account?
                <a href="#" class="signup-link">Sign up free</a>
            </p>

        </div>
    </div>
    {{-- ── LEFT PANEL ── --}}
    <div class="left-panel">
        <div class="left-bg" style="background-image: url('{{ asset('assets/Login/background.png') }}')"></div>
        <div class="left-blobs">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>

        {{-- floating stickers --}}
        <div class="sticker sticker-1">✈️</div>
        <div class="sticker sticker-2">🗺️</div>
        <div class="sticker sticker-3">🌴</div>
        <div class="sticker sticker-4">⛰️</div>
        <div class="sticker sticker-5">🧳</div>

        <div class="left-content">

            <div class="left-text">
                <h1 class="left-heading">
                    Every journey<br>
                    <em>starts here.</em>
                </h1>
                <p class="left-sub">Plan, save, and share your adventures with WayGo.</p>
            </div>
            <img src="{{ asset('assets/Login/luggage.png') }}" class="left-img" id="leftImg" alt="Luggage">
            <div class="left-stats">
                <div class="stat">
                    <span class="stat-num">10K+</span>
                    <span class="stat-label">Travelers</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Destinations</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat">
                    <span class="stat-num">4.9★</span>
                    <span class="stat-label">Rating</span>
                </div>
            </div>
        </div>
    </div>

    

</div>

@vite('resources/js/login.js')
</body>
</html>