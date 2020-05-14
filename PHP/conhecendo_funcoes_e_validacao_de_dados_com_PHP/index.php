<?php
    include "./servicos/servicoMensagemSessao.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    <meta name="description" content="">

    <title>Formulário de inscrição</title>
</head>

<body>

    <p>FORMULÁRIO PARA A INSCRIÇÃO DE COMPETIDORES:</p>

    <form action="script.php" method="post">
        <?php
            $mensagemDeSucesso = obterMensagemSucesso();
            if(!empty($mensagemDeSucesso)){
                echo $mensagemDeSucesso;
            }

            $mensagemDeErro = obterMensagemErro();
            if(!empty($mensagemDeErro)){
                echo $mensagemDeErro;
            }
        ?>
        <p>Nome: <input type="text" name="nome" id="nome" /> </p>
        <p>Idade: <input type="text" name="idade" id="idade" /> </p>
        <p><button type="submit">Enviar</button></p>
    </form>

</body>

</html>