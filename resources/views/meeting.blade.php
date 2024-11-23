<!DOCTYPE html>
<html>
<head>
    <title>Meeting Room</title>
</head>
<body>
<h1>Welcome to your meeting</h1>
<div id="jitsi-container" style="height: 100vh; width: 100%;"></div>

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    const domain = "meet.jit.si";
    const options = {
        roomName: "{{ $roomName }}",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#jitsi-container'),
        userInfo: {
            displayName: "{{ $userName }}"
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);

    api.addEventListener('videoConferenceJoined', () => {
        console.log("Conference joined!");
    });

    api.addEventListener('videoConferenceLeft', () => {
        console.log("Conference left!");
        window.location.href = '/dashboard'; // Redirect after leaving
    });
</script>
</body>
</html>

