<?php

//Controller
class UsuarioController{
	
        private $model;
        private $tarefa = null;
        
        /**
         * 
         * @param type $dao
         */
	public function __construct( $model ) {
            $this->model    = $model;
	}
	
        public function redirect($location) {
            header('Location: '.$location);
        }
        
        public function getTarefaControlador(){
            return $this->tarefa;
        }
        
        public function setTarefaControlador($acao){
            $this->tarefa = $acao;
        }

        public function inserir( $requisicao ){
            
            try {
                
                $objetoCriterio = new VOUsuario(null, $requisicao['nome_usuario'], $requisicao['email_usuario'], $requisicao['telefone_usuario']);
                $this->model->setObjetoCriterio( $objetoCriterio );
                $retornoFuncao      = $this->model->inserir();
                
                if( $retornoFuncao == 0 ){
                    throw new ExcecoesSistema( "Erro no cadastro. Nenhum dado foi INSERIDO.", null );
                }
            } catch (ExcecoesSistema $e) {
                
                throw new ExcecoesSistema( $e->getMessage(), $e->getCode() );
            }
            $this->redirect( 'index.php?tarefa=usuario.listagem' );
        }
        
        public function atualizar( $requisicao ) {
            
            try {
                
                $objetoCriterio = new VOUsuario( $requisicao['id_usuario'], $requisicao['nome_usuario'], $requisicao['email_usuario'], $requisicao['telefone_usuario'] );
                $this->model->setObjetoCriterio( $objetoCriterio );
                $retornoFuncao = $this->model->atualizar();
                
            } catch (ExcecoesSistema $e) {
                throw new ExcecoesSistema( $e->getMessage(), $e->getCode() );
            }

            if( $retornoFuncao == 0 ){
                throw new ExcecoesSistema( "Erro no cadastro. Nenhum dado foi ATUALIZADO.", null );
            }
            $this->redirect( 'index.php?tarefa=usuario.listagem' );
        }
        
        public function excluir( $requisicao ) {

            try {
                
                $objetoCriterio = new VOUsuario( $requisicao['id'] );
                $this->model->setObjetoCriterio( $objetoCriterio );
                $retornoFuncao = $this->model->excluir();
                
            } catch (ExcecoesSistema $e) {
                throw new ExcecoesSistema( $e->getMessage(), $e->getCode() );
            }

            if( $retornoFuncao == 0 ){
                throw new ExcecoesSistema( "Erro no cadastro. Nenhum dado foi EXCLUIDO.", null );
            }

            $this->redirect( 'index.php?tarefa=usuario.listagem' );
        }
        
        public function listagem( $requisicao ){/**/}
        public function montagemCadastro( $requisicao ){/**/}
        
        public function editar( $requisicao ) {
            $objetoCriterio = new VOUsuario( $requisicao['id'] );
            $this->model->setObjetoCriterio( $objetoCriterio );
        }
}

?>
