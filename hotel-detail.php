<?php
session_start();
$page = 'hotels';
$title = 'Hotel Details';
require 'config/database.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM hotels WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$hotel = $stmt->get_result()->fetch_assoc();

if (!$hotel) {
    header('Location: hotels.php');
    exit;
}

$hotelExtras = [
    1 => [
        'description' => 'Cape Weligama blends modern luxury with soft ocean views and private villas. It is a perfect retreat for honeymooners and travelers who want calm beaches, wellness facilities and memorable dining.',
        'location' => 'Weligama, Southern Sri Lanka',
        'contact' => '+94 41 222 5566',
        'amenities' => ['Ocean-view villas', 'Spa & wellness', 'Private dining'],
        'gallery' => [
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80'
        ],
        'feedbacks' => [
            ['name' => 'Asha', 'text' => 'The villas were beautiful and the view was unforgettable.'],
            ['name' => 'Nuwan', 'text' => 'Service felt premium and the beachfront setting was perfect for a relaxed stay.']
        ]
    ],
    2 => [
        'description' => 'The Grand Hotel in Nuwara Eliya offers classic colonial elegance surrounded by cool mountain air and tea-country scenery. It is ideal for travelers wanting a calm highland base.',
        'location' => 'Nuwara Eliya, Central Highlands',
        'contact' => '+94 52 222 3344',
        'amenities' => ['Fireplace suites', 'Tea garden views', 'Afternoon tea service'],
        'gallery' => [
            'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80'
        ],
        'feedbacks' => [
            ['name' => 'Mihiri', 'text' => 'Perfect for a cozy stay in the hills. The grounds and service were excellent.'],
            ['name' => 'Sanjeewa', 'text' => 'Great location for exploring tea country without rushing.']
        ]
    ],
    3 => [
        'description' => 'Anantara Kalutara combines resort comfort with easy access to Sri Lanka’s southwest coast. It is ideal for family stays, weekend escapes and travelers who want both beach and dining convenience.',
        'location' => 'Kalutara, Southwest Coast',
        'contact' => '+94 34 222 8800',
        'amenities' => ['Swimming pools', 'Beach access', 'Family-friendly rooms'],
        'gallery' => [
            'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=900&q=80'
        ],
        'feedbacks' => [
            ['name' => 'Ravindu', 'text' => 'Great for families and the resort facilities were very comfortable.'],
            ['name' => 'Dilini', 'text' => 'Loved the beach access and the easy dining options.']
        ]
    ]
];

require 'includes/gallery_helpers.php';

$extra = $hotelExtras[$id] ?? [];
$detailDescription = !empty($hotel['description']) ? $hotel['description'] : ($extra['description'] ?? '');
$hotelLocation = !empty($hotel['location']) ? $hotel['location'] : ($extra['location'] ?? 'Sri Lanka');
$hotelContact = $extra['contact'] ?? '+94 11 234 5678';
$amenities = $extra['amenities'] ?? ['Comfortable rooms', 'Great hospitality', 'Prime location'];
$gallery = buildGalleryImages($hotel['image_url'], $hotel['gallery_urls'], $extra['gallery'] ?? []);
$feedbacks = $extra['feedbacks'] ?? [];

include 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-bed"></i> Sri Lankan stay</div>
        <h1 class="section-title"><?php echo htmlspecialchars($hotel['name']); ?></h1>
        <p><?php echo htmlspecialchars($hotelLocation); ?></p>
    </div>
</section>

<section>
    <div class="container detail-shell">
        <div class="detail-hero">
            <div class="card">
                <img class="card-media" src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" />
                <div class="card-body">
                    <h3 class="card-title">Stay overview</h3>
                    <p class="card-description"><?php echo nl2br(htmlspecialchars($detailDescription)); ?></p>
                    <div class="detail-badges">
                        <span class="tag"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($hotelLocation); ?></span>
                        <span class="tag"><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($hotel['price']); ?></span>
                    </div>
                </div>
            </div>
            <div class="card" style="padding:1.2rem;">
                <h3 class="card-title">Book this stay</h3>
                <p class="card-description">Reserve your preferred dates and we will help you arrange a smooth stay.</p>
                <form method="post" action="booking.php">
                    <input type="hidden" name="hotel_id" value="<?php echo (int)$hotel['id']; ?>" />
                    <input type="text" name="guest_name" placeholder="Your name" required style="width:100%; padding:0.8rem; margin-bottom:0.7rem; border-radius:10px; border:1px solid #ddd;" />
                    <input type="email" name="guest_email" placeholder="Your email" required style="width:100%; padding:0.8rem; margin-bottom:0.7rem; border-radius:10px; border:1px solid #ddd;" />
                    <input type="date" name="check_in" required style="width:100%; padding:0.8rem; margin-bottom:0.7rem; border-radius:10px; border:1px solid #ddd;" />
                    <input type="date" name="check_out" required style="width:100%; padding:0.8rem; margin-bottom:0.7rem; border-radius:10px; border:1px solid #ddd;" />
                    <input type="number" name="travelers" min="1" value="1" required style="width:100%; padding:0.8rem; margin-bottom:0.7rem; border-radius:10px; border:1px solid #ddd;" />
                    <button class="btn btn-primary" type="submit">Book now</button>
                </form>
            </div>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">Highlights & amenities</h3>
            <ul class="info-list">
                <?php foreach ($amenities as $amenity) { ?>
                    <li><?php echo htmlspecialchars($amenity); ?></li>
                <?php } ?>
            </ul>
            <div class="hotel-contact-box">
                <strong>Contact number:</strong> <?php echo htmlspecialchars($hotelContact); ?><br />
                <strong>Reservation support:</strong> Fast replies for check-in planning and stay requests.
            </div>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">Location map</h3>
            <p class="card-description">See where this hotel sits and plan nearby sightseeing stops.</p>
            <iframe
                title="Hotel map"
                width="100%"
                height="300"
                style="border:0; border-radius:16px;"
                loading="lazy"
                allowfullscreen
                src="<?php echo !empty($hotel['location_url']) ? htmlspecialchars($hotel['location_url']) : 'https://www.google.com/maps?q=' . urlencode($hotelLocation . ', Sri Lanka') . '&output=embed&dirflg=d'; ?>"></iframe>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">More photos</h3>
            <div class="gallery-strip">
                <?php foreach ($gallery as $image) { ?>
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" />
                <?php } ?>
            </div>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">Customer feedback</h3>
            <?php foreach ($feedbacks as $feedback) { ?>
                <div class="review-card">
                    <strong><?php echo htmlspecialchars($feedback['name']); ?></strong>
                    <p class="card-description" style="margin-top:0.35rem;"><?php echo htmlspecialchars($feedback['text']); ?></p>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
