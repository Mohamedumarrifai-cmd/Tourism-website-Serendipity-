<?php
$page = 'home';
$title = 'Discover Sri Lanka';
require 'config/database.php';
include 'includes/header.php';

$destinationsResult = $conn->query('SELECT * FROM destinations ORDER BY id DESC LIMIT 6');
$experiencesResult = $conn->query('SELECT * FROM experiences ORDER BY id DESC LIMIT 3');
$hotelsResult = $conn->query('SELECT * FROM hotels ORDER BY id DESC LIMIT 3');
?>
<section class="hero">
    <video autoplay muted loop playsinline class="hero-bg-video">
        <source src="https://assets.mixkit.co/videos/preview/mixkit-aerial-view-of-a-beautiful-beach-with-waves-4268-large.mp4" type="video/mp4" />
    </video>
    <div class="hero-overlay"></div>
    <div class="container hero-inner">
        <div>
            <div class="section-tag"><i class="fa-solid fa-map-location-dot"></i> Island of Serendipity</div>
            <h1 class="hero-title">Experience the magic of Sri Lanka, from golden beaches to misty peaks.</h1>
            <p class="hero-description">Discover world-class surf, ancient kingdoms, wildlife safaris, luxury retreats, and soul-stirring adventures in one unforgettable island getaway.</p>
            <div class="hero-actions">
                <a href="destinations.php" class="btn btn-primary">Explore Destinations</a>
                <a href="experiences.php" class="btn btn-secondary">View Experiences</a>
            </div>
            <div class="hero-stats">
                <div class="hero-stat"><strong>8 UNESCO</strong><span>heritage sites</span></div>
                <div class="hero-stat"><strong>25+</strong><span>beaches</span></div>
                <div class="hero-stat"><strong>100+</strong><span>curated stays</span></div>
            </div>
        </div>
        <aside class="hero-card">
            <h3>Why travelers love Sri Lanka</h3>
            <ul>
                <li>Unspoiled coastlines and surf-ready beaches</li>
                <li>Tea country vistas and scenic train journeys</li>
                <li>Elephants, leopards, whales and coastal wildlife</li>
                <li>Ancient temples, forts and vibrant local culture</li>
            </ul>
        </aside>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Popular destinations</div>
            <h2 class="section-title">Where unforgettable journeys begin</h2>
            <p class="section-description">From sun-kissed shores to cool mountain escapes, these destinations set the tone for a remarkable Sri Lankan adventure.</p>
        </div>
        <div class="grid grid-3">
            <?php while ($destination = $destinationsResult->fetch_assoc()) { ?>
                <article class="card">
                    <img class="card-media" src="<?php echo htmlspecialchars($destination['image_url']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>" />
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($destination['name']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($destination['description']); ?></p>
                        <ul class="meta-list"><li class="tag"><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($destination['location']); ?></li><li class="tag"><i class="fa-solid fa-compass"></i> <?php echo htmlspecialchars($destination['category']); ?></li></ul>
                        <div class="card-footer"><span><?php echo htmlspecialchars($destination['duration']); ?></span><a href="destination-detail.php?id=<?php echo (int)$destination['id']; ?>" class="btn btn-small btn-secondary">View</a></div>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>

<section class="section-surface">
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Categories</div>
            <h2 class="section-title">Find your perfect Sri Lanka experience</h2>
        </div>
        <div class="grid grid-3 categories-grid">
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-umbrella-beach"></i></div>
                <h3 class="card-title">Beaches</h3>
                <p class="card-description">Golden coves, reef breaks, and sunset dinners along the coast.</p>
            </article>
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-mountain-sun"></i></div>
                <h3 class="card-title">Mountains</h3>
                <p class="card-description">Cloud forests, tea estates, hiking trails and cool highland air.</p>
            </article>
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-paw"></i></div>
                <h3 class="card-title">Wildlife</h3>
                <p class="card-description">Safaris, elephant sanctuaries and marine life encounters in the wild.</p>
            </article>
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-landmark"></i></div>
                <h3 class="card-title">Culture</h3>
                <p class="card-description">Ancient temples, dance shows, markets and local traditions.</p>
            </article>
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-person-hiking"></i></div>
                <h3 class="card-title">Adventure</h3>
                <p class="card-description">Surfing, kayaking, cycling, trekking and adrenaline-fueled days.</p>
            </article>
            <article class="card">
                <div class="category-icon"><i class="fa-solid fa-monument"></i></div>
                <h3 class="card-title">Historical Places</h3>
                <p class="card-description">Fortresses, ruins and royal cities that tell the island’s story.</p>
            </article>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Experiences</div>
            <h2 class="section-title">Featured travel experiences</h2>
            <p class="section-description">Choose a pace that suits you, from slow luxury stays to raw outdoor discovery.</p>
        </div>
        <div class="grid grid-3">
            <?php while ($experience = $experiencesResult->fetch_assoc()) { ?>
                <article class="card">
                    <img class="card-media" src="<?php echo htmlspecialchars($experience['image_url']); ?>" alt="<?php echo htmlspecialchars($experience['title']); ?>" />
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($experience['title']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($experience['description']); ?></p>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Stay & dine</div>
            <h2 class="section-title">Recommended hotels and curated stays</h2>
        </div>
        <div class="grid grid-3">
            <?php while ($hotel = $hotelsResult->fetch_assoc()) { ?>
                <article class="card accommodation-card">
                    <img class="card-media" src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="<?php echo htmlspecialchars($hotel['name']); ?>" />
                    <div class="card-body">
                        <div class="card-title"><?php echo htmlspecialchars($hotel['name']); ?></div>
                        <p class="card-description"><?php echo htmlspecialchars($hotel['description']); ?></p>
                        <div class="price-badge"><?php echo htmlspecialchars($hotel['price']); ?></div>
                        <a href="hotel-detail.php?id=<?php echo (int)$hotel['id']; ?>" class="btn btn-small btn-secondary">View</a>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="section-header">
            <div class="section-tag">Travel guide</div>
            <h2 class="section-title">Helpful trip planning essentials</h2>
        </div>
        <div class="grid grid-3 guide-grid">
            <article class="card guide-card">
                <h3>Best time to visit</h3>
                <p>December to April is ideal for the south and west coasts, while the east coast shines from May to September.</p>
            </article>
            <article class="card guide-card">
                <h3>Getting around</h3>
                <p>Trains, private drivers and domestic flights make Sri Lanka easy to explore at your own pace.</p>
            </article>
            <article class="card guide-card">
                <h3>Travel tips</h3>
                <p>Pack light layers, respect temples, and plan jungle safaris early to avoid crowds.</p>
            </article>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
