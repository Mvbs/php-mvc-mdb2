<?
/**
* Interface dos metodos de acesso ao banco de dados. 
* Esta Interface apresenta todos os metodos que uma classe de acesso a banco é obrigada a implementar
*
* @author Marlon Souza
* @version 1.0
*
*/
interface InterfaceBanco{

	public function inserir();
	public function atualizar();
	public function excluir();

}
?>