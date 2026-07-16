<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class ItineraryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        return view('itineraries.itinerary', compact('category')); 
    }

    public function itineraryDetail()
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'X-goog-api-key' => env('GEMINI_API'),
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => 'Explain how AI works in a few words'
                            ]
                        ]
                    ]
                ]
            ]
        );
        // $data = $response->json();
        // $hasil = $data['candidates'][0]['content']['parts'][0]['text'];
        $hasil = $response['candidates'][0]['content']['parts'][0]['text'];
        //   dd($response->status(), $response->body());

        return view('itineraries.ilist', compact('hasil'));
    }
}
