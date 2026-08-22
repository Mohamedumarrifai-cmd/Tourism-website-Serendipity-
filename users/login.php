<?php
session_start();
require '../config/database.php';

$message = '';
$redirectTo = $_SESSION['redirect_after_login'] ?? 'dashboard.php';
$showWelcome = isset($_SESSION['welcome_message']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare('SELECT id, full_name, password FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['welcome_message'] = 'Welcome back! You are now signed in.';
        unset($_SESSION['redirect_after_login']);
        header('Location: ' . ($redirectTo === 'dashboard.php' ? 'dashboard.php' : '../' . $redirectTo));
        exit;
    }

    $message = 'Invalid email or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Serendipity Sri Lanka</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: #f5efe7; }
        .auth-card { max-width: 480px; margin: 60px auto; background: white; padding: 2rem; border-radius: 24px; box-shadow: 0 20px 50px rgba(0,0,0,0.1); }
        form { display: grid; gap: 0.85rem; }
        input { padding: 0.85rem 1rem; border-radius: 12px; border: 1px solid #d9d5cc; }
        .message { padding: 0.8rem 1rem; border-radius: 10px; background: #fef2f2; color: #b91c1c; }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1>Welcome Back</h1>
        <p>Sign in to continue planning your Sri Lanka journey, browse stays and manage your trip ideas.</p>
        <?php if ($message) { echo '<div class="message">' . htmlspecialchars($message) . '</div>'; } ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email address" required />
            <input type="password" name="password" placeholder="Password" required />
            <button class="btn btn-primary" type="submit">Sign in</button>
        </form>
        <p style="margin-top: 1rem;">Don’t have an account? <a href="register.php">Create one</a></p>
    </div>
</body>
</html>
