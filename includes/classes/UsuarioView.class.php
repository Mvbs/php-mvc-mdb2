<?php

//View 
class UsuarioView {
	
        private $model;
        private $controller;
        private $template;
        private $caminhoTemplates = '/views/usuario';
        private $colecaoTemplates = array();
        
        public function __construct(DAOUsuario $daoUsuario, UsuarioController $controller ) {
            
            $this->model        = $daoUsuario;
            $this->controller   = $controller;
	}

        /**
         * 
         * @param type $acao
         * @return type
         */
        private function getTemplate( $acao ){
            
            switch ($acao) {
                case 'listagem':
                    $this->colecaoTemplates =   array( 'listagem'  =>  array( 
                                                                            'caminho'   =>  "{$this->caminhoTemplates}/listagemUsuarios.php",
                                                                            'variaveis' =>  array(
                                                                                                'versaoSGBD'        => $this->model->retornaSGBD(),
                                                                                                'colecaoUsuarios'   => $this->model->consultarTodos()
                                                                                            )
                                                                       )
                                                );
                break;
                case 'montagemCadastro':
                    $this->colecaoTemplates =   array( 'montagemCadastro'   =>  array( 
                                                                                    'caminho'   =>  "{$this->caminhoTemplates}/formCadastroUsuarios.php",
                                                                                    'variaveis' =>  array()
                                                                                )
                                                );
                break;
                case 'excluir':
                    $this->colecaoTemplates =   array( 'excluir'    =>  array( 
                                                                            'caminho'   =>  "{$this->caminhoTemplates}/listagemUsuarios.php",
                                                                            'variaveis' =>  array()
                                                                        )
                                                );
                break;
                case 'editar':
                    $this->colecaoTemplates =   array( 'editar'    =>  array( 
                                                                            'caminho'   =>  "{$this->caminhoTemplates}/formCadastroUsuarios.php",
                                                                            'variaveis' =>  array(
                                                                                                'usuarioAlteracao'  => $this->model->consultarPorId()
                                                                                            )
                                                                        )
                                        );
                break;
                case 'atualizar':
                    $this->colecaoTemplates =   array( 'atualizar'    =>  array( 
                                                                            'caminho'   =>  "{$this->caminhoTemplates}/listagemUsuarios.php",
                                                                            'variaveis' =>  array()
                                                                        )
                                        );
                break;
            }
            
            //Seleciona quais as opcoes da acao da view
            $this->template = new Template( $this->colecaoTemplates[$acao]['caminho']  );
            $this->template->carregaVariaveisTemplate($this->colecaoTemplates[$acao]['variaveis']);
            return $this->template;
        }
        
        /**
         * Funcao para renderizar a view escolhida pela acao do usuario
         */
        public function imprime() {
            
            try {
                $templateView = $this->getTemplate( $this->controller->getTarefaControlador() );
                $templateView->renderiza();
            } catch (ExcecoesSistema $e) {
                echo $e->aferrolharMensagemDeErro();
            }
	}
}

?>