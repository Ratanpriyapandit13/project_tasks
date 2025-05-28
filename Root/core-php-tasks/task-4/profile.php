<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}
?>

<h2>Profile</h2>
<p>Username: <?= $_SESSION['username'] ?></p>
<p>Role: <?= $_SESSION['role'] ?></p>
<a href="dashboard.php">Back</a>
