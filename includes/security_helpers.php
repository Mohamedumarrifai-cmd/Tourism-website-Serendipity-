<?php
/**
 * Security Helper Functions
 */

// Generate CSRF Token
function generateCsrfToken() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    
    return $_SESSION['csrf_token'];
}

// Verify CSRF Token
function verifyCsrfToken($token = null) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $token = $token ?? ($_POST['csrf_token'] ?? '');
    
    if (empty($token) || empty($_SESSION['csrf_token'])) {
        return false;
    }
    
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Sanitize input
function sanitizeInput($input) {
    return htmlspecialchars(trim((string)$input), ENT_QUOTES, 'UTF-8');
}

// Validate email
function isValidEmail($email) {
    $email = sanitizeInput($email);
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate date
function isValidDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

// Validate URL
function isValidUrl($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

// Rate limiting (simple implementation)
function checkRateLimit($identifier, $limit = 5, $timeWindow = 60) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    $_SESSION['rate_limit'] = $_SESSION['rate_limit'] ?? [];
    
    $now = time();
    $key = md5($identifier);
    
    if (!isset($_SESSION['rate_limit'][$key])) {
        $_SESSION['rate_limit'][$key] = [];
    }
    
    // Clean old entries
    $_SESSION['rate_limit'][$key] = array_filter(
        $_SESSION['rate_limit'][$key],
        function($timestamp) use ($now, $timeWindow) {
            return ($now - $timestamp) < $timeWindow;
        }
    );
    
    if (count($_SESSION['rate_limit'][$key]) >= $limit) {
        return false;
    }
    
    $_SESSION['rate_limit'][$key][] = $now;
    return true;
}
?>
