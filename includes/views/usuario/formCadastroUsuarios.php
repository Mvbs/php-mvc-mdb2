<?
    //Verificacao de objeto de alteracao
    $botaoCadastro      = 'Salvar Dados';
    $tarefaCadastro     = 'usuario.inserir';
    $usuario =  [   'id_usuario'        => '',
                    'nome_usuario'      => '',
                    'email_usuario'     => '',
                    'telefone_usuario'  => ''
                ];

    if( !is_null($this->usuarioAlteracao) ){
        
        $botaoCadastro  = 'Atualizar Dados';
        $tarefaCadastro = 'usuario.atualizar';
        $usuario =  [   'id_usuario'        => $this->usuarioAlteracao->getIdUsuario(),
                        'nome_usuario'      => $this->usuarioAlteracao->getNomeUsuario(),
                        'email_usuario'     => $this->usuarioAlteracao->getEmailUsuario(),
                        'telefone_usuario'  => $this->usuarioAlteracao->getTelefoneUsuario()
                    ];
    }
?>
<!-- INICIO: Area de Cadastro de Usuarios -->
<div class='subCaixaForm'>
    <form name='formCadastroUsuario' id='formCadastroUsuario' method='POST' onsubmit="return validaAcoesCadastro( this, '<?="{$_SERVER['PHP_SELF']}?tarefa={$tarefaCadastro}"?>' );">
        <table>
            <caption>Formulário de Cadastro de Usuário</caption>
            <tbody>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <td><input type='text' id='nome_usuario' name='nome_usuario' value='<?=$usuario['nome_usuario']?>' size='50' maxlength='100'></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><input type='text' id='email_usuario' name='email_usuario' value='<?=$usuario['email_usuario']?>'  size='50' maxlength='100'></td>
                    </tr>
                    <tr>
                        <th>Telefone</th>
                        <td><input type='text' id='telefone_usuario' name='telefone_usuario' value='<?=$usuario['telefone_usuario']?>' size='10' maxlength='12'></td>
                    </tr>
                    <tr>
                        <td colspan='2' align='right'>
                            <input type='submit' id='salvar' name='salvar' value='<?=$botaoCadastro?>'>
                            <input type='hidden' id='id_usuario' name='id_usuario' value='<?=$usuario['id_usuario']?>'>
                        </td>
                    </tr>
                </thead>
            </tbody>    
        </table>
    </form>
</div>
<script> document.getElementById('nome_usuario').focus() </script>
<!-- FIM: Area de Cadastro de Usuarios -->