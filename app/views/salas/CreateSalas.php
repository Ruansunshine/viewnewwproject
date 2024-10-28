<?php
session_start(); // Certifique-se de que a sessão está iniciada
if (!isset($_SESSION['idUser'])) {
    header('Location: ../views/users/login.html?mensagem=Você precisa estar logado.');
    exit();
}
// O ID do usuário pode ser acessado aqui
$usuarioId = $_SESSION['idUser'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Sala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black; /* Mantém o fundo preto */
            color: white; /* Texto branco para melhor contraste */
            font-family: 'Poppins', sans-serif; /* Fonte Poppins para consistência */
            padding: 20px;
        }
        header {
            background: #35424a; /* Cor de fundo do cabeçalho */
            color: #ffffff; /* Cor do texto do cabeçalho */
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px; /* Espaço abaixo do cabeçalho */
        }
        form {
            background: #4a4a4a; /* Cor de fundo do formulário */
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #5cb85c; /* Cor do botão */
            color: white; /* Cor do texto do botão */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c; /* Cor do botão ao passar o mouse */
        }
        .btn-back {
            color: white; /* Cor do texto do botão de voltar */
            text-decoration: none; /* Remove o sublinhado do link */
            margin-bottom: 20px; /* Espaço abaixo do botão de voltar */
        }
    </style>
</head>
<body>

<a class="btn-back" href="http://localhost/projetoAci/app/views/salas/Myenviroment.php">&larr; Voltar</a>

<header>
    <h1>Cadastrar Nova Sala</h1>
</header>

<form action="http://localhost/projetoAci/app/routes/RoutesSala.php?action=cadastrarSala" method="POST">
    <input type="hidden" name="Usuario_IdUsuario" value="<?php echo $_SESSION['idUser']; ?>">

    <label for="Nome">Nome:</label>
    <input type="text" id="Nome" name="Nome" required>

    <label for="Descricao">Descrição:</label>
    <input type="text" id="Descricao" name="Descricao" required>

    <label for="status">Status:</label>
    <select id="status" name="Status" required>
        <option value="1">Ativo</option>
        <option value="0">Inativo</option>
    </select>

    <button type="submit">Cadastrar Sala</button>
</form>

</body>
</html>
