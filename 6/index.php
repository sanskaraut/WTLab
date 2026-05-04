<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Bill Calculator - Lab 6</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f4f8; padding-top: 50px; }
        .bill-card { background: white; border-top: 5px solid #ffc107; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .slab-info { font-size: 0.9rem; color: #666; }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="bill-card p-4">
                <h3 class="text-center mb-4">EB Bill Calculator</h3>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Total Units Consumed:</label>
                        <input type="number" name="units" class="form-control" placeholder="Enter units" value="150" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 fw-bold">Calculate Bill</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $units = $_POST['units'];
                    $total_bill = 0;

                    if ($units <= 50) {
                        $total_bill = $units * 3.50;
                    } else if ($units <= 150) {
                        $total_bill = (50 * 3.50) + (($units - 50) * 4.00);
                    } else if ($units <= 250) {
                        $total_bill = (50 * 3.50) + (100 * 4.00) + (($units - 150) * 5.20);
                    } else {
                        $total_bill = (50 * 3.50) + (100 * 4.00) + (100 * 5.20) + (($units - 250) * 6.50);
                    }

                    echo "<div class='mt-4 p-3 bg-light rounded text-center'>";
                    echo "<h5>Units: <b>$units</b></h5>";
                    echo "<h3 class='text-primary'>Total Bill: ₹ " . number_format($total_bill, 2) . "</h3>";
                    echo "</div>";
                }
                ?>

                <div class="mt-4 slab-info">
                    <h6>Pricing Slabs:</h6>
                    <ul>
                        <li>First 50 units: ₹ 3.50/unit</li>
                        <li>Next 100 units: ₹ 4.00/unit</li>
                        <li>Next 100 units: ₹ 5.20/unit</li>
                        <li>Above 250 units: ₹ 6.50/unit</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
