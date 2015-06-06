<?php
require_once 'MDB2.php';
require_once 'conf/parametrosBanco.conf.php';
/**
* Classe concentradora de acesso ao banco de dados
*
* @author Marlon Souza
* @abstract
* @uses MDB2
* @version 1.0
*/
abstract class DAOAcessoBanco extends ExcecoesSistema implements InterfaceBanco {

	/**
	 * @access private
	 * @var String Driver do Banco utiliazada para conectar-se [e.g Oracle: oci8; Postgres: pgsql; MySql: mysql; ODBC: odbc]
	 */
	private $dbDriverName = _DB_DRIVER_NAME_;

	/**
	 * @access private
	 * @var String Endereco onde o banco de dados se localiza [e.g localhost]
	 */
	private $dbHostName = _DB_HOST_NAME_;

	/**
	 * @access private
	 * @var String Usuario de acesso ao banco
	 */
	private $dbUserName = _DB_USER_NAME_;

	/**
	 * @access private
	 * @var String Senha de acesso ao banco de dados
	 */
	private $dbPassword = _DB_PASSWORD_;

	/**
	 * @access private
	 * @var String Nome da base de dados
	 */
	private $dbDatabaseName	= _DB_DATABASE_NAME_;

	/**
	 * @access private
	 * @var int Inteiro que representa a porta de conexao com o banco de dados
	 */
	private $dbPortNumber = _DB_PORT_NUMBER_;

        /**
         * @access private
         * @var array Opcoes de configuracao do SGBD
         */
        private $dbOptions = array( 
                                    'field_case'       => CASE_UPPER, 
                                    'use_transactions' => true,
                                    'portability'      => MDB2_PORTABILITY_ALL,
                                    'result_buffering' => 60000
                            );
	/**
	 * Objeto de conexao do banco de dados
	 * @access static
	 * @var Object
	 */
	private static $dbObjetoConexao	= null;

	/**
	 * DSN (Data Source Name), string de conexao com o banco formada por todos os parametros de acesso
	 * @access private
	 * @var String
	 */
	private $dbStringConexao = "";

	/**
	 * Retorna o objeto de conexao com o banco de dados
	 *
	 * @return resource
	 */
        protected function getObjetoConexao(){

            if (is_null(self::$dbObjetoConexao))
                $this->conectaBanco();

            return self::$dbObjetoConexao;
	}

	/**
	 * Monta a String de Conexao com o Banco de dados, retornando-a formatada
	 * @return String
	 */
	private function montarStringConexao(){
            $dsn =  "{$this->dbDriverName}://".
                    "{$this->dbUserName}:".
                    "{$this->dbPassword}@".
                    "{$this->dbHostName}:".
                    "{$this->dbPortNumber}/".
                    "{$this->dbDatabaseName}";

            return $dsn;
	}

        /**
	 * Metodo de conexao com a Banco de Dados
	 * @access private
         * @return void Realiza a conexao com a base de dados especificado.
	 */
	private function conectaBanco(){

		$this->dbStringConexao = $this->montarStringConexao();
		self::$dbObjetoConexao =& MDB2::connect( $this->dbStringConexao, $this->dbOptions );
                
		if( PEAR::isError( self::$dbObjetoConexao ) ){
                    throw new ExcecoesSistema( self::$dbObjetoConexao->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_CONEXAO_BANCO_ );
		}

                self::$dbObjetoConexao->setFetchMode(MDB2_FETCHMODE_ASSOC);
	}
        
        /**
         * Retorna o SGBD que esta sendo utilizado
         * @return String
         * @throws ExcecoesSistema
         */
        public function retornaSGBD(){
            
            $retorno = null;
            $rsVersao = $this->getObjetoConexao()->queryAll('SELECT version()', false, MDB2_FETCHMODE_ORDERED);
            
            if( PEAR::isError($rsVersao)  ){
                throw new ExcecoesSistema( $rsVersao->getUserInfo(), ExcecoesSistema::_CODIGO_EXCECAO_ERROQUERY_ );
            }else{
                $retorno = $rsVersao[0][0];
            }
            return $retorno;
        }
}
?>