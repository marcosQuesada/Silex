<?php

use Silex\Application;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Core\Services\DBAL;

$app = new Application();

//Load global configuration
try {
    $configurator = Yaml::Parse( __DIR__ . '/../../app/config.yml');
    $app['debug'] = true;
    $app['config'] = $configurator;
} catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s", $e->getMessage());
}

//initiate DBAL service
$DBAL = new DBAL($configurator);
$app['DBAL'] = $DBAL->getConnection();

return $app;
