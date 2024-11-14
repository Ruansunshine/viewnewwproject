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
                display: inline-block;
                margin-bottom: 20px;
            }

            .sensor-info {
                display: none;
                color: white;
                /* Inicialmente escondido */
            }

            .sensor-info.active {
                color: white;
                display: block;
                /* Mostrar apenas informações ativas */
            }

            .carousel-item img {
                max-width: 100%;
                height: auto;
                /* Ajuste para manter a proporção da imagem */
            }

            .carousel-caption {
                max-width: 100%;
                background: rgba(0, 0, 0, 0.5);
                /* Fundo semi-transparente para melhor legibilidade */
                padding: 10px;
                border-radius: 5px;
            }

            @media (min-width: 768px) {
                .carousel-item {
                    flex-direction: row;
                    text-align: left;
                }

                .carousel-item img {
                    flex: 1;
                    max-width: 50%;
                    margin-right: 20px;
                }

                .carousel-caption {
                    flex: 1;
                    text-align: left;
                    margin-left: 50vh;
                    height: 93%;
                }
            }

            .carousel-caption h5 {
                font-size: 1.2em;
                font-weight: bold;
                color: white;
                /* Garantir que o texto seja visível */
            }

            .carousel-caption h1 {
                font-size: 1.8em;
                font-weight: bold;
                color: white;
                /* Garantir que o texto seja visível */
                margin-bottom: 15px;
            }

            .carousel-caption p {
                font-size: 1em;
                line-height: 1.6;
                color: white;
                /* Garantir que o texto seja visível */
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
                    
                    <option value="lightSensor">Estado da Iluminação</option>
                </select>
            </div>


                <!-- Sensor de Estado da Iluminação -->
                <div class="sensor-info" id="lightSensor">
                    <div id="carouselLightSensor" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="imagens/sensorLdr.webp" class="d-block w-100" alt="Sensor LDR">
                            </div>
                            <div class="carousel-item">
                                <img src="imagens/SensorHLW8012.png" class="d-block w-100" alt="Sensor HLW8012">
                            </div>
                            <div class="carousel-item">
                                <img src="imagens/sensorDallas.webp" class="d-block w-100" alt="Sensor Dallas">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselLightSensor" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselLightSensor" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
                <script>
                    document.getElementById('sensorSelect').addEventListener('change', function() {
                        console.log('Seleção de sensor:', this.value); // Verifica o valor selecionado
                        const allSensorInfo = document.querySelectorAll('.sensor-info');
                        allSensorInfo.forEach(info => info.classList.remove('active')); // Esconde todos os sensores
                        const selectedValue = this.value;
                        if (selectedValue) {
                            console.log('Exibindo sensor:', selectedValue); // Verifica se está exibindo o sensor correto
                            document.getElementById(selectedValue).classList.add('active'); // Mostra o sensor selecionado
                        }
                    });
                </script>
    </body>

    </html>