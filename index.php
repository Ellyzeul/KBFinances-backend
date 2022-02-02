<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";
$_SESSION["dot_env_path"] = __DIR__;
require_once __DIR__ . DIRECTORY_SEPARATOR . "config.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>KBFinancesAPI</title>
</head>
<body>
    <p>Rotas disponíveis</p>
    <hr>
    <p>Serviço de autenticação</p>
    <ul>
        <li>Login - POST - <code>/route/login.php</code></li>
    </ul>
    <p>Despesas</p>
    <ul>
        <li>Criar - POST - <code>/route/expense.php?operation=c</code></li>
        <li>Ler - GET - <code>/route/expense.php?operation=r</code></li>
        <li>Atualizar - POST - <code>/route/expense.php?operation=u</code></li>
        <li>Deletar - POST - <code>/route/expense.php?operation=d</code></li>
        <br>
        <li>Ler despesa única - POST - <code>/route/expense.php?operation=f</code></li>
        <li>Ler valores das despesas por categoria - POST - <code>/route/expense.php?operation=pc</code></li>
    </ul>
    <p>Receitas</p>
    <ul>
        <li>Criar - POST - <code>/route/income.php?operation=c</code></li>
        <li>Ler - GET - <code>/route/income.php?operation=r</code></li>
        <li>Atualizar - POST - <code>/route/income.php?operation=u</code></li>
        <li>Deletar - POST - <code>/route/income.php?operation=d</code></li>
        <br>
        <li>Ler receita única - POST - <code>/route/income.php?operation=f</code></li>
    </ul>
</body>
</html>