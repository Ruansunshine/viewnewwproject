<?php
session_start();

// Verificar se o usuário está logado
if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = $_SESSION['nomeUsuario'];

    // Garantir que $nomeUsuario é uma string
    if (is_array($nomeUsuario)) {
        $nomeUsuario = implode('', $nomeUsuario);
    }
} else {
    
    header('Location: login.php?mensagem não  chegou os dados');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600;700&display=swap" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* ESTILO GERAL */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #000;
            height: 100vh;
            overflow: hidden;
        }

        .interface {
            max-width: 1280px;
            margin-left: 250px;
            margin-top: 20px;
        }

        /* Estilo da barra superior */
        .topbar {
            height: 60px; /* Altura da barra superior */
            width: 100%; /* Largura total */
            position: fixed; /* Fixa a barra no topo */
            top: 0;
            left: 250px; /* Compensa a sidebar */
            background-color: #222; /* Cor de fundo da barra superior */
            padding: 10px;
            z-index: 1000; /* Acima de outros elementos */
            color: white; /* Cor do texto */
            display: flex;
            align-items: center; /* Alinha verticalmente o conteúdo */
            justify-content: space-between; /* Espaça os elementos horizontalmente */
        }

        .topbar h1 {
            margin-left: 10px;
            font-size: 24px;
        }

        /* Estilo da Sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #222;
            padding-top: 20px;
            z-index: 1000;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background-color: #575757;
        }

        .side {
            margin-left: -1vh;
            border-radius: 90vh;
            border-top: 10vh;
            background-color: #222;
            color: white;
        }

        /* Main content */
        main {
            margin-left: 250px;
            margin-top: 60px; /* Para evitar sobreposição com a topbar */
            transition: margin-left 0.3s;
        }

        .quadro-central {
            background-color: #ccc;
            border-radius: 10px;
            margin: 20px auto;
            max-width: 3000px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .carrossel img {
            border-radius: 5px;
            width: 100%;
            height: auto;
        }

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

        /* Estilo da barra de navegação fixa */
        nav.menu-desktop {
            position: fixed;
            bottom: 0;
            left: 250px;
            right: 0;
            background-color: #222;
            padding: 10px 0;
            z-index: 999;
        }

        nav.menu-desktop ul {
            display: flex;
            justify-content: center;
        }

        nav.menu-desktop ul li {
            padding: 0 20px;
        }

        nav.menu-desktop a {
            color: white;
            text-decoration: none;
            font-size: large;
        }

        nav.menu-desktop a:hover {
            text-decoration: underline;
        }
    </style>
    <title>ACLIoT Tech - Home</title>
</head>
<body>

<!-- Barra Superior -->
<div class="topbar">
    <h1>Bem-vindo ao ACLIoT, <?php echo htmlspecialchars($nomeUsuario); ?>!</h1>
</div>

<div class="sidebar" id="sidebar">
    <h2 style="color: #fff; margin-left:1.5vh;">Home</h2>
    <a href="http://localhost/projetoAci/app/views/users/perfil.php">Perfil</a>
    <a href="#">Item 2</a>
    <a href="#">Configurações</a>
    <a href="#">Sobre</a>
   <br>
   <br>
   <br> 
   <br>
   <br>
   <br>
   <br> 
   <br>
   <br>
   <br>
   <br> 
   <br>
   <br>
   <br>
   <br> 
   <br>
   <br>
   <br>
   <br> 
   <br>
   <br>
   <br>
   <br>
   <br> 
   <br>
   
    <a href="">
        <form action="http://localhost/projetoAci/app/views/salas/Myenviroment.php" method="POST">
            <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
            <button type="submit" class="side">Meu Ambiente</button>
        </form>
    </a>
</div>

<main>
    <div class="quadro-central">
        <div id="carouselExample" class="carousel slide carrossel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagens/imagem.webp" class="d-block" alt="Imagem 1">
                </div>
                <div class="carousel-item">
                    <img src="imagens/imagem.webp" class="d-block" alt="Imagem 2">
                </div>
                <div class="carousel-item">
                    <img src="imagens/imagem.webp" class="d-block" alt="Imagem 3">
                </div>
            </div>
            <!-- Controles de navegação -->
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </a>
        </div>

        <?php
        if (isset($mensagemErro)) {
            echo "<p style='color: red;'>$mensagemErro</p>";
        }
        ?>
    </div>

    <!-- Barra de Navegação Fixa -->
    <nav class="menu-desktop">
        <ul>
            <li ><a href="http://localhost/projetoAci/app/views/salas/ListarSalas.php" class="menu-item">Salas</a></li>
            <li><a href="http://localhost/projetoAci/app/views/sensor/listarsensor.php" class="menu-item">Detetor</a></li>
            <li><a href="http://localhost/projetoAci/app/views/users/logs.php" class="menu-item">Logs</a></li>
        </ul>
    </nav>
</main>

<!-- Importando jQuery e Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
