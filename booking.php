<?php
session_start();
require 'config/database.php';
require 'includes/booking_helpers.php';

$message = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $validation = validateBookingInput($_POST);
    $errors = $validation['errors'];

    if (empty($errors)) {
        $hotelId = (int)($_POST['hotel_id'] ?? 0);
        $guestName = $validation['guest_name'];
        $guestEmail = $validation['guest_email'];
        $checkIn = $validation['check_in'];
        $checkOut = $validation['check_out'];
        $travelers = $validation['travelers'];

        $stmt = $conn->prepare('INSERT INTO bookings (hotel_id, guest_name, guest_email, check_in, check_out, travelers, status, notes) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
        $status = 'pending';
        $notes = 'Booked through website';
        $stmt->bind_param('issssiss', $hotelId, $guestName, $guestEmail, $checkIn, $checkOut, $travelers, $status, $notes);
        $stmt->execute();

        $message = 'Your booking request has been received. We will contact you shortly.';
    }
}

include 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-calendar-check"></i> Booking</div>
        <h1 class="section-title">Reservation request sent</h1>
        <p><?php echo htmlspecialchars($message ?: 'Please complete your stay details to request a booking.'); ?></p>
        <?php if (!empty($errors)) { ?>
            <div class="card" style="margin-top:1rem; padding:1rem; max-width:680px;">
                <ul style="margin:0; padding-left:1.2rem; color:#b91c1c;">
                    <?php foreach ($errors as $error) { ?><li><?php echo htmlspecialchars($error); ?></li><?php } ?>
                </ul>
            </div>
        <?php } ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
