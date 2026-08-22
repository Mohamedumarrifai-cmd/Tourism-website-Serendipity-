<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: dashboard.php');
        exit;
    }

    $error = 'Invalid username or password';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f4efe8; font-family: Arial, sans-serif; }
        .login-box { max-width: 420px; margin: 80px auto; background: white; padding: 2rem; border-radius: 20px; box-shadow: 0 20px 45px rgba(0,0,0,0.12); }
        h1 { margin-top: 0; color: #113826; }
        form { display: grid; gap: 0.85rem; }
        input { padding: 0.8rem 1rem; border-radius: 10px; border: 1px solid #ddd; }
        .btn { width: 100%; border: none; cursor: pointer; }
        .error { color: #c0392b; font-size: 0.95rem; }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Admin Login</h1>
        <p>Manage destinations, experiences, hotels, and inquiries.</p>
        <?php if (!empty($error)) echo '<div class="error">' . htmlspecialchars($error) . '</div>'; ?>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required />
            <input type="password" name="password" placeholder="Password" required />
            <button class="btn btn-primary" type="submit">Login</button>
        </form>
    </div>
</body>
</html>
