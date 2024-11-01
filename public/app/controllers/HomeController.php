<?php

namespace app\controllers;

use app\database\models\Jogador;

class HomeController {

    public function index($request,$response){
        
        $response_array=[];
        $jogadores = Jogador::where('id_time', '1')->get();

        foreach ($jogadores as $jogador) {
            array_push($response_array,$jogador->nome);
        }

        
        
    
        $response_str= json_encode($response_array);
        $response->getBody()->write($response_str);
        return $response;
    }

}