<?php

/**
 * Classe para tratar as excecoes do sistema
 *
 * @author Mvbs
 */
class ExcecoesSistema extends Exception {

    const _CODIGO_EXCECAO_CONEXAO_BANCO_    = 100;
    const _CODIGO_EXCECAO_ERROQUERY_        = 101;
    const _CODIGO_EXCECAO_ERROCRIASEQUENCE_ = 102;
    const _CODIGO_EXCECAO_PREPARARQUERY_    = 103;
        
    public function aferrolharMensagemDeErro(){
        
        $titulo     =   'Exceção de Sistema';
        $excecao    =   "
                            <div class='erro'>
                                <b>$titulo</b><br>
                                <ol>
                                    <li>Codigo: {$this->getCode()} </li>
                                    <li>Mensagem: {$this->getMessage()} </li>
                                    <li>Arquivo(Linha do erro): {$this->getFile()}({$this->getLine()}) </li>
                                </ol>
                            </div>
                        ";
        return $excecao;
    }
}

?>
