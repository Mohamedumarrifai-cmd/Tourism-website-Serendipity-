<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';

$edit_id = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : 0;
$edit_hotel = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = trim($_POST['name'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $price = trim($_POST['price'] ?? '');
    $image_url = trim($_POST['image_url'] ?? '');
    $location = trim($_POST['location'] ?? '');
    $location_url = trim($_POST['location_url'] ?? '');
    
    $galleries = [];
    for ($i = 1; $i <= 6; $i++) {
        $g_url = trim($_POST["gallery_$i"] ?? '');
        if ($g_url !== '') $galleries[] = $g_url;
    }
    $gallery_urls = json_encode($galleries);
    
    if ($id > 0) {
        $stmt = $conn->prepare('UPDATE hotels SET name=?, description=?, price=?, image_url=?, gallery_urls=?, location=?, location_url=? WHERE id=?');
        $stmt->bind_param('sssssssi', $name, $description, $price, $image_url, $gallery_urls, $location, $location_url, $id);
    } else {
        $stmt = $conn->prepare('INSERT INTO hotels (name, description, price, image_url, gallery_urls, location, location_url) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $stmt->bind_param('sssssss', $name, $description, $price, $image_url, $gallery_urls, $location, $location_url);
    }
    $stmt->execute();
    header('Location: manage_hotels.php');
    exit;
}

if ($edit_id > 0) {
    $stmt = $conn->prepare('SELECT * FROM hotels WHERE id=?');
    $stmt->bind_param('i', $edit_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res && $res->num_rows > 0) {
        $edit_hotel = $res->fetch_assoc();
    }
}

$stmt = $conn->prepare('SELECT * FROM hotels ORDER BY id DESC');
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Hotels</title>
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
        <div class="panel"><h1>Manage Hotels</h1><a href="dashboard.php">← Back to dashboard</a></div>
        <div class="panel">
            <h3><?php echo $edit_hotel ? 'Edit Hotel' : 'Add New Hotel'; ?></h3>
            <form method="post" action="manage_hotels.php">
                <?php if ($edit_hotel) { ?>
                    <input type="hidden" name="id" value="<?php echo $edit_hotel['id']; ?>" />
                <?php } ?>
                <input type="text" name="name" placeholder="Hotel name" required value="<?php echo $edit_hotel ? htmlspecialchars($edit_hotel['name']) : ''; ?>" />
                <input type="text" name="location" placeholder="Location text (e.g. Weligama)" required value="<?php echo $edit_hotel ? htmlspecialchars($edit_hotel['location'] ?? '') : ''; ?>" />
                <input type="text" name="location_url" placeholder="Embed Map URL (Must be the 'Embed' link, not regular link)" value="<?php echo $edit_hotel ? htmlspecialchars($edit_hotel['location_url'] ?? '') : ''; ?>" />
                <textarea name="description" placeholder="Description" required><?php echo $edit_hotel ? htmlspecialchars($edit_hotel['description']) : ''; ?></textarea>
                <input type="text" name="price" placeholder="Price" required value="<?php echo $edit_hotel ? htmlspecialchars($edit_hotel['price']) : ''; ?>" />
                <input type="text" name="image_url" placeholder="Main Image URL" required value="<?php echo $edit_hotel ? htmlspecialchars($edit_hotel['image_url']) : ''; ?>" />
                
                <div style="border-top:1px solid #eee; padding-top:1rem; margin-top:0.5rem;">
                    <strong>Gallery Images (Up to 6)</strong>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem; margin-top:0.5rem;">
                        <?php
                        $existing_galleries = [];
                        if ($edit_hotel && !empty($edit_hotel['gallery_urls'])) {
                            $decoded = json_decode($edit_hotel['gallery_urls'], true);
                            if (is_array($decoded)) {
                                $existing_galleries = $decoded;
                            } else {
                                $existing_galleries = array_map('trim', explode(',', $edit_hotel['gallery_urls']));
                            }
                        }
                        for ($i = 1; $i <= 6; $i++) {
                            $val = isset($existing_galleries[$i-1]) ? htmlspecialchars($existing_galleries[$i-1]) : '';
                            echo '<input type="text" name="gallery_'.$i.'" placeholder="Picture '.$i.' URL" value="'.$val.'" />';
                        }
                        ?>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit"><?php echo $edit_hotel ? 'Update hotel' : 'Save hotel'; ?></button>
                <?php if ($edit_hotel) { ?>
                    <a href="manage_hotels.php" class="btn btn-secondary" style="text-align:center; padding: 0.8rem;">Cancel</a>
                <?php } ?>
            </form>
        </div>
        <div class="panel">
            <h3>Existing Hotels</h3>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div style="padding: 0.7rem 0; border-bottom: 1px solid #eee; display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <strong><?php echo htmlspecialchars($row['name']); ?></strong><br /><?php echo htmlspecialchars($row['description']); ?> <br /><span style="color:#e0822a; font-weight:700;"><?php echo htmlspecialchars($row['price']); ?></span>
                    </div>
                    <a href="manage_hotels.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-small btn-secondary">Edit</a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>
</html>
