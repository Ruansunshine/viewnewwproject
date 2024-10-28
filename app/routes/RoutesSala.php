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
                        header('Location: ../views/Salas/CreateSalas.php?mensagem=Cadastro realizado com sucesso!');
                        exit();
                        }else{
                            header('Location: ../views/Salas/CreateSalas.php?mensagem=CADASTRO NÃO DEU CERTO!');
                            exit();
                    }
                }else if ($action === 'editarSala') {
                    $dados = $_POST;
                    $resposta = $this->salasController->AtualizarSalasController($dados);
                    if($resposta['mensagem']=== 'sala atualizada com sucesso'){
                    header('Location: ../views/users/homeUser.php?mensagem=sala atualizada com sucesso');
                    exit();
                    }else {
                        header("Location:  ../views/users/login.html?mensagem=Usuario não enncontrado");
                    }
                }else if( $action === 'deletarSala'){
                     $dados = $_POST;
                     $resposta= $this->salasController->deleteSalaController($dados);
                     if($resposta['mensagem']=== 'Sala deletada com sucesso'){
                        header('Location:  ../views/users/editingUser.php?mensagem="usuario atualizado ');
                        exit();
                     }else{
                        header("Location: ../views/users/homeUser.php?mensagem= dados incompletos para atualizar");
                     }
                }else if ($action === 'listarSalas') {
                    $resposta = $this->salasController->SalasUsersControll();
                    if ($resposta['mensagem'] === '') {
                        
                        session_start();
                        $_SESSION['salas'] = $resposta['dados'];
                        header('Location: http://localhost/projetoAci/app/views/salas/ListarSalas.php');
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