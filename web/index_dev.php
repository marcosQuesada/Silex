<?php
require_once __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(-1);
//DebugClassLoader::enable();

if ('cli' !== php_sapi_name()) {
    //ExceptionHandler::register();
}

$app = require_once __DIR__.'/../src/Core/app.php';
require_once __DIR__.'/../src/Core/controller.php';

$app->run();

