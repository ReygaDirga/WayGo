<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Category;
use App\Models\Budget;
use App\Models\itinerary;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ItineraryController extends Controller
{
    public function index()
    {
        session()->forget('itinerary');
        $category = Category::all();
        return view('itineraries.itinerary', compact('category')); 
    }

    public function itineraryDetail(Request $request)
    {
        if (session()->has('itinerary')) {
            $json = session('itinerary');
            return view('itineraries.ilist', compact('json'));
        }

        $tripUuid = Str::uuid()->toString();
        $user = Auth::user();
        $budget = $user->budget;
        if ($budget->max_price == 0) {
            $budget_range = "{$budget->name} (di atas Rp " .
                number_format($budget->min_price,0,',','.') . ")";
        } else {
            $budget_range = "{$budget->name} (Rp " .
                number_format($budget->min_price,0,',','.') .
                " - Rp " .
                number_format($budget->max_price,0,',','.') . ")";
        }   
        $location = $request->location;

        $date = $request->date;
        [$start, $end] = explode(' to ', $date);
        $startDate = Carbon::createFromFormat('d M Y', trim($start));
        $endDate   = Carbon::createFromFormat('d M Y', trim($end));
        $totalDays = $startDate->diffInDays($endDate) + 1;

        $adults = $request->adults;
        $kids = $request->kids;

        $categoryID = explode(',', $request->categories);
        $categoryname = Category::whereIn('id', $categoryID)->pluck('name')->toArray();
        $categories = implode(', ', $categoryname);
        $prompt = <<<PROMPT
                    Berikan rekomendasi itinerary perjalanan.

                    Detail perjalanan:
                    - Lokasi: $location
                    - StartDate: $startDate
                    - EndDate: $endDate
                    - totalDays: $totalDays
                    - Traveler: $adults Dewasa, $kids Anak
                    - Kategori yang dipilih user: $categories
                    - Budget pengguna: $budget_range

                    Jika itinerary memiliki hotel atau penginapan:
                    - Hari pertama selalu dimulai dari hotel/penginapan sebagai destinasi pertama.
                    - Hari terakhir hotel tidak perlu ditampilkan lagi setelah check-out.
                    - Susun destinasi berdasarkan rute paling efisien dari hotel.
                    - Hindari berpindah lokasi bolak-balik.
                    - Prioritaskan destinasi yang berdekatan agar waktu perjalanan lebih singkat.

                    estimated_cost:
                    - Gunakan harga rata-rata yang wajar.
                    - Jangan isi 0 kecuali benar-benar gratis.
                    - Jika merupakan hotel, gunakan estimasi harga per malam.
                    - Jika merupakan pantai umum atau taman kota yang gratis, isi 0.

                    Gunakan data Google Maps untuk memberikan:
                    - destination_name
                    - address
                    - estimated_cost
                    - google_maps_rating
                    - description
                    - distance_to_next (perkiraan jarak antar destinasi berikutnya dalam kilometer berdasarkan lokasi di Google Maps. Untuk destinasi terakhir isi null)

                    PENTING:
                    - Return ONLY valid JSON.
                    - Jangan berikan penjelasan.
                    - Jangan menggunakan markdown.
                    - Jangan menggunakan ```json.
                    - Response harus berupa SATU objek JSON yang valid.

                    Format JSON:

                    {
                        "trip_details": {
                            "location": "$location",
                            "start_date": "2026-07-27",
                            "end_date": "2026-07-30",
                            "adults": $adults,
                            "children": $kids,
                            "categories": [
                                "Nature",
                                "Adventure"
                            ]
                        },
                        "itinerary": [
                            {
                                "day": 1,
                                "date": "2026-07-27",
                                "activities": [
                                    {
                                        "time": "08:00 AM",
                                        "destination_name": "Goa Pindul",
                                        "address": "...",
                                        "estimated_cost": 50000,
                                        "google_maps_rating": 4.5,
                                        "description": "...",
                                        "distance_to_next": "17 km"
                                    },
                                    {
                                        "time": "01:00 PM",
                                        "destination_name": "HeHa Sky View",
                                        "address": "...",
                                        "estimated_cost": 30000,
                                        "google_maps_rating": 4.6,
                                        "description": "...",
                                        "distance_to_next": "8 km"
                                    },
                                    {
                                        "time": "05:00 PM",
                                        "destination_name": "Malioboro",
                                        "address": "...",
                                        "estimated_cost": 0,
                                        "google_maps_rating": 4.7,
                                        "description": "...",
                                        "distance_to_next": null
                                    }
                                ]
                            }
                        ]
                    }
                    PROMPT;

        $response = Http::timeout(60)
        ->retry(2, 1000)        
        ->withHeaders([
            'Content-Type' => 'application/json',
            'X-goog-api-key' => env('GEMINI_API'),
        ])->post(
            'https://generativelanguage.googleapis.com/v1beta/models/gemini-3.1-flash-lite:generateContent',
            [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "$prompt"
                            ]
                        ]
                    ]
                ]
            ]
        );
        $hasil = $response['candidates'][0]['content']['parts'][0]['text'];
        $hasil = str_replace(['```json', '```'], '', $hasil);
        $json = json_decode($hasil, true);
        //dd($date);
        session(['itinerary' => $json]);

        try {
            foreach ($json['itinerary'] as $day) {
                foreach ($day['activities'] as $activity) {
                    itinerary::create([
                        'trip_uuid' => $tripUuid,
                        'user_id' => Auth::id(),
                        'location' => $json['trip_details']['location'],
                        'start_date' => $json['trip_details']['start_date'],
                        'end_date' => $json['trip_details']['end_date'],
                        'day' => $day['day'],
                        'date' => $day['date'],
                        'time' => $activity['time'],
                        'adults' => $json['trip_details']['adults'],
                        'children' => $json['trip_details']['children'],
                        'destination_name' => $activity['destination_name'],
                        'address' => $activity['address'],
                        'estimated_cost' => $activity['estimated_cost'],
                        'rating' => $activity['google_maps_rating'],
                        'description' => $activity['description'],
                        'distance_to_next' => $activity['distance_to_next'],
                    ]);
                }
            }
            return view('itineraries.ilist', compact('json'));

        } catch (\Exception $e) {
            dd($json);
        }
    }
}
