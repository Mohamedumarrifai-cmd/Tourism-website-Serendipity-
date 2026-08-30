<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard | Serendipity Sri Lanka</title>
    <link rel="stylesheet" href="../assets/styles.css" />
    <style>
        body { background: transparent; color: white; }
        .dashboard { max-width: 980px; margin: 40px auto; background: rgba(15, 25, 37, 0.45); backdrop-filter: blur(16px); padding: 2rem; border-radius: 28px; box-shadow: 0 20px 50px rgba(0,0,0,0.25); border: 1px solid rgba(255,255,255,0.1); }
        .dashboard-top { display: grid; gap: 1rem; grid-template-columns: 1.2fr 0.8fr; align-items: center; }
        .hero-video { width: 100%; border-radius: 20px; margin-top: 1rem; }
        .action-grid { display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; margin-top: 1rem; }
        .action-card { background: rgba(15, 25, 37, 0.35); padding: 1rem; border-radius: 16px; border: 1px solid rgba(255,255,255,0.1); }
    </style>
</head>
<body>
<div class="global-bg-video-wrapper">
    <video autoplay muted loop playsinline class="global-bg-video">
        <source src="../includes/videos/176299-855206492.mp4" type="video/mp4" />
    </video>
    <div class="global-bg-overlay"></div>
</div>
    <div class="dashboard">
        <div class="dashboard-top">
            <div>
                <h1>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h1>
                <p>Your account is ready. Start exploring Sri Lanka and save your favorite travel ideas.</p>
                <div style="display:flex; gap:0.8rem; flex-wrap:wrap; margin-top:1rem;">
                    <a class="btn btn-primary" href="../destinations.php">Explore Destinations</a>
                    <a class="btn btn-secondary" href="logout.php">Logout</a>
                </div>
            </div>
            <div class="action-card">
                <h3>Your next trip</h3>
                <p>Plan beaches, mountains, safaris and cultural stops with a guided journey.</p>
                <a class="btn btn-secondary" href="../trip-planner.php">Open planner</a>
            </div>
        </div>

        <video class="hero-video" autoplay muted loop playsinline controls poster="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1200&q=80">
            <source src="https://assets.mixkit.co/videos/preview/mixkit-aerial-view-of-a-beautiful-beach-with-waves-4268-large.mp4" type="video/mp4" />
            Your browser does not support the video tag.
        </video>

        <div class="action-grid">
            <div class="action-card">
                <h3>Discover stays</h3>
                <p>Browse coastal retreats, tea-country hotels and luxury escapes.</p>
                <a class="btn btn-primary" href="../hotels.php">View hotels</a>
            </div>
            <div class="action-card">
                <h3>Need help?</h3>
                <p>Ask for an itinerary or travel guidance from our team.</p>
                <a class="btn btn-secondary" href="../contact.php">Contact us</a>
            </div>
        </div>
    </div>
</body>
</html>
