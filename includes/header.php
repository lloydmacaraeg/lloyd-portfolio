<?php
/**
 * Opens the HTML document. Expects (set before including):
 *   $pageTitle        string  <title> text
 *   $metaDescription  string  meta description
 */
declare(strict_types=1);

$siteName    = (string) config('site.name');
$pageTitle   = $pageTitle ?? ($siteName . ' | ' . config('site.title'));
$metaDesc    = $metaDescription ?? (string) config('site.description');
$siteUrl     = rtrim((string) config('site.url', ''), '/');
?>
<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($pageTitle) ?></title>
    <meta name="description" content="<?= e($metaDesc) ?>">
    <meta name="theme-color" content="#0e0e10">
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?= e($pageTitle) ?>">
    <meta property="og:description" content="<?= e($metaDesc) ?>">
    <?php if ($siteUrl !== ''): ?>
        <link rel="canonical" href="<?= e($siteUrl . '/' . ltrim((string) ($_SERVER['REQUEST_URI'] ?? ''), '/')) ?>">
    <?php endif; ?>
    <link rel="icon" type="image/svg+xml" href="<?= e(asset('images/favicon.svg')) ?>">

    <!-- Apply the saved theme before first paint to avoid a flash. -->
    <script>
        (function () {
            var theme = 'dark';
            try {
                var saved = localStorage.getItem('theme');
                if (saved === 'light' || saved === 'dark') { theme = saved; }
            } catch (err) { /* storage unavailable: keep default */ }
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.classList.add('js');
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Sora:wght@500;600;700&family=Source+Sans+3:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?= e(asset('css/style.css')) ?>">
</head>
<body id="top">
<a class="skip-link" href="#main">Skip to main content</a>
