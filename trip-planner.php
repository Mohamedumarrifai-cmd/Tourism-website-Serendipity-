<?php
$page = 'planner';
$title = 'Trip Planner';
require 'config/database.php';
include 'includes/header.php';
?>
<section class="page-hero">
    <div class="container">
        <div class="section-tag"><i class="fa-solid fa-map"></i> Smart planning</div>
        <h1 class="section-title">Plan your Sri Lanka itinerary in minutes</h1>
        <p>Choose your travel style and build a day-by-day route with beaches, mountains, wildlife, and culture.</p>
    </div>
</section>

<section>
    <div class="container">
        <div class="grid grid-3">
            <article class="card guide-card">
                <h3>Classic 7-Day Escape</h3>
                <p>Colombo → Sigiriya → Kandy → Ella → Mirissa → Galle.</p>
            </article>
            <article class="card guide-card">
                <h3>Surf & Sun 5-Day Trip</h3>
                <p>Arugam Bay → Bentota → Mirissa → beach cafés and seaside stays.</p>
            </article>
            <article class="card guide-card">
                <h3>Nature & Highlands 6-Day Journey</h3>
                <p>Nuwara Eliya → Horton Plains → Ella → Udawalawe → nature lodges.</p>
            </article>
        </div>
    </div>
</section>
<?php include 'includes/footer.php'; ?>
