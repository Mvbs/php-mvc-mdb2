//Funcao para rotear a acao do usuario
function acaoCadastro( mensagem, acao ){
    
    var confirmacao = confirm( mensagem );
    
    if( !confirmacao )
        return;
    
    window.location = acao;
}

function validaAcoesCadastro( objForm, acao ){
    
    var qtdEl   = objForm.elements.length;
    var erros   = new Array();
    var retorno = true;
    
    for (var i = 0; i < qtdEl; i++) {
        if( objForm.elements[i].type == 'text' ){
            if( objForm.elements[i].value == '' ){
                erros.push( 'O campo (' + objForm.elements[i].name + ') nao pode ser vazio. \n' );
                retorno = false;
            }
        }
    }
    
    if( !retorno ){
        erros = erros.toString().replace(/,/g, '');
        alert(erros);
    }
    objForm.action = acao;
    
    if ( !confirm('Deseja proceder com o cadastro?') ){
        retorno = false;
    }
    return retorno;
}