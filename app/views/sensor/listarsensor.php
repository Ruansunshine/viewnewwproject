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
                <option value="tempSensor">Temperatura</option>
                <option value="energySensor">Consumo de Energia</option>
                <option value="lightSensor">Estado da Iluminação</option>
            </select>
        </div>
        <!-- Sensor de Estado da Iluminação -->
        <div class="sensor-info" id="lightSensor">
            <h5>Sensor Estado da Iluminação</h5>
            <div id="carouselLightSensor" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">

                   
                <div class="carousel-item active">
                        <img src="imagens/sensorLdr.webp" alt="Sensor Dallas DS18B20">
                        <div class="carousel-caption">
                            <h5>Sensor LDR</h5>
                            <h1>Uma Descrição Detalhada</h1>
                            <p>
                            O sensor LDR possui resistência variável de acordo com a intensidade da luz, tornando-o ideal para medir luminosidade. É altamente sensível, com resposta rápida à mudança de iluminação, fácil de integrar em circuitos eletrônicos e acessível em termos de custo.
                                <strong>Características Principais:</strong> Sensibilidade à intensidade luminosa com resistência inversamente proporcional à luz incidente.
                                Facilidade de integração com circuitos eletrônicos e baixo custo de implementação.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="imagens/SENSOR TSL2561.jpg" alt="Outro Sensor">
                        <div class="carousel-caption">
                            <h5>Sensor para estado da iluminação TSL2561</h5>
                            <h1>Uma Descrição Detalhada</h1>
                            <p>Um sensor mais avançado para monitoramento do estado da iluminação é o sensor de luminosidade TSL2561. Ele utiliza tecnologia de fotodiodos para medir a intensidade luminosa em uma ampla faixa de luz, incluindo luz infravermelha e visível.</p>
                                <strong>Características Principais:</strong>Medição precisa da luz visível e infravermelha em uma ampla faixa de intensidade luminosa.
Comunicação digital via I2C, facilitando a integração com microcontroladores e sistemas embarcados.
                        </div>
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
        <!-- Sensor de Temperatura -->
        <div class="sensor-info" id="tempSensor">
            <h5>Sensor de Temperatura</h5>
            <div id="carouselTemp" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Primeiro item do carrossel (inicialmente ativo) -->
                    <div class="carousel-item active">
                        <img src="imagens/sensorDallas.webp" alt="Sensor Dallas DS18B20">
                        <div class="carousel-caption">
                            <h5>Sensor de Dallas DS18B20</h5>
                            <h1>Uma Descrição Detalhada</h1>
                            <p>
                                O DS18B20 é um sensor de temperatura digital de precisão, amplamente utilizado em diversas
                                aplicações devido à sua simplicidade, baixo custo e alta precisão. Ele é conhecido por sua
                                interface 1-Wire, que permite a conexão de múltiplos sensores a um único pino de um
                                microcontrolador. <br>
                                <strong>Características Principais:</strong> Precisão de ±0,5°C, baixo consumo de energia,
                                faixa de -55°C a +125°C, ideal para monitoramento de temperatura em diversos ambientes.
                            </p>
                        </div>
                    </div>
                    <!-- Segundo item do carrossel -->
                    <div class="carousel-item">
                        <img src="imagens/sensor2.jpg" alt="Outro Sensor">
                        <div class="carousel-caption">
                            <h5>Sensor de Temperatura IR MLX90614</h5>
                            <h1>Uma Descrição Detalhada</h1>
                            <p>
                                Descrição do outro sensor. <br>
                                <strong>Características Principais:</strong> O Sensor de Temperatura IR MLX90614 é um componente de alta precisão que detecta a temperatura corporal ou de objetos por infravermelho, sem que seja necessário o contato direto com o sensor. Ele já vem calibrado de fábrica e detecta temperaturas entre -40 e 125°C, com precisão de 0,5°C, possuindo ainda vários modos de calibração configuráveis pelo usuário.
                            </p>
                        </div>
                    </div>
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

        <!-- Sensor de Consumo de Energia -->
        <div class="sensor-info" id="energySensor">
            <h5>Sensor de Consumo de Energia</h5>
            <div id="carouselEnergy" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <!-- Primeiro item do carrossel (inicialmente ativo) -->
                    <div class="carousel-item active">
                        <img src="imagens/sensorConsumoEnergia.webp" alt="Sensor ACS712">
                        <div style="height: 50vh;" class="carousel-caption">
                            <h5>Sensor Corrente Elétrica Acs712</h5>
                            <h1>Uma Descrição Detalhada</h1>
                            <p>
                                O Sensor de Corrente Elétrica ACS712 é um módulo que mede corrente AC e DC, amplamente utilizado em projetos de eletrônica para monitoramento de consumo de corrente em dispositivos elétricos. Ele utiliza um sensor de efeito Hall que detecta o campo magnético gerado pela corrente, fornecendo uma saída analógica proporcional à corrente medida. Este sensor é compacto e fornece isolamento galvânico, aumentando a segurança para medir correntes em circuitos de alta tensão. <br>
                                <strong>Especificações e Características:</strong> Faixas de Corrente: Variações de -5A a +5A, -20A a +20A e -30A a +30A, dependendo do modelo (ACS712-05B, ACS712-20A, ACS712-30A). Tensão de Operação: 5V DC. Saída: Analógica.
                            </p>
                        </div>
                    </div>

                    <div class="carousel-item">
                        <img src="imagens/SensorHLW8012.png" alt="Sensor HLW8012">
                        <div class="carousel-caption">
                            <h5>Sensor HLW8012</h5>
                            <h1>Uma Descrição Detalhada</h1>

                            <!-- Área rolável para o texto -->
                            <div style="max-height: 300px; overflow-y: auto; color: white; padding-right: 10px;">
                                <p>
                                    O HLW8012 é um sensor de consumo de energia utilizado principalmente para medir potência ativa, corrente e tensão em sistemas de corrente alternada (AC). É um chip popular em projetos de automação residencial e em dispositivos inteligentes, como tomadas e medidores de energia, por sua capacidade de medir e transmitir dados de consumo de forma precisa. Ele funciona com uma faixa de tensão e corrente AC, fornecendo saídas de pulsos proporcionais à potência ativa e corrente, facilitando a integração com microcontroladores para o monitoramento contínuo de consumo de energia. <br>

                                    <strong>Especificações e Características:</strong>
                                    Faixa de Tensão: Até 220V AC.<br>
                                    Faixa de Corrente: Até 20A (dependendo dos circuitos auxiliares e componentes).<br>
                                    Saídas: Pulsos para potência ativa e corrente.<br>
                                    Precisão: Alta precisão para medições de consumo de energia.<br>
                                    Aplicações Comuns: Dispositivos de IoT, medidores de energia, automação residencial.<br>
                                    Comunicação: Facilidade de integração com microcontroladores, como ESP8266 e ESP32.
                                </p>
                            </div>
                        </div>
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