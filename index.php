<?php
require 'db.php';

$stmt = $pdo->query("SELECT * FROM destinations");
$destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Travel Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <h5>TRAVEL DORO</h5>
            <a href="./login.php" >Sign in</a>
            <a href="./register.php">Sign up</a>
        </nav>
    </header>
    <h1>Welcome to Our Travel Website</h1>
    <div class="destinations">
        <?php foreach ($destinations as $destination): ?>
            <div class="destination">
                <img src="<?= htmlspecialchars($destination['image_path']) ?>" alt="Destination">
                <h3><?= htmlspecialchars($destination['title']) ?></h3>
                <p><?= htmlspecialchars($destination['description']) ?></p>
                <p><strong>Price:</strong> $<?= htmlspecialchars($destination['price']) ?></p>
                <a href="book.php?id=<?= $destination['id'] ?>">Book Now</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
