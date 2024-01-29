<?php

namespace App\Http\Controllers\API;

use App\Models\UserLocation;
use Illuminate\Http\Request;

class LiveLocationController extends Controller
{
    public function index()
    {
        // Get user locations from the database
        $userLocations = UserLocation::all(['id', 'latitude', 'longitude']);

        return response()->json($userLocations);
    }
}
