<?php
session_start();
$conn = new mysqli("localhost", "root", "", "auth_db");
if ($conn->connect_error) {
    $conn = new mysqli("localhost", "root", "");
    $conn->query("CREATE DATABASE IF NOT EXISTS auth_db");
    $conn->select_db("auth_db");
    $conn->query("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE,
        password VARCHAR(255)
    )");
}

$msg = "";
$msgClass = "alert-info";

// Registration
if (isset($_POST['register'])) {
    $user = $_POST['reg_user'];
    $pass = password_hash($_POST['reg_pass'], PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password) VALUES ('$user', '$pass')";
    if ($conn->query($sql)) $msg = "Registration successful! You can now login.";
    else $msg = "Error: Username might already be taken.";
}

// Login
if (isset($_POST['login'])) {
    $user = $_POST['log_user'];
    $pass = $_POST['log_pass'];
    $result = $conn->query("SELECT * FROM users WHERE username='$user'");
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($pass, $row['password'])) {
            $_SESSION['logged_in_user'] = $user;
            setcookie("last_login", date("Y-m-d H:i:s"), time() + 3600);
            header("Location: index.php");
            exit();
        } else {
            $msg = "Invalid password!";
            $msgClass = "alert-danger";
        }
    } else {
        $msg = "User not found!";
        $msgClass = "alert-danger";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Module - Lab 13</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .auth-card { max-width: 400px; margin: 50px auto; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <?php if (!isset($_SESSION['logged_in_user'])): ?>
        <div class="auth-card bg-white p-4">
            <h3 class="text-center mb-4">Authentication</h3>
            <?php if($msg) echo "<div class='alert $msgClass'>$msg</div>"; ?>

            <!-- Login Tabs -->
            <ul class="nav nav-tabs mb-3" id="authTab" role="tablist">
                <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#loginView">Login</button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#registerView">Register</button></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="loginView">
                    <form method="POST">
                        <input type="text" name="log_user" class="form-control mb-2" placeholder="Username" required>
                        <input type="password" name="log_pass" class="form-control mb-3" placeholder="Password" required>
                        <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                    </form>
                </div>
                <div class="tab-pane fade" id="registerView">
                    <form method="POST">
                        <input type="text" name="reg_user" class="form-control mb-2" placeholder="New Username" required>
                        <input type="password" name="reg_pass" class="form-control mb-3" placeholder="New Password" required>
                        <button type="submit" name="register" class="btn btn-success w-100">Register</button>
                    </form>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="auth-card bg-white p-5 text-center">
            <h2 class="text-success">Welcome!</h2>
            <p class="lead">Logged in as: <b><?php echo $_SESSION['logged_in_user']; ?></b></p>
            <p class="text-muted small">Your last login timestamp (from cookie): <br><?php echo $_COOKIE['last_login'] ?? 'Just now'; ?></p>
            <a href="index.php?logout=true" class="btn btn-danger mt-3">Logout</a>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
