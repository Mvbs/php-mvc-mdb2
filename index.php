<?php 
    require_once 'conf/autoLoader.php';
    require_once 'conf/conf.php';

    require_once("/extras/header.php");
    //Criacao do FrontController como concentrador das acoes do sistema
    try {
        //Acao do usuario
        $tarefa          = $_GET['tarefa'];
        $frontController = new FrontController( $tarefa );
        $frontController->escreveSaida();
        
    } catch (ExcecoesSistema $e) {
        print $e->aferrolharMensagemDeErro();
    }
    require_once("/extras/footer.php");
?>