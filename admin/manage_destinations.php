<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: login.php');
    exit;
}
require '../config/database.php';

$edit_id = isset($_GET['edit_id']) ? (int)$_GET['edit_id'] : 0;
$edit_dest = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $category = $conn->real_escape_string($_POST['category'] ?? '');
    $location = $conn->real_escape_string($_POST['location'] ?? '');
    $description = $conn->real_escape_string($_POST['description'] ?? '');
    $activities = $conn->real_escape_string($_POST['activities'] ?? '');
    $image_url = $conn->real_escape_string($_POST['image_url'] ?? '');
    $duration = $conn->real_escape_string($_POST['duration'] ?? '');
    
    $galleries = [];
    for ($i = 1; $i <= 6; $i++) {
        $g_url = trim($_POST["gallery_$i"] ?? '');
        if ($g_url !== '') $galleries[] = $g_url;
    }
    $gallery_urls = $conn->real_escape_string(json_encode($galleries));

    if ($id > 0) {
        $sql = "UPDATE destinations SET name='$name', category='$category', location='$location', description='$description', activities='$activities', image_url='$image_url', duration='$duration', gallery_urls='$gallery_urls' WHERE id=$id";
    } else {
        $sql = "INSERT INTO destinations (name, category, location, description, activities, image_url, duration, gallery_urls) VALUES ('$name', '$category', '$location', '$description', '$activities', '$image_url', '$duration', '$gallery_urls')";
    }
    $conn->query($sql);
    header('Location: manage_destinations.php');
    exit;
}

if ($edit_id > 0) {
    $res = $conn->query("SELECT * FROM destinations WHERE id=$edit_id");
    if ($res && $res->num_rows > 0) {
        $edit_dest = $res->fetch_assoc();
    }
}

$result = $conn->query('SELECT * FROM destinations ORDER BY id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Destinations</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f4efe8; font-family: Arial, sans-serif; }
        .admin-wrap { max-width: 1200px; margin: 40px auto; padding: 0 1rem 2rem; }
        .panel { background: white; padding: 1.4rem; border-radius: 20px; box-shadow: 0 18px 38px rgba(0,0,0,0.08); margin-bottom: 1rem; }
        form { display: grid; gap: 0.8rem; }
        input, textarea, select { padding: 0.8rem 0.9rem; border: 1px solid #ddd; border-radius: 10px; }
        textarea { min-height: 100px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 0.8rem; border-bottom: 1px solid #eee; vertical-align: top; }
    </style>
</head>
<body>
    <div class="admin-wrap">
        <div class="panel">
            <h1>Manage Destinations</h1>
            <a href="dashboard.php">← Back to dashboard</a>
        </div>
        <div class="panel">
            <h3><?php echo $edit_dest ? 'Edit Destination' : 'Add New Destination'; ?></h3>
            <form method="post" action="manage_destinations.php">
                <?php if ($edit_dest) { ?>
                    <input type="hidden" name="id" value="<?php echo $edit_dest['id']; ?>" />
                <?php } ?>
                <input type="text" name="name" placeholder="Destination name" required value="<?php echo $edit_dest ? htmlspecialchars($edit_dest['name']) : ''; ?>" />
                <select name="category">
                    <?php
                    $categories = ['beach' => 'Beach', 'mountain' => 'Mountain', 'wildlife' => 'Wildlife', 'culture' => 'Culture', 'adventure' => 'Adventure', 'history' => 'Historical Place'];
                    foreach ($categories as $val => $label) {
                        $sel = ($edit_dest && $edit_dest['category'] === $val) ? 'selected' : '';
                        echo "<option value=\"$val\" $sel>$label</option>";
                    }
                    ?>
                </select>
                <input type="text" name="location" placeholder="Location" required value="<?php echo $edit_dest ? htmlspecialchars($edit_dest['location']) : ''; ?>" />
                <textarea name="description" placeholder="Description" required><?php echo $edit_dest ? htmlspecialchars($edit_dest['description']) : ''; ?></textarea>
                <input type="text" name="activities" placeholder="Activities" required value="<?php echo $edit_dest ? htmlspecialchars($edit_dest['activities']) : ''; ?>" />
                <input type="text" name="image_url" placeholder="Main Image URL" required value="<?php echo $edit_dest ? htmlspecialchars($edit_dest['image_url']) : ''; ?>" />
                <input type="text" name="duration" placeholder="Suggested duration" required value="<?php echo $edit_dest ? htmlspecialchars($edit_dest['duration']) : ''; ?>" />
                
                <div style="border-top:1px solid #eee; padding-top:1rem; margin-top:0.5rem;">
                    <strong>Gallery Images (Up to 6)</strong>
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:0.5rem; margin-top:0.5rem;">
                        <?php
                        $existing_galleries = [];
                        if ($edit_dest && !empty($edit_dest['gallery_urls'])) {
                            $decoded = json_decode($edit_dest['gallery_urls'], true);
                            if (is_array($decoded)) {
                                $existing_galleries = $decoded;
                            } else {
                                $existing_galleries = array_map('trim', explode(',', $edit_dest['gallery_urls']));
                            }
                        }
                        for ($i = 1; $i <= 6; $i++) {
                            $val = isset($existing_galleries[$i-1]) ? htmlspecialchars($existing_galleries[$i-1]) : '';
                            echo '<input type="text" name="gallery_'.$i.'" placeholder="Picture '.$i.' URL" value="'.$val.'" />';
                        }
                        ?>
                    </div>
                </div>

                <button class="btn btn-primary" type="submit"><?php echo $edit_dest ? 'Update destination' : 'Save destination'; ?></button>
                <?php if ($edit_dest) { ?>
                    <a href="manage_destinations.php" class="btn btn-secondary" style="text-align:center; padding: 0.8rem;">Cancel</a>
                <?php } ?>
            </form>
        </div>
        <div class="panel">
            <h3>Existing Destinations</h3>
            <table>
                <thead>
                    <tr><th>Name</th><th>Category</th><th>Location</th><th>Description</th><th>Action</th></tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['category']); ?></td>
                            <td><?php echo htmlspecialchars($row['location']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><a href="manage_destinations.php?edit_id=<?php echo $row['id']; ?>" class="btn btn-small btn-secondary">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
