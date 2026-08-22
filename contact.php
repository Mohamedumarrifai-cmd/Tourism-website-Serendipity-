<?php
$page = 'contact';
$title = 'Contact';
$message = '';
require 'config/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $conn->real_escape_string($_POST['name'] ?? '');
    $email = $conn->real_escape_string($_POST['email'] ?? '');
    $tripType = $conn->real_escape_string($_POST['trip'] ?? '');
    $details = $conn->real_escape_string($_POST['details'] ?? '');
    $conn->query("INSERT INTO contact_messages (name, email, trip_type, details) VALUES ('$name', '$email', '$tripType', '$details')");
    $message = 'Thank you! Your trip request has been received. We will reach out shortly.';
}
include 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-paper-plane"></i> Contact us</div>
        <h1 class="section-title">Plan your Sri Lanka journey with expert guidance</h1>
        <p>Share your travel dates and interests, and we’ll help shape a tailor-made island itinerary.</p>
    </div>
</section>

<section>
    <div class="container contact-section">
        <div class="contact-card">
            <h3>Reach our travel team</h3>
            <p>We make it easy to design a memorable trip around beaches, mountains, wildlife, culture and adventure.</p>
            <ul>
                <li><i class="fa-solid fa-envelope"></i> hello@serendipitylanka.com</li>
                <li><i class="fa-solid fa-phone"></i> +94 77 123 4567</li>
                <li><i class="fa-solid fa-location-dot"></i> Colombo, Sri Lanka</li>
            </ul>
        </div>
        <form class="contact-form" method="post">
            <?php if ($message) { echo '<div class="success-box">' . htmlspecialchars($message) . '</div>'; } ?>
            <input type="text" name="name" placeholder="Your name" required />
            <input type="email" name="email" placeholder="Your email" required />
            <input type="text" name="trip" placeholder="Trip type or destination" />
            <textarea name="details" placeholder="Tell us about your ideal itinerary"></textarea>
            <button class="btn btn-primary" type="submit">Request itinerary</button>
        </form>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
