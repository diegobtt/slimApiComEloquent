<?php

use app\controllers\HomeController;
use app\controllers\JogadorController;
use app\controllers\TimeController;

$app->get('/',HomeController::class . ':index');


$app->get('/jogador',JogadorController::class . ':index');
$app->post('/jogador',JogadorController::class . ':adicionaJogador');
$app->put('/jogador/{id}',JogadorController::class . ':atualizaJogador');
$app->delete('/jogador/{id}',JogadorController::class . ':removeJogador');

$app->get('/time',TimeController::class . ':index');
$app->post('/time',TimeController::class . ':adicionaTime');
$app->put('/time/{id}',TimeController::class . ':atualizaTime');
$app->delete('/time/{id}',TimeController::class . ':removeTime');
