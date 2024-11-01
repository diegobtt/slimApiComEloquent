<?php

namespace app\database\models;

use app\database\Connection;
use PDOException;

class Time extends Base{

    protected $table='time';

    public function findJogadoresByTime($id){
        try {
            $prepared = $this->connection->prepare("SELECT jogador.*, time.nome AS nome_time FROM jogador INNER JOIN time ON jogador.id_time = time.id where time.id = $id;");
            $prepared->execute();
            return $prepared->fetchAll();
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}