<?php
session_start();
$conn = new mysqli("localhost", "root", "", "complaint_db");
if ($conn->connect_error) {
    $conn = new mysqli("localhost", "root", "");
    $conn->query("CREATE DATABASE IF NOT EXISTS complaint_db");
    $conn->select_db("complaint_db");
    $conn->query("CREATE TABLE IF NOT EXISTS complaints (
        id INT AUTO_INCREMENT PRIMARY KEY,
        student_name VARCHAR(50),
        subject VARCHAR(100),
        description TEXT,
        date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
}

$msg = "";
// Handle Login
if (isset($_POST['login'])) {
    $role = $_POST['role'];
    $pass = $_POST['password'];
    if ($pass == '123') { // Simple password for demo
        $_SESSION['role'] = $role;
        header("Location: index.php");
    } else {
        $msg = "Invalid Password!";
    }
}

// Handle Complaint Submit
if (isset($_POST['submit_complaint'])) {
    $name = $_POST['name'];
    $sub = $_POST['subject'];
    $desc = $_POST['description'];
    $conn->query("INSERT INTO complaints (student_name, subject, description) VALUES ('$name', '$sub', '$desc')");
    $msg = "Complaint submitted successfully!";
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Complaint System - Lab 15</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container" style="max-width: 800px;">
    <h2 class="text-center mb-4">College Complaint Portal</h2>
    <?php if($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>

    <?php if (!isset($_SESSION['role'])): ?>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card p-3 shadow-sm">
                    <h5>Student Login</h5>
                    <form method="POST">
                        <input type="hidden" name="role" value="student">
                        <input type="password" name="password" class="form-control mb-2" placeholder="Pass: 123">
                        <button name="login" class="btn btn-primary w-100">Login as Student</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 shadow-sm border-danger">
                    <h5>Admin Login</h5>
                    <form method="POST">
                        <input type="hidden" name="role" value="admin">
                        <input type="password" name="password" class="form-control mb-2" placeholder="Pass: 123">
                        <button name="login" class="btn btn-danger w-100">Login as Admin</button>
                    </form>
                </div>
            </div>
        </div>
    <?php elseif ($_SESSION['role'] == 'student'): ?>
        <div class="card p-4 shadow">
            <h4>Register a Complaint</h4>
            <form method="POST">
                <input type="text" name="name" class="form-control mb-2" value="Sanskriti" required>
                <input type="text" name="subject" class="form-control mb-2" placeholder="Subject" required>
                <textarea name="description" class="form-control mb-3" rows="4" placeholder="Describe your complaint..." required></textarea>
                <button type="submit" name="submit_complaint" class="btn btn-success w-100">Submit Complaint</button>
            </form>
            <a href="index.php?logout=1" class="btn btn-link mt-2">Logout</a>
        </div>
    <?php else: ?>
        <div class="card p-4 shadow">
            <h4>Admin Dashboard - All Complaints</h4>
            <table class="table table-striped table-hover mt-3">
                <thead><tr><th>ID</th><th>Student</th><th>Subject</th><th>Date</th></tr></thead>
                <tbody>
                    <?php $res = $conn->query("SELECT * FROM complaints"); 
                    while($row = $res->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['student_name']; ?></td>
                        <td><?php echo $row['subject']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <a href="index.php?logout=1" class="btn btn-danger">Logout</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
