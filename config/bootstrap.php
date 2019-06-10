<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__) . '/vendor/autoload.php';

// Load cached env vars if the .env.local.php file exists
// Run "composer dump-env prod" to create it (requires symfony/flex >=1.2)
if (is_array($env = @include dirname(__DIR__) . '/.env.local.php')) {
    $_ENV += $env;
} elseif (!class_exists(Dotenv::class)) {
    throw new RuntimeException('Please run "composer require symfony/dotenv" to load the ".env" files configuring the application.');
} else {
    // load all the .env files
    (new Dotenv(false))->loadEnv(dirname(__DIR__) . '/.env');
}

$_SERVER += $_ENV;

foreach (['APP_ENV', 'APP_DEBUG'] as $environment) {
    $var_server = "SERVER_{$environment}";
    $var_env    = "ENV_{$environment}";
    
    $$var_server = isset($_SERVER[$environment]) ? $_SERVER[$environment] : null;
    $$var_env    = isset($_ENV[$environment]) ? $_ENV[$environment] : null;
}

$_SERVER['APP_ENV'] = $_ENV['APP_ENV'] = ($SERVER_APP_ENV ?? $ENV_APP_ENV ?? null) ?: 'dev';
$_SERVER['APP_DEBUG'] = $SERVER_APP_DEBUG ?? $ENV_APP_DEBUG ?? 'prod' !== $SERVER_APP_ENV;
$_SERVER['APP_DEBUG'] = $_ENV['APP_DEBUG'] = (int)$SERVER_APP_DEBUG || filter_var($SERVER_APP_DEBUG, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
