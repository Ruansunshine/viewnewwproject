    <?php
    session_start();

    echo "<br>";
     var_dump($_SESSION);

    // Verificar se o usuário está logado
    if (isset($_SESSION['idUser']) && isset($_SESSION['nomeUsuario'])) {
        $idUser = $_SESSION['idUser'];
        $nomeUsuario = $_SESSION['nomeUsuario'];


        if (is_array($nomeUsuario)) {
            $nomeUsuario = implode('', $nomeUsuario);
        }
        $salas = isset($_SESSION['salas']) ? $_SESSION['salas'] : [];
        $sensores = $_SESSION['sensoresSala'] ?? [];
    } else {
        header('Location: login.php?mensagem não chegou os dados');
        exit();
    }
    // var_dump($_SESSION);
    if (isset($_GET['mensagem'])) {
        $mensagem = $_GET['mensagem'];
        if ($mensagem === 'Simulacaodeusucesso') {
            echo "<div class='sucesso'>Simulação de dados realizada com sucesso! Clique em 'Ver' + Visualizar.</div>";
        } else {
            echo "<div class='erro'>$mensagem</div>";
        }
    } 
    ?>
    <!DOCTYPE html>
    <html lang="pt-BR">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Seu Ambiente</title>
        <style>
            /* Mantendo os estilos existentes */
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
                padding: 20px;
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

            .scrollbar {
                overflow-y: auto;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .sala-container {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 10 px;
                padding: 10px;
                box-sizing: border-box;
                width: 100%;
            }

            /* Estilos para os cards de sala */
            .card {
                background-color: #333;
                padding: 15px;
                border-radius: 5px;
                color: #fff;
                box-sizing: border-box;
                width: 100%;
                /* Garante que cada card ocupe a largura total do contêiner */
                margin-bottom: 15px;
            }

            .card-body {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .actions {
                display: flex;
                gap: 10px;

                flex-wrap: wrap;
            }

            .action form {
                margin: 0;
            }

            .button {
                padding: 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
            }

            /* Ajustes para telas maiores */
            @media (min-width: 768px) {
                .header {
                    font-size: 20px;
                }

                .sub-header {
                    font-size: 16px;
                }

                .button {
                    font-size: 16px;
                }
            }
        </style>
    </head>

    <body>
        <a style="color: #fff; margin-top: 2vh" href="http://localhost/projetoAci/app/views/users/homeUser.php">&larr; Voltar</a>
        <header style="margin-top: 2vh;" class="header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <span>Seu ambiente, <span class="user-name"><?php echo htmlspecialchars($nomeUsuario); ?></span></span>
                <form action="http://localhost/projetoAci/app/views/salas/CreateSalas.php" method="POST" style="margin: 0;">
                    <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
                    <button class="button register-button">Nova Sala</button>
                </form>
            </div>
        </header>

        <div class="container">
            <div class="sub-header">
                <p>Aqui você pode visualizar suas salas cadastradas</p>

                <form action="http://localhost/projetoAci/app/routes/RoutesSala.php?action=listespecefic" method="POST" style="display: inline;">
                    <input type="hidden" name="action" value="listespecefic">
                    <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
                    <button type="submit" class="button">Ver minha salas</button>
                </form>
            </div>

            <div class="scrollbar">
                <div class="sala-container">
                    <?php if (empty($salas)): ?>
                        <div class="alert alert-info">Nenhuma sala encontrada.</div>
                    <?php else: ?>
                        <?php foreach ($salas as $sala): ?>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Local: <?= htmlspecialchars($sala['NomeSala']) ?></h5>
                                    <p class="card-text">Descrição: <?= htmlspecialchars($sala['DescricaoSala']) ?></p>
                                    <p class="card-text">Status: <?= htmlspecialchars($sala['StatusSala'] == 1 ? 'Ativo' : 'Inativo') ?></p>
                                </div>

                                <div class="actions">
                                    <form action="http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php" method="POST">
                                        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                        <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
                                        <?php foreach ($sensores as $sensor): ?>
                                            <?php if ($sensor['NomeSala'] === $sala['NomeSala']): ?>
                                                <input type="hidden" name="IdSensor[]" value="<?= htmlspecialchars($sensor['IdSensor']); ?>">
                                                <input type="hidden" name="TipoSensor[]" value="<?= htmlspecialchars($sensor['TipoSensor']); ?>">
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                        <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
                                        <button class="button">Ver</button>
                                    </form>

                                    <form action="http://localhost/projetoAci/app/views/salas/EditingSala.php" method="POST">
                                        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                        <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
                                        <input type="hidden" name="descricaoSala" value="<?= htmlspecialchars($sala['DescricaoSala']) ?>">
                                        <input type="hidden" name="statusSala" value="<?= htmlspecialchars($sala['StatusSala']) ?>">
                                        <input type="hidden" name="Usuario_IdUsuario" value="<?php echo htmlspecialchars($idUser); ?>">
                                        <button class="button">Editar</button>
                                    </form>

                                    <form action="http://localhost/projetoAci/app/routes/RoutesSala.php?action=deletarSala" method="POST">
                                        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                        <button class="button">Apagar</button>
                                    </form>

                                    <form action="http://localhost/projetoAci/app/views/sensor/criarSensor.php" method="POST">
                                        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                        <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
                                        <input type="hidden" name="descricaoSala" value="<?= htmlspecialchars($sala['DescricaoSala']) ?>">
                                        <button class="button">Novo detector</button>
                                    </form>

                                    <form action="http://localhost/projetoAci/app/views/sensor/sensorSala.php" method="POST">
                                        <input type="hidden" name="idSalas" value="<?= htmlspecialchars($sala['IdSalas']) ?>">
                                        <input type="hidden" name="nomeSala" value="<?= htmlspecialchars($sala['NomeSala']) ?>">
                                        <button class="button">Verificar sensores</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </body>

    </html>