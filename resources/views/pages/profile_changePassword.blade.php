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

    <div class="max-w-5xl mx-auto px-6 py-10 mt-16">

        {{-- Page Header --}}
        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('profile') }}" class="w-9 h-9 flex items-center justify-center transition">
                <i class="bi bi-arrow-left text-gray-600"></i>
            </a>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Change Password</h2>
                <p class="text-sm text-gray-500">Update your password regularly to keep your account secure</p>
            </div>
        </div>

        {{-- Alert success --}}
        @if(session('success'))
            <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
                <i class="bi bi-check-circle mr-1"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-10 mb-5 ml-10">
            <form method="POST" action="{{ route('profile.changepassword') }}">
                @csrf

                <div class="space-y-5">

                    {{-- Current Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password"
                                class="w-full px-4 py-2.5 pr-10 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                                    {{ $errors->has('current_password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                placeholder="Masukkan password lama">
                            <button type="button" onclick="togglePassword('current_password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="bi bi-eye" id="icon_current_password"></i>
                            </button>
                        </div>
                        @error('current_password')
                            <p class="text-xs text-red-500 mt-1"><i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full px-4 py-2.5 pr-10 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                                    {{ $errors->has('password') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                placeholder="Masukkan password baru">
                            <button type="button" onclick="togglePassword('password')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="bi bi-eye" id="icon_password"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-xs text-red-500 mt-1"><i class="bi bi-exclamation-circle mr-1"></i>{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="w-full px-4 py-2.5 pr-10 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400
                                    {{ $errors->has('password_confirmation') ? 'border-red-400 bg-red-50' : 'border-gray-200' }}"
                                placeholder="Ulangi password baru">
                            <button type="button" onclick="togglePassword('password_confirmation')"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="bi bi-eye" id="icon_password_confirmation"></i>
                            </button>
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('profile') }}"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-600 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-5 py-2.5 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-600 transition">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</body>
</html>