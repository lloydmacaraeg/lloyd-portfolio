<?php
/**
 * Small, dependency-free helpers shared across the site.
 */
declare(strict_types=1);

/** Escape a value for safe HTML output. Use for every dynamic value. */
function e(string|int|float|null $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/** Load KEY=VALUE pairs from a local .env file (optional; real env vars win). */
function load_env(string $path): void
{
    if (!is_readable($path)) {
        return;
    }
    foreach (file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) ?: [] as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#' || !str_contains($line, '=')) {
            continue;
        }
        [$key, $value] = array_map('trim', explode('=', $line, 2));
        $value = trim($value, "\"'");
        if ($key !== '' && getenv($key) === false) {
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

/** Read an environment variable, with a default. */
function env(string $key, ?string $default = null): ?string
{
    $value = getenv($key);
    return ($value === false || $value === '') ? $default : $value;
}

/** Read a config value using dot notation, e.g. config('site.name'). */
function config(string $key, mixed $default = null): mixed
{
    $value = $GLOBALS['portfolio_config'] ?? [];
    foreach (explode('.', $key) as $part) {
        if (!is_array($value) || !array_key_exists($part, $value)) {
            return $default;
        }
        $value = $value[$part];
    }
    return $value;
}

function is_https(): bool
{
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https');
}

function start_secure_session(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }
    session_set_cookie_params([
        'lifetime' => 0,
        'path'     => '/',
        'secure'   => is_https(),
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_name('portfolio_session');
    session_start();
}

function send_security_headers(): void
{
    if (headers_sent()) {
        return;
    }
    header('X-Content-Type-Options: nosniff');
    header('X-Frame-Options: SAMEORIGIN');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header('Permissions-Policy: camera=(), microphone=(), geolocation=()');
}

/** CSRF: one token per session, compared in constant time. */
function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_is_valid(?string $submitted): bool
{
    return is_string($submitted)
        && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $submitted);
}

/** One-time messages stored in the session (used by the contact form). */
function flash_set(string $key, mixed $value): void
{
    $_SESSION['flash'][$key] = $value;
}

function flash_get(string $key): mixed
{
    $value = $_SESSION['flash'][$key] ?? null;
    unset($_SESSION['flash'][$key]);
    return $value;
}

/** Attributes for every external link. */
function external_attrs(): string
{
    return 'target="_blank" rel="noopener noreferrer"';
}

/** URL for a static asset with a cache-busting version based on file time. */
function asset(string $path): string
{
    $file = ROOT_PATH . '/assets/' . $path;
    $version = is_file($file) ? (string) filemtime($file) : '1';
    return 'assets/' . $path . '?v=' . $version;
}

function redirect(string $location): never
{
    header('Location: ' . $location, true, 303);
    exit;
}

/** Find a project by slug in the projects array, or null. */
function find_project(array $projects, string $slug): ?array
{
    foreach ($projects as $project) {
        if ($project['slug'] === $slug) {
            return $project;
        }
    }
    return null;
}

/** Strip control characters (keeps newlines/tabs when $multiline is true). */
function clean_text(string $value, bool $multiline = false): string
{
    $value = str_replace("\r\n", "\n", $value);
    $pattern = $multiline ? '/[^\P{C}\n\t]+/u' : '/\p{C}+/u';
    $value = preg_replace($pattern, '', $value) ?? '';
    return trim($value);
}

/** Character count that works even when the mbstring extension is missing. */
function text_length(string $value): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($value, 'UTF-8')
        : (int) preg_match_all('/./su', $value);
}

/** Social links that have a URL, as [['label','icon','url'], ...]. */
function social_links(): array
{
    $links = [];
    foreach ((array) config('social', []) as $item) {
        if (is_array($item) && !empty($item['url'])) {
            $links[] = $item;
        }
    }
    return $links;
}
