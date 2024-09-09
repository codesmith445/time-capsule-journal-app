<?php
require 'db.php';

$stmt = $pdo->prepare("SELECT id, title, content, unlock_date FROM entries WHERE public_visibility = TRUE AND (unlock_date <= CURDATE() OR is_locked = FALSE)");
$stmt->execute();
$entries = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time Capsule Journal - Home</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        body {
            background: #f8f9fa;
        }
        .hero {
            background: linear-gradient(to right, #3931af, #00c6ff);
            color: #fff;
            padding: 60px 0;
            text-align: center;
            margin-bottom: 30px;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }
        .hero p {
            font-size: 1.25rem;
            font-weight: 300;
        }
        .entry-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: .25rem;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .entry-card h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        .entry-card p {
            font-size: 1rem;
            margin-bottom: 20px;
        }
        .entry-card a {
            font-size: 1rem;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }
        .footer p {
            margin: 0;
        }
        .btn-primary {
            background-color: #0062cc;
            border: none;
            border-radius: 1.5rem;
            padding: 10px 20px;
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #004d99;
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="container">
            <h1>Time Capsule Journal</h1>
            <p>Discover past moments, preserve memories, and see how time changes everything.</p>
            <a href="login.php" class="btn btn-primary">Login</a>
            <a href="register.php" class="btn btn-primary">Register</a>
        </div>
    </div>
    
    <div class="container mt-5">
        <img src="assets/capsule.png" alt="" srcset="">
        <div class="row">
            <?php foreach ($entries as $entry): ?>
                <div class="col-md-4">
                    <div class="entry-card">
                        <p>Entry <?php echo htmlspecialchars($entry['id']); ?></p>
                        <h4>
                            <?php 
                            if (isset($entry['title'])) {
                                echo htmlspecialchars(substr($entry['title'], 0, 500)); // Limit title to 50 characters
                            } else {
                                echo "No title available";
                            }
                            ?>
                        <h4>
                        <p><?php echo htmlspecialchars(substr($entry['content'], 0, 1500)); ?></p>
                        
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Time Capsule Journal. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
