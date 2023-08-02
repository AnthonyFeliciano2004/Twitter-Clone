<?php

namespace App;
use MF\Init\Bootstrap;

class Route extends Bootstrap{
    
    public function initRoutes(){
        $route['home'] = array(
            'route' => '/',
            'controller' => 'indexController',
            'action' => 'index'
        );

        $route['inscreverse'] = array(
            'route' => '/inscreverse',
            'controller' => 'indexController',
            'action' => 'inscreverse'
        );

        $route['registrar'] = array(
            'route' => '/registrar',
            'controller' => 'indexController',
            'action' => 'registrar'
        );

        $route['autenticar'] = array(
            'route' => '/autenticar',
            'controller' => 'authController',
            'action' => 'autenticar'
        );

       $route['timeline'] = array(
            'route' => '/timeline',
            'controller' => 'AppController',
            'action' => 'timeline'
        );
        $route['sair'] = array(
            'route' => '/sair',
            'controller' => 'AuthController',
            'action' => 'sair'
        );
        $route['tweet'] = array(
            'route' => '/tweet',
            'controller' => 'AppController',
            'action' => 'tweet'
        );
        $route['quemSeguir'] = array(
            'route' => '/quemSeguir',
            'controller' => 'AppController',
            'action' => 'quemSeguir'
        );
        $route['acao'] = array(
            'route' => '/quemSeguir',
            'controller' => 'AppController',
            'action' => 'acaoUsuario'
        );
        $route['removerTweet'] = array(
            'route' => '/removerTweet',
            'controller' => 'AppController',
            'action' => 'removerTweet'
        );




    $this->setRoute($route);
    }

  
}
?>