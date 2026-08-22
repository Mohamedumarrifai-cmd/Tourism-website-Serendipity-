<?php
$page = 'blog';
$title = 'Travel Blog';
require 'config/database.php';
include 'includes/header.php';

$result = $conn->query('SELECT * FROM experiences ORDER BY id DESC');
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-newspaper"></i> Travel blog</div>
        <h1 class="section-title">Stories, tips, and inspiration for your Sri Lanka escape</h1>
        <p>Read practical guidance, destination stories, and route ideas from the island.</p>
    </div>
</section>

<section>
    <div class="container grid grid-3">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <article class="card">
                <img class="card-media" src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>" />
                <div class="card-body">
                    <h3 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h3>
                    <p class="card-description"><?php echo htmlspecialchars($row['description']); ?></p>
                </div>
            </article>
        <?php } ?>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
