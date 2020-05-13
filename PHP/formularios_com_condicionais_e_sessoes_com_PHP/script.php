<?php

session_start();

$categorias = array(
    ['infantil' => [6,12]],
    ['adolescente' => [13,17]],
    ['adulto' => [18, 59]]
);

$nome = $_POST['nome'];
$idade = $_POST['idade'];

if(empty($nome)){
    $_SESSION['mensagem de erro'] = 'O nome não pode ser vazio.';
    header('location: index.php');
    return;
}

else if(strlen($nome) < 3){
    $_SESSION['mensagem de erro'] = 'O nome deve ter mais de 3 caracteres.';
    header('location: index.php');
    return;
}

else if(strlen($nome) > 40){
    $_SESSION['mensagem de erro'] = 'O nome é muito extenso.';
    header('location: index.php');
    return;
}

else if(!is_numeric($idade)){
    $_SESSION['mensagem de erro'] = 'Informe um número para a idade.';
    header('location: index.php');
    return;
}

for ($i=0; $i < count($categorias); $i++) { 

    if($i == count($categorias) - 1){
        $tipo = implode('',array_keys($categorias[$i]));
        $_SESSION['mensagem de sucesso'] = "O nadador $nome compete na categoria $tipo.";
        header('location: index.php');
        return;
    }

    $posicao = array_values($categorias[$i]);

    if($idade >= $posicao[0][0] && $idade <= $posicao[0][1]){
        $tipo = implode('',array_keys($categorias[$i]));
        $_SESSION['mensagem de sucesso'] = "O nadador $nome compete na categoria $tipo.";
        header('location: index.php');
        return;
    }
}

?>