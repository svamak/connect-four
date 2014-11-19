<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

$app->get('/hello/{name}', function ($name) use ($app) {
    return 'Hello '.$app->escape($name);
});

$app->get('/players.json', function () use ($app) {
    return json_encode((new \ConnectFour\Player\PlayerFinder())->getAvailablePlayers());
});

$app->post('/game.json', function (\Symfony\Component\HttpFoundation\Request $request) use ($app) {
    $opponent = $request->get('opponent', null);
    $move = $request->get('move', null);
    $grid = $request->get('grid', null);

    $opponent = \ConnectFour\Player\Factory\PlayerFactory::createPlayer($opponent);
    $singlePlayer = new \ConnectFour\Player\SingleMovePlayer((int)$move);
    $grid = new \ConnectFour\Game\Grid($grid);

    $game = new \ConnectFour\Game(
        isset($move) ? $singlePlayer : null,
        $opponent,
        $grid
    );

    try {
        $game->move();
        return json_encode(['grid' => $grid]);
    } catch (\ConnectFour\Game\Exception\WinnerException $ex) {
        $decision = $ex->getDisk() == \ConnectFour\Game\Grid::DISK_PLAYER_1;
        return json_encode(['message' => $decision ? 'Congratulations!' : 'Try next time']);
    }

});

$app->run();
