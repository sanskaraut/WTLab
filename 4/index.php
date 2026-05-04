<?php
// Start the session for login example
session_start();

// Handle Logout
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: index.php");
    exit();
}

$message = "";
$messageClass = "alert-info";

// Process POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 1. Validate Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Invalid email format!";
        $messageClass = "alert-danger";
    } else {
        // 2. Set Cookie for username (expires in 1 hour)
        setcookie("username", $name, time() + 3600, "/");
        
        // 3. Implement Session-based login
        $_SESSION['user'] = $name;
        $message = "Login Successful via POST! Welcome, " . $name;
        $messageClass = "alert-success";
    }
}

// Process GET method (for demo)
if (isset($_GET['name_get'])) {
    $message = "Data received via GET: " . htmlspecialchars($_GET['name_get']);
    $messageClass = "alert-warning";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Processing - Lab 4</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow-sm" style="max-width: 500px;">
    <h2 class="text-center mb-4">PHP Form Handler</h2>

    <?php if ($message): ?>
        <div class="alert <?php echo $messageClass; ?>"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user'])): ?>
        <!-- Login Form -->
        <form action="index.php" method="POST" class="mb-4">
            <h5>Login (POST Method)</h5>
            <div class="mb-3">
                <label>Name:</label>
                <input type="text" name="name" class="form-control" value="John Doe" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="john@example.com" required>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="password" name="password" class="form-control" value="password123" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login via POST</button>
        </form>

        <hr>

        <!-- GET Demo -->
        <form action="index.php" method="GET" class="mt-4">
            <h5>Simple Search (GET Method)</h5>
            <div class="input-group">
                <input type="text" name="name_get" class="form-control" placeholder="Enter name">
                <button type="submit" class="btn btn-secondary">Search via GET</button>
            </div>
        </form>
    <?php else: ?>
        <div class="text-center">
            <h3>Welcome, <?php echo $_SESSION['user']; ?>!</h3>
            <p>Your name is also stored in a cookie: <b><?php echo $_COOKIE['username'] ?? 'Not set yet'; ?></b></p>
            <a href="index.php?action=logout" class="btn btn-danger mt-3">Logout</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
