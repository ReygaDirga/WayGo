@extends('layouts.app')

@section('title', 'About')

@section('content')

<section class="relative h-[70vh]">
    <img src="{{ asset('assets/About/bromo.jpg') }}" 
         class="absolute w-full h-full object-cover">

    <div class="absolute inset-0 bg-black/40 flex flex-col justify-center items-center text-white text-center">
        <h1 class="text-4xl font-bold">THE JOURNEY</h1>
        <p class="mt-2 text-lg">You’ll always remember</p>
    </div>
</section>

<section class="py-12 bg-white text-center">
    <h2 class="text-2xl font-semibold mb-8">Our Service</h2>

    <div class="grid md:grid-cols-4 gap-6 px-10">
        @foreach([
            ['img' => 'service1.jpg', 'title' => 'Trip Planning'],
            ['img' => 'service2.jpg', 'title' => 'Travel Blog'],
            ['img' => 'service3.jpg', 'title' => 'Budget & Collaboration'],
            ['img' => 'service4.jpg', 'title' => 'Saved Trip'],
        ] as $service)

        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-3">
            <img src="{{ asset('images/' . $service['img']) }}" 
                 class="rounded-lg mb-3 h-40 w-full object-cover">
            <p class="font-medium">{{ $service['title'] }}</p>
        </div>

        @endforeach
    </div>
</section>

<section class="py-12 bg-gray-50 text-center">
    <h2 class="text-xl font-semibold">
        Make your <span class="text-orange-500">Trip</span> more Memorable
    </h2>

    <div class="grid md:grid-cols-4 gap-4 px-10 mt-6">
        @foreach(['g1.jpg','g2.jpg','g3.jpg','g4.jpg'] as $img)
            <img src="{{ asset('images/' . $img) }}" 
                 class="rounded-lg h-40 w-full object-cover">
        @endforeach
    </div>
</section>

<section class="py-12 bg-white text-center">
    <h2 class="text-xl font-semibold mb-8">What they say about us</h2>

    <div class="grid md:grid-cols-3 gap-6 px-10">

        @foreach([
            "Keren njir webnya",
            "mantap webnya",
            "gatau mau isi apa"
        ] as $i => $text)

        <div class="bg-white shadow rounded-xl p-5">
            <p class="text-gray-600 italic">"{{ $text }}"</p>
            <p class="mt-3 font-semibold">- User {{ $i+1 }}</p>
        </div>

        @endforeach

    </div>
</section>

@endsection