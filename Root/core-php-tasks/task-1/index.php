<?php
require '../db.php';


$sql = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    age INT NOT NULL);";
try {
    $pdo->exec($sql);
    //echo "Table created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

$name = $email = $age = '';
$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $age   = trim($_POST['age']);

    // Validation for each input
    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (empty($email)) {
        $errors[] = "Email is required.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";
    }

    if (empty($age)) {
        $errors[] = "Age is required.";
    } else if (!is_numeric($age) || $age <= 0) {
        $errors[] = "Age must be a positive number.";
    }
    // Save to DB
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $age])) {
            $success = "User added successfully!";
            $name = $email = $age = '';
        } else {
            $errors[] = "Database error.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Task 1: Form Handling</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <h2>Create User</h2>

    <?php if ($success): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endforeach; ?>

    <form method="POST" action="" class="p-4 border rounded shadow-sm bg-light" style="max-width: 500px;">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Age:</label>
            <input type="number" name="age" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>

</html>