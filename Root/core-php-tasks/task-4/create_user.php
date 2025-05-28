<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}
?>

<h2>Create User</h2>
<form method="POST">
    <input type="text" name="new_user" placeholder="Username" required>
    <input type="password" name="new_pass" placeholder="Password" required>
    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Create</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<p>User '{$_POST['new_user']}' created. (not saved in DB in this demo)</p>";
}
?>
<a href="dashboard.php">Back</a>
