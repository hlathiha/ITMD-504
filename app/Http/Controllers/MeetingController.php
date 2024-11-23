<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function createMeeting()
    {
        $roomName = 'Meeting-' . uniqid(); // Generate unique room name
        $userName = auth()->user()->name; // Get the name of the logged-in user

        return view('meeting', [
            'roomName' => $roomName,
            'userName' => $userName,
        ]);
    }
}
