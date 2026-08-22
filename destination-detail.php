<?php
session_start();
$page = 'destinations';
$title = 'Destination Details';
require 'config/database.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $conn->prepare('SELECT * FROM destinations WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$destination = $stmt->get_result()->fetch_assoc();

if (!$destination) {
    header('Location: destinations.php');
    exit;
}

$destinationExtras = [
    1 => [
        'description' => 'Mirissa is one of Sri Lanka’s most loved beach escapes, where calm turquoise waters meet golden sand and dramatic sunsets. It is ideal for travelers who want a relaxing coastal stay with easy access to whale watching and sea turtle conservation.',
        'highlights' => ['Whale watching in season', 'Sunset dolphin cruises', 'Beach cafes and seafood dinners'],
        'best_time' => 'December to April',
        'gallery' => [
            'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80'
        ]
    ],
    2 => [
        'description' => 'Ella is a misty mountain town wrapped by tea gardens, railway tracks and lush green hills. It is a favorite for hikers, train lovers and couples looking for cool weather and dramatic views.',
        'highlights' => ['Little Adam’s Peak', 'Nine Arch Bridge', 'Tea factory visits'],
        'best_time' => 'January to April',
        'gallery' => [
            'https://images.unsplash.com/photo-1573790387438-4da905039392?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1500534623283-312aade485b7?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=900&q=80'
        ]
    ],
    3 => [
        'description' => 'Sigiriya is one of Sri Lanka’s most iconic heritage sites, known for the ancient rock fortress, royal gardens and storybook frescoes. It is perfect for history lovers and photographers.',
        'highlights' => ['Ancient rock fortress', 'Royal gardens', 'Panoramic viewpoints'],
        'best_time' => 'January to April',
        'gallery' => [
            'https://images.unsplash.com/photo-1548013146-72479768bada?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=900&q=80',
            'https://images.unsplash.com/photo-1566552881560-0be862a7c445?auto=format&fit=crop&w=900&q=80'
        ]
    ]
];

require 'includes/gallery_helpers.php';

$extra = $destinationExtras[$id] ?? [];
$detailDescription = $extra['description'] ?? $destination['description'];
$highlights = $extra['highlights'] ?? ['Great scenery', 'Local culture', 'Easy access'];
$bestTime = $extra['best_time'] ?? $destination['duration'];
$gallery = buildGalleryImages($destination['image_url'], $destination['gallery_urls'], $extra['gallery'] ?? []);

include 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-location-dot"></i> Sri Lankan destination</div>
        <h1 class="section-title"><?php echo htmlspecialchars($destination['name']); ?></h1>
        <p><?php echo htmlspecialchars($destination['location']); ?></p>
    </div>
</section>

<section>
    <div class="container detail-shell">
        <div class="detail-hero">
            <div class="card">
                <img class="card-media" src="<?php echo htmlspecialchars($destination['image_url']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>" />
                <div class="card-body">
                    <h3 class="card-title">About this place</h3>
                    <p class="card-description"><?php echo nl2br(htmlspecialchars($detailDescription)); ?></p>
                    <div class="detail-badges">
                        <span class="tag"><i class="fa-solid fa-compass"></i> <?php echo htmlspecialchars($destination['category']); ?></span>
                        <span class="tag"><i class="fa-solid fa-clock"></i> <?php echo htmlspecialchars($destination['duration']); ?></span>
                        <span class="tag"><i class="fa-solid fa-sun"></i> Best time: <?php echo htmlspecialchars($bestTime); ?></span>
                    </div>
                    <p><strong>Activities:</strong> <?php echo htmlspecialchars($destination['activities']); ?></p>
                </div>
            </div>
            <div class="card" style="padding:1.2rem;">
                <h3 class="card-title">Why travelers love it</h3>
                <ul class="info-list">
                    <?php foreach ($highlights as $highlight) { ?>
                        <li><?php echo htmlspecialchars($highlight); ?></li>
                    <?php } ?>
                </ul>
                <div style="margin-top:1rem;">
                    <h3 class="card-title">Location map</h3>
                    <p class="card-description">See the exact area and plan your route around nearby stops.</p>
                    <iframe
                        title="Destination map"
                        width="100%"
                        height="300"
                        style="border:0; border-radius:16px;"
                        loading="lazy"
                        allowfullscreen
                        src="https://www.google.com/maps?q=<?php echo urlencode($destination['location'] . ', Sri Lanka'); ?>&output=embed&dirflg=d"></iframe>
                </div>
            </div>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">More photos</h3>
            <div class="gallery-strip">
                <?php foreach ($gallery as $image) { ?>
                    <img src="<?php echo htmlspecialchars($image); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>" />
                <?php } ?>
            </div>
        </div>

        <div class="card" style="padding:1.2rem;">
            <h3 class="card-title">Travel tips</h3>
            <p class="card-description">Plan your stay with local transport, early starts for scenic viewpoints, and flexible evenings for beach dining or cultural stops.</p>
            <a class="btn btn-primary" href="contact.php">Ask for itinerary</a>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
