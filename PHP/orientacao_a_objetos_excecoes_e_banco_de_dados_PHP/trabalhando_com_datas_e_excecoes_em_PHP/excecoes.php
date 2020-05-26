<?php

//Exemplo 1:
/*
throw new Exception("Essa é uma exceção");

echo "\n... executando ...\n";
*/

//Exemplo 2:
/*
function validarUsuario(array $usuario)
{
    if(empty($usuario['codigo']) || empty($usuario['nome'] || empty($usuario['idade']))) {
        return false;
    }

    return true;
}

$usuario = [
    'codigo' => 1,
    'nome' => '',
    'idade' => 57
];

$usuarioValido = validarUsuario($usuario);

if(!$usuarioValido) {
    echo "Usuário Invalido!";
    return false;
}
*/

//Exemplo 3:
/* 
function validarUsuario(array $usuario)
{
    if(empty($usuario['codigo']) || empty($usuario['nome'] || empty($usuario['idade']))) {
        throw new Exception("Campos obrigatórios não foram preenchidos!");
    }

    return true;
}

$usuario = [
    'codigo' => 1,
    'nome' => '',
    'idade' => 57
];

validarUsuario($usuario);

echo "\n... executando ...\n";
*/

//Exemplo 4:
/* 
function validarUsuario(array $usuario)
{
    if(empty($usuario['codigo']) || empty($usuario['nome'] || empty($usuario['idade']))) {
        throw new Exception("Campos obrigatórios não foram preenchidos!");
    }

    return true;
}

$usuario = [
    'codigo' => 1,
    'nome' => '',
    'idade' => 57
];

try{
    validarUsuario($usuario);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

echo "\n... executando ...\n";
 */

//Exemplo 5:

function validarUsuario(array $usuario)
{
    if(empty($usuario['codigo']) || empty($usuario['nome'] || empty($usuario['idade']))) {
        throw new Exception("Campos obrigatórios não foram preenchidos!\n");
    }

    return true;
}

$usuario = [
    'codigo' => 1,
    'nome' => '',
    'idade' => 57
];

$status = false;

try{
    validarUsuario($usuario);
} catch (Exception $e) {
    echo $e->getMessage();
} finally {
    echo "Status da operação: " . (int)$status; //cast
    die();
}
