<?php
namespace MF\Controller;

abstract class Action{
    protected $view;

    public function __construct(){
        $this->view = new \stdClass();
    }
    protected function render($view, $layout = 'layout'){
        $this->view->page = $view;
        if(file_exists('../App/Views/'.$layout.'.php ')){
            require_once '../App/Views/'.$layout.'.php ';
        } else {
            $this->content();        
        }
}
    protected function content(){
        $class_atual = get_class($this);
        $class_atual = str_replace('App\\Controllers\\', '', $class_atual);
        $class_atual = strtolower(str_replace('Controller', '', $class_atual));
        
        require_once '../App/Views/'.$class_atual.'/'.$this->view->page.'.php';
    }
    }

?>