<?php

$categorias = array(
    ['infantil' => [6,12]],
    ['adolescente' => [13,17]],
    ['adulto' => [18, 59]]
);

$nome = 'Eduardo';
$idade = 17;

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

/////////////////////////////////////////////////////////////////////

// $categorias = [];
// $categorias[] = 'infantil';
// $categorias[] = 'adolescente';
// $categorias[] = 'adulto';
// $categorias[] = 'idoso';

// print_r($categorias);

// $nome = 'Eduardo';
// $idade = 17;

// var_dump([
//     $nome,
//     $idade
// ]);

// if($idade >= 6 && $idade <= 12){
//     for($i=0; $i<=count($categorias); $i++){
//         if($categorias[$i] == 'infantil'){
//             echo 'O nadador ' . $nome . ' compete na categoria infantil.';
//         }
//     }
// }
// else if($idade >= 13 && $idade <= 17){
//     for($i=0; $i<=count($categorias); $i++){
//         if($categorias[$i] == 'adolescente'){
//             echo 'O nadador ' . $nome . ' compete na categoria adolescente.';
//         }
//     }
// }
// else {
//     for($i=0; $i<=count($categorias); $i++){
//         if($categorias[$i] == 'adulto'){
//             echo 'O nadador ' . $nome . ' compete na categoria adulto.';
//         }
//     }
// }

?>