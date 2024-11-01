<?php

namespace app\controllers;

use app\database\models\Jogador;

class JogadorController
{


    private $jogador;
    public function __construct()
    {
        $this->jogador = new Jogador;
    }


    public function index($request, $response, $args)
    {
        $jogadores = $this->jogador->find();
        $response_str = json_encode($jogadores);
        $response->getBody()->write($response_str);
        return $response;
    }

    public function adicionaJogador($request, $response, $args)
    {
        $input = json_decode(file_get_contents("php://input"), true);

        if (is_array($input)) {
            $nome = $input['nome'] ?? 'Nome não fornecido';
            $posicao = $input['posicao'] ?? 'Posicao não fornecida';
            $time_id = $input['time_id'] ?? 1;
        }

        $created = $this->jogador->create(['nome' => $nome, 'posicao' => $posicao, 'id_time' => $time_id]);
        if ($created) {
            $response_array = [
                'message' => 'Jogador cadastrado com sucesso'
            ];

            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
    }
    public function atualizaJogador($request, $response, $args)
    {

        $id = $args['id'];
        $jogador = $this->jogador->findBy('id', $id);
        if (!$jogador) {
            $response_array = [
                'message' => 'Jogador não existe'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
        $input = json_decode(file_get_contents("php://input"), true);

        if (is_array($input)) {
            $nome = $input['nome'] ?? 'Nome não fornecido';
            $posicao = $input['posicao'] ?? 'Posicao não fornecida';
            $time_id = $input['time_id'] ?? 1;
        }

        $updated = $this->jogador->update(['fields' => ['nome' => $nome, 'posicao' => $posicao, 'id_time' => $time_id], 'where' => ['id' => $id]]);
        if ($updated) {
            $response_array = [
                'message' => 'Jogador atualizado com sucesso'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }

        
        
    }
    public function removeJogador($request, $response, $args)
    {
        $id = $args['id'];
        $jogador = $this->jogador->findBy('id', $id);
        if (!$jogador) {
            $response_array = [
                'message' => 'Jogador não existe'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
        $deleted = $this->jogador->delete('id', $id);
        if ($deleted) {
            $response_array = [
                'message' => 'Jogador deletado com sucesso'
            ];
            $response_str = json_encode($response_array);
            $response->getBody()->write($response_str);
            return $response;
        }
    }
}
