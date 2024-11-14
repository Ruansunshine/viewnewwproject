  <?php



  ob_start();
  session_start();
//  var_dump($_SESSION);
  // echo "<br>";
  // ini_set('display_errors', 1);
  // error_reporting(E_ALL);
  if (isset($_SESSION['mensagem'])) {
    echo "<div class='mensagem'>" . $_SESSION['mensagem'] . "</div>";
    unset($_SESSION['mensagem']);  // Limpar a mensagem após exibição
}
$_SESSION['sensoresSala'] = $_SESSION['sensores'];
// echo "sensoreSala=";
// var_dump($_SESSION['sensoresSala']);
// exit();
  if (!isset($_SESSION['sensoresSala'])) {
     
      header('Location: http://localhost/projetoAci/app/views/users/notfound.php?mensagem=Algunsdadosestãofaltando');
      exit();
  }

  if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = is_array($_SESSION['nomeUsuario']) ? implode('', $_SESSION['nomeUsuario']) : $_SESSION['nomeUsuario'];

    $_SESSION['salas'] = $_SESSION['salas'] ?? []; 
    $sensores = isset($_SESSION['sensores']) ? $_SESSION['sensores'] : [];
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // echo "<br>";
    // var_dump($sensores);
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idSalas = $_POST['idSalas']; 
    $nomeSala = $_POST['nomeSala'];  
    $usuarioId = $_POST['Usuario_IdUsuario'];  
    $sala = null;

    
    foreach ($_SESSION['salas'] as $salaItem) {
        if ($salaItem['IdSalas'] == $idSalas) {
            $sala = $salaItem;
            break;
        }
    }

    
    if ($sala) {
  
        $sensoresEspecificos = [];
        foreach ($_SESSION['sensores'] as $sensor) {
          if (isset($sensor['NomeSala']) && $sensor['NomeSala'] == $sala['NomeSala']) {
                $sensoresEspecificos[] = $sensor;
            }
        }

    
        $_SESSION['sensoresSala'] = $sensoresEspecificos;

        // echo "<br>Verificação após a ação 'Acionar':<br>";
        // var_dump($_SESSION['sensoresSala']);
        // echo "<br>";
        // exit();
      
    } else {
      
        header('Location: http://localhost/projetoAci/app/views/users/notfound.php?mensagem=Sala não encontrada');
        exit();
    }
    if (isset($_SESSION['simulacao_dados'])) {
      $dadosSimulados = $_SESSION['simulacao_dados'];
      unset($_SESSION['simulacao_dados']);  

    
  }
  }
//   echo "<br>";
//  var_dump($_SESSION);
//  echo "<br>";
//  var_dump($_SESSION['sensoresSala']);
//  echo "<br>";
?>






