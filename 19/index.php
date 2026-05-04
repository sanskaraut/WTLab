<?php
session_start();

// Initialize seats if not already set (6 rows x 4 columns)
if (!isset($_SESSION['seats'])) {
    $_SESSION['seats'] = array_fill(0, 24, "available");
}

$msg = "";

// Handle Booking
if (isset($_GET['book'])) {
    $index = $_GET['book'];
    if ($_SESSION['seats'][$index] == "available") {
        $_SESSION['seats'][$index] = "booked";
        $msg = "Seat " . ($index + 1) . " booked successfully!";
    }
}

// Reset for demo
if (isset($_GET['reset'])) {
    unset($_SESSION['seats']);
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Flight Booking - Lab 19</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .seat { width: 50px; height: 50px; margin: 5px; border-radius: 5px; display: inline-block; cursor: pointer; line-height: 50px; text-align: center; font-weight: bold; }
        .available { background-color: #d1e7dd; border: 1px solid #0f5132; color: #0f5132; }
        .booked { background-color: #f8d7da; border: 1px solid #842029; color: #842029; cursor: not-allowed; }
        .aisle { width: 30px; display: inline-block; }
    </style>
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow text-center" style="max-width: 500px;">
    <h3>✈️ Air-VIT Seat Booking</h3>
    <p class="text-muted">Click on a green seat to book it.</p>
    
    <?php if($msg) echo "<div class='alert alert-success'>$msg</div>"; ?>

    <div class="mt-4">
        <?php 
        for ($i = 0; $i < 24; $i++) {
            $status = $_SESSION['seats'][$i];
            $link = ($status == "available") ? "href='index.php?book=$i'" : "";
            
            echo "<a $link class='seat $status'>" . ($i + 1) . "</a>";
            
            // Add aisle after 2nd column
            if (($i + 1) % 2 == 0 && ($i + 1) % 4 != 0) {
                echo "<div class='aisle'></div>";
            }
            
            // New row after 4 seats
            if (($i + 1) % 4 == 0) {
                echo "<br>";
            }
        }
        ?>
    </div>

    <div class="mt-4">
        <span class="badge bg-success">Available</span>
        <span class="badge bg-danger">Booked</span>
    </div>

    <a href="index.php?reset=1" class="btn btn-outline-secondary mt-4">Reset Plane</a>
</div>

</body>
</html>
