<?php
    require_once('../../config/database.php');
    require_once('../../app/controllers/salasControllers.php');

  
    class RoutesSalas{
       
        private $conexao;
        private $salasController;
        public function __construct($conexao){
            $this->conexao = $conexao; 
            $this->salasController = new salasController($this->conexao); 
            session_start();
        }
        public function Requests(){
         
        $method= $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? '';
        switch ($method){
            case 'POST':
               
                    try {
                        if (!isset($_SESSION['idUser'])) {
                            
                            header('Location: ..login.php?mensagem=Você precisa estar logado.');
                            exit();
                        }
                       
                        $userId = $_SESSION['idUser'];
                if($action === 'cadastrarSala'){
                    $dados = $_POST;
                    $dados['Usuario_IdUsuario'] = $userId; 
                    
                   
                    $resposta = $this->salasController->RegistrarSalas($dados);
                    
                    if($resposta['mensagem'] === 'Inserido com sucesso'){
                        header('Location: http://localhost/projetoAci/app/views/salas/Myenviroment.php?mensagem=Cadastro realizado com sucesso!');
                        exit();
                        }else{
                            header('Location: ../views/Salas/CreateSalas.php?mensagem=CADASTRO NÃO DEU CERTO!');
                            exit();
                    }
                }else if ($action === 'editarSala') {
                    $dados = $_POST;
                  
                    $resposta = $this->salasController->AtualizarSalasController($dados);
                    // var_dump($resposta);
                    // exit();
                    if($resposta['mensagem'] === 'Sala atualizada com sucesso'){
                        var_dump("Redirecionando para o sucesso");
                    header('Location:http://localhost/projetoAci/app/views/salas/Myenviroment.php?mensagem=ediçao da sala deu certo');
                    exit();
                    }else {
                        var_dump("Redirecionando para o fracasso");
                        header('Location: http://localhost/projetoAci/app/views/salas/EditingSala.php?mensagem=ediçao da sala não deu certo');
                        exit();
                    }
                }else if( $action === 'deletarSala'){
                     $dados = $_POST;
                   
                     
                     $resposta= $this->salasController->deleteSalaController($dados);
                    
                     if($resposta['mensagem']=== 'Sala deletada com sucesso'){
                        header('Location:  http://localhost/projetoAci/app/views/salas/Myenviroment.php?mensagem="Sala Deletada ');
                        exit();
                     }else{
                        header("Location: http://localhost/projetoAci/app/views/salas/Myenviroment.php?mensagem= error ao apagar");
                     }
                }else if ($action === 'listarSalas') {
                    $resposta = $this->salasController->SalasUsersControll();
                    if ($resposta['mensagem'] === '') {
                        
                        session_start();
                        $_SESSION['salaslistar'] = $resposta['dados'];
                        header('Location: http://localhost/projetoAci/app/views/salas/ListarSalas.php');
                        exit();
                    } else {
                        header("Location: http://localhost/projetoAci/app/views/salas/ListarSalas.php?mensagem=" . urlencode($resposta['mensagem']));
                        exit();
                    }
                    }else if($action === 'listespecefic'){
                            $dados = $_POST['Usuario_IdUsuario'];
                           
                        $resposta = $this->salasController->salaUserEspecif($dados);
                        
                        if ($resposta['mensagem'] === '') {
                            
                            session_start();
                            $_SESSION['salas'] = $resposta['dados'];
                            header('Location: http://localhost/projetoAci/app/views/salas/Myenviroment.php?mensagem? deu certo');
                            exit();
                        } else {
                            header("Location: http://localhost/projetoAci/app/views/salas/ListarSalas.php?mensagem=" . urlencode($resposta['mensagem']));
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



$routes = new RoutesSalas($conexao); 
    $routes->Requests();
     ?>