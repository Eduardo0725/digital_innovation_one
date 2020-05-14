<?php

// declare(strict_type=1);

function validaNome(string $nome) : bool
{
    if(empty($nome)){
        setarMensagemErro('O nome não pode ser vazio.');
        return false;
    }
    
    else if(strlen($nome) < 3){
        setarMensagemErro('O nome deve ter mais de 3 caracteres.');
        return false;
    }
    
    else if(strlen($nome) > 40){
        setarMensagemErro('O nome é muito extenso.');
        return false;
    }
    return true;
}

function validaIdade(string $idade) : bool
{
    if(!is_numeric($idade)){
        setarMensagemErro('Informe um número para a idade.');
        return false;
    }
    return true;
}

?>