<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule a Meeting</title>
    <link rel="stylesheet" href="{{ asset('css/schedule_form.css') }}">
</head>
<body>

<div class="container">
    <h1>Schedule a Meeting</h1>
    <form method="POST" action="{{ route('schedule.store') }}">
        @csrf
        <div class="form-group">
            <label for="Meeting_Name">Meeting Name:</label>
            <input type="text" id="Meeting_Name" name="Meeting_Name" required>
        </div>
        <div class="form-group">
            <label for="Meeting_date">Meeting Date:</label>
            <input type="date" id="Meeting_date" name="Meeting_date" required>
        </div>
        <div class="form-group">
            <label for="startTime">Start Time:</label>
            <input type="time" id="startTime" name="startTime" required>
        </div>
        <div class="form-group">
            <label for="EndTime">End Time:</label>
            <input type="time" id="EndTime" name="EndTime" required>
        </div>
        <div class="form-group">
            <label for="UIDs">Select Users:</label>
            <select id="UIDs" name="UIDs[]" multiple required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Create Schedule</button>
    </form>
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('user-dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Go back to Dashboard') }}
        </x-responsive-nav-link>
    </div>
</div>

</body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</html>

