<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $image_url = $conn->real_escape_string($_POST['image_url'] ?? '');
    $sql = "INSERT INTO experiences (title, description, image_url) VALUES ('$title', '$description', '$image_url')";
    $conn->query($sql);
}

$result = $conn->query('SELECT * FROM experiences ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Experiences</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f4efe8; font-family: Arial, sans-serif; }
        .admin-wrap { max-width: 1100px; margin: 40px auto; padding: 0 1rem 2rem; }
        .panel { background: white; padding: 1.4rem; border-radius: 20px; box-shadow: 0 18px 38px rgba(0,0,0,0.08); margin-bottom: 1rem; }
        form { display: grid; gap: 0.8rem; }
        input, textarea { padding: 0.8rem 0.9rem; border: 1px solid #ddd; border-radius: 10px; }
        textarea { min-height: 100px; }
    </style>
</head>
<body>
    <div class="admin-wrap">
        <div class="panel"><h1>Manage Experiences</h1><a href="dashboard.php">← Back to dashboard</a></div>
        <div class="panel">
            <h3>Add New Experience</h3>
            <form method="post">
                <input type="text" name="title" placeholder="Experience title" required />
                <textarea name="description" placeholder="Description" required></textarea>
                <input type="text" name="image_url" placeholder="Image URL" required />
                <button class="btn btn-primary" type="submit">Save experience</button>
            </form>
        </div>
        <div class="panel">
            <h3>Existing Experiences</h3>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div style="padding: 0.7rem 0; border-bottom: 1px solid #eee;"><strong><?php echo htmlspecialchars($row['title']); ?></strong><br /><?php echo htmlspecialchars($row['description']); ?></div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
