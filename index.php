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
        backdrop-filter: blur(5px);
        background: rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
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
        background: rgba(255, 255, 255, 0.12);
        border-radius: 16px;
        min-height: 250px;
        border: 1px solid rgba(255, 255, 255, 0.1);
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
    </style>
</head>

<body>
    <div class="container">
        <div class="loader"></div>
        <h1>Please Wait...</h1>
        <p>Your link will be ready in <span id="countdown">5</span> seconds</p>
        <!-- Button yang awalnya hidden -->
        <a href="https://your-target-url.com" class="redirect-btn" id="redirectButton" style="display: none;">
            Get Link
        </a>
        <div class="ad-space">
            <!-- Paste kode iklan lo disini -->
            <p style="color: rgba(255,255,255,0.7);">Advertisement Space</p>
        </div>
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
    </script>
</body>

</html>