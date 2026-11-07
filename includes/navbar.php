<?php
/**
 * Sticky navigation. Set $isHome = true on index.php so links are in-page anchors.
 * On other pages they point back to index.php#section.
 */
declare(strict_types=1);

$isHome = $isHome ?? false;
$base   = $isHome ? '' : 'index.php';
$links  = [
    'home'       => 'Home',
    'about'      => 'About',
    'skills'     => 'Skills',
    'projects'   => 'Projects',
    'experience' => 'Education',
    'certificates' => 'Certificates',
    'contact'    => 'Contact',
];
?>
<header class="site-header" id="site-header">
    <nav class="nav container" aria-label="Main">
        <a class="brand" href="<?= e($base . '#home') ?>" aria-label="<?= e(config('site.name')) ?>, home">
            <span class="brand-mark" aria-hidden="true">L</span>
            <span class="brand-name"><?= e(config('site.name')) ?></span>
        </a>

        <ul class="nav-links" id="nav-links">
            <?php foreach ($links as $id => $label): ?>
                <li><a href="<?= e($base . '#' . $id) ?>" data-section="<?= e($id) ?>"><?= e($label) ?></a></li>
            <?php endforeach; ?>
        </ul>

        <div class="nav-actions">
            <button class="icon-btn" id="theme-toggle" type="button" aria-label="Switch to light theme">
                <i class="fa-solid fa-sun" aria-hidden="true"></i>
                <i class="fa-solid fa-moon" aria-hidden="true"></i>
            </button>
            <button class="icon-btn nav-toggle" id="nav-toggle" type="button"
                    aria-expanded="false" aria-controls="nav-links" aria-label="Open menu">
                <i class="fa-solid fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </nav>
</header>
