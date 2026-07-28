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
        if ($request->isMethod('get') && session()->has('itinerary')) {$json = session('itinerary');
            return view('itineraries.ilist', compact('json'));
        }

        session()->forget('itinerary');

        $tripUuid = Str::uuid()->toString();

        $rawBudget =$request->input('budget');
        $userBudget = preg_replace('/[^0-9]/', '',$rawBudget);

        if ($userBudget) {$budget_range = "Rp " . number_format((float)$userBudget, 0, ',', '.');         } else {$budget_range = "Tidak ditentukan";
        }

        $location =$request->location;

        $date =$request->date;
        [$start,$end] = explode(' to ', $date);$startDate = Carbon::createFromFormat('d M Y', trim($start));$endDate   = Carbon::createFromFormat('d M Y', trim($end));$totalDays = $startDate->diffInDays($endDate) + 1;
        $totalNights = max(1, $startDate->diffInDays($endDate));

        $adults =$request->adults;
        $kids =$request->kids;

        $categoryID = explode(',',$request->categories);
        $categoryname = Category::whereIn('id',$categoryID)->pluck('name')->toArray();
        $categories = implode(', ',$categoryname);

        $prompt = <<<PROMPT
                    Berikan rekomendasi itinerary perjalanan.

                    Detail perjalanan:
                    - Lokasi: $location
                    - StartDate: $startDate
                    - EndDate: $endDate
                    - totalDays: $totalDays Hari ($totalNights Malam)
                    - Traveler: $adults Dewasa,$kids Anak
                    - Kategori yang dipilih user: $categories
                    
                    TARGET BUDGET PENGGUNA
                    - Budget maksimum pengguna: $budget_range

                    ATURAN BUDGET (WAJIB DIPATUHI, HARD CONSTRAINT)

                    1. Total estimated_cost keseluruhan HARUS berada pada rentang MINIMAL 90% dan MAKSIMAL 100% dari budget pengguna ($budget_range).
                    2. DILARANG KERAS total biaya kurang dari 90% budget.
                    3. DILARANG MUTLAK total biaya melebihi 100% budget, walaupun hanya lebih Rp1. Ini adalah batas atas yang TIDAK BOLEH dilanggar dalam kondisi apapun.
                    4. Target ideal adalah 95% - 98% dari budget pengguna (aman, tidak mepet ke batas atas).
                    5. Jika ragu antara memilih opsi yang lebih mahal atau lebih murah, SELALU pilih opsi yang lebih murah agar tidak berisiko melebihi budget.

                    PERHITUNGAN TOTAL BIAYA

                    Total Budget =
                    (Harga Hotel per malam × $totalNights malam)
                    +
                    (Seluruh estimated_cost destinasi)
                    +
                    (Seluruh estimated_cost restoran)
                    +
                    (Seluruh estimated_cost aktivitas)

                    CONTOH

                    Jika budget = Rp1.000.000

                    Maka total itinerary HARUS berada di antara:

                    Rp900.000 sampai Rp1.000.000

                    Contoh yang BENAR

                    Hotel
                    Rp175.000 × 2 malam = Rp350.000

                    Wisata
                    Rp210.000

                    Kuliner
                    Rp220.000

                    Transport/aktivitas
                    Rp170.000

                    TOTAL = Rp950.000 ✅ (95% dari budget)

                    Contoh yang SALAH

                    TOTAL = Rp350.000 ❌ (terlalu rendah, di bawah 90%)
                    TOTAL = Rp620.000 ❌ (terlalu rendah, di bawah 90%)
                    TOTAL = Rp1.000.001 ❌ (melebihi budget walau cuma Rp1)
                    TOTAL = Rp1.150.000 ❌ (melebihi budget)

                    ATURAN PEMILIHAN DESTINASI

                    - Jika total biaya masih terlalu rendah (di bawah 90%), pilih hotel yang lebih baik atau tambahkan destinasi dan restoran yang sesuai kategori pengguna.
                    - Jika total biaya berpotensi melebihi budget, WAJIB pilih hotel lebih murah, kurangi destinasi berbayar, atau turunkan estimated_cost pada beberapa aktivitas sampai total kembali di bawah 100% budget.
                    - Selalu usahakan total biaya berada sedekat mungkin dengan budget tanpa pernah melewatinya.
                    - Jangan mengurangi kualitas itinerary hanya agar biaya menjadi sangat murah.

                    LANGKAH WAJIB SEBELUM MENGEMBALIKAN JAWABAN (SELF-CHECK)

                    1. Setelah menyusun seluruh itinerary, JUMLAHKAN semua estimated_cost (termasuk hotel × jumlah malam) secara manual.
                    2. Bandingkan hasil penjumlahan tersebut dengan budget pengguna ($budget_range).
                    3. Jika total < 90% dari budget, TAMBAHKAN destinasi/restoran atau upgrade hotel, lalu hitung ulang.
                    4. Jika total > 100% dari budget, KURANGI/TURUNKAN estimated_cost beberapa item, lalu hitung ulang.
                    5. Ulangi proses ini sampai total benar-benar berada di rentang 90% - 100% dari budget.
                    6. Baru setelah itu kembalikan JSON final. Jangan pernah mengembalikan itinerary yang belum melewati pengecekan ini.

                    Jika itinerary memiliki hotel atau penginapan:
                    - Tampilkan hotel/penginapan HANYA SATU KALI pada Hari 1 (Day 1) sebagai destinasi pertama dengan cost_type "per_night". Pada hari berikutnya tidak perlu menampilkan item hotel lagi agar biaya tidak terhitung ganda.
                    - Susun destinasi berdasarkan rute paling efisien dari hotel.

                    estimated_cost:
                    - Gunakan harga rata-rata yang wajar.
                    - Jika hotel/penginapan, isikan harga PER MALAM (bukan total keseluruhan malam).
                    - Jika destinasi wisata/restoran, isikan biaya per kunjungan.

                    Tambahkan field baru bernama cost_type.
                    Nilainya hanya boleh salah satu:
                    - "per_night" -> untuk hotel/penginapan
                    - "per_visit" -> untuk tempat wisata, restoran, museum, dll

                    Gunakan data Google Maps untuk memberikan:
                    - destination_name
                    - address
                    - estimated_cost
                    - google_maps_rating
                    - description
                    - distance_to_next

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
                                        "destination_name": "Hotel Aston",
                                        "address": "...",
                                        "estimated_cost": 50000,
                                        "cost_type": "per_night",
                                        "google_maps_rating": 4.5,
                                        "description": "...",
                                        "distance_to_next": "17 km"
                                    },
                                    {
                                        "time": "01:00 PM",
                                        "destination_name": "HeHa Sky View",
                                        "address": "...",
                                        "estimated_cost": 30000,
                                        "cost_type": "per_visit",
                                        "google_maps_rating": 4.6,
                                        "description": "...",
                                        "distance_to_next": "8 km"
                                    },
                                    {
                                        "time": "05:00 PM",
                                        "destination_name": "Malioboro",
                                        "address": "...",
                                        "estimated_cost": 0,
                                        "cost_type": "per_visit",
                                        "google_maps_rating": 4.7,
                                        "description": "...",
                                        "distance_to_next": null
                                    }
                                ]
                            }
                        ]
                    }
                    PROMPT;

        $endpoint = 'gemini-3.1-flash-lite:generateContent';
        $p1 = 'https://generative';
        $p2 = 'language.googleapis.com';
        $url = $p1 . $p2 . '/v1beta/models/' . $endpoint;

        $response = Http::withoutVerifying()
            ->timeout(60)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'X-goog-api-key' => env('GEMINI_API'),
            ])
            ->post($url, [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ]
            ]);

        if (!$response->successful()) {
            dd('API Error Detail:', $response->json()['error'] ?? $response->body());
        }

        $hasil = $response['candidates'][0]['content']['parts'][0]['text'];
        $hasil = str_replace(['```json', '```'], '', $hasil);
        $json = json_decode($hasil, true);

        session(['itinerary' => $json]);

        try {
            $totalEstimatedCost = 0;

            foreach ($json['itinerary'] as $dayIndex => $day) {
                foreach ($day['activities'] as $activityIndex => $activity) {
                    $estimatedCost = $activity['estimated_cost'];
                    if (
                        isset($activity['cost_type']) &&
                        $activity['cost_type'] === 'per_night' &&
                        $day['day'] == 1
                    ) {
                        $estimatedCost *= $totalNights;
                    }
                    $json['itinerary'][$dayIndex]['activities'][$activityIndex]['estimated_cost'] = $estimatedCost;
                    $totalEstimatedCost += $estimatedCost;
                }
            }

            $userBudgetValue = (float) $userBudget;

            if ($userBudgetValue > 0 && $totalEstimatedCost > $userBudgetValue) {
                $targetCost = $userBudgetValue * 0.97;
                $scaleFactor = $targetCost / $totalEstimatedCost;

                $newTotal = 0;

                foreach ($json['itinerary'] as $dayIndex => $day) {
                    foreach ($day['activities'] as $activityIndex => $activity) {
                        $originalCost = $activity['estimated_cost'];

                        if ($originalCost > 0) {
                            $scaledCost = (int) (round(($originalCost * $scaleFactor) / 1000) * 1000);
                        } else {
                            $scaledCost = 0;
                        }

                        $json['itinerary'][$dayIndex]['activities'][$activityIndex]['estimated_cost'] = $scaledCost;
                        $newTotal += $scaledCost;
                    }
                }

                $totalEstimatedCost = $newTotal;
            }

            foreach ($json['itinerary'] as $dayIndex => $day) {
                foreach ($day['activities'] as $activityIndex => $activity) {
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
                        'categories' => $categories,
                        'destination_name' => $activity['destination_name'],
                        'address' => $activity['address'],
                        'estimated_cost' => $activity['estimated_cost'],
                        'rating' => $activity['google_maps_rating'],
                        'description' => $activity['description'],
                        'distance_to_next' => $activity['distance_to_next'],
                    ]);
                }
            }

            $totalTravelers = max(1, (int) $adults + (int) $kids);
            $budgetPerPerson = $totalEstimatedCost / $totalTravelers;

            $json['trip_details']['total_estimated_cost'] = $totalEstimatedCost;
            $json['trip_details']['total_travelers'] = $totalTravelers;
            $json['trip_details']['budget_per_person'] = $budgetPerPerson;
            $json['trip_details']['total_estimated_cost_formatted'] = 'Rp ' . number_format($totalEstimatedCost, 0, ',', '.');
            $json['trip_details']['budget_per_person_formatted'] = 'Rp ' . number_format($budgetPerPerson, 0, ',', '.');

            session(['itinerary' => $json]);

            return view('itineraries.ilist', compact('json'));

        } catch (\Exception $e) {
            dd($e);
        }
    }
}