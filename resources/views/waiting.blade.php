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
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
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
            box-shadow: 0 2px 8px rgba(34,74,190,0.08);
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
        <a href="/admin/login" class="btn-back">Back to Login</a>
    </div>
    <script>
        let seconds = 8;
        const countdown = document.getElementById('countdown');
        setInterval(function() {
            if (seconds > 1) {
                seconds--;
                countdown.textContent = seconds;
            } else {
                window.location.href = "/admin/login";
            }
        }, 1000);
    </script>
</body>
</html> 