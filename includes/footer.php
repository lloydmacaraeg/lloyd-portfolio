<?php
declare(strict_types=1);
?>
<footer class="site-footer">
    <div class="container footer-inner">
        <p class="footer-copy">&copy; <?= e(date('Y')) ?> <?= e(config('site.name')) ?>. All rights reserved.</p>

        <ul class="footer-links">
            <?php foreach (social_links() as $link): ?>
                <li><a href="<?= e($link['url']) ?>" <?= external_attrs() ?>>
                    <i class="<?= e($link['icon']) ?>" aria-hidden="true"></i> <?= e($link['label']) ?></a></li>
            <?php endforeach; ?>
            <li><a href="mailto:<?= e(config('site.email')) ?>">
                <i class="fa-solid fa-envelope" aria-hidden="true"></i> Email</a></li>
        </ul>

        <a class="to-top" href="#top">
            <i class="fa-solid fa-arrow-up" aria-hidden="true"></i> Back to top
        </a>
    </div>
</footer>

<script src="<?= e(asset('js/main.js')) ?>" defer></script>
</body>
</html>
