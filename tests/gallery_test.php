<?php
require __DIR__ . '/../includes/gallery_helpers.php';

$galleryFromJson = buildGalleryImages('https://example.com/main.jpg', '["https://example.com/a.jpg","https://example.com/b.jpg"]', null);
if (count($galleryFromJson) < 2) {
    fwrite(STDERR, "Expected JSON gallery data to produce more than one image.\n");
    exit(1);
}

$fallbackGallery = buildGalleryImages('https://example.com/main.jpg', null, null);
if (count($fallbackGallery) < 2) {
    fwrite(STDERR, "Expected fallback gallery to include more than one image.\n");
    exit(1);
}

echo "Gallery fallback test passed." . PHP_EOL;
