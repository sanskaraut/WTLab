<?php
// Database Configuration
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "student_db";

// 1. Create Connection
$conn = new mysqli($host, $user, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Create Database and Table if not exists
$conn->query("CREATE DATABASE IF NOT EXISTS $dbname");
$conn->select_db($dbname);
$conn->query("CREATE TABLE IF NOT EXISTS students (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
)");

$message = "";

// Handle Insert
if (isset($_POST['insert'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO students (name, email) VALUES ('$name', '$email')";
    if ($conn->query($sql)) $message = "Record inserted successfully!";
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
    $message = "Record deleted!";
}

// Handle Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $conn->query("UPDATE students SET name='$name', email='$email' WHERE id=$id");
    $message = "Record updated!";
}

// Fetch Records
$result = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student CRUD - Lab 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow">
    <h2 class="text-center mb-4">Student Database Management</h2>

    <?php if($message) echo "<div class='alert alert-success'>$message</div>"; ?>

    <!-- Form -->
    <form method="POST" class="row g-3 mb-4">
        <div class="col-md-5">
            <input type="text" name="name" class="form-control" placeholder="Student Name" required>
        </div>
        <div class="col-md-5">
            <input type="email" name="email" class="form-control" placeholder="Student Email" required>
        </div>
        <div class="col-md-2">
            <button type="submit" name="insert" class="btn btn-primary w-100">Add Student</button>
        </div>
    </form>

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <form method="POST">
                    <td><?php echo $row['id']; ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                    <td><input type="text" name="name" class="form-control form-control-sm" value="<?php echo $row['name']; ?>"></td>
                    <td><input type="email" name="email" class="form-control form-control-sm" value="<?php echo $row['email']; ?>"></td>
                    <td>
                        <button type="submit" name="update" class="btn btn-sm btn-warning">Update</button>
                        <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>

<!--
SQL SETUP:
CREATE DATABASE student_db;
USE student_db;
CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50)
);
-->
