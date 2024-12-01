
<!DOCTYPE html>

<html lang="en">

<head>
    <title>XYZ Video Conference</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/user_dashboard.css') }}">
    <style> body { display: flex;  justify-content: center; height: 100vh; margin: 0; } .button-container { display: flex; gap: 10px; /* Adjust the gap between buttons as needed */ }</style>
</head>
<body>
    <div class="container">

    <h1>XYZ Pte Ltd.</h1>
    <h2>Welcome, {{ $user->name }}</h2>

    <!-- Action Button -->
    <div class="button-container">
        <button onclick="window.location.href='{{ route('schedule.create') }}'">Create New Meeting</button>
        <form action="{{ route('profile.edit') }}" method="GET" class="inline">
            <button type="submit" class="text-gray-700 hover:text-gray-900 font-medium">
                {{ __('Profile') }}
            </button>
        </form>
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-gray-700 hover:text-gray-900 font-medium">
                {{ __('Logout') }}
            </button>
        </form>

    </div>


    <!-- Meetings Table -->
    <table>
        <thead>
        <tr>
            <th>Meeting Name</th>
            <th>Meeting Organizer</th>
            <th>Meeting Link</th>
            <th>Meeting Date</th>
            <th>Meeting Start Time</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($futureMeetings as $meeting)
            <tr>
                <td >{{ $meeting->Meeting_Name }}</td>
                <td>{{ $meeting->organizer->name ?? 'Unknown' }}</td>
                <td>
                    <a href="{{ $meeting->Meeting_Link }}" target="_blank">
                        {{ $meeting->Meeting_Link ? 'Join' : 'Not Available' }}
                    </a>
                </td>
                <td>{{ $meeting->Meeting_date }}</td>
                <td>{{ $meeting->startTime }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No future meetings scheduled.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

</div>

    <div class="button-container">






    </div>
</body>
</html>
