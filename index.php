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
    <link rel="stylesheet" href="/static/index.css">
    <title>KBFinancesAPI</title>
</head>
<body>
    <p>Rotas disponíveis</p>
    <hr>
    <p>Serviço de autenticação</p>
    <ul>
        <li class="collapsible">Login - POST - <code>/route/login.php</code></li>
        <div class="content">
            <p>Exemplo de requisição para realizar login</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "password": "12345678"
                    }
                </pre>
            </code>
        </div>
    </ul>
    <p>Serviços Kakeibo</p>
    <ul>
        <li class="collapsible">Ler economia prevista - POST - <code>/route/kakeibo.php?operation=get_economy</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler a economia prevista</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "month"?: 2,
                        "year"?: 2022,
                    }
                </pre>
            </code>
        </div>
        <li class="collapsible">Atualizar economia prevista - POST - <code>/route/kakeibo.php?operation=set_economy</code></li>
        <div class="content">
            <p>Exemplo de requisição para atualizar a economia prevista</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "economy": 20,
                        "month"?: 2,
                        "year"?: 2022,
                    }
                </pre>
            </code>
        </div>
        <br>
        <li class="collapsible">Ler anotação mensal - POST - <code>/route/kakeibo.php?operation=get_annotation</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler a anotação mensal</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "month"?: 2,
                        "year"?: 2022,
                    }
                </pre>
            </code>
        </div>
        <li class="collapsible">Atualizar anotação mensal - POST - <code>/route/kakeibo.php?operation=set_annotation</code></li>
        <div class="content">
            <p>Exemplo de requisição para atualizar a anotação mensal</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "annotation": "Tenho que economizar...",
                        "month"?: 2,
                        "year"?: 2022,
                    }
                </pre>
            </code>
        </div>
    </ul>
    <p>Usuário</p>
    <ul>
        <li class="collapsible">Criar - POST - <code>/route/user.php?operation=c</code></li>
        <div class="content">
            <p>Exemplo de requisição para criação de usuário</p>
            <code>
                <pre>
                    {
                        "name": "Fulano",
                        "email": "fulano@email.com",
                        "password": "senha_não_criptografada (criptografia feita no lado servidor)"
                    }
                </pre>
            </code>
        </div>
    </ul>
    <p>Despesas</p>
    <ul>
        <p>Operações CRUD</p>
        <li class="collapsible">Criar - POST - <code>/route/expense.php?operation=c</code></li>
        <div class="content">
            <p>Exemplo de requisição para criar uma despesa</p>
            <code>
                <pre>
                    {
                        "description": "Show",
                        "value": 50,
                        "category": 1,
                        "email": "gabriel@email.com",
                        "payment_date": "2022-02-23",
                        "due_date": "2022-02-18"
                    }
                </pre>
            </code>
        </div>

        <li class="collapsible">Ler - POST - <code>/route/expense.php?operation=r</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler todas as despesas de um usuário</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com"
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Atualizar - POST - <code>/route/expense.php?operation=u</code></li>
        <div class="content">
            <p>Exemplo de requisição para atualizar uma despesa</p>
            <code>
                <pre>
                    {
                        "id": 4,
                        "description": "iFood",
                        "value": 32.9,
                        "category": 3,
                        "email":"gabriel@email.com",
                        "payment_date": "2021-11-14",
                        "due_date":null
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Deletar - POST - <code>/route/expense.php?operation=d</code></li>
        <div class="content">
            <p>Exemplo de requisição para deletar uma despesa</p>
            <code>
                <pre>
                    {
                        "id": 4
                    }
                </pre>
            </code>
        </div>
        
        <br>
        <li class="collapsible">Ler despesa única - POST - <code>/route/expense.php?operation=f</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler uma única despesa de um usuário</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com"
                        "id": 4
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Ler valores das despesas por categoria - POST - <code>/route/expense.php?operation=pc</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler os valores das despesas por categoria</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com"
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Ler categorias de despesa - GET - <code>/route/expense.php?operation=get_categories</code></li>
    </ul>
    <p>Receitas</p>
    <ul>
        <p>Operações CRUD</p>
        <li class="collapsible">Criar - POST - <code>/route/income.php?operation=c</code></li>
        <div class="content">
            <p>Exemplo de requisição para criar uma receita</p>
            <code>
                <pre>
                    {
                        "category": 0,
                        "description": "Salario",
                        "email": "gabriel@email.com",
                        "receipt_date": "2022-01-12",
                        "value": 2000
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Ler - POST - <code>/route/income.php?operation=r</code></li>
        <div class="content">
            <p>Exemplo de requisição para todas as receitas de um usuário</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com"
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Atualizar - POST - <code>/route/income.php?operation=u</code></li>
        <div class="content">
            <p>Exemplo de requisição para atualizar uma receita</p>
            <code>
                <pre>
                    {
                        "id": 8,
                        "description":"Bolsa de valores",
                        "category": 2,
                        "email": "gabriel@email.com",
                        "entry_date": "2021-11-17",
                        "receipt_date": "2021-11-30",
                        "value": 300.00
                    }
                </pre>
            </code>
        </div>
        
        <li class="collapsible">Deletar - POST - <code>/route/income.php?operation=d</code></li>
        <div class="content">
            <p>Exemplo de requisição para deletar uma receita</p>
            <code>
                <pre>
                    {
                        "id": 8
                    }
                </pre>
            </code>
        </div>
        
        <br>
        <li class="collapsible">Ler receita única - POST - <code>/route/income.php?operation=f</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler uma única receita de um usuário</p>
            <code>
                <pre>
                    {
                        "email": "gabriel@email.com",
                        "id": 28
                    }
                </pre>
            </code>
        </div>
        <li class="collapsible">Ler categorias de receita - POST - <code>/route/income.php?operation=get_categories</code></li>
        <div class="content">
            <p>Exemplo de requisição para ler as categorias de receitas de um usuário</p>
            <code>
                <pre>
                    {
                        
                        "email": "gabriel@email.com"
                    }
                </pre>
            </code>
        </div>
        <li class="collapsible">Inserir categoria de receita - POST - <code>/route/income.php?operation=set_caegory</code></li>
        <div class="content">
            <p>Exemplo de requisição para inserir uma categoria de receita de um usuário</p>
            <code>
                <pre>
                    {
                        "category": "Empreendimentos",
                        "email": "gabriel@email.com"
                    }
                </pre>
            </code>
        </div>
        
    </ul>

    <script src="/static/collapsible.js"></script>
</body>
</html>