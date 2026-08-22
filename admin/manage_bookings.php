<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';
require '../includes/booking_helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookingId = (int)($_POST['booking_id'] ?? 0);
    $status = trim((string)($_POST['status'] ?? 'pending'));
    $notes = trim((string)($_POST['notes'] ?? ''));
    if ($bookingId > 0) {
        $stmt = $conn->prepare('UPDATE bookings SET status = ?, notes = ? WHERE id = ?');
        $stmt->bind_param('ssi', $status, $notes, $bookingId);
        $stmt->execute();
    }
}

$result = $conn->query('SELECT * FROM bookings ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f5efe7; font-family: Arial, sans-serif; }
        .admin-wrap { max-width: 1200px; margin: 40px auto; padding: 0 1rem 2rem; }
        .panel { background: white; padding: 1.4rem; border-radius: 20px; box-shadow: 0 18px 38px rgba(0,0,0,0.08); margin-bottom: 1rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 0.8rem; border-bottom: 1px solid #eee; vertical-align: top; }
        select, textarea { width: 100%; padding: 0.6rem; border-radius: 8px; border: 1px solid #ddd; }
    </style>
</head>
<body>
    <div class="admin-wrap">
        <div class="panel"><h1>Manage Bookings</h1><a href="dashboard.php">← Back to dashboard</a></div>
        <div class="panel">
            <table>
                <thead><tr><th>Guest</th><th>Email</th><th>Hotel ID</th><th>Dates</th><th>Travelers</th><th>Status</th><th>Notes</th></tr></thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['guest_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['guest_email']); ?></td>
                            <td><?php echo htmlspecialchars($row['hotel_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['check_in'] . ' → ' . $row['check_out']); ?></td>
                            <td><?php echo (int)$row['travelers']; ?></td>
                            <td>
                                <form method="post" style="display:grid; gap:0.5rem; min-width:180px;">
                                    <input type="hidden" name="booking_id" value="<?php echo (int)$row['id']; ?>" />
                                    <select name="status">
                                        <?php foreach (getBookingStatusOptions() as $value => $label) { $selected = $row['status'] === $value ? 'selected' : ''; echo '<option value="' . htmlspecialchars($value) . '" ' . $selected . '>' . htmlspecialchars($label) . '</option>'; } ?>
                                    </select>
                                    <textarea name="notes" rows="2" placeholder="Add notes"><?php echo htmlspecialchars($row['notes'] ?? ''); ?></textarea>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                </form>
                            </td>
                            <td><?php echo nl2br(htmlspecialchars($row['notes'] ?? '')); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
