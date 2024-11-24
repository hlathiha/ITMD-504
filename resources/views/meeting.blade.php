<!DOCTYPE html>
<html>
<head>
    <title>Jitsi Meeting</title>
</head>
<body>
<h1>Welcome to your meeting, {{ $userName }}</h1>
<div id="jitsi-container" style="height: 100vh; width: 100%;"></div>

<script src="https://47.130.73.49/external_api.js"></script>
<script>
    const domain = "47.130.73.49";
    const options = {
        roomName: "{{ $roomName }}",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#jitsi-container'),

        configOverwrite: {
            disableCertificateVerification: true
        },
        userInfo: {
            displayName: "{{ $userName }}"
        },
        interfaceConfigOverwrite: {
            // Customize the interface
            TOOLBAR_BUTTONS: [
                'microphone', 'camera', 'desktop', 'fullscreen', 'hangup' // Include only these buttons
            ],
            SHOW_JITSI_WATERMARK: false, // Hide Jitsi watermark
            SHOW_BRAND_WATERMARK: false, // Hide brand watermark
            SHOW_POWERED_BY: false, // Hide "Powered by Jitsi" label
            filmStripOnly: false // Show full interface (false), or filmstrip only (true)
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);

    api.addEventListener('videoConferenceJoined', () => {
        console.log("Conference joined!");
    });

    api.addEventListener('videoConferenceLeft', () => {
        console.log("Conference left!");
        window.location.href = '/dashboard';
    });
</script>
</body>
</html>
