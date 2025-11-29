<?php
/**
 * AJAX Form Action Handler
 * 
 * This file handles form submissions via AJAX requests.
 * It validates form data and returns JSON responses.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

// Disable error display to prevent output before JSON
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

// Start output buffering to catch any unwanted output
ob_start();

// Set proper headers
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    ob_end_clean();
    http_response_code(200);
    exit;
}

// Define BASE_URL if not already defined
if (!defined('BASE_URL')) {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];
    $path = dirname($script);
    $path = $path === '/' ? '' : $path;
    define('BASE_URL', $protocol . '://' . $host . $path . '/');
}

// Handle POST requests
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    try {
        // Clean any output buffer
        ob_clean();
        
        $action = isset($_POST['action']) ? $_POST['action'] : '';
        switch( $action ){
            case 'signup':
                // Get file data safely
                $file = null;
                if (isset($_FILES['file']) && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
                    $file = $_FILES['file'];
                }
                
                $result = validateForm( 
                    isset($_POST['first_name']) ? $_POST['first_name'] : '', 
                    isset($_POST['last_name']) ? $_POST['last_name'] : '', 
                    isset($_POST['password']) ? $_POST['password'] : '', 
                    isset($_POST['password_confirm']) ? $_POST['password_confirm'] : '', 
                    isset($_POST['email']) ? $_POST['email'] : '', 
                    $file
                );
                
                // Clean output buffer and send JSON
                ob_end_clean();
                echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
                exit;
            default:
                ob_end_clean();
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'عملیات نامعتبر است'], JSON_UNESCAPED_UNICODE);
                exit;
        }
    } catch (Exception $e) {
        ob_end_clean();
        http_response_code(500);
        echo json_encode([
            'success' => false, 
            'message' => 'خطای سرور: ' . $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    } catch (Error $e) {
        ob_end_clean();
        http_response_code(500);
        echo json_encode([
            'success' => false, 
            'message' => 'خطای سرور: ' . $e->getMessage()
        ], JSON_UNESCAPED_UNICODE);
        exit;
    }
} else {
    // Not a POST request
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'متد مجاز نیست'], JSON_UNESCAPED_UNICODE);
    exit;
}

/**
 * Validate form data
 * 
 * Validates all form fields including first name, last name, email, 
 * password, password confirmation, and optional file upload.
 * 
 * @param string $first_name User's first name
 * @param string $last_name User's last name
 * @param string $password User's password
 * @param string $password_confirm Password confirmation
 * @param string $email User's email address
 * @param array|null $file Uploaded file array or null
 * @return array Validation result with 'success' and 'message' keys
 */
function validateForm( $first_name, $last_name, $password, $password_confirm, $email, $file ){
    // Validate first name
    if( empty(trim($first_name)) ){
        return ['success' => false, 'message' => 'لطفاً نام خود را وارد کنید'];
    }
    if( strlen(trim($first_name)) < 2 ){
        return ['success' => false, 'message' => 'نام باید حداقل 2 کاراکتر باشد'];
    }
    
    // Validate last name
    if( empty(trim($last_name)) ){
        return ['success' => false, 'message' => 'لطفاً نام خانوادگی خود را وارد کنید'];
    }
    if( strlen(trim($last_name)) < 2 ){
        return ['success' => false, 'message' => 'نام خانوادگی باید حداقل 2 کاراکتر باشد'];
    }
    
    // Validate email
    if( empty(trim($email)) ){
        return ['success' => false, 'message' => 'لطفاً ایمیل خود را وارد کنید'];
    }
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        return ['success' => false, 'message' => 'لطفاً یک ایمیل معتبر وارد کنید'];
    }
    
    // Validate password
    if( empty($password) ){
        return ['success' => false, 'message' => 'لطفاً رمز عبور خود را وارد کنید'];
    }
    if( strlen($password) < 6 ){
        return ['success' => false, 'message' => 'رمز عبور باید حداقل 6 کاراکتر باشد'];
    }
    
    // Validate password confirmation
    if( empty($password_confirm) ){
        return ['success' => false, 'message' => 'لطفاً تأیید رمز عبور را وارد کنید'];
    }
    if( $password != $password_confirm ){
        return ['success' => false, 'message' => 'رمز عبور و تأیید رمز عبور یکسان نیستند'];
    }
    
    // Validate file upload (if provided)
    if( $file && is_array($file) && isset($file['error']) ){
        if( $file['error'] === UPLOAD_ERR_OK ){
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            if( !in_array($file['type'], $allowed_types) ){
                return ['success' => false, 'message' => 'نوع فایل مجاز نیست. فقط تصویر (JPG, PNG, GIF) یا PDF مجاز است'];
            }
            if( $file['size'] > 5 * 1024 * 1024 ){ // 5MB
                return ['success' => false, 'message' => 'حجم فایل نباید بیشتر از 5 مگابایت باشد'];
            }
        } elseif( $file['error'] !== UPLOAD_ERR_NO_FILE ){
            return ['success' => false, 'message' => 'خطا در آپلود فایل رخ داد'];
        }
    }
    
    return createUser( $first_name, $last_name, $password, $email, $file );
}

/**
 * Create user record
 * 
 * Creates a user data array with validated form data.
 * In a production environment, this would typically save to a database.
 * 
 * @param string $first_name User's first name
 * @param string $last_name User's last name
 * @param string $password User's password (should be hashed in production)
 * @param string $email User's email address
 * @param array|null $file Uploaded file array or null
 * @return array Success response with user data
 */
function createUser( $first_name, $last_name, $password, $email, $file ){
    $user = [
        'first_name' => trim($first_name),
        'last_name' => trim($last_name),
        'password' => trim($password), // Note: In production, hash this password
        'email' => trim($email),
    ];
    if( $file ){
        $user['file_name'] = $file['name'];
        $user['file_path'] = $file['tmp_name'];
    }
    return [
        'success' => true, 
        'message' => 'ثبت نام با موفقیت انجام شد',
        'user' => $user
    ];
}
?>  