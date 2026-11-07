<?php
/**
 * Main entry point: renders every section of the one-page portfolio.
 */
declare(strict_types=1);

require __DIR__ . '/includes/bootstrap.php';

$projects = require __DIR__ . '/includes/projects-data.php';
$skills   = require __DIR__ . '/includes/skills-data.php';
$profile  = require __DIR__ . '/includes/profile-data.php';
$certificates = require __DIR__ . '/includes/certificates-data.php';

$resumeFile   = (string) config('site.resume_file');
$hasResume    = is_file(ROOT_PATH . '/' . $resumeFile);
$timelineGroups = [
    'education'      => 'Education',
    'experience'     => 'Experience',
];

$pageTitle = config('site.name') . ' | ' . config('site.title');
$isHome    = true;

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/navbar.php';
?>
<main id="main">

    <!-- HOME / HERO -->
    <section class="hero" id="home" aria-labelledby="hero-title">
        <div class="container hero-grid">
            <div class="hero-copy">
                <p class="hero-hello">Hello, I'm</p>
                <h1 id="hero-title"><?= e(config('site.name')) ?></h1>
                <p class="hero-role"><?= e(config('site.title')) ?></p>
                <p class="hero-intro"><?= e(config('site.intro')) ?></p>

                <div class="btn-row">
                    <a class="btn btn-primary" href="#projects">View Projects</a>
                    <a class="btn btn-secondary" href="#contact">Contact Me</a>
                    <?php if ($hasResume): ?>
                        <a class="btn btn-ghost" href="<?= e($resumeFile) ?>" download>
                            <i class="fa-solid fa-download" aria-hidden="true"></i> Download Resume
                        </a>
                    <?php endif; ?>
                </div>

                <ul class="social-row" aria-label="Social links">
                    <?php foreach (social_links() as $link): ?>
                        <li><a href="<?= e($link['url']) ?>" <?= external_attrs() ?> aria-label="<?= e($link['label']) ?> profile">
                            <i class="<?= e($link['icon']) ?>" aria-hidden="true"></i></a></li>
                    <?php endforeach; ?>
                    <li><a href="mailto:<?= e(config('site.email')) ?>" aria-label="Send an email">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="hero-visual">
                <div class="portrait-frame">
                    <img src="<?= e(asset('images/profile.png')) ?>" width="420" height="420"
                         alt="Portrait of <?= e(config('site.name')) ?>">
                </div>
            </div>
        </div>
    </section>

    <!-- ABOUT -->
    <section class="section" id="about" aria-labelledby="about-title">
        <div class="container about-layout">
            <div class="about-photo reveal">
                <img src="<?= e(asset('images/profile1.JPEG')) ?>" width="420" height="520" loading="lazy"
                     alt="Portrait of <?= e(config('site.name')) ?>">
            </div>
            <div class="about-content reveal">
                <div class="about-intro">
                    <h2 id="about-title">About me</h2>
                    <?php foreach (config('about.summary', []) as $paragraph): ?>
                        <p><?= e($paragraph) ?></p>
                    <?php endforeach; ?>
                </div>
                <div class="about-details">
                    <div class="about-detail-card">
                        <h3><i class="fa-solid fa-compass" aria-hidden="true"></i> Interests</h3>
                        <ul class="interest-tags">
                            <?php foreach (config('about.interests', []) as $interest): ?>
                                <li><?= e($interest) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="about-detail-card">
                        <h3><i class="fa-solid fa-bullseye" aria-hidden="true"></i> Career objective</h3>
                        <p><?= e(config('about.objective')) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SKILLS -->
    <section class="section section-alt" id="skills" aria-labelledby="skills-title">
        <div class="container">
            <h2 id="skills-title">Skills</h2>
            <p class="section-lead">Tools and technologies I work with, grouped by area.</p>

            <div class="skill-groups">
                <?php foreach ($skills as $group => $items): ?>
                    <div class="skill-group reveal">
                        <h3><?= e($group) ?></h3>
                        <ul class="skill-list">
                            <?php foreach ($items as $skill): ?>
                                <li class="skill-card">
                                    <i class="<?= e($skill['icon']) ?>" aria-hidden="true"></i>
                                    <span><?= e($skill['name']) ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- PROJECTS -->
    <section class="section" id="projects" aria-labelledby="projects-title">
        <div class="container">
            <h2 id="projects-title">Projects</h2>
            <p class="section-lead">Selected work. Each card opens a detail page.</p>

            <?php if ($projects === []): ?>
                <p class="empty-state">Projects are coming soon.</p>
            <?php endif; ?>

            <div class="project-grid" id="project-grid">
                <?php foreach ($projects as $project): ?>
                    <article class="project-card reveal" data-category="<?= e($project['category']) ?>">
                        <a class="project-media" href="project.php?slug=<?= e(rawurlencode($project['slug'])) ?>" tabindex="-1" aria-hidden="true">
                            <img src="<?= e(asset('images/' . $project['image'])) ?>" width="640" height="360" loading="lazy"
                                 alt="">
                        </a>
                        <div class="project-body">
                            <div class="project-meta">
                                <span class="tag"><?= e($project['category']) ?></span>
                                <?php if (!empty($project['placeholder'])): ?>
                                    <span class="tag tag-placeholder">Placeholder</span>
                                <?php endif; ?>
                            </div>
                            <h3><a href="project.php?slug=<?= e(rawurlencode($project['slug'])) ?>"><?= e($project['title']) ?></a></h3>
                            <p><?= e($project['summary']) ?></p>
                            <?php if (!empty($project['stack'])): ?>
                                <ul class="stack-list" aria-label="Tech stack">
                                    <?php foreach ($project['stack'] as $tech): ?>
                                        <li><?= e($tech) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="project-links">
                                <?php if ($project['repo'] !== ''): ?>
                                    <a href="<?= e($project['repo']) ?>" <?= external_attrs() ?>>
                                        <i class="fa-brands fa-github" aria-hidden="true"></i> GitHub
                                        <span class="visually-hidden">repository for <?= e($project['title']) ?></span></a>
                                <?php endif; ?>
                                <?php if ($project['demo'] !== ''): ?>
                                    <a href="<?= e($project['demo']) ?>" <?= external_attrs() ?>>
                                        <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i> Live demo
                                        <span class="visually-hidden">of <?= e($project['title']) ?></span></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- EDUCATION / EXPERIENCE -->
    <section class="section section-alt" id="experience" aria-labelledby="experience-title">
        <div class="container">
            <h2 id="experience-title">Education</h2>
            <p class="section-lead">Where I study.</p>

            <div class="timeline-groups">
                <?php foreach ($timelineGroups as $key => $label): ?>
                    <?php if (!empty($profile[$key])): ?>
                        <div class="timeline-group reveal">
                            <h3><?= e($label) ?></h3>
                            <ol class="timeline">
                                <?php foreach ($profile[$key] as $item): ?>
                                    <li class="timeline-item">
                                        <?php if ($item['period'] !== ''): ?><p class="timeline-period"><?= e($item['period']) ?></p><?php endif; ?>
                                        <h4><?= e($item['title']) ?></h4>
                                        <?php if ($item['place'] !== ''): ?><p class="timeline-place"><?= e($item['place']) ?></p><?php endif; ?>
                                        <?php if ($item['detail'] !== ''): ?><p><?= e($item['detail']) ?></p><?php endif; ?>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- CERTIFICATES -->
    <section class="section" id="certificates" aria-labelledby="certificates-title">
        <div class="container">
            <h2 id="certificates-title">Certificates</h2>
            <p class="section-lead">Seminars and trainings I have attended to keep learning.</p>

            <ul class="cert-grid">
                <?php foreach ($certificates as $cert): ?>
                    <?php
                    $certFile = $cert['image'] !== '' ? 'assets/images/certificates/' . $cert['image'] : '';
                    $hasImage = $certFile !== '' && is_file(ROOT_PATH . '/' . $certFile);
                    ?>
                    <li class="cert-card reveal">
                        <figure>
                            <?php if ($hasImage): ?>
                                <a class="cert-frame" href="<?= e($certFile) ?>" <?= external_attrs() ?>>
                                    <img src="<?= e($certFile) ?>" loading="lazy" alt="Certificate: <?= e($cert['title']) ?>">
                                    <span class="visually-hidden">(opens the full certificate)</span>
                                </a>
                            <?php else: ?>
                                <div class="cert-frame cert-empty" aria-hidden="true">
                                    <i class="fa-solid fa-certificate"></i>
                                </div>
                            <?php endif; ?>
                            <figcaption>
                                <span class="cert-title"><?= e($cert['title']) ?></span>
                                <?php if ($cert['type'] !== ''): ?><span class="cert-type"><?= e($cert['type']) ?></span><?php endif; ?>
                            </figcaption>
                        </figure>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <!-- CONTACT: direct contact details (no form or mail service required) -->
    <section class="section section-alt" id="contact" aria-labelledby="contact-title">
        <div class="container">
            <div class="contact-heading reveal">
                <h2 id="contact-title">Contact</h2>
                <p class="section-lead">Let's connect! You can reach me through email, phone, or my social profiles.</p>
            </div>
            <div class="contact-cards">
                <div class="contact-card reveal">
                    <span class="contact-card-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
                    <h3>Email</h3>
                    <a href="mailto:<?= e(config('site.email')) ?>"><?= e(config('site.email')) ?></a>
                </div>
                <div class="contact-card reveal">
                    <span class="contact-card-icon"><i class="fa-solid fa-phone" aria-hidden="true"></i></span>
                    <h3>Contact number</h3>
                    <?php $phone = (string) config('site.phone', ''); ?>
                    <?php if ($phone !== ''): ?>
                        <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', $phone)) ?>"><?= e($phone) ?></a>
                    <?php else: ?>
                        <p class="contact-placeholder">Add your number in <code>includes/config.php</code></p>
                    <?php endif; ?>
                </div>
                <div class="contact-card reveal">
                    <span class="contact-card-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
                    <h3>Location</h3>
                    <p><?= e(config('site.location')) ?></p>
                </div>
            </div>
            <div class="contact-social reveal">
                <h3>Find me online</h3>
                <div class="contact-social-links">
                    <?php foreach (social_links() as $link): ?>
                        <a href="<?= e($link['url']) ?>" <?= external_attrs() ?>>
                            <i class="<?= e($link['icon']) ?>" aria-hidden="true"></i>
                            <?= e($link['label']) ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

</main>
<?php require __DIR__ . '/includes/footer.php'; ?>
