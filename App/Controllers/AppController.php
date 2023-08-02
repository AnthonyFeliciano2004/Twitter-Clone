<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
    
    public function timeline(){
        $this->validaUsuario();
        //Instacia o objeto
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id', $_SESSION['id']);
        //Busca os Tweet do banco de dados
        $tweets = $tweet->Recuperar();
        $this->view->tweets = $tweets;

        $usuario = Container::getModel('Usuario');
         $usuario->__set('id', $_SESSION['id']);
        
        $this->view->informacoes_usuario = $usuario->getInformacoesUsuario();
        $this->render('timeline');
    }

    public function tweet(){
        $this->validaUsuario();
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_usuario', $_SESSION['id']);
        $tweet->__set('tweet', $_POST['tweet']);
        $tweet->Salvar();
        header('Location: /timeline');             
    } 
    public function quemSeguir(){
        $this->validaUsuario();
        
        $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
        $usuarios = array();
        if($pesquisa != ''){
            $usuario = Container::getModel('Usuario');
            $usuario->__set('nome', $pesquisa);
            $usuario->__set('id', $_SESSION['id']);
            $usuarios = $usuario->pesquisaUsuario();
            
        } 
        $usuario = Container::getModel('Usuario');
        $usuario->__set('id', $_SESSION['id']);
        $this->view->informacoes_usuario = $usuario->getInformacoesUsuario();
        $this->view->usuarios = $usuarios;
        $this->render('quemSeguir');
    }

    public function validaUsuario(){
        session_start();
        if (!isset($_SESSION['id']) || $_SESSION['id'] == '' || !isset($_SESSION['nome']) || $_SESSION['id']== ''){
            header('Location: /?login=erro');
        }
    }
    public function acaoUsuario(){
        $this->validaUsuario();
        
        $acao = isset($_GET['acao']) ? $_GET['acao'] : '';
        $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';

        $usuario = Container::getModel('Usuario');
        $usuario->__set('id',$_SESSION['id']);

        if($acao == 'seguir'){
            $usuario->seguirUsuario($id_usuario);
            header('Location: /quemSeguir');
            
        } else if($acao == 'deixar_de_seguir'){
            $usuario->deixarDeSeguir($id_usuario);
            header('Location: /quemSeguir');
        }         
    }
    public function removerTweet() {
        $this->validaUsuario();
        $tweet = Container::getModel('Tweet');
        $tweet->__set('id_usuario', $_POST['id_usuario']);
        $tweet->__set('id', $_POST['id_tweet']);
        $tweet->removerTweet();
        header('Location: /timeline');       
    }
    
}

?>