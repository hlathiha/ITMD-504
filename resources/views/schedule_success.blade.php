<!DOCTYPE html>
<html lang="en">

<head>
    <title>XYZ Video Conference</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Success</title>
    <style>
        .container {
    max-width: 600px;
            margin: 50px auto;
            text-align: center;
        }
        h2 {
    color: #28a745;
}
    </style>

</head>
<body>
    <div class="container">
        <h2>Meeting Scheduled Successfully!</h2>
        <p>The meeting has been scheduled and shared with all attendees.</p>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user-dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
    </div>
</body>
</html>
