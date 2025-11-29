<?php
/**
 * Notification Helper
 * 
 * Displays notification messages with different types (success, error, warning, info).
 * Note: This is a utility function. The main application uses SweetAlert2 for notifications.
 * 
 * @package Practice
 * @author Your Name
 * @version 1.0.0
 */

/**
 * Display notification message
 * 
 * @param string $message Notification message to display
 * @param string $type Notification type: 'success', 'error', 'warning', or 'info'
 * @return void
 */
function notify( string $message, string $type = 'success' ): void {
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
    
    if( $type == 'success' ){
        echo "<div class='notify-container'>
            <div class='notify-content'>
                <div class='notify-icon'>
                    <i class='bi text-success bi-check-circle'></i>
                </div>
                <div class='notify-text'>
                    $message
                </div>
            </div>
        </div>";
    }elseif( $type == 'error' ){
        echo "<div class='notify-container'>
            <div class='notify-content'>
                <div class='notify-icon'>
                    <i class='bi text-danger bi-x-circle'></i>
                </div>
                <div class='notify-text'>
                    $message
                </div>
            </div>
        </div>";
    }elseif( $type == 'warning' ){
        echo "<div class='notify-container'>
            <div class='notify-content'>
                <div class='notify-icon'>
                    <i class='bi text-warning bi-exclamation-circle'></i>
                </div>
                <div class='notify-text'>
                    $message
                </div>
            </div>
        </div>";
    }else{
        echo "<div class='notify-container'>
            <div class='notify-content'>
                <div class='notify-icon'>
                    <i class='bi text-primary bi-info-circle'></i>
                </div>
                <div class='notify-text'>
                    $message
                </div>
            </div>
        </div>";
    }
}
?>
<style>
    .notify-container {
        position: absolute; 
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 100%;
        height: 100px;
        background: rgba(0, 0, 0, 0.5);
        border-radius: 5px;
        padding: 20px;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>