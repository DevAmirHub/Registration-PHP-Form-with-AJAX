# راهنمای استفاده از Bootstrap و SweetAlert2

## وضعیت فعلی

پروژه شما اکنون به گونه‌ای تنظیم شده که:
1. ابتدا از فایل‌های موجود در `assets/` استفاده می‌کند
2. اگر فایل‌ها در `assets/` نبودند، از `node_modules/` استفاده می‌کند

## روش 1: استفاده مستقیم از node_modules (پیشنهادی)

اگر وب سرور شما (Laragon) به `node_modules` دسترسی دارد، نیازی به کار اضافی نیست. فایل‌ها به صورت خودکار از `node_modules` لود می‌شوند.

## روش 2: کپی فایل‌ها به assets

اگر `node_modules` از طریق وب سرور قابل دسترسی نیست:

1. فایل `copy-assets.php` را اجرا کنید:
   ```bash
   php copy-assets.php
   ```

2. این اسکریپت فایل‌های مورد نیاز را از `node_modules` به `assets` کپی می‌کند.

## بررسی

برای بررسی اینکه فایل‌ها درست لود می‌شوند:

1. صفحه را در مرورگر باز کنید
2. Developer Tools را باز کنید (F12)
3. به تب Network بروید
4. صفحه را Refresh کنید
5. بررسی کنید که فایل‌های CSS و JS با موفقیت لود شده‌اند

## فایل‌های مورد نیاز

- `bootstrap.rtl.min.css`
- `bootstrap.bundle.min.js`
- `sweetalert2.min.css`
- `sweetalert2.min.js`

## استفاده از SweetAlert2

بعد از لود شدن صفحه، می‌توانید از SweetAlert2 استفاده کنید:

```javascript
// مثال ساده
Swal.fire({
    icon: 'success',
    title: 'موفقیت',
    text: 'عملیات با موفقیت انجام شد'
});

// یا از توابع آماده در assets/js/sweetalert-example.js
showSuccess('پیام موفقیت');
showError('پیام خطا');
```

## عیب‌یابی

اگر فایل‌ها لود نمی‌شوند:

1. بررسی کنید که `node_modules` وجود دارد و `npm install` اجرا شده است
2. بررسی کنید که پوشه `node_modules` از طریق وب سرور قابل دسترسی است
3. اگر نه، فایل `copy-assets.php` را اجرا کنید
4. بررسی کنید که `BASE_URL` به درستی تعریف شده است

