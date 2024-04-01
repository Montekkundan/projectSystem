<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$isAdmin = false;
$stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$role = $stmt->fetchColumn();
if ($role === 'admin') {
    $isAdmin = true;
    $usersStmt = $pdo->query("SELECT id, username FROM users");
    $users = $usersStmt->fetchAll();
}

$appointments = [];
if (isset($_GET['user_id']) && $isAdmin) {
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE user_id = ?");
    $stmt->execute([$_GET['user_id']]);
    $appointments = $stmt->fetchAll();
} elseif (!$isAdmin) {
    $stmt = $pdo->prepare("SELECT * FROM appointments WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $appointments = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointment Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="content">
    <h2>Your Appointments</h2>
    <?php if ($isAdmin): ?>
        <h3>All Users</h3>
        <table class="user-table">
            <tr>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><a href="?user_id=<?= $user['id'] ?>">View Appointments</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="add_appointment.php" class="add-appointment">Add an appointment</a>

    <?php if (count($appointments) > 0): ?>
        <ul>
            <?php foreach ($appointments as $appointment): ?>
                <li><?= htmlspecialchars($appointment['description']) ?> - <?= $appointment['date'] ?>
                    <?php if ($isAdmin || $appointment['user_id'] == $_SESSION['user_id']): ?>
                        <a href="delete_appointment.php?id=<?= $appointment['id'] ?>" class="delete-link">Delete</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No appointments found.</p>
    <?php endif; ?>
    <a href="logout.php" class="logout-link">Logout</a>
</div>
</body>
</html>
