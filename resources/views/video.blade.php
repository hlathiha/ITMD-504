
<!DOCTYPE html>
<html>
<head>
    <title>Video Conference</title>
</head>
<body>
<div id="jitsi-container" style="height: 100vh; width: 100%;"></div>

<script src="https://meet.jit.si/external_api.js"></script>
<script>
    const domain = "meet.jit.si";
    const options = {
        roomName: "YourRoomName",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#jitsi-container'),
        interfaceConfigOverwrite: {
            // Customize the interface here if needed
        }
    };
    const api = new JitsiMeetExternalAPI(domain, options);

    api.addEventListener('videoConferenceJoined', () => {
        console.log("Conference joined!");
    });

    api.addEventListener('videoConferenceLeft', () => {
        console.log("Conference left!");
    });
</script>
</body>
</html>
