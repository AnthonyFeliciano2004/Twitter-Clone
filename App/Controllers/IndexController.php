<?php

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

use App\Models\Usuario;

class IndexController extends Action {

	public function index() {
		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse(){
		/*$this->view->usuario = array('nome' => '',
		'email' => '',
		'senha' => '');*/
		$this->view->falhaCadastro = false;
		$this->render('inscreverse');
	}

	public function registrar(){
		$usuario = Container::getModel('Usuario');
		$usuario->__set('nome', $_POST['nome']);
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));

		//sucesso
		if($usuario->validaCadastro() == true && count($usuario->getUsuarioPorEmail()) == 0 ){
			$usuario->salvar();
			$this->render('cadastro');
		}
		//erro
		else{
			$this->view->usuario = array('nome' => $_POST['nome'],
			'email' => $_POST['email'],
			'senha' => $_POST['senha']);
			$this->view->falhaCadastro = true;
			$this->render('inscreverse');
		}
	}
}


?>