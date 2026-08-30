<?php
$page = 'contact';
$title = 'Contact';
$message = '';
require 'config/database.php';
require 'includes/security_helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken()) {
        $message = 'Security validation failed. Please try again.';
    } else {
        $name = sanitizeInput($_POST['name'] ?? '');
        $email = sanitizeInput($_POST['email'] ?? '');
        $tripType = sanitizeInput($_POST['trip'] ?? '');
        $details = sanitizeInput($_POST['details'] ?? '');
        
        if (empty($name) || empty($email) || empty($details)) {
            $message = 'Please fill in all required fields.';
        } elseif (!isValidEmail($email)) {
            $message = 'Please enter a valid email address.';
        } elseif (!checkRateLimit('contact_' . $email, 5, 300)) {
            $message = 'You have submitted too many requests. Please try again later.';
        } else {
            $stmt = $conn->prepare('INSERT INTO contact_messages (name, email, trip_type, details) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('ssss', $name, $email, $tripType, $details);
            if ($stmt->execute()) {
                $message = 'Thank you! Your trip request has been received. We will reach out shortly.';
            } else {
                $message = 'Error: Unable to save your message. Please try again.';
            }
        }
    }
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
            <?php if ($message) { $isError = (strpos($message, 'error') !== false || strpos($message, 'failed') !== false); echo '<div class="' . ($isError ? 'error' : 'success') . '-box">' . htmlspecialchars($message) . '</div>'; } ?>
            <input type="hidden" name="csrf_token" value="<?php echo generateCsrfToken(); ?>" />
            <input type="text" name="name" placeholder="Your name" required />
            <input type="email" name="email" placeholder="Your email" required />
            <input type="text" name="trip" placeholder="Trip type or destination" />
            <textarea name="details" placeholder="Tell us about your ideal itinerary"></textarea>
            <button class="btn btn-primary" type="submit">Request itinerary</button>
        </form>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
