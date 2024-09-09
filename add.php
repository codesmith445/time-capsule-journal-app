<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        die("You must be logged in to add entries.");
    }
    
    $title = $_POST['title'];
    $content = $_POST['content'];
    $unlock_date = $_POST['unlock_date'];
    $public_visibility = isset($_POST['public_visibility']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO entries (user_id, title, content, unlock_date, public_visibility) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$user_id, $title, $content, $unlock_date, $public_visibility]);

    echo "Entry saved successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Entry</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom CSS here */
        body {
            background: #f8f9fa; /* Background color to match the login form */
        }
        .container {
            background: #ffffff; /* White background for the form container */
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px; /* Adjust width as needed */
            margin-top: 5%; /* Center vertically */
            margin-bottom: 5%; /* Center vertically */
        }
        h2 {
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
        .btn-primary {
            background-color: #0062cc;
            border-color: #0062cc;
            border-radius: 0.5rem;
        }
        .btn-primary:hover {
            background-color: #004ba0;
            border-color: #004ba0;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
            <a href="view.php" class="btn btn-primary mb-2">Back</a>
        <h2>Add Journal Entry</h2>
        <form method="POST">
            <div class="form-group">
                <label for="content">Journal Title</label>
                <input type="text" name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label for="content">Journal Entry</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="unlock_date">Unlock Date</label>
                <input type="date" class="form-control" id="unlock_date" name="unlock_date" required>
            </div>
            <div class="form-group">
                <label for="public_visibility">Make Public</label>
                <input type="checkbox" id="public_visibility" name="public_visibility">
            </div>
            <button type="submit" class="btn btn-primary">Save Entry</button>
        </form>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
