<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile — WayGo</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/css/createprofile.css'])
</head>
<body>

<div class="cp-page">

    {{-- ── BACKGROUND ── --}}
    <div class="cp-bg">
        <div class="cp-bg-img" style="background-image: url('{{ asset('assets/Login/background.png') }}')"></div>
        <div class="cp-bg-overlay"></div>
        <div class="cp-orb cp-orb-1"></div>
        <div class="cp-orb cp-orb-2"></div>
        <div class="cp-orb cp-orb-3"></div>
    </div>

    {{-- ── FLOATING ELEMENTS ── --}}
    <div class="cp-floats">
        <span class="cp-float" style="--x:8%;--y:15%;--d:0s;--s:2rem">✈️</span>
        <span class="cp-float" style="--x:88%;--y:20%;--d:1.2s;--s:1.6rem">🌴</span>
        <span class="cp-float" style="--x:5%;--y:70%;--d:2.5s;--s:1.8rem">⛰️</span>
        <span class="cp-float" style="--x:92%;--y:75%;--d:0.8s;--s:2.2rem">🧳</span>
        <span class="cp-float" style="--x:50%;--y:5%;--d:1.8s;--s:1.4rem">🗺️</span>
    </div>

    {{-- ── CARD ── --}}
    <div class="cp-card">

        {{-- Logo --}}
        <div class="cp-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="WayGo">
            </a>
        </div>

        {{-- Steps --}}
        <div class="cp-steps">
            <div class="cp-step cp-step--active">
                <div class="cp-step__circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <span>Profile</span>
            </div>
            <div class="cp-step__track"><div class="cp-step__fill" style="width:0%"></div></div>
            <div class="cp-step">
                <div class="cp-step__circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <span>Preferences</span>
            </div>
            <div class="cp-step__track"><div class="cp-step__fill" style="width:0%"></div></div>
            <div class="cp-step">
                <div class="cp-step__circle">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <span>Done</span>
            </div>
        </div>

        {{-- Avatar --}}
        <div class="cp-avatar-wrap">
            <div class="cp-avatar" id="cpAvatar">
                @if(auth()->user()->avatar)
                    <img src="{{ auth()->user()->avatar }}" id="cpAvatarImg" alt="avatar">
                @else
                    <img src="" id="cpAvatarImg" style="display:none" alt="avatar">
                    <span id="cpAvatarInitial">{{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}</span>
                @endif
                <div class="cp-avatar-ring"></div>
            </div>
            <label for="cpAvatarInput" class="cp-avatar-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </label>
            <input type="file" id="cpAvatarInput" accept="image/*" style="display:none">
            <p class="cp-avatar-hint">Upload photo</p>
        </div>

        {{-- Form --}}
        <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data" class="cp-form" id="cpForm">
            @csrf
            <input type="file" name="avatar" id="cpAvatarFile" style="display:none">

            <div class="cp-fields">

                <div class="cp-field">
                    <label class="cp-label">Full Name</label>
                    <div class="cp-input-wrap">
                        <svg class="cp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <input type="text" name="name" class="cp-input" placeholder="Your full name" value="{{ auth()->user()->name }}">
                    </div>
                </div>

                <div class="cp-field">
                    <label class="cp-label">Phone Number</label>
                    <div class="cp-input-wrap cp-phone-wrap">
                        <button type="button" class="cp-phone-flag">
                            <span>🇮🇩</span>
                            <span>+62</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" style="width:10px;height:10px">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <input type="tel" name="phone" class="cp-input cp-phone-input" placeholder="812 3456 7890" value="{{ auth()->user()->phone ?? '' }}">
                    </div>
                </div>

                <div class="cp-field">
                    <label class="cp-label">Date of Birth</label>
                    <div class="cp-input-wrap">
                        <svg class="cp-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <input type="date" name="dob" class="cp-input" value="{{ auth()->user()->dob ?? '' }}">
                    </div>
                </div>

                <div class="cp-field">
                    <label class="cp-label">
                        Description
                        <span class="cp-optional">Optional</span>
                    </label>
                    <textarea name="description" class="cp-input cp-textarea" placeholder="Tell us about yourself...">{{ auth()->user()->description ?? '' }}</textarea>
                </div>

            </div>

            <div class="cp-actions">
                <a href="{{ url('/') }}" class="cp-skip">Skip for now</a>
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

<script>
document.getElementById('cpAvatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const dt = new DataTransfer();
    dt.items.add(file);
    document.getElementById('cpAvatarFile').files = dt.files;
    const reader = new FileReader();
    reader.onload = function(e) {
        const img = document.getElementById('cpAvatarImg');
        const initial = document.getElementById('cpAvatarInitial');
        img.src = e.target.result;
        img.style.display = 'block';
        if (initial) initial.style.display = 'none';
        document.getElementById('cpAvatar').classList.add('has-photo');
    };
    reader.readAsDataURL(file);
});
</script>

@vite('resources/js/login.js')
</body>
</html>