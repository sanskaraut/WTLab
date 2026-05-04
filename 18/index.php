<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Service Complaint - Lab 18</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f3f5; padding: 40px; }
        .form-container { background: white; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); overflow: hidden; }
        .header-bg { background: #004085; color: white; padding: 20px; }
    </style>
</head>
<body>

<div class="container" style="max-width: 700px;">
    <div class="form-container">
        <div class="header-bg text-center">
            <h3>Civic Grievance Portal</h3>
            <p class="mb-0">PMC | PMT | Other Public Services</p>
        </div>
        
        <div class="p-4">
            <form method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Select Organization:</label>
                        <select name="org" class="form-select" required>
                            <option value="PMC">PMC (Municipal Corp)</option>
                            <option value="PMT">PMT (Public Transport)</option>
                            <option value="MSEB">MSEB (Electricity)</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Complaint Category:</label>
                        <select name="category" class="form-select">
                            <option>Potholes</option>
                            <option>Garbage</option>
                            <option>Bus Delay</option>
                            <option>Power Cut</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Your Name:</label>
                    <input type="text" name="name" class="form-control" value="Sanskriti" required>
                </div>

                <div class="mb-3">
                    <label>Complaint Details:</label>
                    <textarea name="details" class="form-control" rows="3" placeholder="Explain the issue..." required></textarea>
                </div>

                <button type="submit" name="file_complaint" class="btn btn-primary w-100 py-2">File Grievance</button>
            </form>

            <?php
            if (isset($_POST['file_complaint'])) {
                $org = $_POST['org'];
                $name = $_POST['name'];
                $cat = $_POST['category'];
                
                echo "<div class='mt-4 alert alert-info border-primary'>";
                echo "<strong>Grievance Submitted!</strong><br>";
                echo "Dear $name, your complaint regarding <b>$cat</b> for <b>$org</b> has been registered.<br>";
                echo "Tracking Number: <b>" . strtoupper(uniqid($org . "-")) . "</b>";
                echo "</div>";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
