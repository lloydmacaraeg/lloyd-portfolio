<?php
/**
 * Bootstrap: loaded first by every page.
 * Defines paths, loads helpers and configuration, starts a hardened session.
 */
declare(strict_types=1);

define('ROOT_PATH', dirname(__DIR__));

require_once __DIR__ . '/functions.php';

load_env(ROOT_PATH . '/.env');

$GLOBALS['portfolio_config'] = require __DIR__ . '/config.php';

start_secure_session();
send_security_headers();
