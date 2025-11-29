/**
 * AJAX Form Action Handler
 * 
 * Handles form submission via AJAX and displays notifications.
 * 
 * @file ajax-form-action.js
 * @package Practice
 * @version 1.0.0
 */

/**
 * Show success notification
 * 
 * @param {string} message Success message to display
 */
function showSuccess(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        icon: 'success',
        title: 'موفقیت',
        text: message,
        confirmButtonText: 'باشه',
        confirmButtonColor: '#3085d6'
    });
}

/**
 * Show error notification
 * 
 * @param {string} message Error message to display
 */
function showError(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        icon: 'error',
        title: 'خطا',
        text: message,
        confirmButtonText: 'باشه',
        confirmButtonColor: '#d33'
    });
}

/**
 * Show warning notification
 * 
 * @param {string} message Warning message to display
 */
function showWarning(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        icon: 'warning',
        title: 'هشدار',
        text: message,
        confirmButtonText: 'باشه',
        confirmButtonColor: '#f0ad4e'
    });
}

/**
 * Show info notification
 * 
 * @param {string} message Info message to display
 */
function showInfo(message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        icon: 'info',
        title: 'اطلاعات',
        text: message,
        confirmButtonText: 'باشه',
        confirmButtonColor: '#5bc0de'
    });
}

/**
 * Initialize form submission handler
 * 
 * Sets up AJAX form submission when DOM is loaded.
 */
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('ajax-form');
    
    if (form) {
        // Get action URL from form data attribute or calculate it
        let actionUrl = form.getAttribute('data-action-url');
        
        if (!actionUrl) {
            // Fallback: calculate from current location
            const currentPath = window.location.pathname;
            let basePath = currentPath;
            
            // Remove filename
            if (basePath.includes('/')) {
                basePath = basePath.substring(0, basePath.lastIndexOf('/'));
            }
            
            // If in template, go up one level
            if (basePath.endsWith('/template')) {
                basePath = basePath.substring(0, basePath.length - '/template'.length);
            }
            
            // Remove trailing slash
            if (basePath.endsWith('/')) {
                basePath = basePath.slice(0, -1);
            }
            
            actionUrl = basePath + '/include/ajax-form-action.php';
        }
        
        console.log('AJAX URL:', actionUrl); // Debug log
        
        // Handle form submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Disable submit button and show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>در حال ارسال...';
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Send AJAX request
            fetch(actionUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => {
                // Get response text first to check content
                return response.text().then(text => {
                    // Check if response is ok
                    if (!response.ok) {
                        console.error('HTTP Error:', response.status, text);
                        throw new Error('HTTP error! status: ' + response.status);
                    }
                    
                    // Try to parse as JSON
                    try {
                        const data = JSON.parse(text);
                        return data;
                    } catch (e) {
                        // If not JSON, log the response
                        console.error('Invalid JSON response:', text);
                        console.error('Content-Type:', response.headers.get('content-type'));
                        throw new Error('Server returned invalid JSON. Response: ' + text.substring(0, 100));
                    }
                });
            })
            .then(data => {
                // Restore submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                
                if (data.success) {
                    // Redirect to success page
                    // Calculate success page URL
                    let successUrl;
                    if (actionUrl.includes('/include/')) {
                        const baseUrl = actionUrl.substring(0, actionUrl.indexOf('/include/'));
                        successUrl = baseUrl + '/template/success.php';
                    } else {
                        // Fallback
                        const currentPath = window.location.pathname;
                        let basePath = currentPath;
                        if (basePath.includes('/')) {
                            basePath = basePath.substring(0, basePath.lastIndexOf('/'));
                        }
                        if (basePath.endsWith('/template')) {
                            basePath = basePath.substring(0, basePath.length - '/template'.length);
                        }
                        if (basePath.endsWith('/')) {
                            basePath = basePath.slice(0, -1);
                        }
                        successUrl = basePath + '/template/success.php';
                    }
                    
                    successUrl += '?title=' + encodeURIComponent('ثبت نام با موفقیت انجام شد') + '&message=' + encodeURIComponent(data.message || 'با تشکر از شما برای ثبت نام');
                    window.location.href = successUrl;
                } else {
                    // Show error message
                    showError(data.message);
                }
            })
            .catch(error => {
                // Restore submit button
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
                
                console.error('AJAX Error:', error);
                console.error('Error details:', {
                    message: error.message,
                    stack: error.stack,
                    url: actionUrl
                });
                
                // Show more specific error message
                let errorMessage = 'خطا در ارتباط با سرور. لطفاً دوباره تلاش کنید.';
                if (error.message.includes('Failed to fetch') || error.message.includes('NetworkError')) {
                    errorMessage = 'خطای شبکه. لطفاً اتصال اینترنت خود را بررسی کنید و دوباره تلاش کنید.';
                } else if (error.message.includes('HTTP error')) {
                    errorMessage = 'خطای سرور. لطفاً بعداً دوباره تلاش کنید.';
                } else if (error.message.includes('Invalid server response')) {
                    errorMessage = 'پاسخ نامعتبر از سرور. لطفاً تنظیمات سرور را بررسی کنید.';
                }
                
                showError(errorMessage);
            });
        });
    }
});
