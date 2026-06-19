<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/Logo1.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <title>WayGo</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/css/maps.css',
        'resources/js/location.js',
        'resources/js/date.js',
        'resources/js/travel.js'
    ])
</head>
<body class="bg-gray-50 min-h-screen">

    @include('Component.navbar')

    @auth
        <div class="max-w-5xl mx-auto px-6 py-10 mt-16">

        {{-- Page header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">My Profile</h2>
                <p class="text-sm text-gray-500">Manage your personal information and travel preferences</p>
            </div>
            <a href="{{ route('create-blog') }}" class="group flex items-center shrink-0">
                {{-- Circle Pencil --}}
                <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center shadow-md z-10 shrink-0 relative">
                    <i class="bi bi-pencil-fill text-white text-lg"></i>
                </div>

                {{-- Expanding Box --}}
                <div class="left-0 top-0
                        overflow-hidden w-0 opacity-0
                        group-hover:w-[140px]
                        group-hover:opacity-100
                        transition-all duration-300 ease-in-out
                        -ml-5 h-12 z-0">
                    <div class="w-[140px] h-12 pl-8 pr-4
                            bg-white border border-gray-200
                            rounded-r-full
                            flex items-center
                            shadow-sm">
                        <span class="text-amber-500 text-sm font-semibold whitespace-nowrap">
                            Create Blog
                        </span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Profile card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                {{-- Left: Avatar + name --}}
                <div class="md:border-r md:border-gray-100 flex flex-col items-center text-center pr-0 md:pr-6">
                    <div class="relative mb-4">
                        <div class="w-40 h-40 rounded-full bg-gradient-to-br from-amber-300 to-amber-500 flex items-center justify-center text-2xl font-bold text-amber-900">
                            @if (auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover rounded-full">
                            @else
                                <span class="text-2xl font-bold text-amber-900">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif       
                        </div>
                    </div>
                    <h5 class="text-lg font-bold text-gray-900 mb-0.5">{{ auth()->user()->id }}</h5>
                    <p class="text-xs text-gray-500 leading-relaxed">{{ auth()->user()->description }}</p>
                    <p class="text-xs text-gray-500 flex items-center gap-1 mt-1.5">
                        <i class="bi bi-geo-alt"></i> {{ $user->location ?? "" }}
                    </p>
                </div>

                {{-- Right: Personal info --}}
                <div class="md:col-span-2 flex flex-col justify-center">
                    <p class="text-l font-bold text-gray-900 uppercase tracking-widest mb-3">Personal Information</p>
                    <div class="space-y-0 divide-y divide-gray-100">
                        <div class="flex items-center justify-between py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="bi bi-envelope text-base"></i> Email address
                            </span>
                            <span class="text-sm font-medium text-gray-800">{{ auth()->user()->email }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="bi bi-telephone"></i> Phone number
                            </span>
                            <span class="text-sm font-medium text-gray-800">{{ auth()->user()->phone }}</span>
                        </div>
                        <div class="flex items-center justify-between py-3">
                            <span class="flex items-center gap-2 text-sm text-gray-500">
                                <i class="bi bi-calendar"></i>Date of birth
                            </span>
                            <span class="text-sm font-medium text-gray-800">{{ auth()->user()->dob }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom two cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            {{-- Travel preferences --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h6 class="text-lg font-bold text-gray-900 mb-0.5">Travel preferences</h6>
                <p class="text-xs text-gray-400 mb-5">Your travel style and interests</p>

                <p class="text-xs font-semibold text-gray-900 mb-2">Travel Categories</p>
                <div class="flex flex-wrap gap-2 mb-4">
                    @php
                        $styles = [
                            'Nature' => 'bg-[#27AE60] text-white',
                            'Culinary' => 'bg-[#FA9009] text-white',
                            'Culture' => 'bg-[#8A38F5] text-white',
                            'Adventure' => 'bg-[#21C4FD] text-white',
                        ];
                    @endphp

                    @forelse($user->categories as $ct)
                        <span class="px-4 py-1 rounded-xl font-medium {{ $styles[$ct->name] ?? 'bg-gray-100 text-gray-600' }}">
                            {{ $ct->name }}
                        </span>
                    @empty
                        <p>Belum ada preferensi</p>
                    @endforelse
                </div>

                <p class="text-xs font-semibold text-gray-900 mb-2">Budget range</p>
                <div class="rounded-xl p-3 text-center">
                    <p class="text-base font-semibold text-amber-900">
                        @php
                            $style = [
                                'Low'=>'bg-[#BBE9D3] text-[#267867]',
                                'Medium'=>'bg-[#FBE3B0] text-[#F39C33]',
                                'High'=>'bg-[#F45959] text-[#B30000]',
                            ];
                        @endphp

                        <div class="rounded-2xl p-3 text-center {{ $style[$user->budget->name] }}">
                            <p class="text-2xl font-bold">{{ $user->budget->name }}</p>
                            <p class="text-sm">
                                Rp{{ number_format($user->budget->min_price) }} - 
                                {{ $user->budget->max_price? number_format($user->budget->max_price) : '∞'}} / Trip
                            </p>
                        </div>
                    </p>
                </div>
            </div>

            {{-- Account settings --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h6 class="text-lg font-bold text-gray-900 mb-0.5">Account settings</h6>
                <p class="text-xs text-gray-400 mb-5">Manage your account security</p>

                <div class="space-y-2">
                    <a href="{{ route('changepassword') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 group-hover:bg-gray-200 transition">
                            <i class="bi bi-lock leading-none text-gray-700"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Change password</p>
                            <p class="text-[11px] text-gray-400">Update your password regulary</p>
                        </div>
                        <i class="bi bi-chevron-right text-xs text-gray-400"></i>
                    </a>

                    <a href="{{ route('editprofile') }}" class="flex items-center gap-3 p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition group">
                        <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 group-hover:bg-gray-200 transition">
                            <i class="bi bi-person-gear"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-gray-800">Edit profile</p>
                            <p class="text-[11px] text-gray-400">Manage your profile details </p>
                        </div>
                        <i class="bi bi-chevron-right text-xs text-gray-400"></i>
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 p-3 rounded-xl border border-red-100 hover:bg-red-50 transition group">
                            <div class="w-8 h-8 rounded-lg bg-red-50 flex items-center justify-center text-red-600 group-hover:bg-red-100 transition">
                                <i class="bi bi-box-arrow-right"></i>
                            </div>
                            <div class="flex-1 text-left">
                                <p class="text-sm font-medium text-red-600">Log out</p>
                                <p class="text-[11px] text-gray-400">Log out of your account securely.</p>
                            </div>
                            <i class="bi bi-chevron-right text-xs text-gray-400"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @endauth
    
    @include('Component.footer')
</body>
</html>