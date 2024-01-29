<?php

namespace App\Http\Controllers\API;

use App\Models\UserLocation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;
date_default_timezone_set("Asia/Kuala_lumpur");

class UserLocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        UserLocation::create([
            'user_id' => Auth::id(),
            'latitude' => $request->input('latitude'),
            'longitude' => $request->input('longitude'),
        ]);

        return response()->json(['message' => 'Location saved successfully'], 201);
    }

    public function index()
    {
        $userLocations = UserLocation::all();

        return response()->json($userLocations);
    }
}
