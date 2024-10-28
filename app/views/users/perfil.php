<?php
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario']) && isset($_SESSION['emailUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    $emailUsuario = $_SESSION['emailUsuario'];

    // Garantir que $nomeUsuario é uma string
    if (is_array($nomeUsuario)) {
        $nomeUsuario = implode('', $nomeUsuario);
    }
} else {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            font-size: medium;
        }
        a {
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .user-container {
            background-color: #333333; /* Fundo levemente cinza */
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .user-container h1, .user-container p {
            color: white;
        }
    </style>
</head>
<body>
    <a href="http://localhost/projetoAci/app/views/users/homeUser.php">&larr; Voltar</a>

    <form action="http://localhost/projetoAci/app/routes/routesUsuarios.php?action=editar" method="POST">
        <div class="container user-container">
            <h1>Olá <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
            <input type="hidden" name="IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
            <p>Sistema ACLIoT</p>
            <div class="mb-3">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="Nome" placeholder="<?php echo htmlspecialchars($nomeUsuario); ?>" aria-label="Nome">
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="Email" placeholder=<?php echo htmlspecialchars($emailUsuario); ?> aria-label="Email">
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="Senha" placeholder="Senha" aria-label="Senha">
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Salvar Alterações</button>
            <button class="btn btn-danger" type="submit" formaction="http://localhost/projetoAci/app/routes/routesUsuarios.php?action=delete">Excluir conta</button>
        </div>
    </form>
</body>
</html>
