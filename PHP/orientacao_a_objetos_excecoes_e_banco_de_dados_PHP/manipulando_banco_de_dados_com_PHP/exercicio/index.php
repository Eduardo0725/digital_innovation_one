<?php

require 'Blog.php';

$blog = new Blog;

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nome = isset($_GET['nome']) ? $_GET['nome'] : null;
$conteudo = isset($_GET['conteudo']) ? $_GET['conteudo'] : null;


switch (isset($_GET['operacao']) ? $_GET['operacao'] : null) {
    case 'insert':
        echo $blog->insert($nome, $conteudo);
        break;

    case 'update':
        echo $blog->update($id, $nome, $conteudo);
        break;

    case 'delete':
        echo $blog->delete($id);
        break;

    default:
    $lista = $blog->list();

    ?>
        <h1>Posts:</h1>
        <br>
    <?php
    
    foreach($lista as $value){
        ?>
            <p>ID: <?= $value['id'] ?></p>
            <p>Post: <?= $value['nome'] ?></p>
            <p><?= $value['conteudo'] ?></p>
            <hr>
        <?php
    }
}
