<?php
session_start();
$page = 'hotels';
$title = 'Hotels';
require 'config/database.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'hotels.php';
}

$result = $conn->query('SELECT * FROM hotels ORDER BY id DESC');
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-bed"></i> Stay in comfort</div>
        <h1 class="section-title">Handpicked stays for every style of travel</h1>
        <p>From boutique hideaways to beachfront resorts and cool highland retreats.</p>
    </div>
</section>

<section>
    <div class="container grid grid-3">
        <?php if ($result && $result->num_rows > 0) { while ($hotel = $result->fetch_assoc()) { ?>
            <article class="card accommodation-card">
                <img class="card-media" src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" />
                <div class="card-body">
                    <h3 class="card-title"><?php echo htmlspecialchars($hotel['name']); ?></h3>
                    <p class="card-description"><?php echo htmlspecialchars($hotel['description']); ?></p>
                    <div class="price-badge"><?php echo htmlspecialchars($hotel['price']); ?></div>
                    <a class="btn btn-primary" href="hotel-detail.php?id=<?php echo (int)$hotel['id']; ?>">View details</a>
                </div>
            </article>
        <?php } } else { ?>
            <div class="card" style="grid-column: 1 / -1; padding: 1.4rem;">
                <h3 class="card-title">Stay collection is being prepared</h3>
                <p class="card-description">The hotel catalog will appear here once the database content is imported.</p>
            </div>
        <?php } ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
