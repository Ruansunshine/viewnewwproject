<?php
session_start();


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            font-size: medium;
            text-align: center; /* Centraliza o texto */
        }
        a {
            color: #00ff00; /* Cor do link para se destacar */
            font-size: 1.5rem; /* Tamanho do link */
            text-decoration: none;
            font-weight: bold; /* Deixa o link em negrito */
        }
        .not-found {
            font-size: 5rem; /* Tamanho grande para a mensagem de erro */
            color: #00ff00; /* Cor verde */
            margin-top: 50px; /* Espaço acima da mensagem */
            margin-bottom: 20px; /* Espaço abaixo da mensagem */
        }
        .container {
            margin-top: 100px; /* Espaço superior para centralizar verticalmente */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="not-found">404 NOT FOUND</div>
        <p>Desculpe, Id do sensor não existe, a função ver so está disponivel caso exista sensores, caso exista voce deve ir em  verificar detetores em <a href="http://localhost/projetoAci/app/views/salas/Myenviroment.php"> Seu ambiente</a>  escolher a sala e listar
</p>
        <a href="http://localhost/projetoAci/app/views/users/homeUser.php">&larr; Voltar ao Início</a>




        <?php 
        echo "<br>";
            
          echo "<br>";
        ?>
    </div>
</body>
</html>
