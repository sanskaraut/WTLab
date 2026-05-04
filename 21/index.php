<?php
$conn = new mysqli("localhost", "root", "", "student_db");
if ($conn->connect_error) {
    $conn = new mysqli("localhost", "root", "");
    $conn->query("CREATE DATABASE IF NOT EXISTS student_db");
    $conn->select_db("student_db");
    $conn->query("CREATE TABLE IF NOT EXISTS students (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(50), email VARCHAR(50), course VARCHAR(50))");
}

$msg = "";

// Delete
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    $conn->query("DELETE FROM students WHERE id=$id");
    $msg = "Record #$id deleted.";
}

// Update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $conn->query("UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id");
    $msg = "Record #$id updated successfully.";
}

// Initial Data for Demo
$check = $conn->query("SELECT * FROM students");
if ($check->num_rows == 0) {
    $conn->query("INSERT INTO students (name, email, course) VALUES ('Rahul', 'rahul@vit.edu', 'CS'), ('Snehal', 'snehal@vit.edu', 'IT')");
}

$students = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Students - Lab 21</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow">
    <h2 class="text-center mb-4">Student Record Management</h2>
    <?php if($msg) echo "<div class='alert alert-warning'>$msg</div>"; ?>

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $students->fetch_assoc()): ?>
            <tr>
                <form method="POST">
                    <td><?php echo $row['id']; ?><input type="hidden" name="id" value="<?php echo $row['id']; ?>"></td>
                    <td><input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>"></td>
                    <td><input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>"></td>
                    <td><input type="text" name="course" class="form-control" value="<?php echo $row['course']; ?>"></td>
                    <td>
                        <div class="btn-group">
                            <button type="submit" name="update" class="btn btn-sm btn-success">Update</button>
                            <a href="index.php?del=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </td>
                </form>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <p class="text-muted small">* Edit the text in the boxes and click Update to save changes.</p>
</div>

</body>
</html>
