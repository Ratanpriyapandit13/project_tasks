<?php
session_start();
include 'users.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    foreach ($users as $user) {
        if ($user['username'] === $_POST['username'] && $user['password'] === $_POST['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header('Location: dashboard.php');
            exit;
        }
    }
    $error = "Invalid credentials.";
}
?>

<h2>Login</h2>
<form method="POST">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <button type="submit">Login</button>
</form>
<p style="color:red;"><?= $error ?></p>
