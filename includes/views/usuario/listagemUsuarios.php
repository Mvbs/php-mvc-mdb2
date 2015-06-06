<?  $caminhoFormulario  = $_SERVER['PHP_SELF']; ?>
<form id='formConsulta' method='post' action="<?=$caminhoFormulario?>">
<div class='subCaixaForm'>
    <div><b>Banco de dados atual:</b> <?=$this->versaoSGBD ?> </div><br>
    <!-- INICIO: TABELA DE LISTAGEM DE USUARIOS -->
    <table>
        <caption>Listagem dos Usuários</caption>
        <tbody>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th colspan='2'> Ações </th>
                </tr>
            </thead>
            <?  foreach ($this->colecaoUsuarios as $chave => $usuario){   ?>
            <tr>
                <td><?=$usuario->getIdUsuario()?></td>
                <td><?=$usuario->getNomeUsuario()?></td>
                <td><?=$usuario->getTelefoneUsuario()?></td>
                <td><?=$usuario->getEmailUsuario()?></td>
                <td>
                    <input type='button' value="Alterar" onclick="acaoCadastro('Deseja alterar o usuario (<?=$usuario->getNomeUsuario()?>) ?', '<?=$caminhoFormulario?>?tarefa=usuario.editar&id=<?=$usuario->getIdUsuario()?>' )" />
                </td>
                <td>
                    <input type='button' value="Excluir" onclick="acaoCadastro('Deseja excluir o usuario (<?=$usuario->getNomeUsuario()?>) ?', '<?=$caminhoFormulario?>?tarefa=usuario.excluir&id=<?=$usuario->getIdUsuario()?>' )" />
                </td>
            </tr>
            <?  }   ?>
        </tbody>
    </table>
    <!-- FIM: TABELA DE LISTAGEM DE USUARIOS -->
</div>
</form>