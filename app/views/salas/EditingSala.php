<?php
session_start();
echo '<pre>';
var_dump($_POST);
echo '</pre>';

if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = $_SESSION['nomeUsuario'];
    
    // if (!isset($_POST['idSalas']) || empty($_POST['idSalas'])) {
    //     header('Location: http://localhost/projetoAci/app/views/salas/EditingSala.php?mensagem= "pronto"');
    //     exit();
    // }
    // Capturando os dados da sala
    $idSala = isset($_POST['idSalas']) ? htmlspecialchars($_POST['idSalas']) : '';
    $nomeSala = isset($_POST['nomeSala']) ? htmlspecialchars($_POST['nomeSala']) : '';
    $descricaoSala = isset($_POST['descricaoSala']) ? htmlspecialchars($_POST['descricaoSala']) : '';
    $statusSala = isset($_POST['statusSala']) ? htmlspecialchars($_POST['statusSala']) : '';

} else {
    header('Location: login.php?mensagem=não chegou os dados');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sala</title>
    <style>
        body {
            font-family: "Poppins", sans-serif;
            background-color: #121212;
            color: #fff;
            padding: 20px;
        }
        .container {
            background-color: #1e1e1e;
            border-radius: 10px;
            padding: 20px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        button {
            background-color: #444;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Sala</h1>
        <form action="http://localhost/projetoAci/app/routes/RoutesSala.php?action=editarSala" method="POST">
            <input type="hidden" name="idSalas" value="<?= htmlspecialchars($idSala) ?>">

          
            <input type="hidden" name="Usuario_IdUsuario" value="<?= htmlspecialchars($idUser) ?>">

            <label for="nomeSala">Nome da Sala:</label>
            <input type="text" name="Nome" id="nomeSala" value="<?= $nomeSala ?>" >

            <label for="descricaoSala">Descrição:</label>
            <textarea name="Descricao" id="Descricao" required><?= $descricaoSala ?></textarea>

            <label for="statusSala">Status:</label>
            <select name="Status" id="Status">
                <option value="1" <?= $statusSala == 1 ? 'selected' : '' ?>>Ativo</option>
                <option value="0" <?= $statusSala == 0 ? 'selected' : '' ?>>Inativo</option>
            </select>

            <button type="submit">Salvar Alterações</button>
        </form>
        <a href="http://localhost/projetoAci/app/views/salas/Myenviroment.php" style="color: #fff; margin-top: 20px; display: inline-block;">Voltar</a>
    </div>
</body>
</html>
