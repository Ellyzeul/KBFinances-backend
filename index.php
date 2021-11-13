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
    <ul>
        <li>Login - POST - <code>/route/login.php</code></li>
        <li>Criar despesa - POST - <code>/route/expense.php?operation=c</code></li>
        <li>Criar receita - POST - <code>/route/income.php?operation=c</code></li>
    </ul>
</body>
</html>