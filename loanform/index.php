<?php
include('db.php');
session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password FROM loan_users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $id;
        $_SESSION['name'] = $name;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "❌ Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="mr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Shri Chhatrapati Rajarshi Shahu Urban Coop Bank Ltd Beed</title>
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

        /* Login Container */
        .login-container {
            background: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            width: 350px;
        }

        /* Section Title */
        .form-title {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 15px;
        }

        /* Input Fields */
        input[type="email"], input[type="password"] {
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
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2980b9;
        }

        /* Error Message */
        .error {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }

        /* Register Link */
        .register-link {
            display: block;
            margin-top: 10px;
            color: #27ae60;
            font-size: 14px;
            text-decoration: none;
        }

        .register-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    🏦 Shri Chhatrapati Rajarshi Shahu Urban Coop Bank Ltd Beed
</div>

<!-- Login Form -->
<div class="container">
    <div class="login-container">
        <!-- Form Title -->
        <div class="form-title">📝 ऑनलाइण व्यवसाय भेट अहवाल Login</div>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="email" placeholder="📧 Email" required>
            <input type="password" name="password" placeholder="🔒 Password" required>
            <button type="submit">🔑 Login</button>
        </form>

        <a href="register.php" class="register-link">📝 New user? Register here</a>
    </div>
</div>

</body>
</html>
