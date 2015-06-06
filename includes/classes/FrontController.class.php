<?php

class FrontController {

    private $controller;
    private $view;
    private $tarefa;
    private $header  = 'extras/header.php';
    private $footer  = 'extras/footer.php';
                
    public function __construct( $tarefa = null ) {

        //Recebe a tarefa e procede com a escolha das camadas
        $this->tarefa = $tarefa;
        
        if ( !is_null($tarefa) ){

            $tarefaAcao = explode('.', $tarefa);
            
            if( !isset($tarefaAcao[1]) or is_null($tarefaAcao[1]) or empty(trim($tarefaAcao[1])) ){
                throw new ExcecoesSistema('Opcao invalida do sistema', null );
            }
            
            switch ($tarefaAcao[0]) {

                case "usuario":
                    $daoUsuario         = DAOUsuario::getInstancia(); //Model
                    $this->controller   = new UsuarioController($daoUsuario); //Controller
                    $this->view         = new UsuarioView($daoUsuario, $this->controller); //View
                break;
            }
            
            //Configura a acao do controlador escolhido
            $this->controller->setTarefaControlador($tarefaAcao[1]);
            $this->controller->$tarefaAcao[1]( $_REQUEST );
        }
    }

    protected function index(){
        
        require_once($this->header);
        require_once($this->footer);
    }

        //Imprime o resultado baseado na view passada ao FrontController
    public function escreveSaida() {
        
        if( !is_null($this->tarefa) ){
            
            require_once($this->header);
                print $this->view->imprime();
            require_once($this->footer); 
            
        }else{
            $this->index();
        }
    }
}
?>