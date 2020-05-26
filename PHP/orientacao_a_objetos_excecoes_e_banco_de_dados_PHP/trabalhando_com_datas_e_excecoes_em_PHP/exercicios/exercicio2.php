<?php

declare(strict_types=1);

function divisao(int $n1, int $n2){
    if($n1 == 0 || $n2 == 0){
        throw new Exception("Escolha um número maior que 0.");
    }
    
    return $n1 + $n2;
}

try{
    $resultado = divisao(3,1);
    echo "O resultado é: $resultado";
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}