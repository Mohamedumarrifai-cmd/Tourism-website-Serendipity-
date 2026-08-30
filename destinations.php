<?php
session_start();
$page = 'destinations';
$title = 'Destinations';
require 'config/database.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    $_SESSION['redirect_after_login'] = 'destinations.php';
}

$categoryFilter = $_GET['category'] ?? 'all';
$searchTerm = $_GET['search'] ?? '';

$query = 'SELECT * FROM destinations WHERE 1=1';
$params = [];
$types = '';

if ($categoryFilter !== 'all' && in_array($categoryFilter, ['beach', 'mountain', 'wildlife', 'culture', 'adventure', 'history'], true)) {
    $query .= " AND category = ?";
    $params[] = $categoryFilter;
    $types .= 's';
}

if ($searchTerm !== '') {
    $searchPattern = '%' . $searchTerm . '%';
    $query .= " AND (name LIKE ? OR location LIKE ? OR description LIKE ? OR activities LIKE ?)";
    $params = array_merge($params, [$searchPattern, $searchPattern, $searchPattern, $searchPattern]);
    $types .= 'ssss';
}

$query .= ' ORDER BY id DESC';

$stmt = $conn->prepare($query);
if ($types && $params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$destinationsResult = $stmt->get_result();
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-route"></i> Discover Sri Lanka</div>
        <h1 class="section-title">Explore the island one unforgettable destination at a time</h1>
        <p>Curated highlights across beaches, culture, mountains, wildlife and adventure.</p>
    </div>
</section>

<section>
    <div class="container">
        <form class="filters" method="get">
            <div class="filter-group">
                <label for="destinationSearch">Search destinations</label>
                <input id="destinationSearch" name="search" type="text" value="<?php echo htmlspecialchars($searchTerm); ?>" placeholder="Search by place or activity" />
            </div>
            <div class="filter-group">
                <label for="destinationFilter">Category</label>
                <select id="destinationFilter" name="category">
                    <option value="all" <?php echo $categoryFilter === 'all' ? 'selected' : ''; ?>>All categories</option>
                    <option value="beach" <?php echo $categoryFilter === 'beach' ? 'selected' : ''; ?>>Beaches</option>
                    <option value="mountain" <?php echo $categoryFilter === 'mountain' ? 'selected' : ''; ?>>Mountains</option>
                    <option value="wildlife" <?php echo $categoryFilter === 'wildlife' ? 'selected' : ''; ?>>Wildlife</option>
                    <option value="culture" <?php echo $categoryFilter === 'culture' ? 'selected' : ''; ?>>Culture</option>
                    <option value="adventure" <?php echo $categoryFilter === 'adventure' ? 'selected' : ''; ?>>Adventure</option>
                    <option value="history" <?php echo $categoryFilter === 'history' ? 'selected' : ''; ?>>Historical Places</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Apply</button>
        </form>

        <div class="grid grid-3">
            <?php while ($destination = $destinationsResult->fetch_assoc()) { ?>
                <article class="card destination-card" data-search="<?php echo htmlspecialchars(strtolower($destination['name'] . ' ' . $destination['activities'] . ' ' . $destination['description'])); ?>" data-category="<?php echo htmlspecialchars($destination['category']); ?>">
                    <img class="card-media" src="<?php echo htmlspecialchars($destination['image_url']); ?>" alt="<?php echo htmlspecialchars($destination['name']); ?>" />
                    <div class="card-body">
                        <h3 class="card-title"><?php echo htmlspecialchars($destination['name']); ?></h3>
                        <p class="card-description"><?php echo htmlspecialchars($destination['description']); ?></p>
                        <ul class="meta-list"><li class="tag"><?php echo htmlspecialchars($destination['category']); ?></li><li class="tag"><?php echo htmlspecialchars($destination['activities']); ?></li></ul>
                        <div class="card-footer"><span><?php echo htmlspecialchars($destination['location']); ?></span><span><?php echo htmlspecialchars($destination['duration']); ?></span></div>
                        <a class="btn btn-secondary" style="margin-top:0.8rem;" href="destination-detail.php?id=<?php echo (int)$destination['id']; ?>">View details</a>
                    </div>
                </article>
            <?php } ?>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
