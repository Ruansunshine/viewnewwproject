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
            margin-top: 60px; 
            transition: margin-left 0.3s;
        }
        .quadro-central .carousel-inner
        .quadro-central {
          width: 100%;
            
        }

        .quadro-central img {
            background-size: cover;
        }
        

        .carrossel img {   
             background-size: cover; /* Faz com que a imagem cubra toda a tela */
    background-position: center; /* Centraliza a imagem no fundo */
    background-repeat: no-repeat; /* Evita que a imagem se repita */
    height: 100vh; /* Define a altura do body para 100% da altura da janela de visualização */
    margin: 0; /* Remove margens para cobrir totalmente a tela */
}

            
         
        

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
        }

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

       
      /* CSS Responsivo */
@media (max-width: 1024px) {
    .sidebar {
        width: 200px;
    }

    main {
        margin-left: 200px;
    }
}

@media (max-width: 768px) {
    /* Sidebar responsiva */
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
        text-align: center;
    }

    /* Topbar responsiva */
    .topbar {
        left: 0;
        width: 100%;
        text-align: center;
        padding: 10px;
    }

    /* Conteúdo principal adaptado para mobile */
    main {
        margin-left: 0;
        margin-top: 60px;
    }

    .quadro-central {
        width: 100vw;
        height: 100%;
    }

    .quadro-central img {
        width: 100%;
        height: 100%;
    }

    /* Menu de navegação responsivo */
    nav.menu-desktop ul {
        flex-direction: column;
    }

    nav.menu-desktop ul li {
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    /* Sidebar escondida em telas muito pequenas */
    /* .sidebar {
        display: none;
    } */

    .topbar {
        left: 0;
        padding: 10px;
        text-align: center;
    }

    /* Ajustar o carrossel em telas pequenas */
    .quadro-central img {
        height: 100%;
        width: 100%;
        object-fit: contain;
    }
.quadro-central img {
    height: 100%;
    width: 100vw; /* Ajustado para telas menores */
    height: auto; /* Para manter a proporção da imagem */
}

    /* Estilização adicional para o menu de navegação */
    nav.menu-desktop ul {
        flex-direction: column;
        padding: 0;
    }

    nav.menu-desktop ul li {
        padding: 10px 0;
        margin-right: 0;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 30px;
        height: 30px;
    }
}

@media (max-width: 480px) {
    
}

    </style>
    <title style="font-size: medium;">ACLIoT Tech - Home</title>
</head>
<body>

<!-- Barra Superior -->
<div class="topbar">
    <h1 style="font-size: x-large;">Bem Vindo ao ACLIoT, <?php echo htmlspecialchars($nomeUsuario); ?></h1>
</div>

<div style="font-family: 'Times New Roman', Times, serif;" class="sidebar" id="sidebar">
    <h2 style="color: #fff; margin-left:1.5vh;">Home</h2>
    <a href="http://localhost/projetoAci/app/views/users/perfil.php">Perfil</a>
    <a href="#">Historico</a>
    <a href="#">Configurações</a>
    <a href="http://localhost/projetoAci/app/views/users/login.php">Sair</a>
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
 
   
   <form action="http://localhost/projetoAci/app/views/salas/Myenviroment.php" method="POST">
        <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
        <button type="submit" class="side" style="margin-left: 2vh;" >Meu Ambiente</button>
    </form>
</div>

<main>
    <div class="quadro-central">
        <div id="carouselExample" class="carousel slide carrossel" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="imagens/freepik__candid-image-photography-natural-textures-highly-r__23466.jpeg" class="quadro-central img" alt="Imagem 1">
                </div>
                <div class="carousel-item">
                    <img src="imagens/img.jpg   " class="quadro-central img" alt="Imagem 2">
                </div>
                <div class="carousel-item">
                    <img src="imagens/imagensAci.jpeg" class="quadro-central img" alt="Imagem 3">
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
    </div>

    <!-- Barra de Navegação Fixa -->
    <nav class="menu-desktop">
        <ul>
            <li style="margin-right: 60vh; font-family: 'Times New Roman', Times, serif;"><a href="http://localhost/projetoAci/app/views/salas/ListarSalas.php" class="menu-item">Salas</a></li>
            <li style="margin-right: 60vh; font-family: 'Times New Roman', Times, serif;"><a href="http://localhost/projetoAci/app/views/sensor/listarsensor.php" class="menu-item">Detetor</a></li>
            <li style="margin-right: 10vh; font-family: 'Times New Roman', Times, serif;"><a href="http://localhost/projetoAci/app/views/users/logs.php" class="menu-item">Logs</a></li>
        </ul>
    </nav>
</main>

<!-- JQUERY, POPPER JS E BOOTSTRAP JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
