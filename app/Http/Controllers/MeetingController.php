<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function createMeeting()
    {
        $roomName = 'Meeting-' . uniqid(); // Unique room name
        $userName = auth()->user()->name; // Get logged-in user's name

        return view('meeting', [
            'roomName' => $roomName,
            'userName' => $userName,
        ]);
    }
}
