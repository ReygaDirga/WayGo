@extends('layouts.app')

@section('title', 'SavedTrips')

@section('content')

<div class="min-h-screen bg-[#FFF8F0] font-sans text-[#1A1A1A]">
    <section class="bg-[#162D4D] text-white pt-16 pb-24 px-8 md:px-20 relative overflow-hidden">

        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/5 rounded-full -mr-32 -mt-32"></div>
        <div class="absolute bottom-[-50px] left-1/3 w-64 h-64 bg-teal-500/10 rounded-full blur-2xl"></div>

        <div class="max-w-7xl mx-auto relative z-10">
            <h1 class="text-4xl md:text-5xl font-bold mt-20">
                {{ __('messages.memories') }} <span class="text-[#F3A344]">{{ __('messages.always') }}</span>
            </h1>
            <p class="text-gray-400 mt-4 text-lg">{{ __('messages.enjoy') }}</p>

            <hr class="border-white/20 my-10">

            <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">{{ $completedTrip }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">{{ __('messages.complete') }}</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">{{ $visitedCities }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">{{ __('messages.visited') }}</p>
                </div>
                <div>
                    <h3 class="text-3xl font-bold text-[#F3A344]">{{ $ongoingTrip }}</h3>
                    <p class="text-xs text-gray-400 uppercase tracking-widest mt-1">{{ __('messages.ongoing') }}</p>
                </div>
            </div>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-8 md:px-20 pt-12 pb-20 relative z-20">
        
        <h2 class="text-4xl font-bold mb-10">{{ __('messages.savedd') }} <span class="text-[#F3A344]">{{ __('messages.Trips') }}</span></h2>

        @if($latestTripData)

            @php
                $trip = $latestTripData['summary'];

                $totalDays = Carbon\Carbon::parse($trip->start_date)
                    ->diffInDays(Carbon\Carbon::parse($trip->end_date)) + 1;

                $start = Carbon\Carbon::parse($trip->start_date);
                $end = Carbon\Carbon::parse($trip->end_date);
            @endphp

            <div class="bg-white rounded-[2rem] shadow-sm overflow-hidden mb-8 border border-gray-100 trip-card cursor-pointer" data-uuid="{{ $trip->trip_uuid }}">

                <div class="relative h-80">
                    @php
                        $categories = array_map('trim', explode(',', $trip->categories));

                        if(count($categories) == 1){
                            $headerImage = match($categories[0]){
                                'Nature'   => asset('assets/category/catNature.jpg'),
                                'Culture'  => asset('assets/category/catCulture.jpg'),
                                'Culinary' => asset('assets/category/catCuliner.jpg'),
                                'Adventure'=> asset('assets/category/catAdventure.jpg'),
                            };
                        }else{
                            $images = [];

                            foreach($categories as $cat){
                                switch($cat){
                                    case 'Nature':
                                        $images[] = asset('assets/category/catNature.jpg');
                                        break;

                                    case 'Culture':
                                        $images[] = asset('assets/category/catCulture.jpg');
                                        break;

                                    case 'Culinary':
                                        $images[] = asset('assets/category/catCuliner.jpg');
                                        break;

                                    case 'Adventure':
                                        $images[] = asset('assets/category/catAdventure.jpg');
                                        break;
                                }
                            }

                            $headerImage = $images[array_rand($images)];
                        }
                    @endphp
                    <img src="{{ $headerImage }}" class="w-full h-full object-cover">
                    
                    <div class="absolute bottom-0    left-0 p-8 text-white bg-gradient-to-t from-black/70 to-transparent w-full">
                        <h3 class="text-3xl font-bold">{{ explode(',', $trip->location)[0] }}</h3>
                    </div>
                    <div class="">

                    </div>
                    <div class="absolute bottom-8 right-8 flex flex-col gap-3 z-20">
                        <form
                            action="{{ route('saved.destroy', $trip->trip_uuid) }}"
                            method="POST"
                            class="deleteForm"
                            onclick="event.stopPropagation();">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-white/20 hover:bg-white/40 backdrop-blur-md p-3 rounded-xl transition">

                                <img src="{{ asset('assets/delete.png') }}" class="w-8">

                            </button>
                        </form>
                        <a href="{{ route('pdf_export', $trip->trip_uuid) }}"
                            target="_blank"
                            onclick="event.stopPropagation();"
                            class="bg-white/20 hover:bg-white/40 backdrop-blur-md p-3 rounded-xl transition">

                            <img src="{{ asset('assets/pdf.png') }}"
                                class="w-8 h-auto">

                        </a>

                    </div>
                </div>
                
                <div class="p-8 grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <div class="flex space-x-6 text-sm font-semibold mb-6">
                            <span class="flex items-center gap-2"><i class="far fa-calendar"></i> {{ $start->format('d') }}-{{ $end->format('d M Y') }}   </span>
                            <span class="flex items-center gap-2"><i class="far fa-clock"></i> {{ $totalDays }} {{ __('messages.days') }}</span>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-100 rounded-2xl border border-gray-200 p-5 flex flex-col justify-center">
                                <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                                    Categories
                                </p>

                                <p class="mt-3 text-lg font-bold text-gray-900">
                                    {{ $trip->categories }}
                                </p>
                            </div>

                            <div class="bg-[#0b5f8d] rounded-2xl border border-orange-200 p-5 flex flex-col justify-center">
                                <p class="text-xs uppercase tracking-wide text-white font-semibold">
                                    Total Estimated Budget
                                </p>

                                <p class="mt-3 text-2xl font-bold text-white">
                                   Rp {{ number_format($latestTripData['total_budget'], 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center gap-3">
                            <span class="text-sm text-gray-500">
                                {{ $trip->adults }}
                                        Adult
                                        @if($trip->children > 0)
                                            + {{ $trip->children }} Kids
                                        @endif
                                 {{ __('messages.traveler') }}
                            </span>  
                        </div>
                    </div>
                    
                    <div class="border-l border-gray-100 pl-8">
                        <h4 class="text-[#F3A344] font-bold text-lg mb-3">{{ __('messages.highlight') }}</h4>
                        <ul class="space-y-2 text-gray-700">
                            @foreach($latestTripData['highlights'] as $activity)
                                <li>
                                    • {{ $activity->destination_name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

        @endif



        <div class="grid md:grid-cols-2 gap-8">
            @foreach($otherTrips as $trip)
                @php
                    $start = \Carbon\Carbon::parse($trip->start_date);
                    $end = \Carbon\Carbon::parse($trip->end_date);
                @endphp
                <div class="bg-white rounded-[2rem] shadow-sm overflow-hidden border border-gray-100 trip-card cursor-pointer" data-uuid="{{ $trip->trip_uuid }}">
                    <div class="relative h-56">
                        @php
                        $categories = array_map('trim', explode(',', $trip->categories));

                        if(count($categories) == 1){
                            $headerImage = match($categories[0]){
                                'Nature'   => asset('assets/category/catNature.jpg'),
                                'Culture'  => asset('assets/category/catCulture.jpg'),
                                'Culinary' => asset('assets/category/catCuliner.jpg'),
                                'Adventure'=> asset('assets/category/catAdventure.jpg'),
                            };
                        }else{
                            $images = [];

                            foreach($categories as $cat){
                                switch($cat){
                                    case 'Nature':
                                        $images[] = asset('assets/category/catNature.jpg');
                                        break;

                                    case 'Culture':
                                        $images[] = asset('assets/category/catCulture.jpg');
                                        break;

                                    case 'Culinary':
                                        $images[] = asset('assets/category/catCuliner.jpg');
                                        break;

                                    case 'Adventure':
                                        $images[] = asset('assets/category/catAdventure.jpg');
                                        break;
                                }
                            }

                            $headerImage = $images[array_rand($images)];
                        }
                    @endphp
                    <img src="{{ $headerImage }}" class="w-full h-full object-cover">
                        <div class="absolute bottom-0 left-0 p-6 text-white w-full">
                            <h3 class="text-2xl font-bold">{{ explode(',', $trip->location)[0] }}</h3>
                        </div>
                        <div class="absolute bottom-8 right-8 flex flex-col gap-3 z-20">
                        <form
                            action="{{ route('saved.destroy', $trip->trip_uuid) }}"
                            method="POST"
                            class="deleteForm"
                            onclick="event.stopPropagation();">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="bg-white/20 hover:bg-white/40 backdrop-blur-md p-3 rounded-xl transition">

                                <img src="{{ asset('assets/delete.png') }}" class="w-8">

                            </button>
                        </form>
                        <a href="{{ route('pdf_export', $trip->trip_uuid) }}"
                            target="_blank"
                            onclick="event.stopPropagation();"
                            class="bg-white/20 hover:bg-white/40 backdrop-blur-md p-3 rounded-xl transition">

                            <img src="{{ asset('assets/pdf.png') }}"
                                class="w-8 h-auto">

                        </a>

                    </div>
                    </div>
                    <div class="p-6">
                        <p class="text-sm font-semibold mb-4 text-gray-600 italic">{{ $start->format('d') }}-{{ $end->format('d M Y') }}</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-100 rounded-2xl border border-gray-200 p-5 flex flex-col justify-center">
                                <p class="text-xs uppercase tracking-wide text-gray-500 font-semibold">
                                    Categories
                                </p>

                                <p class="mt-3 text-lg font-bold text-gray-900">
                                    {{ $trip->categories }}
                                </p>
                            </div>

                            <div class="bg-[#0b5f8d] rounded-2xl p-5 flex flex-col justify-center">
                                <p class="text-xs uppercase tracking-wide font-semibold text-white">
                                    Total Estimated Budget
                                </p>

                                <p class="mt-3 text-2xl font-bold text-white">
                                   Rp {{ number_format($trip->total_budget,0,',','.') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-xs text-gray-500">
                                {{ $trip->adults }}
                                        Adult
                                        @if($trip->children > 0)
                                            + {{ $trip->children }} Kids
                                        @endif
                                {{ __('messages.traveler') }}
                            </span>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    </main>
</div>
<div id="tripModal"
    class="fixed inset-0 bg-black/60 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl w-[90vw] h-[90vh] overflow-hidden">
        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="text-2xl font-bold">
                Trip Detail
            </h2>
            <button id="closeModal"
                class="text-3xl">
                &times;
            </button>
        </div>
        <div
            id="tripContent"
            class="overflow-y-auto h-[calc(90vh-80px)] p-6">
        </div>
    </div>
</div>

@if(session('success'))
<script>
Swal.fire({
    toast: true,
    position: 'top-end',
    icon: 'success',
    title: 'Itinerary deleted successfully',
    showConfirmButton: false,
    timer: 2500,
    timerProgressBar: true
});
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.querySelectorAll(".deleteForm").forEach(form => {

    form.addEventListener("submit", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Delete itinerary?",
                text: "This itinerary will be permanently deleted.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc2626",
                cancelButtonColor: "#6b7280",
                confirmButtonText: "Yes, delete it",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    const modal = document.getElementById("tripModal");
    const content = document.getElementById("tripContent");

    document.querySelectorAll(".trip-card").forEach(card => {

        card.addEventListener("click", async () => {

            const uuid = card.dataset.uuid;

            const response = await fetch(`/saved/${uuid}`);

            const data = await response.json();

            renderTrip(data);

            modal.classList.remove("hidden");

        });

    });

    document.getElementById("closeModal").onclick = () => {
        modal.classList.add("hidden");
    }

    function renderTrip(data){
        let html = "";
        let currentDay = 0;
        data.forEach(item=>{
            if(item.day !== currentDay){
                currentDay = item.day;
                html += `
                    <h2 class="text-2xl font-bold mt-6 mb-4">
                        Day ${item.day}
                    </h2>
                `;
            }
            const mapsUrl =
            `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(
                item.destination_name + " " + item.address
            )}`;
            html += `
                <div class="border rounded-xl p-5 mb-3">
                    <div class="flex justify-between">
                        <div>
                            <h3 class="font-bold text-lg">
                                ${item.destination_name}
                            </h3>

                            <p class="text-gray-500">
                                ${item.address}
                            </p>

                            <p class="mt-2">
                                Rp ${Number(item.estimated_cost).toLocaleString('id-ID')}
                            </p>
                        </div>

                        <span class="text-orange-500 font-semibold">
                            ⭐ ${item.rating}
                        </span>
                    </div>

                    <p class="mt-3 text-gray-600">
                        ${item.description}
                    </p>

                    <div class="mt-4 flex justify-end">
                        <a
                            href="${mapsUrl}"
                            target="_blank"
                            class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-semibold text-sm"
                        >
                            Navigate with Google Maps
                        </a>
                    </div>
                </div>
            `;

            

        });
        content.innerHTML = html;
    }
</script>

@endsection