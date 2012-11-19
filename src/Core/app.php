<?php

use Silex\Application;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

$app = new Application();

//Load global configuration
try {
    $configurator = Yaml::Parse( __DIR__ . '/../../app/config.yml');
    $app['config'] = $configurator;
} catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s", $e->getMessage());
}

return $app;
