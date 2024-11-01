<?php
session_start();



if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
    $idUser = $_SESSION['idUser'];
    $nomeUsuario = is_array($_SESSION['nomeUsuario']) ? implode('', $_SESSION['nomeUsuario']) : $_SESSION['nomeUsuario'];

    $_SESSION['salas'] = $_SESSION['salas'] ?? []; // Inicializa como um array vazio se não estiver definido

    $salas = $_SESSION['salas']; // Atribui à variável
} else {
    header('Location: login.php?mensagem=Você precisa estar logado aqui é a home ambiente .');
    exit();
}
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

      .ligada-desligada{
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
        animation: bulb 0.3s 0.3s 5 cubic-bezier(0.26, 1.17, 0.89, -0.74)
          alternate forwards;
      }

      @keyframes bulb {
        to {
          fill-opacity: 1;
          fill: #cccc; /* Desligado */
          fill: #fbf8ca; /* Ligado */
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
      <header style="margin-top: 1vh;"   class="header"> Dashboard</header>
      <form action="http://localhost/projetoAci/app/views/sensor/sensorSala.php">

        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['idSalas']) ?>">
        <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['nomeSala']) ?>">
          <button style="margin-left: 171vh; color:#000" class="button register-button">Verificar sensores</button>
          </form>
      <div class="container">
        <div class="sub-header">
          <p>
            Aqui você pode visualizar dados dos sensores da
            <span class="nome-sala">sala 2</span>
          </p>
        
          
        </div>

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
  class="lamp"
>
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
      y2="113.4"
    />
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
      y2="113.4"
    />
    <polyline
      style="
        fill: none;
        stroke: #d7d5af;
        stroke-width: 0.263;
        stroke-linecap: round;
        stroke-miterlimit: 10;
      "
      points="27.8,113.5 28.3,112.8 28.8,113.5 29.6,112.8 30,113.5 30.7,112.9 31.2,113.5 31.8,112.8 32.3,113.5"
    />
  </g>
  <!-- /bulb -->
  <rect
    x="20.7"
    y="66.7"
    style="fill: #2d2d2f"
    width="18.6"
    height="15.6"
  />
  <rect
    x="28.5"
    y="0"
    style="fill: #2d2d2f"
    width="3"
    height="66.7"
  />
  <path
    style="fill: #2d2d2f"
    d="M30,80.3c-16.6,0-30,13.4-30,30h60C60,93.8,46.6,80.3,30,80.3z"
  />
  <path
    style="fill: #2d2d2f"
    d="M30,80.3c-16.6,0-30,13.4-30,30h60C60,93.8,46.6,80.3,30,80.3z"
  />

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
      y2="118"
    />
    <circle
      style="
        fill: none;
        stroke: #2d2d2f;
        stroke-width: 0.5;
        stroke-miterlimit: 10;
      "
      cx="49"
      cy="120"
      r="1.6"
    />
  </g>
</svg>

<h1 class="ligada-desligada">Ligada</h1>
</div>
</div>
</div>
            <form action="http://localhost/projetoAci/app/views/sensor/criarSensor.php" method="POST">             
              
              <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['idSalas']) ?>">
              <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['nomeSala']) ?>">
              
          <button style="margin-left: 150vh; color:#000" type="submit" class="button register-button">Novo detector</button>
          </form>
          </div>
        </div>
      </div>
    </body>
  </html>
