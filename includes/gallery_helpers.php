<?php
function buildGalleryImages($mainImage, $galleryUrls, $fallbackGallery = null) {
    $gallery = [];

    if (!empty($galleryUrls)) {
        if (is_string($galleryUrls)) {
            $decoded = json_decode($galleryUrls, true);
            if (is_array($decoded)) {
                $gallery = array_values(array_filter(array_map('trim', $decoded), static function ($value) {
                    return $value !== '';
                }));
            } else {
                $trimmed = array_map('trim', explode(',', $galleryUrls));
                $gallery = array_values(array_filter($trimmed, static function ($value) {
                    return $value !== '';
                }));
            }
        } elseif (is_array($galleryUrls)) {
            $gallery = array_values(array_filter(array_map('trim', $galleryUrls), static function ($value) {
                return $value !== '';
            }));
        }
    }

    if (empty($gallery)) {
        if (!empty($fallbackGallery) && is_array($fallbackGallery)) {
            $gallery = array_values(array_filter(array_map('trim', $fallbackGallery), static function ($value) {
                return $value !== '';
            }));
        } elseif (!empty($mainImage)) {
            $gallery = [
                $mainImage,
                'https://images.unsplash.com/photo-1500375592092-40eb2168fd21?auto=format&fit=crop&w=900&q=80',
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=900&q=80'
            ];
        }
    }

    if (empty($gallery) && !empty($mainImage)) {
        $gallery = [$mainImage];
    }

    if (!empty($mainImage) && !in_array($mainImage, $gallery, true)) {
        array_unshift($gallery, $mainImage);
    }

    return $gallery;
}
