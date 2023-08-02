<?php
namespace App\Models;

use MF\Model\Model;

class Usuario extends Model{
    private $id = null;
    private $nome = null;
    private $email = null;
    private $senha = null;

    public function __set($atrr, $vlr){
        $this->$atrr = $vlr; 
    }

    public function __get($vlr){
        return $this->$vlr;

    }

    //Salvar usuario no banco 
    public function salvar(){
        $query ='INSERT INTO TB_USUARIO (NOME, EMAIL, SENHA)
        VALUES (:nome, :email, :senha)';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':nome', $this->__get('nome'));
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        return $this;
    }

    //Validar se o cadastro pode ser realzado
    public function validaCadastro(){
        $valida = true;
        if(strlen($this->__get('nome'))< 3){
            $valida = false;
        }
        if (strlen($this->__get('email'))< 3){
            $valida = false;
        }
        if(strlen($this->__get('senha'))<3){
            $valida = false;
        }

        return $valida;
    }

    //Recuperar um usuario por e-mail
    public function getUsuarioPorEmail(){
        $query = 'SELECT NOME, EMAIL, SENHA 
                    FROM TB_USUARIO 
                    WHERE EMAIL = :email';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function autenticar(){
        $query = 'SELECT ID, NOME, EMAIL 
                    FROM TB_USUARIO 
                        WHERE EMAIL = :email 
                        AND SENHA = :senha';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($usuario['ID'] != '' && $usuario['NOME'] != '' ) {
            $this->__set('id', $usuario['ID']);
            $this->__set('nome', $usuario['NOME']);
        }
        return $this;
    }

    public function pesquisaUsuario(){
        $query = "SELECT  A.ID, A.NOME, A.EMAIL,
        (SELECT COUNT(*) FROM TB_RELACAOUSUARIO B
        WHERE B.USUARIO_ORIGEM = :usuarioAtual
        AND B.USUARIO_ALVO = A.ID) AS SEGUINDO_SN
                    FROM TB_USUARIO A
                    WHERE (A.NOME LIKE :valor 
                    OR  A.EMAIL LIKE :valor)
                    AND A.ID <> :usuarioAtual";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':valor', '%'.$this->__get('nome').'%');
        $stmt->bindValue(':usuarioAtual', $this->__get('id'));
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function seguirUsuario($id_usuario){
        $query = "INSERT INTO TB_RELACAOUSUARIO(USUARIO_ALVO, USUARIO_ORIGEM)
            VALUES(:usuario_alvo, :usuario_origem)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':usuario_alvo', $id_usuario);
        $stmt->bindValue(':usuario_origem', $this->__get('id'));
        $stmt->execute();
        return true;
    }

    public function deixarDeSeguir($id_usuario){
        $query = 'DELETE FROM TB_RELACAOUSUARIO
                WHERE USUARIO_ALVO = :usuario_alvo
                AND USUARIO_ORIGEM = :usuario_origem';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':usuario_alvo', $id_usuario);
        $stmt->bindValue(':usuario_origem', $this->__get('id'));
        $stmt->execute();
        return true;
    }
    
    public function getInformacoesUsuario(){
        $query = 'SELECT 

        (SELECT COUNT(*)
            FROM TB_TWEETS 
            WHERE ID_USUARIO = :id_usuario) AS TOTAL_TWEETES
            
        ,(SELECT COUNT(*)
            FROM TB_RELACAOUSUARIO
            WHERE USUARIO_ORIGEM = :id_usuario) AS TOTAL_SEGUINDO
            
        ,(SELECT COUNT(*)
            FROM TB_RELACAOUSUARIO
            WHERE USUARIO_ALVO = :id_usuario) AS TOTAL_SEGUIDORES
             
        ,(SELECT NOME 
  	        FROM TB_USUARIO
  	        WHERE ID = :id_usuario) AS USUARIO';

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id_usuario', $this->__get('id'));
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}

?>