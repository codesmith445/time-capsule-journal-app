<?php
require 'db.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view entries.");
}

$user_id = $_SESSION['user_id'];
echo "User ID: " . htmlspecialchars($user_id) . "<br>"; // Debugging output

// Test simpler query
$stmt = $pdo->prepare("SELECT * FROM entries WHERE user_id = ?");
$stmt->execute([$user_id]);
$entries = $stmt->fetchAll();


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Entries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .entry {
            background: #ffffff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 15px;
        }
        .entry p {
            margin: 0;
        }
        .entry small {
            color: #6c757d;
        }
        h2 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
    <form action="logout.php" method="POST">
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        <h2 class="text-center">My Journal Entries</h2>
        <div class="text-center mb-4">
            <a href="add.php" class="btn btn-primary">Add New Entry</a>
        </div>
        <?php foreach ($entries as $entry): ?>
            <div class="entry">
                <h3><?php echo htmlspecialchars($entry['title']); ?></h3>
                <p><?php echo htmlspecialchars($entry['content']); ?></p>
                <p><small>Unlock Date: <?php echo htmlspecialchars($entry['unlock_date']); ?></small></p>
            </div>
        <?php endforeach; ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>