<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}
?>

<h2>Delete User</h2>
<!-- Dummy form (no DB) -->
<form method="POST">
    <input type="text" name="del_user" placeholder="Username to delete" required>
    <button type="submit">Delete</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p>User '{$_POST['del_user']}' deleted. (not removed from DB in this demo)</p>";
}
?>
<a href="dashboard.php">Back</a>
