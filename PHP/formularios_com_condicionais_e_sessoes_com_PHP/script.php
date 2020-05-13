<?php

$categorias = array(
    ['infantil' => [6,12]],
    ['adolescente' => [13,17]],
    ['adulto' => [18, 59]]
);

$nome = $_POST['nome'];
$idade = $_POST['idade'];

if(empty($nome)){
    echo 'O nome não pode ser vazio.';
    return;
}

if(strlen($nome) < 3){
    echo 'O nome deve ter mais de 3 caracteres.';
    return;
}

if(strlen($nome) > 40){
    echo 'O nome é muito extenso.';
    return;
}

if(!is_numeric($idade)){
    echo "Informe um número para a idade.";
    return;
}

for ($i=0; $i < count($categorias); $i++) { 

    if($i == count($categorias) - 1){
        $tipo = implode('',array_keys($categorias[$i]));
        echo "O nadador $nome compete na categoria $tipo.";
        return;
    }

    $posicao = array_values($categorias[$i]);

    if($idade >= $posicao[0][0] && $idade <= $posicao[0][1]){
        $tipo = implode('',array_keys($categorias[$i]));
        echo "O nadador $nome compete na categoria $tipo.";
        return;
    }
}

?>