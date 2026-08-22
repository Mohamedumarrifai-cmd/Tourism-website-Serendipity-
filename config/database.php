<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'traveller_db';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Database connection failed: ' . $conn->connect_error);
}

$conn->set_charset('utf8mb4');

$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->query("CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    hotel_id INT NOT NULL,
    guest_name VARCHAR(150) NOT NULL,
    guest_email VARCHAR(150) NOT NULL,
    check_in DATE NOT NULL,
    check_out DATE NOT NULL,
    travelers INT NOT NULL DEFAULT 1,
    status VARCHAR(30) NOT NULL DEFAULT 'pending',
    notes TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// Safely add gallery_urls columns if they don't exist
@$conn->query("ALTER TABLE hotels ADD COLUMN gallery_urls TEXT DEFAULT NULL");
@$conn->query("ALTER TABLE destinations ADD COLUMN gallery_urls TEXT DEFAULT NULL");
@$conn->query("ALTER TABLE hotels ADD COLUMN location VARCHAR(255) DEFAULT NULL");
@$conn->query("ALTER TABLE hotels ADD COLUMN location_url TEXT DEFAULT NULL");
?>
