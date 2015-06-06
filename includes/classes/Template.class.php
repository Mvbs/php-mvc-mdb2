<?php

class Template {
    
    protected $templateFile = '';
    protected $vars = array();
    
    public function __construct( $templateFile ) {
        
        if ( $templateFile !== null ){
            $this->templateFile = $templateFile;
        }
    }
    
    public function renderiza() {

        if ( stream_resolve_include_path("{$this->templateFile}") !== false ) {
            include "{$this->templateFile}";
        } else {
            throw new ExcecoesSistema( "Nenhum template encontrado no caminho: {$this->templateFile}", null );
        }
    }
    
    public function carregaVariaveisTemplate( $variaveis = array() ){

        if( !is_array($variaveis) ){
            throw new ExcecoesSistema( "Objeto de tratamento de variaveis do tipo errado (".gettype($variaveis)."), esperado tipo 'array', no template: {$this->templateFile}", null );
        }

        if( count($variaveis) > 0 ){
            foreach ($variaveis as $chave => $valor) {
                $this->$chave = $valor;
            }
        }
    }

    public function __set($name, $value) {
        $this->vars[$name] = $value;
    }
    
    public function __get($name) {
        return $this->vars[$name];
    }
}
?>