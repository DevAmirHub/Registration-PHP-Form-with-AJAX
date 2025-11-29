# Registration Form with AJAX

A modern, responsive registration form built with PHP, Bootstrap 5, and AJAX. Features real-time validation, file upload support, and a beautiful user interface.

## Features

- ✅ **AJAX Form Submission** - No page reload required
- ✅ **Real-time Validation** - Client and server-side validation
- ✅ **File Upload Support** - Images (JPG, PNG, GIF) and PDF files up to 5MB
- ✅ **Responsive Design** - Works on all devices with Bootstrap 5 RTL
- ✅ **Beautiful UI** - Modern card-based design with Bootstrap Icons
- ✅ **SweetAlert2 Integration** - Elegant notification system
- ✅ **Success Page** - Redirects to success page after registration
- ✅ **RTL Support** - Right-to-left layout for Persian/Arabic languages

## Requirements

- PHP 7.4 or higher
- Web server (Apache/Nginx) with PHP support
- Node.js and npm (for installing dependencies)

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/practice.git
   cd practice
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Copy assets (optional)**
   ```bash
   php copy-assets.php
   ```
   This script copies Bootstrap and SweetAlert2 files from `node_modules` to the `assets` directory. The application will automatically use assets from the `assets` directory if available, otherwise it will fall back to `node_modules`.

4. **Configure your web server**
   - Point your web server document root to the project directory
   - Ensure PHP is enabled and configured

5. **Access the application**
   - Open `http://localhost/practice` in your browser
   - Or configure a virtual host for a custom domain

## Project Structure

```
practice/
├── assets/              # Static assets (CSS, JS, fonts)
│   ├── css/            # Stylesheets
│   ├── js/             # JavaScript files
│   └── font/           # Custom fonts
├── include/             # PHP includes
│   └── ajax-form-action.php  # AJAX form handler
├── lib/                 # Library files
│   └── import.php      # Asset import manager
├── template/            # HTML templates
│   ├── header-form.php # Page header
│   ├── form.php        # Registration form
│   └── success.php     # Success page
├── utils/               # Utility functions
│   └── notify.php      # Notification helper
├── copy-assets.php      # Asset copy script
├── index.php           # Main entry point
└── package.json        # Node.js dependencies
```

## Usage

### Form Fields

The registration form includes the following fields:

- **First Name** (required, min 2 characters)
- **Last Name** (required, min 2 characters)
- **Email** (required, must be valid email format)
- **Password** (required, min 6 characters)
- **Password Confirmation** (required, must match password)
- **File Upload** (optional, JPG/PNG/GIF/PDF, max 5MB)

### AJAX Endpoint

The form submits to `/include/ajax-form-action.php` with the following structure:

**Request:**
- Method: POST
- Content-Type: multipart/form-data
- Fields: `action`, `first_name`, `last_name`, `email`, `password`, `password_confirm`, `file`

**Response:**
```json
{
  "success": true,
  "message": "Registration completed successfully",
  "user": {
    "first_name": "John",
    "last_name": "Doe",
    "email": "john@example.com",
    "password": "password123",
    "file_name": "document.pdf",
    "file_path": "/tmp/phpXXXXXX"
  }
}
```

## Configuration

### BASE_URL

The application automatically detects the base URL. If you need to set it manually, you can define it before including any files:

```php
define('BASE_URL', 'http://yourdomain.com/practice/');
```

### Asset Management

The `lib/import.php` file manages asset loading with automatic fallback:

1. First, it checks for assets in the `assets/` directory
2. If not found, it falls back to `node_modules/`

This allows you to:
- Use CDN or local copies in production
- Develop with npm packages without copying files
- Easily switch between asset sources

## Customization

### Styling

Edit `assets/css/style.css` to customize the appearance:

```css
/* Your custom styles */
```

### Form Validation Messages

Edit validation messages in `include/ajax-form-action.php`:

```php
return ['success' => false, 'message' => 'Your custom message'];
```

### Success Page

Customize the success page in `template/success.php`. The page accepts GET parameters:

- `title` - Page title
- `message` - Success message

## Dependencies

### PHP
- No external PHP libraries required (uses built-in functions)

### JavaScript/CSS (via npm)
- **Bootstrap 5.3.8** - CSS framework (RTL version)
- **jQuery 3.7.1** - JavaScript library
- **SweetAlert2 11.26.3** - Beautiful alert dialogs
- **Bootstrap Icons** - Icon library (via CDN)

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Security Considerations

⚠️ **Important:** This is a demonstration project. For production use, consider:

1. **Password Hashing** - Currently passwords are stored in plain text. Use `password_hash()` in production.
2. **CSRF Protection** - Add CSRF tokens to prevent cross-site request forgery.
3. **Input Sanitization** - Sanitize all user inputs before processing.
4. **File Upload Security** - Validate file types server-side, scan for malware, store files outside web root.
5. **SQL Injection** - If using a database, use prepared statements.
6. **XSS Protection** - Always use `htmlspecialchars()` when outputting user data (already implemented in success.php).

## Development

### Running Locally

1. Start your local web server:
   ```bash
   # Using PHP built-in server
   php -S localhost:8000
   ```

2. Open `http://localhost:8000` in your browser

### Testing

Test the form with various scenarios:

- Valid submissions
- Invalid email formats
- Short passwords
- Mismatched passwords
- Large file uploads
- Invalid file types

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License

This project is open source and available under the [MIT License](LICENSE).

## Author

Your Name - [@yourusername](https://github.com/yourusername)

## Acknowledgments

- [Bootstrap](https://getbootstrap.com/) - CSS framework
- [SweetAlert2](https://sweetalert2.github.io/) - Beautiful alerts
- [Bootstrap Icons](https://icons.getbootstrap.com/) - Icon library

## Support

If you have any questions or issues, please open an issue on GitHub.

---

Made with ❤️ using PHP and Bootstrap

