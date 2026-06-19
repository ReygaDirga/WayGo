<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo1.png') }}" />
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
                <h2 class="text-2xl font-bold text-gray-900 mb-1">Edit Profile</h2>
                <p class="text-sm text-gray-500">Update your personal information and travel preferences</p>
            </div>
        </div>

        <form class="ml-10" method="POST" action="{{ route('profile.edit') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')

            {{-- Profile Picture --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5">
                <h6 class="text-lg font-bold text-gray-900 mb-4">Profile Picture</h6>
                <div class="flex items-center gap-6">
                    <div class="relative">
                        <div class="w-24 h-24 rounded-full bg-gradient-to-br from-amber-300 to-amber-500 overflow-hidden flex items-center justify-center" id="avatarPreviewWrapper">
                            @if (auth()->user()->avatar)
                                <img src="{{ auth()->user()->avatar }}" alt="Avatar" class="w-full h-full object-cover rounded-full">
                            @else
                                <span class="text-2xl font-bold text-amber-900">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </span>
                            @endif  
                        </div>
                        <label for="avatarInput" class="absolute bottom-0 right-0 w-7 h-7 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow cursor-pointer hover:bg-gray-50 transition">
                            <i class="bi bi-camera text-gray-600 text-xs"></i>
                        </label>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" class="hidden">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-1">Profile Picture</p>
                        <p class="text-xs text-gray-400 mb-3">JPG, PNG, or GIF. Max Size 2MB</p>
                        <label for="avatarInput" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-gray-200 text-sm text-gray-600 hover:bg-gray-50 cursor-pointer transition">
                            <i class="bi bi-upload"></i> Change Photo
                        </label>
                    </div>
                </div>
            </div>

            {{-- Personal Information --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
                <h6 class="text-lg font-bold text-gray-900 mb-4">Personal Information</h6>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400">
                            @error('name') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Date of Birth</label>
                        <input type="text" name="dob" id="dob" value="{{ old('dob', auth()->user()->dob) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400"
                            placeholder="Select date">
                            @error('dob') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Email Address</label>
                        <input type="email" value="{{ old('email', auth()->user()->email) }}" disabled
                            class="w-full px-4 py-2.5 border border-gray-100 rounded-xl text-sm bg-gray-50 text-gray-400 cursor-not-allowed">
                        <p class="text-[10px] text-gray-400 mt-1">Email tidak dapat diubah</p>
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Location</label>
                        <input type="text" name="location" value="{{ old('location', auth()->user()->location) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400"
                            placeholder="e.g. Semarang, Indonesia">
                            @error('location') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400"
                            placeholder="e.g. 0812-3456-7890">
                            @error('phone') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Bio</label>
                        <input type="text" name="description" value="{{ old('description', auth()->user()->description) }}"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-amber-400"
                            placeholder="e.g. Explorer · Traveler · Dreamer">
                            @error('description') 
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p> 
                            @enderror
                    </div>  

                </div>
            </div>

           {{-- Travel Categories --}}
            <p class="text-lg font-semibold text-gray-700 mb-4">Travel Categories</p>
            
            <div class="flex flex-wrap gap-2 mb-5">
                
            </div>

            {{-- Budget Range --}}
            <p class="text-lg font-semibold text-gray-700 mb-4">Budget Range</p>
            
            <div class="grid grid-cols-3 gap-3 mb-8">
                
            </div>
                        {{-- Submit Button --}}
            <div class="flex justify-end gap-3">
                <a href="{{ route('profile') }}"
                    class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm text-gray-600 hover:bg-gray-50 transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-8 py-2.5 rounded-xl bg-amber-500 text-white text-sm font-semibold hover:bg-amber-600 transition">
                    Update Changes
                </button>
            </div>

        </form>
    </div>

    <script>
        // Avatar preview
        document.getElementById('avatarInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatarPreview');
                    const initial = document.getElementById('avatarInitial');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                    if (initial) initial.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Flatpickr date picker
        flatpickr('#dob', {
            dateFormat: 'd F, Y',
            maxDate: 'today',
        });
    </script>

</body>
</html>