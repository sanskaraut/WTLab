<?php
$conn = new mysqli("localhost", "root", "", "attendance_db");
if ($conn->connect_error) {
    $conn = new mysqli("localhost", "root", "");
    $conn->query("CREATE DATABASE IF NOT EXISTS attendance_db");
    $conn->select_db("attendance_db");
    $conn->query("CREATE TABLE IF NOT EXISTS students (
        id INT AUTO_INCREMENT PRIMARY KEY,
        roll_no VARCHAR(20) UNIQUE,
        name VARCHAR(50)
    )");
    $conn->query("CREATE TABLE IF NOT EXISTS attendance (
        id INT AUTO_INCREMENT PRIMARY KEY,
        roll_no VARCHAR(20),
        status VARCHAR(10),
        date DATE
    )");
}

$msg = "";
// Student Registration
if (isset($_POST['register'])) {
    $roll = $_POST['roll'];
    $name = $_POST['name'];
    $sql = "INSERT INTO students (roll_no, name) VALUES ('$roll', '$name')";
    if ($conn->query($sql)) $msg = "Student registered!";
    else $msg = "Error: Roll number might already exist.";
}

// Teacher taking attendance
if (isset($_POST['mark_attendance'])) {
    $date = date('Y-m-d');
    $p_students = $_POST['status'] ?? []; // Array of roll numbers marked Present
    
    // Fetch all students to mark others as Absent
    $all = $conn->query("SELECT roll_no FROM students");
    while($row = $all->fetch_assoc()) {
        $roll = $row['roll_no'];
        $status = in_array($roll, $p_students) ? 'Present' : 'Absent';
        $conn->query("INSERT INTO attendance (roll_no, status, date) VALUES ('$roll', '$status', '$date')");
    }
    $msg = "Attendance marked for today ($date)!";
}

$students = $conn->query("SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance System - Lab 12</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-4">

<div class="container">
    <h2 class="text-center mb-4">VIT Attendance System</h2>
    <?php if($msg) echo "<div class='alert alert-info'>$msg</div>"; ?>

    <div class="row">
        <!-- Registration -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm">
                <h5>Student Registration</h5>
                <form method="POST">
                    <input type="text" name="roll" class="form-control mb-2" placeholder="Roll No (e.g. CS101)" required>
                    <input type="text" name="name" class="form-control mb-2" placeholder="Student Name" required>
                    <button type="submit" name="register" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="col-md-8">
            <div class="card p-3 shadow-sm">
                <h5>Mark Attendance (Teacher View)</h5>
                <form method="POST">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Roll No</th>
                                <th>Name</th>
                                <th>Present?</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $students->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['roll_no']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td>
                                    <input type="checkbox" name="status[]" value="<?php echo $row['roll_no']; ?>" checked>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <button type="submit" name="mark_attendance" class="btn btn-success w-100">Submit Attendance for Today</button>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
