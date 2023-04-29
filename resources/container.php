<?php

use Fusio\Adapter\Hadoop\Connection\Hive;
use Fusio\Adapter\Hadoop\Connection\Impala;
use Fusio\Engine\Adapter\ServiceBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container) {
    $services = ServiceBuilder::build($container);
    $services->set(Hive::class);
    $services->set(Impala::class);
};
