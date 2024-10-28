<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seu Ambiente</title>
    <style>

@font-face {
    font-family: 'SevenSegment';
    src: url('./fonts/SevenSegment.ttf') format('truetype');
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
        background: #58E9FF;
        display: flex;
        width:90%;
        padding: 5px;
        height: 90%;
        align-items: center;
        justify-content: center;
      }

      .digital-display .number{
        font-family: 'SevenSegment', monospace;
        color: #000;
        font-size: 1.5rem;
        display: flex;
      }

      .digital-display .kw-h{
        font-family: 'SevenSegment', monospace;
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
        left: -70px;
        font-size: 12px;
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

        .digital-display .number{
          font-size: 4rem;
        }

        .digital-display .kw-h{
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
    </style>
  </head>

  <body>
  <a style="color:#e0e0e0" href="http://localhost/projetoAci/app/views/salas/Myenviroment.php">&larr; Voltar</a>
    <header style="margin-top: 1vh;"   class="header"> Dashboard</header>

    <div class="container">
      <div class="sub-header">
        <p>
          Aqui você pode visualizar dados dos sensores da
          <span class="nome-sala">sala 2</span>
        </p>
        <form action="http://localhost/projetoAci/app/views/sensor/sensorSala.php">
        <button class="button register-button">Verificar sensores</button>
        </form>
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


          <div class="lampada"></div>
        </div>
      </div>
    </div>
  </body>
</html>
