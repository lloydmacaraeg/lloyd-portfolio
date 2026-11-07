<?php
/**
 * Project detail page, rendered server-side from includes/projects-data.php.
 * URL: project.php?slug=sample-task-manager
 */
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';

$projects = require __DIR__ . '/includes/projects-data.php';

$slug    = isset($_GET['slug']) && is_string($_GET['slug']) ? $_GET['slug'] : '';
$project = preg_match('/^[a-z0-9-]{1,80}$/', $slug) ? find_project($projects, $slug) : null;

$isHome = false;

if ($project === null) {
    http_response_code(404);
    $pageTitle       = 'Project not found | ' . config('site.name');
    $metaDescription = 'The requested project does not exist.';
    require __DIR__ . '/includes/header.php';
    require __DIR__ . '/includes/navbar.php';
    ?>
    <main id="main" class="section">
        <div class="container narrow">
            <h1>Project not found</h1>
            <p>That project does not exist or may have been renamed.</p>
            <p><a class="btn btn-primary" href="index.php#projects">Back to all projects</a></p>
        </div>
    </main>
    <?php
    require __DIR__ . '/includes/footer.php';
    exit;
}

// Previous / next project for simple navigation.
$index = array_search($project['slug'], array_column($projects, 'slug'), true);
$prev  = $projects[($index - 1 + count($projects)) % count($projects)];
$next  = $projects[($index + 1) % count($projects)];

$pageTitle       = $project['title'] . ' | ' . config('site.name');
$metaDescription = $project['summary'];

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/navbar.php';
?>
<main id="main" class="section project-detail">
    <div class="container narrow">
        <p><a class="back-link" href="index.php#projects"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> All projects</a></p>

        <div class="project-meta">
            <span class="tag"><?= e($project['category']) ?></span>
            <?php if ($project['year'] !== ''): ?><span class="tag"><?= e($project['year']) ?></span><?php endif; ?>
            <?php if (!empty($project['placeholder'])): ?>
                <span class="tag tag-placeholder">Placeholder</span>
            <?php endif; ?>
        </div>

        <h1><?= e($project['title']) ?></h1>
        <p class="section-lead"><?= e($project['summary']) ?></p>

        <?php
        $video    = $project['video'] ?? null;
        $hasVideo = is_array($video) && !empty($video['file']) && is_file(ROOT_PATH . '/' . $video['file']);
        ?>
        <?php if ($hasVideo): ?>
            <video class="detail-image detail-video" controls preload="metadata" playsinline
                   <?= !empty($video['poster']) ? 'poster="' . e(asset('images/' . $video['poster'])) . '"' : '' ?>>
                <source src="<?= e($video['file']) ?>" type="<?= e(str_ends_with($video['file'], '.webm') ? 'video/webm' : 'video/mp4') ?>">
                Your browser cannot play this video. <a href="<?= e($video['file']) ?>">Download the video</a>.
            </video>
        <?php else: ?>
            <img class="detail-image" src="<?= e(asset('images/' . $project['image'])) ?>" width="960" height="540"
                 alt="Preview image for <?= e($project['title']) ?>">
        <?php endif; ?>

        <div class="btn-row">
            <?php if ($project['repo'] !== ''): ?>
                <a class="btn btn-primary" href="<?= e($project['repo']) ?>" <?= external_attrs() ?>>
                    <i class="fa-brands fa-github" aria-hidden="true"></i> View on GitHub</a>
            <?php endif; ?>
            <?php if ($project['demo'] !== ''): ?>
                <a class="btn btn-secondary" href="<?= e($project['demo']) ?>" <?= external_attrs() ?>>
                    <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Live demo</a>
            <?php endif; ?>
            <?php $dl = $project['download'] ?? null; ?>
            <?php if (is_array($dl) && !empty($dl['file']) && is_file(ROOT_PATH . '/' . $dl['file'])): ?>
                <a class="btn btn-secondary" href="<?= e($dl['file']) ?>" download>
                    <i class="fa-solid fa-download" aria-hidden="true"></i> <?= e($dl['label'] ?? 'Download') ?></a>
            <?php endif; ?>
        </div>
        <?php if (is_array($dl) && !empty($dl['note']) && !empty($dl['file']) && is_file(ROOT_PATH . '/' . $dl['file'])): ?>
            <p class="download-note"><?= e($dl['note']) ?></p>
        <?php endif; ?>

        <h2>About this project</h2>
        <?php foreach ($project['description'] as $paragraph): ?>
            <p><?= e($paragraph) ?></p>
        <?php endforeach; ?>

        <?php if (!empty($project['role'])): ?>
            <h2>My role</h2>
            <p><?= e($project['role']) ?></p>
        <?php endif; ?>

        <?php if (!empty($project['features'])): ?>
            <h2>Features</h2>
            <ul class="bullets">
                <?php foreach ($project['features'] as $feature): ?>
                    <li><?= e($feature) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (!empty($project['stack'])): ?>
            <h2>Tech stack</h2>
            <ul class="stack-list">
                <?php foreach ($project['stack'] as $tech): ?>
                    <li><?= e($tech) ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <?php if (count($projects) > 1): ?>
        <nav class="pager" aria-label="More projects">
            <a href="project.php?slug=<?= e(rawurlencode($prev['slug'])) ?>">
                <span class="pager-label">Previous</span> <?= e($prev['title']) ?></a>
            <a href="project.php?slug=<?= e(rawurlencode($next['slug'])) ?>">
                <span class="pager-label">Next</span> <?= e($next['title']) ?></a>
        </nav>
        <?php endif; ?>
    </div>
</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
