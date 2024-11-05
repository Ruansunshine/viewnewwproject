<?php
    require_once('../../config/database.php');
    require_once('../../app/controllers/sensorcontroller.php');
     
  
    class routesSensor{
       
        private $conexao;
        private $sensorController;
        public function __construct($conexao){
            $this->conexao = $conexao; 
            $this->sensorController = new sensorController($this->conexao); 
            session_start();
                }
        public function Requests(){
         
        $method= $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? '';
        switch ($method){
                case 'POST':
                    try{
                    
                    if (empty($_SESSION['salas'])) {
                        header('Location: ../login.php?mensagem=Você precisa estar logado aqui e a rota.');
                        exit();
                    }
                    $idSala = $_SESSION['salas'][0]['IdSalas'];
                    
                    if($action === 'cadastrarSensor'){
                        $dados = $_POST;
                    $dados['Salas_idSalas'] = $idSala;
                    $dados['IdUsuario'] = $_SESSION['salas'][0]['IdUsuario'];
                        
                        
                        $resposta = $this->sensorController->RegistrarSensor($dados);
                    
                        if ($resposta['sucess']) {
                        
                            $_SESSION['idUser'] = $_SESSION['salas'][0]['IdUsuario'];
                            
                            header('Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem=Novo sensor inserido');
                            exit();
                            }else{
                                header('Location: http://localhost/projetoAci/app/views/sensor/criarSensor.php?mensagem=ERRO, não foi cadastrado!');
                                exit();
                        }
                    }else if ($action === 'editarSensor') {
                    $dados = $_POST;
                    var_dump($dados); //aqui ta chegando
                  
                    $resposta = $this->sensorController->AtualizarSensor($dados);
                  var_dump($resposta); //chega aqui
                  exit();
                    if($resposta['mensagem']=== 'sensor atualizado com sucesso'){ 
                        $_SESSION['idUser'] = $resposta['IdUsuario']; 
                        $_SESSION['idSensor'] = $dados['idSensor'];
                        $_SESSION['tipoSensor'] = $dados['TipoSensor'];
                    header('Location: http://localhost/projetoAci/app/views/sensor/EditingSensor.php?mensagem=Atualização completa');
                    exit();
                    }else {
                        
                        header('Location: http://localhost/projetoAci/app/views/sensor/EditingSensor.php?mensagem=erro na atualização');
                        exit();
                    }
                }else if( $action === 'listar'){
                     $dados = $_POST;
                     $resposta= $this->sensorController->ListarSensores($dados);
                     if($resposta['mensagem']=== 'Usuario atualizado com sucesso'){
                        header('Location:  ../views/users/editingUser.php?mensagem="usuario atualizado ');
                        exit();
                     }else{
                        header("Location: ../views/users/homeUser.php?mensagem= dados incompletos para atualizar");
                     }
                }else if($action === 'delete') {
                    $dados = $_POST;
                
                    if (isset($dados['idSensor'])) {
                        $dados['IdSensor'] = (int)$dados['idSensor'];
                    } else {
                        
                        header("Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem=ID do sensor ausente");
                        exit();
                    }
                
                    $resposta = $this->sensorController->DeleteSensor($dados);
                
                    if ($resposta['mensagem'] === 'Sensor deletado com sucesso, e registros associados na tabela ambiente removidos') {
                        if (isset($_SESSION['sensores'])) {
                            $_SESSION['sensores'] = array_filter($_SESSION['sensores'], function($sensor) use ($dados) {
                                return (int)$sensor['IdSensor'] !== $dados['IdSensor'];
                            });
                        }
                
                       
                        if (!isset($dados['Salas_idSalas'])) {
                            header("Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem=ID da sala ausente");
                            exit();
                        }
                
                        header("Location: http://localhost/projetoAci/app/routes/RoutesSensor.php?action=listSensorUserSala&idSalas=" . $dados['Salas_idSalas']);
                        exit();
                    } else {
                        header("Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem=Erro ao deletar sensor");
                        exit();
                    }
                }
                else if($action === 'listSensorUserSala'){
               
                        $dados = $_POST;
                       
                        if (empty($dados) && isset($_GET['idSalas'])) {
                            $dados['Salas_idSalas'] = $_GET['idSalas'];
                        } else if (isset($dados['idSalas'])) {
                            $dados['Salas_idSalas'] = $dados['idSalas'];
                        }
                        if (isset($dados['Salas_idSalas'])) {
                        $resposta = $this->sensorController->controlerSensorSalaUser($dados);

                       
                        if($resposta['mensagem'] === 'Consulta bem sucedida'){
                            $_SESSION['sensores'] = $resposta['sensores'];  
                            header('Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem = listados com sucesso');
                            exit();
                        }else{
                            header('Location: http://localhost/projetoAci/app/views/sensor/sensorSala.php?mensagem = nenhuma a ser listada ou erro.');
                            exit();
                        }
                    }

                    }else if ($action === 'buscarAmbiente'){
                        $dados = $_POST;
                        if (isset($dados['idSalas'])){
                            $dados['Salas_idSalas'] = $dados['idSalas'];
                        }
                        $resposta = $this->sensorController->controleSalaAmbiente($dados);
                        if($resposta['mensagem'] === 'Consulta bem sucedida'){
                              $_SESSION['ambiente'] = $resposta['ambiente'];
                              header('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem =dadosdoambientesucesso');
                              exit();
                        }else {
                              header ('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem= dadosnaoretornadoorconsulta falhou');
                              exit();
                        }
                    }
            }catch (mysqli_sql_exception $e) {
                header('Location:  ../views/users/createUsers.php?mensagem=ERRO, ' . urlencode("Erro: " . $e->getMessage()));
                exit();
        }
        
    break;
         default:
         break;
        }
     

    }
    
    }
    $routes = new routesSensor($conexao);
   $routes->Requests();
    ?>