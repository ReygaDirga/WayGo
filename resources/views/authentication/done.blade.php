<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Set! — WayGo</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/css/createprofile.css', 'resources/css/done.css'])
</head>
<body>

<div class="cp-page">

    <div class="cp-bg">
        <div class="cp-bg-img" style="background-image: url('{{ asset('assets/Login/background.png') }}')"></div>
        <div class="cp-bg-overlay"></div>
        <div class="cp-orb cp-orb-1"></div>
        <div class="cp-orb cp-orb-2"></div>
        <div class="cp-orb cp-orb-3"></div>
    </div>

    <div class="cp-floats">
        <span class="cp-float" style="--x:15%;--y:10%;--d:0.5s;--s:2rem">✨</span>
        <span class="cp-float" style="--x:85%;--y:70%;--d:1.2s;--s:1.8rem">🎒</span>
        <span class="cp-float" style="--x:5%;--y:60%;--d:2s;--s:2.2rem">📍</span>
    </div>

    <div class="cp-card">

        <div class="cp-logo">
            <a href="{{ url('/') }}">
                <img src="{{ asset('assets/logo.png') }}" alt="WayGo">
            </a>
        </div>

        <div class="cp-steps">
            <div class="cp-step">
                <div class="cp-step__circle cp-step--finished">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span>Profile</span>
            </div>
            <div class="cp-step__track"><div class="cp-step__fill" style="width:100%"></div></div>
            <div class="cp-step">
                <div class="cp-step__circle cp-step--finished">
                    <i class="fa-solid fa-check"></i>
                </div>
                <span>Preferences</span>
            </div>
            <div class="cp-step__track"><div class="cp-step__fill" style="width:100%"></div></div>
            <div class="cp-step cp-step--active">
                <div class="cp-step__circle">
                    <i class="fa-solid fa-flag-checkered"></i>
                </div>
                <span>Done</span>
            </div>
        </div>

        <div class="cp-done-content">
            <div class="cp-success-icon">
                <i class="fa-solid fa-paper-plane"></i>
            </div>
            <h2>You're all set!</h2>
            <p>Your travel profile is ready. We've tailored some amazing destinations just for you.</p>
        </div>

        <div class="cp-actions cp-done-actions">
            <a href="{{ url('/') }}" class="cp-next cp-btn-full">
                <span>Start Exploring</span>
                <div class="cp-next-arrow">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </div>
            </a>
        </div>

    </div>

</div>
</body>
</html>