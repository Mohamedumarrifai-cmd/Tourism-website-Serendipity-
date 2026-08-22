<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';

$stmt = $conn->prepare('SELECT COUNT(*) AS total_destinations FROM destinations');
$stmt->execute();
$totalDestinations = $stmt->get_result()->fetch_assoc()['total_destinations'];

$stmt = $conn->prepare('SELECT COUNT(*) AS total_messages FROM contact_messages');
$stmt->execute();
$totalMessages = $stmt->get_result()->fetch_assoc()['total_messages'];

$stmt = $conn->prepare('SELECT COUNT(*) AS total_bookings FROM bookings');
$stmt->execute();
$totalBookings = $stmt->get_result()->fetch_assoc()['total_bookings'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f4efe8; font-family: Arial, sans-serif; }
        .admin-wrap { max-width: 1100px; margin: 40px auto; padding: 0 1rem 2rem; }
        .panel { background: white; padding: 1.4rem; border-radius: 20px; box-shadow: 0 18px 38px rgba(0,0,0,0.08); margin-bottom: 1rem; }
        .stats { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; }
        .stat-card { background: linear-gradient(135deg, #113826, #1f6a46); color: white; padding: 1.2rem; border-radius: 18px; }
        .nav-links { display: flex; gap: 0.7rem; flex-wrap: wrap; margin: 1rem 0; }
        .nav-links a { background: #eee; padding: 0.7rem 1rem; border-radius: 999px; }
    </style>
</head>
<body>
    <div class="admin-wrap">
        <div class="panel">
            <h1>Admin Dashboard</h1>
            <p>Manage the Sri Lanka travel website content from one place.</p>
            <div class="nav-links">
                <a href="manage_destinations.php">Manage Destinations</a>
                <a href="manage_experiences.php">Manage Experiences</a>
                <a href="manage_hotels.php">Manage Hotels</a>
                <a href="manage_bookings.php">Manage Bookings</a>
                <a href="inquiries.php">View Inquiries</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Destinations</h3>
                <p style="font-size: 1.8rem; margin: 0;"><?php echo $totalDestinations; ?></p>
            </div>
            <div class="stat-card">
                <h3>Bookings</h3>
                <p style="font-size: 1.8rem; margin: 0;"><?php echo $totalBookings; ?></p>
            </div>
            <div class="stat-card">
                <h3>Messages</h3>
                <p style="font-size: 1.8rem; margin: 0;"><?php echo $totalMessages; ?></p>
            </div>
        </div>

        <div class="panel">
            <h3>Featured travel video</h3>
            <p>Showcase a polished Sri Lanka experience right on the admin dashboard.</p>
            <video controls style="width:100%; border-radius:20px; margin-top:0.8rem;" poster="https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=1400&q=80">
                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</body>
</html>
