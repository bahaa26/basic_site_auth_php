<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userRole = $_SESSION['role'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security App - Dashboard</title>
    <!-- smart ui style -->
    <link rel="stylesheet" href="assets/source/styles/smart.default.css" type="text/css" />
    <script type="module">
        window.Smart.License = "0A2C72B9-D78F-5E17-8D07-0CBC0E1EDC29";
    </script>
    <!-- smart ui style -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="dashboard-container">
        <header class="dashboard-header">
            <div class="header-content">
                <h1>Security Dashboard</h1>
                <div class="user-info">
                    <span>Welcome, <?php echo htmlspecialchars($username); ?> (<?php echo ucfirst($userRole); ?>)</span>
                    <a href="logout.php" class="logout-btn">Logout</a>
                </div>
            </div>
        </header>

        <main class="dashboard-main">
            <?php if ($userRole === 'supervisor'): ?>
                <div class="dashboard-section">
                    <h2>Guards Management</h2>
                    <div id="guardsGrid"></div>
                </div>
            <?php else: ?>
                <div class="dashboard-section">
                    <h2>Guard Dashboard</h2>
                    <div class="guard-tasks">
                        <smart-button class="primary">Start Patrol</smart-button>
                        <smart-button>Report Incident</smart-button>
                        <smart-button>View Checkpoints</smart-button>
                    </div>
                </div>
            <?php endif; ?>
        </main>
    </div>

    <script type="text/javascript" src="assets/source/smart.elements.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>