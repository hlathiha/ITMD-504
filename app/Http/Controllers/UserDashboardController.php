<?php

namespace App\Http\Controllers;
use App\Models\Schedule;

use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{

    public function index()
    {
        $user = auth()->user(); // Get the logged-in user
        $futureMeetings = Schedule::where('UID', $user->id)
            ->whereDate('Meeting_date', '>=', now()) // Only future meetings
            ->get();

        return view('user_dashboard', [
            'user' => $user,
            'futureMeetings' => $futureMeetings,
        ]);
    }
}
