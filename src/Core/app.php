<?php

use Silex\Application;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;
use Core\Services\DBAL;

$app = new Application();

//Load global configuration
$app['debug'] = true;

//parse config.yml
try {
    $configurator = Yaml::Parse( __DIR__ . '/../../app/config.yml');

    $app['db.options'] = $configurator['database'];


} catch (ParseException $e) {
    printf("Unable to parse the YAML string: %s", $e->getMessage());
}

$app->register(new Silex\Provider\DoctrineServiceProvider());

return $app;
