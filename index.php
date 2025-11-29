<?php 
/**
 * Main Entry Point
 * 
 * This is the main entry point of the application.
 * It defines BASE_URL and includes the form template.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

// Define BASE_URL if not already defined
if (!defined('BASE_URL')) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $path = dirname($script);
    $path = $path === '/' ? '' : $path;
    define('BASE_URL', $protocol . '://' . $host . $path . '/');
}

// Include templates
// Note: import.php is included in header-form.php
include 'template/header-form.php';
include 'template/form.php';
?>