<?php

use app\controllers\HomeController;
use app\database\models\Jogador;
use app\database\models\Time;
use app\migrations\JogadorMigrations;
use app\migrations\TimeMigrations;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as Capsule;
require_once __DIR__ . '/../vendor/autoload.php';

$capsule = new Capsule();
$config = [
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "banco1",
    "username" => "root",
    "password" => ""
];
$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$jogadores = new Jogador();
$times = new Time();

$times->nome = "Avai";
$times->estado = "Santa Catarina";
$times->save();

$jogadores->nome = "Ronaldo";
$jogadores->posicao = "Atacante";
$jogadores->id_time = 1;
$jogadores->save();

$app = AppFactory::create();

require '../app/routes/api.php';


$app->run();