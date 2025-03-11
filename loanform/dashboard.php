<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shri Chhatrapati Rajarshi Shahu Urban Coop Bank ltd Beed</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #ffefd5, #ffcba4);
			 
            margin: 0;
            padding: 0;
        }

        /* Header */
        .header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        /* Welcome Message */
        .welcome {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Navigation Buttons */
        .btn-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            font-size: 16px;
            text-decoration: none;
            color: white;
            border-radius: 5px;
            transition: 0.3s;
            text-align: center;
            width: 180px;
            font-weight: bold;
        }

        /* Different Button Styles */
        .btn-visit { background: #3498db; }
        .btn-visit:hover { background: #2980b9; }

        .btn-reports { background: #2ecc71; }
        .btn-reports:hover { background: #27ae60; }

        .btn-logout { background: #e74c3c; }
        .btn-logout:hover { background: #c0392b; }

        /* Footer */
        .footer {
            margin-top: 30px;
            text-align: center;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    🏦 Shri Chhatrapati Rajarshi Shahu Urban Coop Bank ltd Beed
</div>

<!-- Dashboard Container -->
<div class="container">
    <div class="welcome">👋 Welcome, <?php echo $_SESSION['name']; ?>!</div>

    <!-- Buttons Section -->
    <div class="btn-container">
        <a href="form.php" class="btn btn-visit">📋 Online Visit</a>
        <a href="view_reports.php" class="btn btn-reports">📄 View Reports</a>
        <a href="logout.php" class="btn btn-logout">🚪 Logout</a>
    </div>
</div>

<!-- Footer
<div class="footer">
    © 2025 Shri Chhatrapati Rajarshi Shahu Urban Coop Bank ltd Beed
</div> 
 -->
</body>
</html>
