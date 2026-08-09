<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Logo1.png') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>WayGo</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/js/date.js',
        'resources/js/location.js',
        'resources/js/blog_create.js'
        ])
</head>
<body class="bg-white min-h-screen flex flex-col">
    
    @include('Component.navbar')
    
    <main class="flex-grow max-w-[1080px] mx-auto px-4 w-full pt-22 pb-20">
        
        <div class="bg-white rounded-3xl shadow-2xl p-8 mt-8 md:p-12 w-full">
            
            <div class="flex items-start gap-4 mb-10 border-b border-gray-200 pb-6">
                <a href="{{ route('blog') }}" class="border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:text-black rounded-xl p-2.5 transition mt-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">{{ __('messages.judulcreate') }}</h1>
                    <p class="text-sm font-semibold text-gray-600">{{ __('messages.descreate') }}</p>
                </div>
            </div>

            <form action="{{ route('store-blog') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">{{ __('messages.basic') }}</h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">{{ __('messages.title') }}</label>
                            <input required type="text" name="title" value="{{ old('title') }}" class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-[#0B5F8D] transition" placeholder="{{ __('messages.desctitle') }}">
                        </div>
                        
                        <div class="relative w-full">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">{{ __('messages.lc') }}</label>
                            <div class="flex items-center gap-2">
                                <input
                                    required
                                    id="locationSearch"
                                    type="text"
                                    name="location"
                                    value="{{ old('location') }}"
                                    placeholder="{{ __('messages.desclc') }}"
                                    class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-[#0B5F8D] transition"
                                    autocomplete="off"
                                >
                            </div>
                            <div id="locationResults" class="hidden absolute top-full left-0 mt-3 bg-white shadow-xl rounded-xl w-80 z-50 max-h-60 overflow-auto">
                            </div>
                        </div>

                        <div class="relative w-full">
                            <label class="block text-sm font-bold text-gray-800 mb-1.5">{{ __('messages.island') }}</label>
                            <select name="id_pulau" required class="w-full border-2 border-gray-300 rounded-xl px-4 py-2.5 outline-none focus:border-[#0B5F8D] transition bg-white cursor-pointer appearance-none text-gray-800 invalid:text-gray-400">
                                <option value="" disabled {{ old('id_pulau') ? '' : 'selected' }}>{{ __('messages.descisland') }}</option>
                                @foreach($pulaus as $pulau)
                                    <option value="{{ $pulau->id }}" {{ old('id_pulau') == $pulau->id ? 'selected' : '' }} class="text-gray-800">{{ $pulau->name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-5 h-5 text-gray-500 absolute right-4 top-9 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-1.5">{{ __('messages.cover') }}</h2>
                    <p class="text-xs font-bold text-gray-600 mb-4">{{ __('messages.desccov') }}</p>
                    
                    <label for="cover-upload" class="relative overflow-hidden border-2 border-dashed border-gray-400 hover:border-[#0B5F8D] bg-gray-50 hover:bg-blue-50 rounded-2xl p-10 flex flex-col items-center justify-center transition group min-h-[250px]">
                        
                        <input type="file" id="cover-upload" name="image" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" accept="image/*" onchange="previewImage(event)">
                        
                        <div id="upload-placeholder" class="flex flex-col items-center z-10 pointer-events-none">
                            <svg class="w-12 h-12 text-[#0B5F8D] mb-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                            <p class="text-sm font-semibold text-gray-700 mb-1">{{ __('messages.isi1img') }}</p>
                            <p class="text-xs font-semibold text-gray-500">{{ __('messages.isi2img') }}</p>
                        </div>

                        <img id="image-preview" class="absolute inset-0 w-full h-full object-cover hidden z-20" alt="Cover Preview">
                    </label>

                    @if($errors->any())
                        <p class="text-red-500 text-sm mt-2 font-bold flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            {{ __('messages.errorimg') }}
                        </p>
                    @endif
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">{{ __('messages.konten') }}</h2>
                    <textarea required name="content" class="w-full border-2 border-gray-300 rounded-2xl px-5 py-4 h-64 outline-none focus:border-[#0B5F8D] transition resize-y" placeholder="{{ __('messages.isikonten') }}">{{ old('content') }}</textarea>
                </div>

                <div class="mb-10">
                    <h2 class="text-lg font-bold text-gray-900 mb-1.5">{{ __('messages.hl') }}</h2>
                    <p class="text-xs font-bold text-gray-600 mb-4">{{ __('messages.deschl') }}</p>
                    
                    <div class="bg-[#FDF5E6] rounded-2xl p-6 md:p-8 border border-orange-200 grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ __('messages.bestime') }}
                            </div>
                            
                            <div id="best-time-wrapper" class="flex justify-between items-center w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 transition cursor-text">
                                <div class="flex items-center gap-2">
                                    <input type="text" name="time_start" value="{{ old('time_start') }}" class="timepicker w-16 bg-transparent border-none outline-none font-semibold text-gray-800 text-base text-center cursor-pointer" placeholder="{{ __('messages.bestmulai') }}">
                                    <span class="font-bold text-gray-500">-</span>
                                    <input type="text" name="time_end" value="{{ old('time_end') }}" class="timepicker w-16 bg-transparent border-none outline-none font-semibold text-gray-800 text-base text-center cursor-pointer" placeholder="{{ __('messages.bestakhir') }}">
                                </div>
                                <svg class="w-6 h-6 text-gray-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                {{ __('messages.cost') }}
                            </div>
                            <div class="relative">
                                <input type="text" name="estimated_cost" value="{{ old('estimated_cost') }}" class="w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 outline-none focus:border-orange-500 transition font-semibold text-gray-800" placeholder="{{ __('messages.desccost') }}">
                                <svg class="w-5 h-5 text-gray-600 absolute right-4 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 font-bold text-gray-900 mb-2">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                                {{ __('messages.tips') }}
                            </div>
                            <input type="text" name="tips" value="{{ old('tips') }}" class="w-full border-2 border-gray-400 bg-transparent rounded-xl px-4 py-2.5 outline-none focus:border-orange-500 transition font-semibold text-gray-800" placeholder="{{ __('messages.desctips') }}">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end items-center border-t border-gray-200 pt-6 mt-8 gap-4">
                    <div id="autosave-indicator" class="hidden flex items-center gap-2 text-green-600 font-bold text-sm transition-all duration-300 sm:mr-auto">
                        <svg id="autosave-icon" class="w-5 h-5 hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span id="autosave-text" 
                            data-text-saving="{{ __('messages.sv') }}" 
                            data-text-saved="{{ __('messages.auto') }}">
                            {{ __('messages.auto') }}
                        </span>
                    </div>

                    <button type="submit" class="bg-[#F59E0B] hover:bg-orange-600 transition text-white px-8 py-3 rounded-xl font-bold flex items-center gap-2 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transform duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        {{ __('messages.pp_button') }}
                    </button>
                </div>

            </form>
        </div>
    </main>

    @include('Component.footer')
</body>
</html>