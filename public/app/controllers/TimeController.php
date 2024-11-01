<?php

namespace app\controllers;

use app\database\models\Time;

class TimeController
{


    private $time;
    public function __construct()
    {
        $this->time = new Time;
    }


    public function index($request, $response, $args)
    {
        $times = $this->time->find();
        $response_str = json_encode($times);
        $response->getBody()->write($response_str);
        return $response;
    }

    public function adicionaTime($request, $response, $args)
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (is_array($input)) {
            $nome = $input['nome'] ?? 'Nome não fornecido';
            $estado = $input['estado'] ?? 'UF não fornecida';
        }

        $created = $this->time->create(['nome' => $nome, 'estado' => $estado]);
        if ($created) {
            $response_array = [
                'message' => 'Time cadastrado com sucesso'
            ];

            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
    }
    public function atualizaTime($request, $response, $args)
    {

        $id = $args['id'];
        $time = $this->time->findBy('id', $id);
        if (!$time) {
            $response_array = [
                'message' => 'Time não existe'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
        $input = json_decode(file_get_contents("php://input"), true);

        if (is_array($input)) {
            $nome = $input['nome'] ?? 'Nome não fornecido';
            $estado = $input['estado'] ?? 'UF não fornecida';
        }

        $updated = $this->time->update(['fields' => ['nome' => $nome, 'estado' => $estado], 'where' => ['id' => $id]]);
        if ($updated) {
            $response_array = [
                'message' => 'Time atualizado com sucesso'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }

        
        
    }
    public function removeTime($request, $response, $args)
    {
        $id = $args['id'];
        $time = $this->time->findBy('id', $id);
        if (!$time) {
            $response_array = [
                'message' => 'Time não existe'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
        $deleted = $this->time->delete('id', $id);
        if ($deleted) {
            $response_array = [
                'message' => 'Time deletado com sucesso'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
    }
}
