<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فرم ثبت نام</title>
    <?php 
        // Define BASE_URL if not already defined
        if (!defined('BASE_URL')) {
            $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'];
            $script = $_SERVER['SCRIPT_NAME'];
            $path = dirname($script);
            
            // If we're in the template folder, go up one level
            if (strpos($path, '/template') !== false || strpos($path, '\\template') !== false) {
                $path = dirname($path);
            }
            
            $path = $path === '/' ? '' : $path;
            $path = rtrim($path, '/');
            define('BASE_URL', $protocol . '://' . $host . $path . '/');
        }
        require_once __DIR__ . '/../lib/import.php'; 
    ?>
</head>