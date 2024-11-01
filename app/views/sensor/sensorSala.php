<?php
session_start(); // Inicie a sessão para acessar os dados armazenados
// var_dump($_POST); // Foco aqui
//var_dump($_SESSION); // Foco aqui
// exit();

// Verifique se há uma mensagem a ser exibida
if (isset($_GET['mensagem'])) {
    echo '<div class="alert alert-warning">' . htmlspecialchars($_GET['mensagem']) . '</div>';
}


// Recupera as salas do usuário logado
$salas = isset($_SESSION['salas']) ? $_SESSION['salas'] : [];
$sensores = isset($_SESSION['sensores']) ? $_SESSION['sensores'] : [];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegação de Sensores</title>
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
        .card {
            margin-bottom: 15px;
        }
        .sensor-container {
            background-color: #4a4a4a;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            max-height: 400px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <a style="color: white;" href="http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php">&larr; Voltar</a>
    <div class="container mt-3">
       <h1>Olá  <h2>Olá, <?= htmlspecialchars($_SESSION['nomeUsuario']) ?>!</h2></h1> 
        
        <!-- Formulário para listar sensores -->
        <div class="d-flex justify-content-between mb-3">
            <form method="POST" action="http://localhost/projetoAci/app/routes/RoutesSensor.php?action=listSensorUserSala">
                <select name="idSalas" class="form-select" required>
                    <option value="" disabled selected>Selecione uma sala</option>
                    <?php if (!empty($salas)): ?>
                        <?php foreach ($salas as $sala): ?>
                            <option value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                <?= htmlspecialchars($sala['NomeSala']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <option value="" disabled>Nenhuma sala disponível</option>
                    <?php endif; ?>
                </select>
                <button type="submit" class="btn btn-primary">Listar Sensores</button>
            </form>
        </div>
        
        <div class="container sensor-container">
          
    <?php if (empty($sensores)): ?>
        <div class="alert alert-info">Nenhum sensor encontrado.</div>
    <?php else: ?>
        <?php foreach ($sensores as $sensor): ?>
            <div class="card bg-dark text-light">
                <div class="card-body">
                <h5 class="card-title">ID: <?= htmlspecialchars($sensor['IdSensor']) ?></h5>
                    <h5 class="card-title">Tipo: <?= htmlspecialchars($sensor['TipoSensor']) ?></h5> <!-- Assumindo que você quer mostrar o tipo do sensor -->
                    <!-- <p class="card-text">Usuário associado: <?= htmlspecialchars($sensor['NomeUsuario']) ?></p> -->
                    <p class="card-text">Sala: <?= htmlspecialchars($sensor['NomeSala']) ?></p>
                    <p class="card-text">Descrição: <?= htmlspecialchars($sensor['DescricaoSala']) ?></p>
                    <div class="d-flex justify-content-between">
                    </form>
                    <form action="http://localhost/projetoAci/app/routes/RoutesSensor.php?action=delete" method="POST">
                        <input type="hidden" name="idSensor" value="<?= htmlspecialchars($sensor['IdSensor']) ?>">
                    <button type="submit" class="btn btn-danger">Apagar</button>
                    </form>
                            </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

    </div>
</body>
</html>
