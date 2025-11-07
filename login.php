<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security App - Login</title>
    <!-- smart ui style -->
    <link rel="stylesheet" href="assets/source/styles/smart.default.css" type="text/css" />
    <script type="module">
        window.Smart.License = "0A2C72B9-D78F-5E17-8D07-0CBC0E1EDC29";
    </script>
    <!-- smart ui style -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-body">
    <div class="login-container">
        <div class="login-card">
            <div class="logo-section">
                <img src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTEyIDJMNCA3TDEyIDEyTDIwIDdMMTIgMlpNMTIgMTdMNCAxMkwyMCAxMkwyMiAxNEwxMiAxN1pNMTIgMjJMMjAgMTdMMTggMTZMMTIgMTlWNjBWNjBaTTEyIDIyTDQgMTdMNiAxNkwxMiAxOVY2MFY2MFoiIGZpbGw9IiMxYTIzN2UiLz4KPC9zdmc+"
                    alt="Security Logo">
                <h1>Security Pro</h1>
                <p>Secure • Reliable • Professional</p>
            </div>

            <form id="loginForm" class="login-form">
                <div class="form-group">
                    <smart-input label="Email" type="email" required placeholder="Enter your email" autocomplete="off"
                        autocorrect="off" autocapitalize="off" spellcheck="false"></smart-input>
                </div>
                <div class="form-group">
                    <smart-input label="Password" type="password" required placeholder="Enter your password"
                        autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></smart-input>
                </div>
                <div class="form-group">
                    <smart-button type="submit" class="primary" id="loginBtn">LOGIN</smart-button>
                </div>
                <div class="role-selection">
                    <smart-radio-button name="role" value="supervisor" checked>Supervisor</smart-radio-button>
                    <smart-radio-button name="role" value="guard">Security Guard</smart-radio-button>
                </div>
            </form>

            <div id="errorMessage" class="error-message" style="display: none;"></div>
        </div>
    </div>
    <script type="text/javascript" src="assets/source/smart.elements.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>