<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Seu Ambiente</title>
  <style>
    @font-face {
      font-family: "SevenSegment";
      src: url("./fonts/SevenSegment.ttf") format("truetype");
      font-weight: normal;
      font-style: normal;
    }

    body {
      font-family: "Poppins", sans-serif;
      background-color: #121212;
      padding: 10px;
      color: #fff;
      margin: 0;
      display: flex;
      flex-direction: column;
      height: 100vh;
    }

    .container {
      padding: 20px;
      border-radius: 10px;
      background-color: #1e1e1e;
      display: flex;
      flex-direction: column;
    }

    .header {
      font-size: 8vw;
      font-weight: bold;
      margin-bottom: 20px;
      padding: 20px;
      border-radius: 10px;
      border: 1px solid #fff;
      text-align: center;
    }

    .buscar-dados-container {
      width: 100%;
      padding-top: 10px;
      display: flex;
      align-items: center;
      justify-content: end;
    }

    .sub-header {
      display: flex;
      font-size: 4vw;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .button {
      display: inline-block;
      padding: 10px 15px;
      background-color: #444;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 3vw;
      text-align: center;
      max-width: 300px;
    }

    .button:hover {
      background-color: #666;
    }

    .grid {
      display: flex;
      gap: 20px;
    }

    .temperatura {
      display: flex;
      align-items: center;
      justify-content: center;
      border: 1px solid #fff;
      width: 200px;
      position: relative;
    }

    .energia-lampada {
      display: flex;
      gap: 20px;
      flex-direction: column;
      width: 100%;
    }

    .consumo-de-energia,
    .lampada {
      border: 1px solid #fff;
      width: 100%;
      height: 50%;
    }

    .lampada {
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .ligada-desligada {
      font-size: 20px;
      width: 100%;
      text-align: center;
    }

    .termometro {
      transform: scale(0.4);
      width: 50px;
      height: 500px;
      background-color: #e0e0e0;
      border-radius: 25px 25px 0 0;
      position: relative;
      box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .coluna {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 15%;
      background-color: #ff0000;
      transition: height 0.5s ease;
    }

    .termometro::before {
      content: "";
      position: absolute;
      bottom: -71.5px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 80px;
      border-radius: 50%;
      background: #ff0000;
    }

    .consumo-de-energia {
      border: 1px solid #fff;
      width: 100%;
      height: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .digital-display {
      background: #58e9ff;
      display: flex;
      width: 90%;
      padding: 5px;
      height: 90%;
      align-items: center;
      justify-content: center;
    }

    .digital-display .number {
      font-family: "SevenSegment", monospace;
      color: #000;
      font-size: 1.5rem;
      display: flex;
    }

    .digital-display .kw-h {
      font-family: "SevenSegment", monospace;
      color: #000;
      font-size: 8px;
      display: flex;
      flex-direction: row;
      justify-content: start;
      align-items: start;
    }

    .marker {
      position: absolute;
      left: -30px;
      width: 20px;
      height: 2px;
      background-color: #ff0000;
    }

    .marker-label {
      position: absolute;
      left: -95px;
      font-size: 18px;
      color: #1eff00;
    }



    .marker-100 {
      bottom: 500px;
    }

    .marker-90 {
      bottom: 450px;
    }

    .marker-80 {
      bottom: 400px;
    }

    .marker-70 {
      bottom: 350px;
    }

    .marker-60 {
      bottom: 300px;
    }

    .marker-50 {
      bottom: 250px;
    }

    .marker-40 {
      bottom: 200px;
    }

    .marker-30 {
      bottom: 150px;
    }

    .marker-20 {
      bottom: 100px;
    }

    .marker-10 {
      bottom: 50px;
    }

    .marker-0 {
      bottom: 0;
    }

    /* Estilo dos botões */
    .btn-primary,
    .btn-secondary {
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 8px;
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
      cursor: pointer;
    }

    .btn-primary {
      background-color: #007bff;
      color: #ffffff;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
      background-color: #0056b3;
      box-shadow: 0 6px 12px rgba(0, 86, 179, 0.4);
    }

    .btn-secondary {
      background-color: #6c757d;
      color: #ffffff;
      border: none;
      box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
    }

    .btn-secondary:hover {
      background-color: #5a6268;
      box-shadow: 0 6px 12px rgba(90, 98, 104, 0.4);
    }

    /* Ajustes adicionais */
    .button-container {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 15px;
      /* Espaçamento entre os botões */
      margin-top: 20px;
    }



    /* Responsividade para tablets e desktops */
    @media (min-width: 768px) {
      .header {
        font-size: 3vw;
      }

      .sub-header,
      .button {
        font-size: 2vw;
      }

      .grid {
        flex-direction: row;
      }

      .temperatura {
        width: 150px;
        height: 350px;
      }

      .termometro {
        transform: scale(0.5);
      }

      .energia-lampada {
        gap: 20px;
      }

      .digital-display .number {
        font-size: 4rem;
      }

      .digital-display .kw-h {
        font-size: 2rem;
      }
    }

    /* Responsividade para desktops maiores */
    @media (min-width: 1024px) {
      .header {
        font-size: 2.5vw;
      }

      .sub-header,
      .button {
        font-size: 1.5vw;
      }

      .temperatura {
        width: 200px;
      }

      .termometro {
        transform: scale(0.5);
      }
    }

    .lamp {
      width: 5em;
      margin-top: -5px;
      display: inline-block;
      transform-origin: top center;
      transform: rotate(45deg);
      animation: lamp 3s forwards;
    }

    .bulb {
      fill: #fbf8ca;
      fill-opacity: 0.1;
      animation: bulb 0.3s 0.3s 5 cubic-bezier(0.26, 1.17, 0.89, -0.74) alternate forwards;
    }

    .table-responsive {
      margin-top: 20px;
      /* Espaço superior para a tabela */
    }

    .data-container {
      color: #000000;
      padding: 10px;
      /* Espaçamento interno */
      border: 1px solid #ccc;
      /* Borda do contêiner */
      border-radius: 5px;
      /* Bordas arredondadas */
      background-color: #f5f5f5;
      /* Cor de fundo clara */
      margin-bottom: 10px;
      /* Espaço entre os contêineres */
    }

    .data-tuple-container {
      background-color: #f5f5f5;
      /* Um cinza claro que se destaca do preto */
      border-radius: 5px;
      /* Arredondar os cantos */
      padding: 15px;
      /* Espaçamento interno */
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      /* Sombra leve para destacar */
      margin-bottom: 20px;
      /* Espaço entre os contêineres */
    }



    .table th,
    .table td {
      vertical-align: middle;
      /* Alinha o conteúdo ao centro verticalmente */
    }

    /* .data-tuple-container {
    border: 1px solid #ddd; /* Borda leve ao redor do contêiner */
    /*  border-radius: 8px; /* Bordas arredondadas */
    /*  background-color: #fdfdfd; /* Cor de fundo */
    /* padding: 15px; /* Espaçamento interno */
    /* box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    /*} */
    /*  */
    /*.table th, .table td {
    vertical-align: middle; /* Alinha o conteúdo ao centro verticalmente */
    /*}*/

    .table-responsive {
      margin-top: 20px;
      /* Espaço superior para a tabela */
    }

    @keyframes bulb {
      to {
        fill-opacity: 1;
        fill: #cccc;
        /* Desligado */
        fill: #fbf8ca;
        /* Ligado */
      }
    }

    .switch {
      transition: transform 0.3s;

      &:active {
        transform: translateY(5px);
      }
    }

    @keyframes lamp {
      5% {
        transform: rotate(-45deg);
      }

      10% {
        transform: rotate(35deg);
      }

      15% {
        transform: rotate(-35deg);
      }

      25% {
        transform: rotate(15deg);
      }

      40% {
        transform: rotate(-15deg);
      }

      65% {
        transform: rotate(3deg);
      }

      85% {
        transform: rotate(-1deg);
      }

      100% {
        transform: rotate(0deg);
      }
    }
  </style>
</head>

<body>
  <a style="color:#e0e0e0" href="http://localhost/projetoAci/app/views/salas/Myenviroment.php">&larr; Voltar</a>
  <header style="margin-top: 1vh;" class="header"> Dashboard</header>

  <div class="container">
    <div class="sub-header">
      <div class="container">
        <div class="sub-header">
          <!-- Inserção do código PHP dos botões dentro da sub-header -->
          <?php if (!empty($_SESSION['sensoresSala'])) : ?>

            <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
              <form action="http://localhost/projetoAci/app/routes/RoutesAmbiente.php?action=simularAmbiente" method="POST">
                <?php foreach ($_SESSION['sensoresSala'] as $sensor) : ?>
                  <input type="hidden" name="IdSensor_IdSensor[]" value="<?= htmlspecialchars($sensor['IdSensor']) ?>">
                  <input type="hidden" name="Tipo[]" value="<?= htmlspecialchars($sensor['TipoSensor']) ?>">
                <?php endforeach; ?>
                <button type="submit" class="btn btn-primary">Acionar todos os sensores</button>
              </form>
            </div>

            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                    <?php if (isset($sala)) : ?>
                        <form action="http://localhost/projetoAci/app/routes/RoutesAmbiente.php?action=Views" method="POST">
                            <input type="hidden" name="IdSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                            <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
                            <button type="submit" class="btn btn-secondary">Visualizar dados da <?= htmlspecialchars($sala['NomeSala']) ?></button>
                        </form>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center align-items-center gap-3 mt-4">
                    <?php if (isset($sala)) : ?>
                        <form action="http://localhost/projetoAci/app/routes/RoutesAmbiente.php?action=alertas" method="POST">
                            <input type="hidden" name="IdUser" value="<?= htmlspecialchars($_SESSION['idUser']) ?>">
                            <input type="hidden" name="IdSala" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                            <button type="submit" class="btn btn-secondary">Visualizar alertas da <?= htmlspecialchars($sala['NomeSala']) ?></button>
                        </form>
                    <?php endif; ?>
                </div>

          <?php else : ?>
            <?php
            header('Location: http://localhost/projetoAci/app/views/users/notfound.php?mensagem=Algunsdadosestãofaltando');
            exit();
            ?>
          <?php endif; ?>

        </div>
      </div>



    </div>
    <!-- termometro -->
    <div class="grid">
      <div class="temperatura">
        <div class="termometro">
          <div class="coluna"></div>

          <div class="marker marker-100"></div>
          <div class="marker marker-90"></div>
          <div class="marker marker-80"></div>
          <div class="marker marker-70"></div>
          <div class="marker marker-60"></div>
          <div class="marker marker-50"></div>
          <div class="marker marker-40"></div>
          <div class="marker marker-30"></div>
          <div class="marker marker-20"></div>
          <div class="marker marker-10"></div>
          <div class="marker marker-0"></div>

          <div class="marker-label marker-100" style="bottom: 494px">
            100°C
          </div>
          <div class="marker-label marker-90" style="bottom: 444px">90°C</div>
          <div class="marker-label marker-80" style="bottom: 394px">80°C</div>
          <div class="marker-label marker-70" style="bottom: 344px">70°C</div>
          <div class="marker-label marker-60" style="bottom: 294px">60°C</div>
          <div class="marker-label marker-50" style="bottom: 244px">50°C</div>
          <div class="marker-label marker-40" style="bottom: 194px">40°C</div>
          <div class="marker-label marker-30" style="bottom: 144px">30°C</div>
          <div class="marker-label marker-20" style="bottom: 94px">20°C</div>
          <div class="marker-label marker-10" style="bottom: 44px">10°C</div>
          <div class="marker-label marker-0" style="bottom: -6px">0°C</div>
        </div>
      </div>
      <!-- fim termometro -->
      <div class="energia-lampada">


        <div class="consumo-de-energia">

          <div class="digital-display">
            <h2 class="number">00000000 <span class="kw-h">kw/h</span></h2>


          </div>

        </div>


        <div class="lampada">

          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 60 130"
            class="lamp">
            <!-- bulb -->
            <g>
              <circle class="bulb" style="" cx="30" cy="109.3" r="10.7" />
              <line
                style="
        fill: none;
        stroke: #d7d5af;
        stroke-width: 0.263;
        stroke-linecap: round;
        stroke-miterlimit: 10;
      "
                x1="28.1"
                y1="108.1"
                x2="27.4"
                y2="113.4" />
              <line
                style="
        fill: none;
        stroke: #d7d5af;
        stroke-width: 0.263;
        stroke-linecap: round;
        stroke-miterlimit: 10;
      "
                x1="32"
                y1="108.1"
                x2="32.6"
                y2="113.4" />
              <polyline
                style="
        fill: none;
        stroke: #d7d5af;
        stroke-width: 0.263;
        stroke-linecap: round;
        stroke-miterlimit: 10;
      "
                points="27.8,113.5 28.3,112.8 28.8,113.5 29.6,112.8 30,113.5 30.7,112.9 31.2,113.5 31.8,112.8 32.3,113.5" />
            </g>
            <!-- /bulb -->
            <rect
              x="20.7"
              y="66.7"
              style="fill: #2d2d2f"
              width="18.6"
              height="15.6" />
            <rect
              x="28.5"
              y="0"
              style="fill: #2d2d2f"
              width="3"
              height="66.7" />
            <path
              style="fill: #2d2d2f"
              d="M30,80.3c-16.6,0-30,13.4-30,30h60C60,93.8,46.6,80.3,30,80.3z" />
            <path
              style="fill: #2d2d2f"
              d="M30,80.3c-16.6,0-30,13.4-30,30h60C60,93.8,46.6,80.3,30,80.3z" />

            <g class="switch">
              <line
                style="
        fill: none;
        stroke: #2d2d2f;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
      "
                x1="49"
                y1="100"
                x2="49"
                y2="118" />
              <circle
                style="
        fill: none;
        stroke: #2d2d2f;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
      "
                cx="49"
                cy="120"
                r="1.6" />
            </g>
          </svg>

          <h1 class="ligada-desligada">Ligada</h1>
        </div>
      </div>
    </div>





  </div>
  </div>
  <br>
  <br>
  <br>
  <br>


  <div class="container mt-5">
    

   <?php
    
    if (isset($_SESSION['AlertaDados']) && is_array($_SESSION['AlertaDados']) && count($_SESSION['AlertaDados']) > 0) {
      echo '<div class="mt-5">';
      echo '<h3 class="text-center">Alertas</h3>';
      foreach ($_SESSION['AlertaDados'] as $alerta) {
          // Acessando e exibindo os dados do alerta
          echo "<br>";
          echo '<div class="alert alert-danger">';
          echo '<strong>Alerta:</strong> ' . htmlspecialchars($alerta['alerta']) . '<br>'; // Alerta
          echo '<strong>Nome da Sala:</strong> ' . htmlspecialchars($alerta['sala']) . '<br>'; // Nome da sala
          echo '<strong>Data:</strong> ' . htmlspecialchars($alerta['dataAlerta']) . '<br>'; // Data do alerta
          echo '<strong>Sensor:</strong> ' . htmlspecialchars($alerta['sensor']) . '<br>'; // Tipo de sensor
          echo '</div>';
      }
      echo '</div>';
  }
   else {
      echo '<div class="alert alert-info">Não existem alertas para exibir.</div>';
  }
  
    ?>
  </div>



  </div>
  </div>
  </div>
</body>

</html>