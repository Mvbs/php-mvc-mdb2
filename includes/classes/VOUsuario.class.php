<?php

/**
 * Classe Basica de usuario
 *
 * @access public
 * @author Marlon Souza
 * @uses
 * @version 1.0
 */
class VOUsuario {
	
        /**
	 * Id do usuario
	 *
	 * @var integer
	 */
	private $idUsuario = null;
    
	/**
	 * Nome do usuario
	 *
	 * @var String
	 */
	private $nomeUsuario = '';

	/**
	 * Data de nascimento do usuario
	 *
	 * @var Date
	 */
	private $emailUsuario = '';

	/**
	 * Telefone do usuario
	 *
	 * @var String
	 */
	private $telefoneUsuario = '';
	
        public function __construct(    $idUsuario          = null, 
                                        $nomeUsuario        = '', 
                                        $emailUsuario       = '', 
                                        $telefoneUsuario    = ''
                                    )
        {
            $this->idUsuario        = $idUsuario;
            $this->nomeUsuario      = $nomeUsuario;
            $this->emailUsuario     = $emailUsuario;
            $this->telefoneUsuario  = $telefoneUsuario;
        }
        
        /**
	 * Configura o nome do objeto de usuario
	 *
	 * @param String $nomeUsuario
	 */
	public function setNomeUsuario( $nomeUsuario ){
		$this->nomeUsuario = $nomeUsuario;
	}

	/**
	 * Configura a data de nascimento do usuario
	 *
	 * @param String $emailUsuario
	 */
	public function setEmailUsuario( $emailUsuario ){
		$this->emailUsuario = $emailUsuario;
	}

	/**
	 * Configura o telefone do usuario
	 *
	 * @param String $telefoneUsuario
	 */
	public function setTelefoneUsuario( $telefoneUsuario ){
		$this->telefoneUsuario = $telefoneUsuario;
	}

        /**
	 * Retorna o nome do usuario
	 *
	 * @return String
	 */
	public function getIdUsuario(){
		return $this->idUsuario;
	}
        
	/**
	 * Retorna o nome do usuario
	 *
	 * @return String
	 */
	public function getNomeUsuario(){
		return $this->nomeUsuario;
	}

	/**
	 * Retorna a data de nascimento do usuario
	 *
	 * @return String
	 */
	public function getEmailUsuario(){
		return $this->emailUsuario;
	}

	/**
	 * Retorna o telefone do usuario
	 *
	 * @return String
	 */
	public function getTelefoneUsuario(){
		return $this->telefoneUsuario;
	}

        /**
         * 
         * @return string
         */
	public function __toString(){

            $retorno = "Classe::Metodo: (".__METHOD__.")";
            $retorno .= "<br><br>";
            
            foreach (get_class_methods(get_class($this)) as $key => $value) {
                                                        
                if( stristr($value, "get")){
                    
                    $retorno .= $this->$value();
                    $retorno .= "<br>";
                }
            }
            
            return $retorno;
	}
}
?>