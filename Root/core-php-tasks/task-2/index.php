<?php
require '../db.php';

$errors = [];
$success = '';

$sql = "CREATE TABLE IF NOT EXISTS profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    image_path VARCHAR(255) NOT NULL
);";
try {
    $pdo->exec($sql);
    //echo "Table created successfully.";
} catch (PDOException $e) {
    echo "Error creating table: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!isset($_FILES['profile_pic']) || $_FILES['profile_pic']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "Image upload failed.";
    } else {
        $allowedTypes = ['image/jpeg', 'image/png'];
        $fileType = mime_content_type($_FILES['profile_pic']['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Only JPG and PNG files are allowed.";
        }

        if ($_FILES['profile_pic']['size'] > 2 * 1024 * 1024) {
            $errors[] = "File size must be less than 2MB.";
        }
    }

    if (empty($errors)) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = uniqid() . '_' . basename($_FILES['profile_pic']['name']);
        $filePath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $filePath)) {
            $stmt = $pdo->prepare("INSERT INTO profiles (name, image_path) VALUES (?, ?)");
            if ($stmt->execute([$name, $filePath])) {
                $success = "Profile uploaded successfully!";
            } else {
                $errors[] = "Database insertion failed.";
            }
        } else {
            $errors[] = "Failed to save uploaded file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Task 2: File Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
</head>

<body>
    <h2>Upload Profile Picture</h2>

    <?php if ($success): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <?php foreach ($errors as $error): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endforeach; ?>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Upload Profile Picture</h4>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="profile_pic" class="form-label">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic" class="form-control" accept=".jpg,.jpeg,.png" required>
                    </div>

                    <button type="submit" class="btn btn-success">Upload</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>