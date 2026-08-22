<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';
$result = $conn->query('SELECT * FROM contact_messages ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Travel Inquiries</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f4efe8; font-family: Arial, sans-serif; }
        .admin-wrap { max-width: 1100px; margin: 40px auto; padding: 0 1rem 2rem; }
        .panel { background: white; padding: 1.4rem; border-radius: 20px; box-shadow: 0 18px 38px rgba(0,0,0,0.08); margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.8rem; border-bottom: 1px solid #eee; vertical-align: top; }
    </style>
</head>
<body>
    <div class="admin-wrap">
        <div class="panel"><h1>Travel Inquiries</h1><a href="dashboard.php">← Back to dashboard</a></div>
        <div class="panel">
            <table>
                <thead><tr><th>Name</th><th>Email</th><th>Trip Type</th><th>Details</th></tr></thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['trip_type']); ?></td>
                            <td><?php echo htmlspecialchars($row['details']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
