<?php
session_start();
require 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$isAdmin = false;
$userId = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$userId]);
$role = $stmt->fetchColumn();
if ($role === 'admin') {
    $isAdmin = true;
}

if (isset($_GET['id'])) {
    $appointmentId = $_GET['id'];
    
    $query = $isAdmin ? "SELECT * FROM appointments WHERE id = ?" : "SELECT * FROM appointments WHERE id = ? AND user_id = ?";
    $stmt = $pdo->prepare($query);
    $params = $isAdmin ? [$appointmentId] : [$appointmentId, $userId];
    $stmt->execute($params);
    $appointment = $stmt->fetch();
    
    if ($appointment) {
        $stmt = $pdo->prepare("DELETE FROM appointments WHERE id = ?");
        if ($stmt->execute([$appointmentId])) {
            $_SESSION['message'] = "Appointment deleted successfully.";
        } else {
            $_SESSION['message'] = "There was a problem deleting the appointment.";
        }
    } else {
        $_SESSION['message'] = "Appointment not found or doesn't belong to you.";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

header("Location: index.php");
exit;
