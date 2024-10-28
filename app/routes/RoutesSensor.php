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
                    if (!isset($_SESSION['idSalas'])) {
                            
                        header('Location: ..login.php?mensagem=Você precisa estar logado.');
                        exit();
                    }
                   $idSala = $_SESSION['idSalas'];
                   
                if($action === 'cadastrar'){
                    $dados = $_POST;
                   $dados['Salas_idSalas'] = $idSala;
                    $resposta = $this->sensorController->RegistrarSensor($dados);
                    
                    if ($resposta['sucess']) {
                        $_SESSION['idUser'] = $resposta['idUsuario'];
                        header('Location: ../views/users/homeUser.php?mensagem=Cadastro realizado com sucesso!');
                        exit();
                        }else{
                            header('Location: ../views/users/createUsers.php?mensagem=ERRO, dados incompletos!');
                            exit();
                    }
                }else if ($action === 'editar') {
                    $dados = $_POST;
                    $resposta = $this->sensorController->AtualizarSensor($dados);
                    if($resposta['mensagem']=== 'Login realizado com sucesso'){
                        $_SESSION['idUser'] = $resposta['IdUsuario']; 
                    header('Location: ../views/users/homeUser.php?mensagem=Login realizado com sucesso');
                    exit();
                    }else {
                        header("Location:  ../views/users/login.html?mensagem=Usuario não enncontrado");
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
                }else if( $action === 'delete'){
                        $dados = $_POST;
                        $resposta = $this->sensorController->DeleteSensor($dados);
                        if($resposta['mensagem'] === 'Usuario e suas dependencia deletadas'){
                            header("Location:");
                            exit();
                        }else{
                            header("mensagem: sucesso");
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
    $routes = new routesUsuarios($conexao);
   $routes->Requests();
    ?>