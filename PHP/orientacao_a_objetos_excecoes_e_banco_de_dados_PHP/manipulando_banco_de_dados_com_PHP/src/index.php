<?php
require 'Produto.php';
$produto = new Produto();

$id = isset($_GET['id']) ? $_GET['id'] : false;
$descricao = isset($_GET['descricao']) ? $_GET['descricao'] : false;

switch ($_GET['operacao']) {
    case 'list':
        //var_dump($produto->list());

        echo '<h3>Produtos: </h3>';

        foreach ($produto->list() as $key => $value) {
            echo 'Id:' . $value['id'] . '<br> Descrição: ' . $value['descricao'] . '<hr>';
        }
        break;

    case 'insert':
        $status = $produto->insert($descricao);

        if(!$status){
            echo 'Não foi possível executar a operação!';
            return;
        }

        echo "Registro inserido com sucesso!";
        return;

        break;

    case 'update':
        $status = $produto->update($descricao, $id);

        if(!$status){
            echo 'Não foi possível executar a operação!';
            return;
        }

        echo "Registro alterado com sucesso!";
        return;

        break;

    case 'delete':
        $status = $produto->delete($id);

        if(!$status){
            echo 'Não foi possível executar a operação!';
            return;
        }

        echo "Registro removido com sucesso!";
        return;

        break;
}
