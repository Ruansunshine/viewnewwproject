<?php
    require_once('../../config/database.php');
    require_once('../../app/controllers/ambientecontroller.php');

  
    class routesAmbiente{
       
        private $conexao;
        private $ambienteController;
        public function __construct($conexao){
            $this->conexao = $conexao; 
            $this->ambienteController = new AmbienteController ($this->conexao); 
            session_start();
                }
        public function Requests(){
         
        $method= $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? '';
        switch ($method){
            case 'POST':
                try{
                if($action === 'cadastrarSensor'){
                    $dados = $_POST;
                   
                    $resposta = $this->ambienteController->RegistrarAmbiente($dados);
                    
                    if ($resposta['sucess']) {
                        $_SESSION['idUser'] = $resposta['idUsuario'];
                        header('Location: ../views/users/homeAmbiente.php?mensagem=Cadastro realizado com sucesso!');
                        exit();
                        }else{
                            header('Location: ../views/users/createUsers.php?mensagem=ERRO, dados incompletos!');
                            exit();
                    }
               
                }else if( $action === 'listar'){
                     $dados = $_POST;
                     $resposta= $this->ambienteController->ListarAmbientes($dados);
                     if($resposta['mensagem']=== 'Usuario atualizado com sucesso'){
                        header('Location:  ../views/users/editingUser.php?mensagem="usuario atualizado ');
                        exit();
                     }else{
                        header("Location: ../views/users/homeUser.php?mensagem= dados incompletos para atualizar");
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