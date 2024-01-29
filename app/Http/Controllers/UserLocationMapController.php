<?php

// app/Http/Controllers/UserLocationMapController.php

namespace App\Http\Controllers;

use App\Models\UserLocation;
use Illuminate\Support\Facades\DB;

class UserLocationMapController extends Controller
{
    public function showMap()
    {
        // Fetch the latest user locations from the database
        $latestUserLocations = DB::table('user_locations')
            ->select(DB::raw('MAX(id) as id'))
            ->groupBy('user_id')
            ->get();

        // Extract the IDs from the result
        $latestLocationIds = $latestUserLocations->pluck('id');

        // Fetch the complete latest user locations along with user information based on the IDs
        $userLocations = UserLocation::with('user')->whereIn('id', $latestLocationIds)->get();

        // Pass user locations to the view
        return view('user-location-map', compact('userLocations'));
    }
}
