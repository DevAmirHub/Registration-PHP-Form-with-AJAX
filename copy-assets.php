<?php
/**
 * Asset Copy Script
 * 
 * Copies Bootstrap and SweetAlert2 files from node_modules to assets directory.
 * Run this script once to copy the required files.
 * 
 * Usage: php copy-assets.php
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

$source_dir = __DIR__ . '/node_modules';
$assets_dir = __DIR__ . '/assets';

// Check if node_modules exists
if (!is_dir($source_dir)) {
    die("❌ node_modules directory not found. Please run 'npm install' first.\n");
}

// Create required directories
$dirs = [
    $assets_dir . '/css',
    $assets_dir . '/js'
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "✅ Directory created: $dir\n";
    }
}

// Files to copy
$files_to_copy = [
    // Bootstrap CSS
    'bootstrap/dist/css/bootstrap.rtl.min.css' => 'assets/css/bootstrap.rtl.min.css',
    'bootstrap/dist/css/bootstrap.rtl.min.css.map' => 'assets/css/bootstrap.rtl.min.css.map',
    
    // Bootstrap JS
    'bootstrap/dist/js/bootstrap.bundle.min.js' => 'assets/js/bootstrap.bundle.min.js',
    'bootstrap/dist/js/bootstrap.bundle.min.js.map' => 'assets/js/bootstrap.bundle.min.js.map',
    
    // SweetAlert2 CSS
    'sweetalert2/dist/sweetalert2.min.css' => 'assets/css/sweetalert2.min.css',
    
    // SweetAlert2 JS
    'sweetalert2/dist/sweetalert2.min.js' => 'assets/js/sweetalert2.min.js',
];

$copied = 0;
$failed = 0;

foreach ($files_to_copy as $source => $dest) {
    $source_path = $source_dir . '/' . $source;
    $dest_path = __DIR__ . '/' . $dest;
    
    if (file_exists($source_path)) {
        if (copy($source_path, $dest_path)) {
            echo "✅ Copied: $dest\n";
            $copied++;
        } else {
            echo "❌ Error copying: $dest\n";
            $failed++;
        }
    } else {
        echo "⚠️  File not found: $source_path\n";
        $failed++;
    }
}

echo "\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "✅ Files copied: $copied\n";
if ($failed > 0) {
    echo "❌ Files failed: $failed\n";
}
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n";
echo "💡 If files were copied successfully, lib/import.php will automatically\n";
echo "   use assets directory instead of node_modules.\n";
?>

