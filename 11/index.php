<?php
// Set session expiration to 5 minutes (300 seconds)
ini_set('session.gc_maxlifetime', 300);
session_set_cookie_params(300);
session_start();

$session_file = 'sessions.json';
$max_sessions = 3;
$user_id = "user123"; // Simulating a fixed user for demo

// Helper function to load active sessions
function get_active_sessions($file) {
    if (!file_exists($file)) return [];
    $data = json_decode(file_get_contents($file), true);
    // Cleanup expired sessions (older than 5 mins)
    $now = time();
    return array_filter($data, function($timestamp) use ($now) {
        return ($now - $timestamp) < 300;
    });
}

// Helper function to save active sessions
function save_active_sessions($file, $sessions) {
    file_put_contents($file, json_encode($sessions));
}

$active_sessions = get_active_sessions($session_file);
$current_sid = session_id();

// Logic to check and add current session
if (!isset($active_sessions[$current_sid])) {
    if (count($active_sessions) >= $max_sessions) {
        die("<h3>Access Denied: Maximum concurrent sessions (3) reached.</h3><p>Please close another session or wait 5 minutes.</p>");
    }
    $active_sessions[$current_sid] = time();
    save_active_sessions($session_file, $active_sessions);
} else {
    // Update last activity
    $active_sessions[$current_sid] = time();
    save_active_sessions($session_file, $active_sessions);
}

// Handle Logout
if (isset($_GET['logout'])) {
    unset($active_sessions[$current_sid]);
    save_active_sessions($session_file, $active_sessions);
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session Limit - Lab 11</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow text-center" style="max-width: 600px;">
    <h2 class="text-primary mb-4">Concurrent Session Limiter</h2>
    
    <div class="alert alert-success">
        <h5>Session Active!</h5>
        <p>Your current Session ID: <code><?php echo $current_sid; ?></code></p>
    </div>

    <div class="mt-4">
        <h6>Active Sessions Tracking (Simulated):</h6>
        <ul class="list-group">
            <?php foreach($active_sessions as $sid => $time): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ID: <?php echo substr($sid, 0, 8); ?>...
                    <span class="badge bg-info rounded-pill">Active</span>
                </li>
            <?php endforeach; ?>
        </ul>
        <p class="mt-2 text-muted">Max allowed: 3 | Expiry: 5 minutes</p>
    </div>

    <hr>
    <p>To test this, open this URL in <b>Incognito Mode</b> or <b>Different Browsers</b>.</p>
    
    <a href="index.php" class="btn btn-primary">Refresh State</a>
    <a href="index.php?logout=true" class="btn btn-danger">Logout/Close Session</a>
</div>

</body>
</html>
