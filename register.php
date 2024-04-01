<?php
require 'connection.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $role = isset($_POST['role']) && $_POST['role'] === 'admin' ? 'admin' : 'user';

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        $message = "Username already exists!";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if ($stmt->execute([$username, $password, $role])) {
            header('Location: login.php');
            exit;
        } else {
            $message = "Failed to register!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<h2>Register</h2>
<?php if (!empty($message)): ?>
    <p><?= $message ?></p>
<?php endif; ?>
<form action="register.php" method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Role: <input type="radio" name="role" value="user" checked>User
          <input type="radio" name="role" value="admin">Admin<br>
    <input type="submit" value="Register">
</form>
<a href="login.php">Login</a>
</body>
</html>
