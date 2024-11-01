<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navegação de Detectores</title>
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
        a {
            color: white;
            font-size: 1.2rem;
            text-decoration: none;
        }
        .sensor-info {
            display: none; /* Inicialmente escondido */
        }
        .active {
            display: block; /* Mostrar apenas informações ativas */
        }
    </style>
</head>
<body>
    <a href="http://localhost/projetoAci/app/views/users/homeUser.php">&larr; Voltar</a>
    <div class="container mt-3">
        <h1>Bem-vindos à navegação de detectores</h1>
        
        <div class="mb-3">
            <select class="form-select" id="sensorSelect">
                <option value="">Selecione um tipo de sensor</option>
                <option value="tempSensor">Temperatura</option>
                <option value="energySensor">Consumo de Energia</option>
                <option value="lightSensor">Estado da Iluminação</option>
                <!-- Adicione mais opções se necessário -->
            </select>
        </div>

        <!-- Carrossel para Sensor de Temperatura -->
        <div class="sensor-info" id="tempSensor">
            <h5>Sensor de Temperatura</h5>
            <div id="carouselTemp" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="link_para_imagem_1.jpg" class="d-block w-100" alt="Sensor 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 1</h5>
                            <p>Este sensor mede a temperatura em graus Celsius.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="link_para_imagem_2.jpg" class="d-block w-100" alt="Sensor 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 2</h5>
                            <p>Este sensor é ideal para ambientes internos.</p>
                        </div>
                    </div>
                    <!-- Adicione mais itens de carrossel conforme necessário -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselTemp" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselTemp" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>

        <!-- Carrossel para Sensor de Consumo de Energia -->
        <div class="sensor-info" id="energySensor">
            <h5>Sensor de Consumo de Energia</h5>
            <div id="carouselEnergy" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="link_para_imagem_1.jpg" class="d-block w-100" alt="Sensor 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 1</h5>
                            <p>Este sensor monitora o consumo de energia em tempo real.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="link_para_imagem_2.jpg" class="d-block w-100" alt="Sensor 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 2</h5>
                            <p>Ideal para gerenciar o consumo energético.</p>
                        </div>
                    </div>
                    <!-- Adicione mais itens de carrossel conforme necessário -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselEnergy" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselEnergy" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>

        <!-- Carrossel para Sensor de Estado da Iluminação -->
        <div class="sensor-info" id="lightSensor">
            <h5>Sensor de Estado da Iluminação</h5>
            <div id="carouselLight" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="link_para_imagem_1.jpg" class="d-block w-100" alt="Sensor 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 1</h5>
                            <p>Este sensor detecta o estado da iluminação em um ambiente.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="link_para_imagem_2.jpg" class="d-block w-100" alt="Sensor 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Descrição do Sensor 2</h5>
                            <p>Ajuda a otimizar o uso de energia através da iluminação.</p>
                        </div>
                    </div>
                    <!-- Adicione mais itens de carrossel conforme necessário -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselLight" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselLight" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Próximo</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mostrar ou esconder informações de sensores com base na seleção
        document.getElementById('sensorSelect').addEventListener('change', function() {
            // Esconder todas as informações de sensores
            const allSensorInfo = document.querySelectorAll('.sensor-info');
            allSensorInfo.forEach(info => info.classList.remove('active'));

            // Mostrar apenas a informação do sensor selecionado
            const selectedValue = this.value;
            if (selectedValue) {
                document.getElementById(selectedValue).classList.add('active');
            }
        });
    </script>
</body>
</html>
