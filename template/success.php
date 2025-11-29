<?php 
/**
 * Success Page Template
 * 
 * Displays a success message after form submission.
 * Accepts 'title' and 'message' GET parameters.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

    // Set BASE_URL for proper static file access
    if (!defined('BASE_URL')) {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'];
        // Calculate path from current file path
        $script_dir = dirname($_SERVER['SCRIPT_NAME']);
        // If we're in the template folder, go up one level
        if (strpos($script_dir, '/template') !== false || strpos($script_dir, '\\template') !== false) {
            $path = dirname($script_dir);
        } else {
            $path = $script_dir;
        }
        $path = $path === '/' ? '' : $path;
        define('BASE_URL', $protocol . '://' . $host . $path . '/');
    }
    include 'header-form.php'; 
?>

<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 glass-card">
                    <div class="card-header bg-primary text-white text-center py-4">
                        <h1 class="card-title mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            <?php echo isset($_GET['title']) ? htmlspecialchars($_GET['title']) : 'ثبت نام با موفقیت انجام شد'; ?>
                        </h1>
                    </div>
                    <div class="card-body p-4">
                        <p class="text-center text-success">
                            <?php echo isset($_GET['message']) ? htmlspecialchars($_GET['message']) : 'با تشکر از شما برای ثبت نام'; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>