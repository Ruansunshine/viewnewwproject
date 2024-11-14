<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do Ambiente</title>
    <style>
        body {
            margin: 0; /* Remove margens */
            padding: 0; /* Remove preenchimento */
            height: 100vh; /* Altura total da tela */
            overflow: hidden; /* Evita barras de rolagem no body */
        }
        .background-image {
            position: absolute; /* Posiciona a imagem de fundo */
            top: 0; /* Alinha ao topo */
            left: 0; /* Alinha à esquerda */
            width: 100%; /* Largura total */
            height: 100%; /* Altura total */
            background-image: url('https://bdtechtalks.com/wp-content/uploads/2019/08/smart-home-internet-of-things-iot.jpg'); /* Substitua pelo caminho da sua imagem */
            background-size: cover; /* Cobre toda a área da tela */
            background-position: center; /* Centraliza a imagem */
            z-index: 1; /* Coloca a imagem atrás do conteúdo */
        }
        .container {
            position: relative; /* Permite que os filhos se posicionem em relação a ele */
            max-width: 1500px; /* Limita a largura do contêiner */
            margin: auto; /* Centraliza o contêiner */
            padding: 20px; /* Espaçamento interno */
            background-color: rgba(0, 0, 0, 0.8); /* Fundo semi-transparente */
            color: #e0e0e0; /* Cor do texto */
            z-index: 2; /* Coloca o contêiner acima da imagem */
            border-radius: 8px; /* Bordas arredondadas */
            height: 80vh; /* Define altura fixa do contêiner */
            overflow-y: auto; /* Habilita rolagem vertical quando necessário */
            margin-top: 10vh;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-info {
            background-color: #007bff; /* Cor para mensagens de info */
            color: white; /* Texto branco */
        }
        .alert-warning {
            background-color: #ffc107; /* Cor para mensagens de alerta */
            color: black; /* Texto preto */
        }
        .data-tuple-container {
            background-color: #1a1a1a; /* Cor de fundo do card */
            border: 1px solid #444; /* Borda do card */
            border-radius: 8px; /* Bordas arredondadas */
            padding: 20px; /* Espaçamento interno do card */
            margin-bottom: 20px; /* Espaçamento inferior entre cards */
            width: 100%; /* O card ocupa 100% da largura disponível */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra para dar profundidade */
        }
        .table {
            width: 100%; /* Tabela ocupa toda a largura do card */
            margin: 0; /* Sem margem */
            border-collapse: collapse; /* Remover espaçamento entre células */
        }
        .table th, .table td {
            padding: 10px; /* Espaçamento interno das células */
            text-align: left; /* Alinhamento à esquerda */
        }
        .thead-dark {
            background-color: #333; /* Cor de fundo do cabeçalho da tabela */
            color: white; /* Texto branco no cabeçalho */
        }
    </style>
</head>
<body>

    <div class="background-image">
        
<a style="color:white;" href="http://localhost/projetoAci/app/views/salas/Myenviroment.php">&larr; Voltar</a>
    </div> 
    <div class="container mt-5">
      <h1> RESULTADO DA SIMULAÇÃO</h1>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Exibe a mensagem de sucesso, se houver
        if (isset($_SESSION['mensagem'])) {
            echo '<div class="alert alert-info">' . htmlspecialchars($_SESSION['mensagem']) . '</div>';
            unset($_SESSION['mensagem']);
        }

        // Verifica se há dados na sessão e exibe
        if (isset($_SESSION['dados'])) {
            foreach ($_SESSION['dados'] as $dado) {
                // Início do contêiner para cada tupla de dados
                echo '<div class="data-tuple-container mb-4">'; // Contêiner para cada tupla

                echo '<div class="table-responsive">'; // Contêiner responsivo para a tabela
                echo '<table class="table table-striped table-bordered">'; // Adicionando classes para estilização
                echo '<thead class="thead-dark">'; // Estilo para o cabeçalho
                echo '<tr><th>Informação</th><th>Detalhes</th></tr>'; // Cabeçalho da tabela
                echo '</thead>';
                echo '<tbody>';
                echo '<tr>'; // Cada linha da tabela
                echo '<td>';
                echo '<div class="data-container">'; // Contêiner para cada célula
                echo '<strong>Local:</strong> ' . htmlspecialchars($dado['NomeSala']) . '<br>';
                echo '<strong>Descrição:</strong> ' . htmlspecialchars($dado['DescricaoSala']) . '<br>';
                echo '<strong>Data Local:</strong> ' . htmlspecialchars($dado['DataCadastro']) . '<br>';
                echo '<strong>Status:</strong> ' . (htmlspecialchars($dado['StatusSala']) == '1' ? 'Ativo' : 'Inativo') . '<br>';
                echo '<strong>Estado da Iluminação:</strong> ' . (isset($dado['IiluminacaoEstado']) ? (htmlspecialchars($dado['IiluminacaoEstado']) == '1' ? 'Ligado' : 'Desligado') : 'NULL') . '<br>';
                echo '<strong>Temperatura:</strong> ' . (isset($dado['Temperatura']) ? htmlspecialchars($dado['Temperatura']) . ' °C' : 'NULL') . '<br>';
                echo '<strong>Consumo de Energia:</strong> ' . (isset($dado['ConsumoEnergia']) ? htmlspecialchars($dado['ConsumoEnergia']) . ' kWh' : 'NULL') . '<br>';
                echo '<strong>Tipo de Sensor:</strong> ' . htmlspecialchars($dado['TipoSensor']) . '<br>';
                echo '</div>'; // Fim do contêiner de dados
                echo '</td>';
                echo '</tr>'; // Fim da linha da tabela
                echo '</tbody>';
                echo '</table>';
                echo '</div>'; // Fim do contêiner responsivo

                echo '</div>'; // Fim do contêiner para cada tupla
            }

            unset($_SESSION['dados']); // Limpa os dados após exibição
        } else {
            echo '<div class="alert alert-warning">Nenhum dado encontrado para exibir.</div>';
        }
        ?>
    </div>
</body>
</html>
