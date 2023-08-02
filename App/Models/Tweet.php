<?php
namespace App\Models;

use MF\Model\Model;

class Tweet extends Model{
    private $id;
    private $id_usuario;
    private $tweet;
    private $data;

    public function __set($atr, $vlr){
        $this->$atr = $vlr;
    }

    public function __get($vlr){
        return $this->$vlr;
    }

    //Salvar Tweets (Create)
    public function Salvar(){
        $query = 'INSERT INTO TB_TWEETS (ID_USUARIO, TWEET)
            VALUES (:id_usuario, :tweet)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->bindValue(':tweet', $this->__get('tweet'));
        $stmt->execute();
        return $this;
    }

    //Recuperar Tweets (Read)
    public function Recuperar(){
        $query = "SELECT A.ID, A.ID_USUARIO, A.TWEET, DATE_FORMAT(A.DATA, '%d/%m/%y %H:%i') AS DATA, B.NOME, B.EMAIL
            FROM TB_TWEETS A
            LEFT JOIN TB_USUARIO B ON (A.ID_USUARIO = B.ID)
            WHERE (ID_USUARIO = :id_usuario
            OR A.ID_USUARIO IN (SELECT USUARIO_ALVO FROM TB_RELACAOUSUARIO WHERE USUARIO_ORIGEM = :id_usuario))
            ORDER BY A.DATA DESC";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    //Deletar Tweets (Delete)
    public function removerTweet(){
        $query='DELETE FROM TB_TWEETS 
                WHERE ID = :id_tweet
                AND ID_USUARIO = :id_usuario;';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_tweet', $this->__get('id'));
        $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
        $stmt->execute();
        return $this;
    }
}

?>