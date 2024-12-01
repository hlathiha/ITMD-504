<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Log;

class ScheduleController extends Controller
{

    public function createForm()
    {
        // Fetch all users from the database
        $users = User::all();

        // Pass the users to the view
        return view('schedule_form', compact('users'));
    }

    // Show the form for scheduling a meeting
    public function showForm()
    {
        // Fetch all users for the dropdown
        $users = User::all();

        return view('schedule_form', compact('users'));
    }

    // Create a new schedule
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            // Log incoming request data
            Log::info('Request Data:', $request->all());

            // Validate request data
            $validated = $request->validate([
                'Meeting_Name' => 'required|string|max:255',
                'Meeting_date' => 'required|date',
                'startTime' => 'required|date_format:H:i',
                'EndTime' => 'required|date_format:H:i|after:startTime',
                'Meeting_Link' => 'nullable|string|max:255',
                'UID' => 'required|array',
            ]);

            // Create schedule entries for each user
            foreach ($validated['UID'] as $userId) {
                Schedule::create([
                    'Meeting_Name' => $validated['Meeting_Name'],
                    'Meeting_date' => $validated['Meeting_date'],
                    'startTime' => $validated['startTime'],
                    'EndTime' => $validated['EndTime'],
                    'Meeting_Link' => $validated['Meeting_Link'],
                    'UID' => $userId,
                ]);
            }

            // Log success
            Log::info('Schedule saved successfully.');

            return response()->json(['message' => 'Schedule created successfully!']);
        } catch (\Exception $e) {
            // Log error
            Log::error('Error creating schedule: ' . $e->getMessage());

            return response()->json(['error' => 'Failed to create schedule.'], 500);
        }
    }

    // Generate a JWT token for Jitsi API
    private function generateJwt(string $meetingName): string
    {
        $key = env('JITSI_APP_SECRET');
        $appId = env('JITSI_APP_ID');
        $domain = env('JITSI_MEET_DOMAIN');

        $payload = [
            "aud" => $appId,
            "iss" => $appId,
            "sub" => $domain,
            "exp" => time() + 2678400, // Token expires in 31 days
            "room" => $meetingName,
            "context" => [
                "user" => [
                    "name" => "Meeting Organizer",
                    "email" => auth()->user()->email ?? 'organizer@example.com',
                ]
            ],
        ];

        return JWT::encode($payload, $key, 'HS256');
    }


    // Get the Jitsi domain from .env
    private function getJitsiDomain(): string
    {
        return env('JITSI_MEET_DOMAIN');
    }

    //----- store meeting info to tbl_Schedule
    public function store(Request $request)
    {
        Log::info('Form submitted to the store method.');
        // Validate incoming data
        $validatedData = $request->validate([
            'Meeting_Name' => 'required|string|max:255',
            'Meeting_date' => 'required|date|after_or_equal:today',
            'startTime' => 'required|date_format:H:i',
            'EndTime' => 'required|date_format:H:i|after:startTime',
            'UIDs' => 'required|array|min:1', // Ensure at least one user is selected
        ]);

        try {
            // Generate a unique meeting name
            $meetingName = uniqid('meeting_');

            // Generate JWT token for the meeting
            $jwt = $this->generateJwt($meetingName);

            // Generate the meeting link with JWT
            $meetingLink = 'https://' . $this->getJitsiDomain() . '/' . $meetingName . '?jwt=' . $jwt;

            // Iterate through selected users and save to `tbl_schedule`
            foreach ($validatedData['UIDs'] as $uid) {
                // Optional: Add conflict-checking logic here, if needed
                Schedule::create([
                    'Meeting_Name' => $validatedData['Meeting_Name'],
                    'Meeting_date' => $validatedData['Meeting_date'],
                    'startTime' => $validatedData['startTime'],
                    'EndTime' => $validatedData['EndTime'],
                    'Meeting_Link' => $meetingLink,
                    'UID' => $uid, // Store each user ID
                    
                ]);

                Log::info("Meeting created for User ID: {$uid} with link: {$meetingLink}");
            }

            // Redirect to success page with a success message
            return redirect()->route('schedule.success')->with('success', 'Meeting scheduled successfully!');
        } catch (\Exception $e) {
            Log::error('Failed to schedule meeting: ' . $e->getMessage());
            return back()->withErrors('Failed to save the meeting. Please try again.');
        }
    }

}
