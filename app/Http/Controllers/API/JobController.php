<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use DB;
use stdClass;
use Illuminate\Support\Facades\Storage;
date_default_timezone_set("Asia/Kuala_lumpur");



class JobController extends Controller
{
    public function clockIn(Request $request)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'venue' => 'required|string',
                'customer' => 'required|string',
                'callType' => 'required|string',
                'remark' => 'string',
                'userLocation' => 'required|string',
                'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $email = auth()->user()->email;
            $validatedData['userEmail'] = $email;
            $validatedData['status'] = 'clock_in';

            // Store each image and update the 'image' field with their paths
            $imagePaths = [];
            foreach ($request->file('image') as $index => $image) {
                $imagePath = $image->store('images', 'public');
                $imagePaths["image_$index"] = $imagePath;
            }

            $validatedData['image'] = implode(',', $imagePaths);


            // Create a new job entry in the database
            $job = Job::create($validatedData);

            // Create a timesheet entry for clocking in
            $job->timesheet()->create($validatedData);

            return response()->json(['message' => 'Clock in successful', 'job' => $job], 201);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'Clock in failed', 'error' => $e->getMessage()], 500);
        }
    }

    // ... (other methods)

    public function clockOut(Request $request, $jobId)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'status' => 'required|string', // 'clock_out'
            ]);
            

            // Find the job by ID
            $job = Job::findOrFail($jobId);

            // Create a timesheet entry for clocking out
            $job->timesheet()->create($validatedData);

            return response()->json(['message' => 'Clock out successful'], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            dd($e->getMessage());
            return response()->json(['message' => 'Clock out failed', 'error' => $e->getMessage()], 500);
        }
    }

    // ... (other methods)

    public function getStatus(Request $request)
    {
        try {
            // Validate the request data (you might want to add more validation if needed)
            $validatedData = $request->validate([
                'userEmail' => 'required|email',
            ]);
            $email = auth()->user()->email;
            $validatedData['userEmail'] = $email;

            // Find the latest job entry for the user
            $latestJob = Job::where('userEmail', $validatedData['userEmail'])
                ->latest('created_at')
                ->first();

            // Determine the status based on the latest job entry
            $status = $latestJob ? $latestJob->status : 'clock_out';

            return response()->json(['status' => $status], 200);
        } catch (\Exception $e) {
            // Handle exceptions
            return response()->json(['message' => 'Failed to get status', 'error' => $e->getMessage()], 500);
        }
    }
}
