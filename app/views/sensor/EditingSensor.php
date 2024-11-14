<?php
session_start();

// Exibir os dados recebidos via POST para depuração
// var_dump($_POST);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura os dados do POST
    $idSensor = htmlspecialchars($_POST['idSensor']);
    $tipoSensor = htmlspecialchars($_POST['TipoSensor']);

    // Aqui você pode continuar com a lógica de edição do sensor
    // echo "ID do Sensor: $idSensor<br>";
    // echo "Tipo do Sensor: $tipoSensor<br>";
} else {
    echo "Método de requisição inválido.";
}

// Verifica se o usuário está logado
if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
} else {
    echo "Você precisa estar logado.";
    exit();
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Sensor</title>
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

<a class="btn-back" href="http://localhost/projetoAci/app/views/sensor/sensorSala.php">&larr; Voltar</a>

<header>
<h1>Editar Sensor</h1>
</header>

<form action="http://localhost/projetoAci/app/routes/RoutesSensor.php?action=editarSensor" method="POST">
    <input type="hidden" name="Usuario_IdUsuario" value="<?php echo $idUser; ?>">
    <input type="hidden" name="IdSensor" value="<?= htmlspecialchars($idSensor) ?>">

    <label for="Tipo">Tipo de Sensor:</label>
    <select id="Tipo" name="Tipo" required>
        <option value="" disabled>Selecione um tipo de sensor</option>
        <option value="temperatura" <?= ($tipoSensor === 'temperatura') ? 'selected' : '' ?>>Temperatura</option>
        <option value="Consumo Energia" <?= ($tipoSensor === 'Consumo Energia') ? 'selected' : '' ?>>Consumo de Energia</option>
        <option value="iluminacao" <?= ($tipoSensor === 'iluminacao') ? 'selected' : '' ?>>Iluminação</option>
    </select>

    <button type="submit">Salvar Alterações</button>
</form>

</body>
</html>
