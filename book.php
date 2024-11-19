<?php
session_start();
require 'db.php';

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination_id'])) {
    // Fetch user and destination details
    $destinationId = $_POST['destination_id'];
    $userId = $_SESSION['user_id'];

    // Insert the booking into the database
    $stmt = $pdo->prepare("INSERT INTO bookings (user_id, destination_id) VALUES (?, ?)");
    if ($stmt->execute([$userId, $destinationId])) {
        $message = "Booking successful!";
    } else {
        $message = "Error: Could not complete the booking.";
    }
} else {
    $message = "";
}

// Fetch available destinations
$stmt = $pdo->query("SELECT id, title FROM destinations");
$destinations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link rel="stylesheet" href="Style1.css">
</head>
<body>
    <div class="booking-container">
        <h1>Book Your Destination</h1>
        <?php if ($message): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form method="POST" action="booking.php">
            <label for="destination_id">Select Destination:</label>
            <select name="destination_id" id="destination_id" required>
                <option value="">-- Select --</option>
                <?php foreach ($destinations as $destination): ?>
                    <option value="<?php echo htmlspecialchars($destination['id']); ?>">
                        <?php echo htmlspecialchars($destination['title']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit" class="btn">Book Now</button>
        </form>
        <a href="dashboard.php" class="back-link">Go to Dashboard</a>
    </div>
</body>
</html>
