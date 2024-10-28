<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seu Ambiente</title>
    <style>
      body {
        font-family: "Poppins", sans-serif;
        background-color: #121212;
        padding: 10px;
        color: #fff;
        margin: 0;
        display: flex;
        flex-direction: column;
        height: 100vh;
        overflow-y: hidden;
      }

      .container {
        border: 1px solid #fff;
        padding: 20px 20px 0px 20px;
        border-radius: 10px;
        background-color: #1e1e1e;
        height: 80%;
        display: flex;
        flex-direction: column;
      }

      .header {
        font-size: 5vw;
        font-weight: bold;
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 10px;
        border: 1px solid #fff;
      }

      .sub-header {
        display: flex;
        font-size: 3vw;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
      }

      .button {
        display: inline-block;
        padding: 10px 15px;
        margin-left: 5px;
        background-color: #444;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 2vw;
      }

      .button:hover {
        background-color: #666;
      }

      .sala-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #333;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
      }

      .sala-container .nome-sala {
        font-size: 4vw;
      }

      .sala-container .actions {
        display: flex;
      }

      .actions .button {
        margin-left: 5px;
      }

      .register-button {
        float: right;
      }

      .scrollbar {
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        height: 100%;
      }

      @media (min-width: 768px) {
        .header {
          font-size: 20px;
        }

        .sub-header {
          font-size: 16px;
        }

        .sala-container .nome-sala {
          font-size: 16px;
        }

        .button {
          font-size: 16px;
        }
      }
    </style>
  </head>

  <body>
  <a style="color: #fff; margin-top: 2vh"  href="http://localhost/projetoAci/app/views/users/homeUser.php">&larr; Voltar</a>
    <header style="margin-top: 2vh;" class="header">
      Seu ambiente, <span class="user-name">Fulano de Tal</span>
    </header>

    <div class="container">
      <div class="sub-header">
        <p>Aqui você pode visualizar suas salas cadastradas</p>
        <form action="http://localhost/projetoAci/app/views/salas/CreateSalas.php" method="POST">
        <button class="button register-button">Cadastrar nova sala</button>
        </form>
      </div>

      <div class="scrollbar">
        <div class="sala-container">
          <div class="nome-sala">Sala 1</div>
          <div class="actions">
            <form action="http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php">
            <button class="button">Ver</button>
            </form>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 2</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 3</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 3</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 4</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 5</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 6</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 7</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 8</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 9</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 10</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>

        <div class="sala-container">
          <div class="nome-sala">Sala 11</div>
          <div class="actions">
            <button class="button">Ver</button>
            <button class="button">Editar</button>
            <button class="button">Apagar</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
