<?php

use app\controllers\HomeController;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Factory\AppFactory;

require_once __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

require '../app/routes/api.php';

// Exemplo de middleware para CORS
$app->add(function ($request, $handler) {
    // Permitir todos os domínios e métodos HTTP
    $response = new \Slim\Psr7\Response();
    $response = $response->withHeader('Access-Control-Allow-Origin', '*')
                         ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                         ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');

    // Verifique se a requisição é do tipo OPTIONS
    if ($request->getMethod() === 'OPTIONS') {
        return $response;
    }

    // Continue o processamento da requisição
    $response = $handler->handle($request);

    // Retorne a resposta com os cabeçalhos de CORS
    return $response->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
});


$app->run();