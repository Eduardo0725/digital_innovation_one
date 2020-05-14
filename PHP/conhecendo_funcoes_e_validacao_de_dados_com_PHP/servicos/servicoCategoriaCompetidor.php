<?php

function defineCategoriaCompetidor(string $nome, string $idade) : ?string
{
    $categorias = array(
        ['infantil' => [6,12]],
        ['adolescente' => [13,17]],
        ['adulto' => [18]]
    );

    if(validaNome($nome) && validaIdade($idade)){
        removerMensagemErro();
        for ($i=0; $i < count($categorias); $i++) { 

            if($i == count($categorias) - 1){
                $tipo = implode('',array_keys($categorias[$i]));
                setarMensagemSucesso("O nadador $nome compete na categoria $tipo.");
                return null;
            }
        
            $posicao = array_values($categorias[$i]);
        
            if($idade >= $posicao[0][0] && $idade <= $posicao[0][1]){
                $tipo = implode('',array_keys($categorias[$i]));
                setarMensagemSucesso("O nadador $nome compete na categoria $tipo.");
                return null;
            }
        }
    }else{
        removerMensagemSucesso();
        return obterMensagemErro();
    }
}

?>