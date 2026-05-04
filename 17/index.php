<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waste Collection - Lab 17</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #fdfcf0; padding-top: 50px; }
        .waste-card { background: white; border-left: 5px solid #198754; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="waste-card p-4">
                <h3 class="text-success text-center mb-4">♻️ Waste Collection Request</h3>
                
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Type of Waste:</label>
                        <select name="waste_type" class="form-select" required>
                            <option value="Plastic">Plastic</option>
                            <option value="Paper">Paper</option>
                            <option value="Electronic">E-Waste</option>
                            <option value="Organic">Organic</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pickup Location:</label>
                        <input type="text" name="location" class="form-control" placeholder="Enter Room No / Street / Landmark" value="Lab 102, Main Building" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number:</label>
                        <input type="tel" name="phone" class="form-control" placeholder="9876543210" value="9876543210" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit Request</button>
                </form>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $type = $_POST['waste_type'];
                    $loc = $_POST['location'];
                    $phone = $_POST['phone'];

                    // Logic to "direct authority"
                    $authority = "General Municipal Service";
                    if ($type == 'Electronic') $authority = "E-Waste Disposal Unit";
                    if ($type == 'Plastic') $authority = "Plastic Recycling Cell";

                    echo "<div class='mt-4 alert alert-success'>";
                    echo "<h5>Request Registered!</h5>";
                    echo "The <b>$authority</b> has been notified to collect <b>$type</b> waste from <b>$loc</b>.";
                    echo "<br><small>Ticket ID: " . rand(1000, 9999) . "</small>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
