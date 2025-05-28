<?php
session_start();
if (!isset($_SESSION['username'])) header('Location: index.php');
?>

<h2>Welcome <?= $_SESSION['username'] ?> (<?= $_SESSION['role'] ?>)</h2>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="create_user.php">Create User</a><br>
    <a href="delete_user.php">Delete User</a><br>
<?php endif; ?>

<a href="profile.php">View Profile</a><br>
<a href="logout.php">Logout</a>
