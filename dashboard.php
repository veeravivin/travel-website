<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM bookings INNER JOIN destinations ON bookings.destination_id = destinations.id WHERE bookings.user_id = ?");
$stmt->execute([$userId]);
$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Your Bookings</h1>
    <?php foreach ($bookings as $booking): ?>
        <div>
            <h3><?= htmlspecialchars($booking['title']) ?></h3>
            <p>Booking Date: <?= htmlspecialchars($booking['booking_date']) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
