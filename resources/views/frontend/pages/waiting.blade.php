<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Blocked</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            font-family: 'Cairo', 'Tajawal', Arial, sans-serif;
        }

        .waiting-container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            text-align: center;
        }

        .waiting-icon {
            font-size: 5rem;
            margin-bottom: 1.5rem;
            color: #f6c23e;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }

        .waiting-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: 1px;
        }

        .waiting-message {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .redirect-info {
            font-size: 1rem;
            color: #d1d3e2;
        }

        .btn-back {
            margin-top: 2rem;
            background: #fff;
            color: #224abe;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            transition: background 0.3s, color 0.3s;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 2px 8px rgba(34, 74, 190, 0.08);
        }

        .btn-back:hover {
            background: #f6c23e;
            color: #fff;
        }
    </style>

</head>
<body>
<div class="waiting-container">
    <div class="waiting-icon">
        <i class="fas fa-user-lock"></i>
    </div>
    <div class="waiting-title">Account Blocked</div>
    <div class="waiting-message">
        Your account has been temporarily blocked.<br>
        Please contact the administrator if you believe this is a mistake.
    </div>
    <div class="redirect-info">
        You will be redirected to the login page in <span id="countdown">8</span> seconds.
    </div>
    <a href="/contact-us" class="btn-back">Contact Support</a>
</div>
<script>
    let seconds = 8;
    const countdown = document.getElementById('countdown');
    setInterval(function () {
        if (seconds > 1) {
            seconds--;
            countdown.textContent = seconds;
        } else {
            window.location.href = "/contact-us";
        }
    }, 1000);
</script>
</body>
</html>



{{--<!DOCTYPE html>--}}
{{--<html lang="ar">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8"/>--}}
{{--    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>--}}
{{--    <title> wait</title>--}}
{{--    <!-- Include Tailwind CSS -->--}}
{{--    <link--}}
{{--            href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css"--}}
{{--            rel="stylesheet"--}}
{{--    />--}}

{{--</head>--}}

{{--<body class="bg-gray-200 flex items-center justify-center h-screen">--}}
{{--<div class="max-w-md bg-white p-8 rounded-lg shadow-lg text-center" style="min-width: 80ch">--}}
{{--    <div class="mb-6">--}}
{{--        <svg--}}
{{--                class="animate-spin h-12 w-12 text-blue-500 mx-auto mb-4"--}}
{{--                xmlns="http://www.w3.org/2000/svg"--}}
{{--                fill="none"--}}
{{--                viewBox="0 0 24 24">--}}
{{--            <circle--}}
{{--                    class="opacity-25"--}}
{{--                    cx="12"--}}
{{--                    cy="12"--}}
{{--                    r="10"--}}
{{--                    stroke="currentColor"--}}
{{--                    stroke-width="4"--}}
{{--            ></circle>--}}
{{--            <path--}}
{{--                    class="opacity-75"--}}
{{--                    fill="currentColor"--}}
{{--                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A8.003 8.003 0 0112 4.018V0C6.477 0 2 4.477 2 10h4zm2 6.764V20c5.523 0 10-4.477 10-10h-4a6 6 0 00-6 6z"--}}
{{--            ></path>--}}
{{--        </svg>--}}
{{--        <div class="message"><a style="color: red" href="" class="btn btn-primary">Refresh </a></div>--}}
{{--        <br>--}}
{{--        <h2 class="text-2xl font-semibold mb-2">ًWait </h2>--}}
{{--        <p class="text-gray-700">--}}
{{--            Opps!! you are blocked !--}}
{{--        </p>--}}
{{--    </div>--}}
{{--    <hr class="my-4 border-gray-300"/>--}}
{{--    <p class="text-sm text-gray-600">--}}
{{--        this wating page--}}
{{--    </p>--}}
{{--</div>--}}


{{--</body>--}}
{{--</html>--}}









