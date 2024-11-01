<?php

namespace app\controllers;

class HomeController {

    public function index($request,$response){
        $response_array=[
            'message'=> 'Bem vindo a ApiTimes'
        ];
    
        $response_str= json_encode($response_array);
        $response->getBody()->write($response_str);
        return $response;
    }

}