<?php 

 /**
  * Classe de Persistencia do objeto Usuario
  * @access public
  * @version 1.0
  * @author Marlon Souza
  */
class DAOUsuario extends DAOAcessoBanco { 

    private static $objetoDAO   = null;
    private $tabelaDAO          = "USUARIO";
    private $sequence           = 'pk_id_usuario';
    private $objetoCriterio     = null;
    
    public static function getInstancia(){

        if( is_null(self::$objetoDAO) ){
            self::$objetoDAO = new self();
        }
        return self::$objetoDAO;
    }

    private function getConexaoBanco(){
        
        try {
            return parent::getObjetoConexao();
        } catch (ExcecoesSistema $exc) {
            throw new ExcecoesSistema( $exc->getMessage(), $exc->getCode() );
        }
    }

    public function setObjetoCriterio( $objeto = null ){
        $this->objetoCriterio = $objeto;
    }

    public function getObjetoCriterio(){
        return $this->objetoCriterio;
    }

    /**
     * @return VOUsuario
     * @throws ExcecoesSistema
     */
    public function consultarTodos(){
        
        $colecaoUsuarios    = array();
        $this->usuarios     = null;
        $query              = "SELECT * FROM {$this->tabelaDAO}";
        $rs                 = $this->getConexaoBanco()->queryAll( $query );
        
        //Excecao de sistema no caso de uma falha de execucao de query
        if ( PEAR::isError( $rs ) ){
            throw new ExcecoesSistema( $rs->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
        }
        
        //Listagem de Usuarios
        foreach ($rs as $usuario) {
            array_push($colecaoUsuarios, new VOUsuario($usuario['ID_USUARIO'], $usuario['NOME_USUARIO'], $usuario['EMAIL_USUARIO'], $usuario['TELEFONE']));
        }
        
        return $colecaoUsuarios;
    }
    
    /**
     * @return VOUsuario
     * @throws ExcecoesSistema
     */
    public function consultarPorId(){
        
        $query              = "SELECT * FROM {$this->tabelaDAO} WHERE id_usuario = {$this->objetoCriterio->getIdUsuario()}";
        $rs                 = $this->getConexaoBanco()->queryAll( $query );
        
        //Excecao de sistema no caso de uma falha de execucao de query
        if ( PEAR::isError( $rs ) ){
            throw new ExcecoesSistema( $rs->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
        }
        
        //Listagem de Usuarios
        foreach ($rs as $usuario) {
            $usuarioConsulta = new VOUsuario($usuario['ID_USUARIO'], $usuario['NOME_USUARIO'], $usuario['EMAIL_USUARIO'], $usuario['TELEFONE']);
        }
        
        return $usuarioConsulta;
    }
    
    /**
     * Metodo de insercao da Classe
     *
     * @access public
     * @return Boolean
     */
    public function inserir(){

        $campos         = 'id_usuario, nome_usuario, telefone, email_usuario';
        $stakeholders   = ':id, :nome, :telefone, :email';
        $tipos          = array('integer', 'text', 'text', 'text');
        $query          = "INSERT INTO {$this->tabelaDAO} ({$campos}) VALUES ({$stakeholders})";
        $objConexao     = $this->getObjetoConexao();
        $statement      = $objConexao->prepare( $query, $tipos, MDB2_PREPARE_MANIP );
                
        //Excecao de sistema no caso de uma falha ao se criar um 'prepared statement'
        if ( PEAR::isError( $statement ) ){
            throw new ExcecoesSistema( $statement->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_PREPARARQUERY_ );
            $statement->free();
        }
        
        //Cria a sequence do banco. Caso exista, retorna o proximo valor
        $pkUsuario  = $objConexao->nextID( $this->sequence );
        
        //Excecao de sistema no caso de uma falha de criacao da sequence
        if ( PEAR::isError( $pkUsuario ) ){
            throw new ExcecoesSistema( $pkUsuario->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROCRIASEQUENCE_ );
            $statement->free();
        }
        
        //Array com os dados que serao inseridos
        $usuarioVO  =   $this->objetoCriterio;
        $dados      =   array(  'id'        => $pkUsuario,
                                'nome'      => $usuarioVO->getNomeUsuario(), 
                                'telefone'  => $usuarioVO->getTelefoneUsuario(),
                                'email'     => $usuarioVO->getEmailUsuario(),
                        );
        
        //Executa a query preparada
        $rs = $statement->execute($dados);
        
        //Excecao de sistema no caso de uma falha de execucao de query
        if ( PEAR::isError( $rs ) ){
            throw new ExcecoesSistema( $rs->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
            $statement->free();
        }
        
        return $rs;
    }

    /**
     * Metodo de alteracao da Classe
     *
     * @access public
     * @return 
     */
    public function atualizar() {

        $campos         = 'nome_usuario=:nome, telefone=:telefone, email_usuario=:email';
        $tipos          = array('integer', 'text', 'text', 'text');
        $query          = "UPDATE {$this->tabelaDAO} SET {$campos} WHERE id_usuario=:id";
        $objConexao     = $this->getObjetoConexao();
        $statement      = $objConexao->prepare( $query, $tipos, MDB2_PREPARE_MANIP );
                
        //Excecao de sistema no caso de uma falha ao se criar um 'prepared statement'
        if ( PEAR::isError( $statement ) ){
            throw new ExcecoesSistema( $statement->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_PREPARARQUERY_ );
            $statement->free();
        }
        
        //Array com os dados que serao inseridos
        $usuarioVO  =   $this->objetoCriterio;
        $dados      =   array(  'id'        => $usuarioVO->getIdUsuario(),
                                'nome'      => $usuarioVO->getNomeUsuario(), 
                                'telefone'  => $usuarioVO->getTelefoneUsuario(),
                                'email'     => $usuarioVO->getEmailUsuario(),
                        );
        
        //Executa a query preparada
        $rs = $statement->execute($dados);
        
        //Excecao de sistema no caso de uma falha de execucao de query
        if ( PEAR::isError( $rs ) ){
            throw new ExcecoesSistema( $rs->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
            $statement->free();
        }
        
        return $rs;
    }

    /**
     * 
     * @param type $usuarioVO
     * @return type
     * @throws ExcecoesSistema
     */
    public function excluir(){

        $objetoConexao  = $this->getObjetoConexao();

        //Montagem da query
        $tabelaDelete   = $this->tabelaDAO;
        $queryDelete    = "DELETE FROM {$tabelaDelete} WHERE id_usuario = {$this->objetoCriterio->getIdUsuario()}";
        $rs             = $objetoConexao->exec( $queryDelete );

        //Excecao de sistema no caso de uma falha de execucao de query
        if ( PEAR::isError( $rs ) ){
            throw new ExcecoesSistema( $rs->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
        }
        
        return $rs;
    }

}
?>