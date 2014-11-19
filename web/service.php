<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/players.json', function () use ($app) {
    return json_encode((new \ConnectFour\Player\PlayerFinder())->getAvailablePlayers());
});

$app->run();
