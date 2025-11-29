<?php
/**
 * Asset Import Manager
 * 
 * This file manages the import of CSS and JavaScript assets.
 * It checks for assets in the assets directory first, then falls back to node_modules.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

if (defined('BASE_URL')) {
    $base_url = BASE_URL;
} else {
    $base_url = '../';
}

/**
 * Get asset path with fallback
 * 
 * Checks if asset exists in assets directory, otherwise uses CDN.
 * 
 * @param string $base_url Base URL of the application
 * @param string $assets_path Path to asset in assets directory
 * @param string $cdn_url CDN URL as fallback
 * @return string Full URL path to the asset
 */
if (!function_exists('getAssetPath')) {
    function getAssetPath($base_url, $assets_path, $cdn_url) {
        $assets_file = __DIR__ . '/../' . $assets_path;
        if (file_exists($assets_file)) {
            return $base_url . $assets_path;
        }
        return $cdn_url;
    }
}

// Bootstrap CSS (RTL) - CDN fallback
$bootstrap_css = getAssetPath($base_url, 'assets/css/bootstrap.rtl.min.css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css');
echo '<link rel="stylesheet" href="' . htmlspecialchars($bootstrap_css) . '">' . "\n";

// SweetAlert2 CSS - CDN fallback
$sweetalert_css = getAssetPath($base_url, 'assets/css/sweetalert2.min.css', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css');
echo '<link rel="stylesheet" href="' . htmlspecialchars($sweetalert_css) . '">' . "\n";

// Bootstrap Icons (CDN)
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">' . "\n";

// Custom stylesheet
echo '<link rel="stylesheet" href="' . htmlspecialchars($base_url . 'assets/css/style.css') . '">' . "\n";

// Bootstrap JS Bundle - CDN fallback
$bootstrap_js = getAssetPath($base_url, 'assets/js/bootstrap.bundle.min.js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
echo '<script src="' . htmlspecialchars($bootstrap_js) . '"></script>' . "\n";

// SweetAlert2 JS - CDN fallback
$sweetalert_js = getAssetPath($base_url, 'assets/js/sweetalert2.min.js', 'https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js');
echo '<script src="' . htmlspecialchars($sweetalert_js) . '"></script>' . "\n";

// jQuery - CDN fallback
$jquery_js = getAssetPath($base_url, 'assets/js/jquery.min.js', 'https://code.jquery.com/jquery-3.7.1.min.js');
echo '<script src="' . htmlspecialchars($jquery_js) . '"></script>' . "\n";
?>