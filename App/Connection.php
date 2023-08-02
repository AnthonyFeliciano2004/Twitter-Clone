<?php

namespace App;

class Connection {
    public static function getDb() {
        try {
            $conn = new \PDO(
                "mysql:host=localhost;dbname=twitter_clone",
                "root",
                ""
            );
            return $conn;
        } catch (\PDOException $e) {
            // Trate o erro de alguma forma adequada, como registrar em um arquivo de log ou exibir uma mensagem de erro
            echo 'Erro na conexão com o banco de dados: ' . $e->getMessage();
            //exit(); // Você pode escolher como lidar com o erro, encerrar a execução ou retornar um valor adequado dependendo do contexto
        }
    }
}


?>