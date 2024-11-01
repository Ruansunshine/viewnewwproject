<?php
session_start();

var_dump($_SESSION['salas']);
// Verificar se o usuário está logado
if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = $_SESSION['nomeUsuario'];

    // Verificar se o nome do usuário é um array e ajustá-lo para uma string
    if (is_array($nomeUsuario)) {
        $nomeUsuario = implode('', $nomeUsuario);
    }

    // Carregar as salas na sessão (ou em uma variável do banco de dados)
    $salas = isset($_SESSION['salas']) ? $_SESSION['salas'] : []; // Salas associadas ao usuário
} else {
    header('Location: login.php?mensagem=Você precisa estar logado.');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Sensor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        header {
            background: #35424a;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            background: #4a4a4a;
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
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #4cae4c;
        }
        .btn-back {
            color: white;
            text-decoration: none;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<a class="btn-back" href="http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php">&larr; Voltar</a>

<header>
<h1>Cadastrar Novo Sensor em <?= htmlspecialchars($salas[0]['NomeSala']) ?></h1>
</header>

<form action="http://localhost/projetoAci/app/routes/RoutesSensor.php?action=cadastrarSensor" method="POST">
    <input type="hidden" name="Usuario_IdUsuario" value="<?php echo $idUser; ?>">
    <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
    <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
    

    <label for="Tipo">Tipo de Sensor:</label>
<select id="Tipo" name="Tipo" required>
    <option value="">Selecione um tipo de sensor</option>
    <option value="temperatura">Temperatura</option>
    <option value="Consumo Energia">Consumo Energia</option>
    <option value="iluminacao">Iluminação</option>
</select>


    <label for="Sala">Sala:</label>
    <select id="Sala" name="Salas_idSalas" required>
    <option value="">Selecione uma sala</option>
    <?php if (!empty($salas)): // Verifica se $salas não está vazio ?>
        <?php foreach ($salas as $sala): ?>
            <option value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                <?= htmlspecialchars($sala['DescricaoSala']) ?>
            </option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">Nenhuma sala disponível</option>
    <?php endif; ?>
</select>

    <button type="submit">Cadastrar Sensor</button>
</form>

</body>
</html>