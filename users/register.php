<?php
session_start();
require '../config/database.php';

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    if ($fullName === '' || $email === '' || $password === '' || $confirmPassword === '') {
        $message = 'Please fill in all fields.';
    } elseif (strlen($password) < 6) {
        $message = 'Password must be at least 6 characters long.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
    } elseif ($password !== $confirmPassword) {
        $message = 'Passwords do not match.';
    } else {
        $stmt = $conn->prepare('SELECT id FROM users WHERE email = ?');
        if ($stmt === false) {
            $message = 'Registration setup failed: ' . $conn->error;
        } else {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $message = 'An account with that email already exists.';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $insertStmt = $conn->prepare('INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)');
                if ($insertStmt === false) {
                    $message = 'Registration setup failed: ' . $conn->error;
                } else {
                    $insertStmt->bind_param('sss', $fullName, $email, $hashed);
                    if ($insertStmt->execute()) {
                        $_SESSION['user_id'] = $insertStmt->insert_id;
                        $_SESSION['user_name'] = $fullName;
                        $_SESSION['welcome_message'] = 'Welcome aboard! Your account is ready.';
                        $redirectTarget = $_SESSION['redirect_after_login'] ?? 'dashboard.php';
                        unset($_SESSION['redirect_after_login']);
                        header('Location: ' . ($redirectTarget === 'dashboard.php' ? 'dashboard.php' : '../' . $redirectTarget));
                        exit;
                    } else {
                        $message = 'Registration failed. Please try again.';
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Serendipity Sri Lanka</title>
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
        <h1>Create Your Account</h1>
        <p>Join Serendipity Sri Lanka to save trip ideas, book stays and plan your next journey with confidence.</p>
        <?php if ($message) { echo '<div class="message">' . htmlspecialchars($message) . '</div>'; } ?>
        <form method="post">
            <input type="text" name="full_name" placeholder="Full name" required />
            <input type="email" name="email" placeholder="Email address" required />
            <input type="password" name="password" placeholder="Password" required />
            <input type="password" name="confirm_password" placeholder="Confirm password" required />
            <button class="btn btn-primary" type="submit">Create account</button>
        </form>
        <p style="margin-top: 1rem;">Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
