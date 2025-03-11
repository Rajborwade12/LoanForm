<?php
include('db.php');
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO loan_users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $message = "✅ Registration successful! <a href='index.php' class='login-link'>Login Here</a>";
    } else {
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Shri Chhatrapati Rajarshi Shahu Urban Coop Bank Ltd Beed</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #ffefd5;
            margin: 0;
            padding: 0;
        }

        /* Header Bar */
        .header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
        }

        /* Center Content */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 60px);
        }

        /* Registration Box */
        .register-container {
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            width: 350px;
        }

        /* Form Title */
        .form-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        /* Input Fields */
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        /* Buttons */
        button {
            width: auto;
            padding: 10px 20px;
            background: #2ecc71;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #27ae60;
        }

        /* Success/Error Message */
        .message {
            font-size: 14px;
            margin-top: 10px;
            color: green;
        }

        .error {
            color: red;
        }

        /* Login Link */
        .login-link {
            display: block;
            margin-top: 10px;
            color: #3498db;
            font-size: 14px;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    🏦 Shri Chhatrapati Rajarshi Shahu Urban Coop Bank Ltd Beed
</div>

<!-- Registration Form -->
<div class="container">
    <div class="register-container">
        <!-- Form Title -->
        <div class="form-title">📝व्यवसाय भेट अहवाल Register</div>

        <?php if ($message): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="name" placeholder="👤 Full Name" required>
            <input type="email" name="email" placeholder="📧 Email" required>
            <input type="password" name="password" placeholder="🔒 Password" required>
            <button type="submit">📝 Register</button>
        </form>

        <a href="index.php" class="login-link">🔑 Already Registered? Login Here</a>
    </div>
</div>

</body>
</html>
