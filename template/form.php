<?php 
/**
 * Registration Form Template
 * 
 * Displays the user registration form with validation.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

    include 'header-form.php'; 
    
    /**
     * Get AJAX action URL
     * 
     * Returns the URL to the AJAX form handler.
     * 
     * @return string URL to ajax-form-action.php
     */
    if (!function_exists('getActionUrl')) {
        function getActionUrl() {
            if (defined('BASE_URL')) {
                $url = BASE_URL;
                $url = rtrim($url, '/');
                return $url . '/include/ajax-form-action.php';
            } else {
                return '../include/ajax-form-action.php';
            }
        }
    }
?>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg border-0 glass-card">
                    <div class="card-header bg-primary text-white text-center">
                        <h1 class="card-title mb-0">
                            <i class="bi bi-person-plus-fill me-2"></i>
                            فرم ثبت نام
                        </h1>
                    </div>
                    <div class="card-body">
                        <form action="" id="ajax-form" method="post" enctype="multipart/form-data" data-action-url="<?php echo defined('BASE_URL') ? BASE_URL . 'include/ajax-form-action.php' : '../include/ajax-form-action.php'; ?>">
                            <input type="hidden" name="action" value="signup">
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="first_name" class="form-label">
                                        <i class="bi bi-person me-1"></i>
                                        نام
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="first_name" 
                                           name="first_name" 
                                           placeholder="نام خود را وارد کنید"
                                           >
                                </div>
                                <div class="col-md-6">
                                    <label for="last_name" class="form-label">
                                        <i class="bi bi-person-fill me-1"></i>
                                        نام خانوادگی
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg" 
                                           id="last_name" 
                                           name="last_name" 
                                           placeholder="نام خانوادگی خود را وارد کنید"
                                           >
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="bi bi-envelope me-1"></i>
                                    ایمیل
                                </label>
                                <input type="email" 
                                       class="form-control form-control-lg" 
                                       id="email" 
                                       name="email" 
                                       placeholder="example@email.com"
                                       >
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="password" class="form-label">
                                        <i class="bi bi-lock me-1"></i>
                                        رمز عبور
                                    </label>
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password" 
                                           name="password" 
                                           placeholder="رمز عبور خود را وارد کنید"
                                           >
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirm" class="form-label">
                                        <i class="bi bi-lock-fill me-1"></i>
                                        تأیید رمز عبور
                                    </label>
                                    <input type="password" 
                                           class="form-control form-control-lg" 
                                           id="password_confirm" 
                                           name="password_confirm" 
                                           placeholder="رمز عبور را مجدداً وارد کنید"
                                           >
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="file" class="form-label">
                                    <i class="bi bi-file-earmark-arrow-up me-1"></i>
                                    آپلود فایل
                                </label>
                                <input type="file" 
                                       class="form-control form-control-lg" 
                                       id="file" 
                                       name="file">
                                <div class="form-text">فایل مورد نظر خود را انتخاب کنید</div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-check-circle me-2"></i>
                                    ثبت نام
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="<?php echo defined('BASE_URL') ? BASE_URL : '../'; ?>assets/js/ajax-form-action.js"></script>
</body>
</html>
