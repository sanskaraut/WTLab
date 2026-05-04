<?php
session_start();

// Initialize or Reset
if (!isset($_SESSION['board']) || isset($_GET['reset'])) {
    $_SESSION['board'] = array_fill(0, 9, "");
    $_SESSION['turn'] = "X";
    $_SESSION['winner'] = null;
    if(isset($_GET['reset'])) { header("Location: index.php"); exit(); }
}

// Handle Move
if (isset($_GET['move']) && $_SESSION['winner'] === null) {
    $pos = $_GET['move'];
    if ($_SESSION['board'][$pos] === "") {
        $_SESSION['board'][$pos] = $_SESSION['turn'];
        
        // Check for Winner
        if (checkWin($_SESSION['board'])) {
            $_SESSION['winner'] = $_SESSION['turn'];
        } else if (!in_array("", $_SESSION['board'])) {
            $_SESSION['winner'] = "Draw";
        } else {
            $_SESSION['turn'] = ($_SESSION['turn'] == "X") ? "O" : "X";
        }
    }
}

function checkWin($b) {
    $wins = [[0,1,2],[3,4,5],[6,7,8],[0,3,6],[1,4,7],[2,5,8],[0,4,8],[2,4,6]];
    foreach($wins as $w) {
        if ($b[$w[0]] != "" && $b[$w[0]] == $b[$w[1]] && $b[$w[1]] == $b[$w[2]]) return true;
    }
    return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tic-Tac-Toe - Lab 20</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .cell { width: 80px; height: 80px; border: 2px solid #333; font-size: 2rem; display: flex; align-items: center; justify-content: center; text-decoration: none; color: #333; font-weight: bold; }
        .cell:hover { background-color: #f8f9fa; }
        .grid { display: grid; grid-template-columns: repeat(3, 80px); gap: 5px; justify-content: center; margin-top: 20px; }
        .X { color: #dc3545; }
        .O { color: #0d6efd; }
    </style>
</head>
<body class="bg-light p-5">

<div class="container bg-white p-4 rounded shadow text-center" style="max-width: 400px;">
    <h3>Tic-Tac-Toe</h3>
    
    <?php if ($_SESSION['winner']): ?>
        <div class="alert alert-success mt-3">
            <?php echo ($_SESSION['winner'] == "Draw") ? "It's a Draw!" : "Player " . $_SESSION['winner'] . " Wins!"; ?>
        </div>
    <?php else: ?>
        <div class="mt-3">Turn: <span class="badge bg-secondary"><?php echo $_SESSION['turn']; ?></span></div>
    <?php endif; ?>

    <div class="grid">
        <?php for($i=0; $i<9; $i++): ?>
            <a href="index.php?move=<?php echo $i; ?>" class="cell <?php echo $_SESSION['board'][$i]; ?>">
                <?php echo $_SESSION['board'][$i]; ?>
            </a>
        <?php endfor; ?>
    </div>

    <a href="index.php?reset=1" class="btn btn-primary mt-4">New Game</a>
</div>

</body>
</html>
