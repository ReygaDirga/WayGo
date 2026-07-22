<?php

namespace App\Http\Controllers;

use App\Models\itinerary;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB; 

class SavedController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $completedTrip = Itinerary::where('user_id', $userId)
            ->whereDate('end_date', '<', now())
            ->distinct('trip_uuid')
            ->count('trip_uuid');

        $ongoingTrip = Itinerary::where('user_id', $userId)
            ->whereDate('end_date', '>=', now())
            ->distinct('trip_uuid')
            ->count('trip_uuid');

        $visitedCities = Itinerary::where('user_id', $userId)
            ->distinct('location')
            ->count('location');

        // Ambil UUID itinerary terakhir
        $latestTrip = Itinerary::where('user_id', $userId)
            ->latest('created_at')
            ->first();

        $latestTripData = null;

        // if ($latestTrip) {
        //     $latestTripData = Itinerary::where('trip_uuid', $latestTrip->trip_uuid)
        //         ->orderBy('day')
        //         ->orderBy('time')
        //         ->get();
        // }

        // $latestTripData = null;

        if ($latestTrip) {
            $activities = Itinerary::where('trip_uuid', $latestTrip->trip_uuid)
                ->orderBy('day')
                ->orderBy('time')
                ->get();

            $latestTripData = [
                'summary' => $activities->first(),
                'activities' => $activities,
                'total_budget' => $activities->sum('estimated_cost'),
                'highlights' => $activities->take(3),
            ];
        }

        $otherTrips = Itinerary::where('user_id', $userId)
            ->when($latestTrip, function ($query) use ($latestTrip) {
                $query->where('trip_uuid', '!=', $latestTrip->trip_uuid);
            })
            ->select(
                'trip_uuid',
                'location',
                'start_date',
                'end_date',
                'adults',
                'children',
                'categories',
                DB::raw('SUM(estimated_cost) as total_budget')
            )
            ->groupBy(
                'trip_uuid',
                'location',
                'start_date',
                'end_date',
                'adults',
                'children',
                'categories'
            )
            ->orderByDesc('start_date')
            ->get();

        return view('itineraries.saved', compact(
            'completedTrip',
            'ongoingTrip',
            'visitedCities',
            'latestTripData',
            'otherTrips'
        ));
    }

    public function detail($uuid)
    {
        $trip = itinerary::where('trip_uuid', $uuid)
            ->where('user_id', Auth::id())
            ->orderBy('day')
            ->orderBy('time')
            ->get();

        return response()->json($trip);
    }

    public function exportPdf($uuid)
    {
        $user = Auth::user();
        $trip = itinerary::where('trip_uuid', $uuid)
            ->where('user_id', Auth::id())
            ->orderBy('day')
            ->orderBy('time')
            ->get();

        if ($trip->isEmpty()) {
            abort(404);
        }

        $totalBudget = $trip->sum('estimated_cost');

        $pdf = Pdf::loadView('pdf.itinerary', [
            'trip' => $trip,
            'user' => $user,
            'totalBudget' => $totalBudget,
        ]);

        $pdf->setPaper('a4');

        return $pdf->download(
            explode(',', $trip->first()->location)[0] . '-Itinerary.pdf'
        );
    }

    public function destroy($uuid)
    {
        Itinerary::where('trip_uuid', $uuid)
            ->where('user_id', Auth::id())
            ->delete();

        return redirect()
            ->route('trips')
            ->with('success', 'Itinerary deleted successfully.');
    }
}