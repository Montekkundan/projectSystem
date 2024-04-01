<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['date']) && !empty($_POST['description'])) {
    $date = $_POST['date'];
    $description = $_POST['description'];
    $userId = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO appointments (user_id, date, description) VALUES (?, ?, ?)");
    if ($stmt->execute([$userId, $date, $description])) {
        $message = "Appointment successfully added!";
    } else {
        $message = "There was a problem adding your appointment.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Add Appointment</h2>
<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>
<form action="add_appointment.php" method="post">
    Date and Time: <input type="datetime-local" name="date" required><br>
    Description: <textarea name="description" required></textarea><br>
    <input type="submit" value="Add Appointment">
</form>
<a href="index.php">Go Back</a>
</body>
</html>
