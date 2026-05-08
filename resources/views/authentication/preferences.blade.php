<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Preferences — WayGo</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/createprofile.css', 'resources/css/preferences.css'])
</head>
<body>

{{-- @include('partials.navbar') --}}

<div class="cp-page">

    {{-- ── BACKGROUND ── --}}
    <div class="cp-bg">
        <div class="cp-bg-img" style="background-image: url('{{ asset('assets/Login/background.png') }}')"></div>
        <div class="cp-bg-overlay"></div>
        <div class="cp-orb cp-orb-1"></div>
        <div class="cp-orb cp-orb-2"></div>
        <div class="cp-orb cp-orb-3"></div>
    </div>

    {{-- ── CARD ── --}}
    <div class="cp-card">

        <div class="cp-logo-center">
            <img src="{{ asset('assets/logo.png') }}" alt="WayGo">
        </div>

        {{-- Steps Indicator --}}
        <div class="cp-steps">
            <div class="cp-step">
                <div class="cp-step__circle cp-step--passed"><span>1</span></div>
                <span>Profile</span>
            </div>
            <div class="cp-step__track"></div>
            <div class="cp-step cp-step--active">
                <div class="cp-step__circle"><span>2</span></div>
                <span>Preferences</span>
            </div>
            <div class="cp-step__track"></div>
            <div class="cp-step">
                <div class="cp-step__circle"><span>3</span></div>
                <span>Done</span>
            </div>
        </div>

        <div class="cp-header-center">
            <h2>Tell us about your travel style</h2>
            <p>This helps us personalize your experience</p>
        </div>

        <form action="{{ route('preferences.store') }}" method="POST" id="preferencesForm">
            @csrf

            {{-- 1. Interests --}}
            <div class="pref-group">
                <label class="pref-label">What are you most interested in? <span class="pref-hint">(Choose up to 3)</span></label>
                <div class="interest-grid">
                    <label class="interest-tile">
                        <input type="checkbox" name="interests[]" value="nature" hidden>
                        <div class="interest-tile-inner">
                            <i class="fa-solid fa-tree"></i>
                            <span>Nature</span>
                        </div>
                    </label>
                    <label class="interest-tile">
                        <input type="checkbox" name="interests[]" value="culinary" hidden>
                        <div class="interest-tile-inner">
                            <i class="fa-solid fa-utensils"></i>
                            <span>Culinary</span>
                        </div>
                    </label>
                    <label class="interest-tile">
                        <input type="checkbox" name="interests[]" value="adventure" hidden>
                        <div class="interest-tile-inner">
                            <i class="fa-solid fa-mountain-sun"></i>
                            <span>Adventure</span>
                        </div>
                    </label>
                    <label class="interest-tile">
                        <input type="checkbox" name="interests[]" value="culture" hidden>
                        <div class="interest-tile-inner">
                            <i class="fa-solid fa-landmark"></i>
                            <span>Culture</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 2. Budget --}}
            <div class="pref-group">
                <label class="pref-label">What's your budget range?</label>
                <div class="budget-grid">
                    <label class="budget-tile">
                        <input type="radio" name="budget" value="low" hidden>
                        <div class="budget-tile-inner">
                            <span class="budget-title">Low</span>
                            <span class="budget-price">< 2.000.000</span>
                        </div>
                    </label>
                    <label class="budget-tile">
                        <input type="radio" name="budget" value="medium" hidden>
                        <div class="budget-tile-inner">
                            <span class="budget-title">Medium</span>
                            <span class="budget-price">2jt - 5jt</span>
                        </div>
                    </label>
                    <label class="budget-tile">
                        <input type="radio" name="budget" value="high" hidden>
                        <div class="budget-tile-inner">
                            <span class="budget-title">High</span>
                            <span class="budget-price">> 5.000.000</span>
                        </div>
                    </label>
                </div>
            </div>

            {{-- 3. Location --}}
            <div class="pref-group">
                <label class="pref-label">Where are you from? (Optional)</label>
                <div class="cp-input-wrap">
                     <svg class="cp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <input type="text" name="location" class="cp-input" placeholder="e.g. Jakarta, Indonesia">
                </div>
            </div>

            {{-- Actions --}}
            <div class="cp-actions">
                <a href="{{ url()->previous() }}" class="cp-skip">Prev</a>
                <button type="submit" class="cp-next">
                    <span>Next</span>
                    <div class="cp-next-arrow">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </div>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- @include('partials.footer') --}}

<script>
    // Toggle active class untuk Interest (Checkbox) + Limit 3
    document.querySelectorAll('.interest-tile input').forEach(input => {
        input.addEventListener('change', function() {
            const checkedCount = document.querySelectorAll('.interest-tile input:checked').length;
            if (checkedCount > 3) {
                this.checked = false;
                return;
            }
            this.closest('.interest-tile').classList.toggle('is-active', this.checked);
        });
    });

    // Toggle active class untuk Budget (Radio)
    document.querySelectorAll('.budget-tile input').forEach(input => {
        input.addEventListener('change', function() {
            document.querySelectorAll('.budget-tile').forEach(t => t.classList.remove('is-active'));
            if (this.checked) this.closest('.budget-tile').classList.add('is-active');
        });
    });
</script>
</body>
</html>