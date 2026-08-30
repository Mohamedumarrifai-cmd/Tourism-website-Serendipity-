<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = $page ?? 'home';
$loggedIn = isset($_SESSION['user_id']);
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($title) ? $title : 'Sri Lanka Travel'; ?> | Serendipity Sri Lanka</title>
    <meta name="description" content="Discover Sri Lanka through immersive travel guides, curated destinations, hotels, experiences, and trip planning resources." />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
<div class="global-bg-video-wrapper">
    <video autoplay muted loop playsinline class="global-bg-video">
        <source src="includes/videos/176299-855206492.mp4" type="video/mp4" />
    </video>
    <div class="global-bg-overlay"></div>
</div>
<header class="site-header">
    <div class="container nav-wrap">
        <a href="index.php" class="brand">
            <span class="brand-badge"><i class="fa-solid fa-compass"></i></span>
            <span>Serendipity Sri Lanka</span>
        </a>
        <button class="menu-toggle" aria-label="Toggle navigation" aria-expanded="false" aria-controls="site-nav">
            <span></span><span></span><span></span>
        </button>
        <nav id="site-nav" class="main-nav">
            <button class="menu-close" type="button" aria-label="Close navigation"><i class="fa-solid fa-xmark"></i></button>
            <a href="destinations.php" class="<?php echo $page === 'destinations' ? 'active' : ''; ?>">Destinations</a>
            <a href="experiences.php" class="<?php echo $page === 'experiences' ? 'active' : ''; ?>">Experiences</a>
            <a href="hotels.php" class="<?php echo $page === 'hotels' ? 'active' : ''; ?>">Stays</a>
            <a href="guide.php" class="<?php echo $page === 'guide' ? 'active' : ''; ?>">Travel Guide</a>
            
            <?php if ($loggedIn) { ?>
                <a href="users/dashboard.php">Dashboard</a>
            <?php } else { ?>
                <a href="users/login.php">Login</a>
            <?php } ?>
            <a href="trip-planner.php" class="btn btn-small btn-ghost">Plan Trip</a>
        </nav>
        <div class="nav-overlay" aria-hidden="true"></div>
    </div>
</header>
<main>
