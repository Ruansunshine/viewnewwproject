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
                if($action === 'simularAmbiente'){
                    $dados = $_POST;
                    // echo "DADOS DO POST=";
                    //  var_dump($dados);
                    // echo "<br>";
               
                    if (isset($dados['idSensor']) && isset($dados['TipoSensor'])   ){
                        $dados['IdSensor_IdSensor'] = (array) $dados['idSensor'];
                        $dados['Tipo'] =  (array)$dados['TipoSensor'];
                    }
                //     echo "<br>";
                //     echo "DADOS DO POST DEPOIS DO IF =";
                //     var_dump($dados);
                //    echo "<br>";
                   
                    $resposta = $this->ambienteController->contoleStored($dados);
                //     echo "<br>";
                //     echo "DADOS DA RESPOSTA NA ROTA  =";
                //     var_dump($resposta);
                //    echo "<br>";
                //    exit();
                    if ($resposta['mensagem'] === 'Simulação de dados realizada com sucesso') {
                    
                        header('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem=Simulacaodeusucesso!');
                        exit();
                        }else{
                            header('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem=ERRO,erro!');
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
                }else if ($action === 'Views'){
                    $dados = $_POST;
                    
                    $resposta= $this->ambienteController->ControllerDadosAmbienteSensor($dados);
                    
                    if($resposta['mensagem'] === 'Dados obtidos com sucesso'){
                        if (isset($resposta['dados'])) {
                            $_SESSION['dados'] = $resposta['dados'];
                        }
                        $_SESSION['mensagem'] = $resposta['mensagem'];
                     header('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem=Sucesso ');
                    }else{
                        header('Location: http://localhost/projetoAci/app/views/ambienteRegistro/homeAmbiente.php?mensagem=falhou ');
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
    $routes = new routesAmbiente($conexao);
   $routes->Requests();
    ?>