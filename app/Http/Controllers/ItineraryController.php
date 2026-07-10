<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('itineraries.ilist');
    }
}
