<?php
/**
 * Installation Verification Script
 * Check if all components are properly set up
 */

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installation Check - Serendipity Sri Lanka</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1f5d4b, #2d8a6f);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        h1 {
            color: #1f5d4b;
            margin-top: 0;
            text-align: center;
        }
        .check-item {
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            border-left: 4px solid;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .check-item.pass {
            background: #f0fdf4;
            border-left-color: #22c55e;
            color: #166534;
        }
        .check-item.fail {
            background: #fef2f2;
            border-left-color: #ef4444;
            color: #991b1b;
        }
        .check-item.warning {
            background: #fefce8;
            border-left-color: #eab308;
            color: #854d0e;
        }
        .badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .pass .badge {
            background: #dcfce7;
            color: #166534;
        }
        .fail .badge {
            background: #fee2e2;
            color: #991b1b;
        }
        .warning .badge {
            background: #fef3c7;
            color: #854d0e;
        }
        .summary {
            margin-top: 30px;
            padding: 20px;
            background: #f8fafc;
            border-radius: 8px;
            text-align: center;
        }
        .summary.success {
            background: #f0fdf4;
            color: #166534;
        }
        .summary.error {
            background: #fef2f2;
            color: #991b1b;
        }
        .actions {
            margin-top: 30px;
            display: grid;
            gap: 10px;
        }
        .btn {
            padding: 12px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            transition: all 0.3s ease;
        }
        .btn-primary {
            background: #1f5d4b;
            color: white;
        }
        .btn-primary:hover {
            background: #164037;
        }
        .btn-secondary {
            background: #e2e8f0;
            color: #1f5d4b;
        }
        .btn-secondary:hover {
            background: #cbd5e1;
        }
        .section {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }
        .section h3 {
            color: #1f5d4b;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 Installation Verification</h1>
        <p style="text-align: center; color: #64707d;">Check if your Serendipity Sri Lanka website is properly configured</p>

        <?php
        $checks = [];
        $pass_count = 0;
        $total_checks = 0;

        // PHP Version
        $total_checks++;
        if (version_compare(PHP_VERSION, '7.4.0', '>=')) {
            $checks[] = ['name' => 'PHP Version', 'status' => 'pass', 'message' => 'PHP ' . PHP_VERSION . ' (Required: 7.4+)', 'type' => 'critical'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'PHP Version', 'status' => 'fail', 'message' => 'PHP ' . PHP_VERSION . ' (Required: 7.4+)', 'type' => 'critical'];
        }

        // MySQL Extension
        $total_checks++;
        if (extension_loaded('mysqli')) {
            $checks[] = ['name' => 'MySQL Extension', 'status' => 'pass', 'message' => 'MySQLi loaded', 'type' => 'critical'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'MySQL Extension', 'status' => 'fail', 'message' => 'MySQLi not loaded', 'type' => 'critical'];
        }

        // Session Support
        $total_checks++;
        if (session_id() !== '') {
            $checks[] = ['name' => 'Sessions', 'status' => 'pass', 'message' => 'Session support active', 'type' => 'critical'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Sessions', 'status' => 'fail', 'message' => 'Sessions not working', 'type' => 'critical'];
        }

        // Database Connection
        $total_checks++;
        $db_status = 'fail';
        $db_message = 'Database not connected';
        
        @$conn = new mysqli('localhost', 'root', '', 'traveller_db');
        if (!$conn->connect_error) {
            $checks[] = ['name' => 'Database', 'status' => 'pass', 'message' => 'Connected to traveller_db', 'type' => 'critical'];
            $pass_count++;
            $conn->close();
        } else {
            $checks[] = ['name' => 'Database', 'status' => 'fail', 'message' => 'Cannot connect: ' . $conn->connect_error, 'type' => 'critical'];
        }

        // Configuration File
        $total_checks++;
        if (file_exists('config/database.php')) {
            $checks[] = ['name' => 'Config File', 'status' => 'pass', 'message' => 'config/database.php exists', 'type' => 'critical'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Config File', 'status' => 'fail', 'message' => 'config/database.php not found', 'type' => 'critical'];
        }

        // Header Include
        $total_checks++;
        if (file_exists('includes/header.php')) {
            $checks[] = ['name' => 'Header Include', 'status' => 'pass', 'message' => 'includes/header.php exists', 'type' => 'important'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Header Include', 'status' => 'fail', 'message' => 'includes/header.php not found', 'type' => 'important'];
        }

        // Footer Include
        $total_checks++;
        if (file_exists('includes/footer.php')) {
            $checks[] = ['name' => 'Footer Include', 'status' => 'pass', 'message' => 'includes/footer.php exists', 'type' => 'important'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Footer Include', 'status' => 'fail', 'message' => 'includes/footer.php not found', 'type' => 'important'];
        }

        // Security Helpers
        $total_checks++;
        if (file_exists('includes/security_helpers.php')) {
            $checks[] = ['name' => 'Security Helpers', 'status' => 'pass', 'message' => 'includes/security_helpers.php exists', 'type' => 'important'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Security Helpers', 'status' => 'warning', 'message' => 'includes/security_helpers.php not found', 'type' => 'important'];
        }

        // Styling
        $total_checks++;
        if (file_exists('assets/styles.css')) {
            $checks[] = ['name' => 'Stylesheet', 'status' => 'pass', 'message' => 'assets/styles.css exists', 'type' => 'feature'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Stylesheet', 'status' => 'fail', 'message' => 'assets/styles.css not found', 'type' => 'feature'];
        }

        // JavaScript
        $total_checks++;
        if (file_exists('assets/main.js')) {
            $checks[] = ['name' => 'JavaScript', 'status' => 'pass', 'message' => 'assets/main.js exists', 'type' => 'feature'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'JavaScript', 'status' => 'warning', 'message' => 'assets/main.js not found (non-critical)', 'type' => 'feature'];
        }

        // Admin Panel
        $total_checks++;
        if (file_exists('admin/login.php') && file_exists('admin/dashboard.php')) {
            $checks[] = ['name' => 'Admin Panel', 'status' => 'pass', 'message' => 'Admin files present', 'type' => 'feature'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Admin Panel', 'status' => 'fail', 'message' => 'Admin files missing', 'type' => 'feature'];
        }

        // User System
        $total_checks++;
        if (file_exists('users/login.php') && file_exists('users/register.php')) {
            $checks[] = ['name' => 'User System', 'status' => 'pass', 'message' => 'User pages present', 'type' => 'feature'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'User System', 'status' => 'fail', 'message' => 'User pages missing', 'type' => 'feature'];
        }

        // Key Pages
        $total_checks++;
        $pages = ['index.php', 'destinations.php', 'hotels.php', 'contact.php'];
        $missing = [];
        foreach ($pages as $page) {
            if (!file_exists($page)) $missing[] = $page;
        }
        if (empty($missing)) {
            $checks[] = ['name' => 'Key Pages', 'status' => 'pass', 'message' => 'All main pages present', 'type' => 'critical'];
            $pass_count++;
        } else {
            $checks[] = ['name' => 'Key Pages', 'status' => 'fail', 'message' => 'Missing: ' . implode(', ', $missing), 'type' => 'critical'];
        }

        // Display Results
        foreach ($checks as $check) {
            $badge_text = $check['status'] === 'pass' ? '✓' : ($check['status'] === 'fail' ? '✗' : '⚠');
            echo '<div class="check-item ' . $check['status'] . '">';
            echo '<span><strong>' . $check['name'] . '</strong><br><small>' . $check['message'] . '</small></span>';
            echo '<span class="badge">' . $badge_text . '</span>';
            echo '</div>';
        }

        // Summary
        $success_rate = round(($pass_count / $total_checks) * 100);
        echo '<div class="summary ' . ($pass_count === $total_checks ? 'success' : ($pass_count > $total_checks * 0.75 ? 'warning' : 'error')) . '">';
        echo '<strong>Status: ' . $pass_count . ' / ' . $total_checks . ' checks passed (' . $success_rate . '%)</strong><br>';
        
        if ($pass_count === $total_checks) {
            echo '<p style="margin-bottom: 0;">✅ Everything is set up correctly! You can start using the website.</p>';
        } elseif ($pass_count > $total_checks * 0.75) {
            echo '<p style="margin-bottom: 0;">⚠️ Most components are working, but some optional features may not work.</p>';
        } else {
            echo '<p style="margin-bottom: 0;">❌ Critical components are missing. Please review the issues above.</p>';
        }
        echo '</div>';
        ?>

        <div class="section">
            <h3>🚀 Next Steps</h3>
            <div class="actions">
                <?php if ($pass_count === $total_checks): ?>
                    <a href="index.php" class="btn btn-primary">→ Go to Website</a>
                    <a href="admin/login.php" class="btn btn-secondary">→ Admin Panel</a>
                    <a href="users/register.php" class="btn btn-secondary">→ Register Account</a>
                <?php else: ?>
                    <p style="color: #991b1b; text-align: center;">
                        <strong>⚠️ Please resolve the issues above before using the website.</strong><br>
                        See README.md or QUICKSTART.md for troubleshooting help.
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <div class="section">
            <h3>📖 Documentation</h3>
            <p style="color: #64707d; margin-bottom: 15px;">
                For detailed setup and usage information, please read:
            </p>
            <div class="actions">
                <a href="README.md" target="_blank" class="btn btn-secondary">📖 Full Documentation (README.md)</a>
                <a href="QUICKSTART.md" target="_blank" class="btn btn-secondary">⚡ Quick Start Guide</a>
                <a href="COMPLETION_REPORT.md" target="_blank" class="btn btn-secondary">✅ Project Report</a>
            </div>
        </div>

        <div class="section" style="text-align: center; color: #64707d; font-size: 12px;">
            <p>Serendipity Sri Lanka • Travel Website<br>
            Version 1.0 • <?php echo date('Y-m-d'); ?></p>
        </div>
    </div>
</body>
</html>
