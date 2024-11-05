        <?php
        require_once('../../config/database.php');
        require_once('../../app/controllers/usersControllers.php');
        require_once('../../app/models/usermodels.php');

    
        class routesUsuarios{
        
            private $conexao;
            private $UsuarioController;
            public function __construct($conexao){
                $this->conexao = $conexao; 
                $this->UsuarioController = new UsuarioController($this->conexao); 
                session_start();
                    }
            public function Requests(){
            
            $method= $_SERVER['REQUEST_METHOD'];
            $action = $_GET['action'] ?? '';
            switch ($method){
                case 'POST':
                    try{
                    if($action === 'cadastrar'){
                        session_start();
                        $_SESSION= [];
                        $dados = $_POST;
                    
                        $resposta = $this->UsuarioController->Registrar($dados);
                        
                        if ($resposta['sucess']) {
                            $_SESSION['idUser'] = $resposta['idUsuario'];

                            // Recuperando as informações do usuário diretamente na sessão
                            $usuarioInfo = $this->UsuarioController->GetByNameId($_SESSION['idUser']);
                            $_SESSION['nomeUsuario'] = $usuarioInfo['nomeUsuario'];
                            $_SESSION['emailUsuario'] = $usuarioInfo['emailUsuario'];
                            $_SESSION['senhaUsuario'] = $usuarioInfo['senhaUsuario'];
                            header('Location: ../views/users/homeUser.php?mensagem=Cadastro realizado com sucesso!');
                            exit();
                            }else{
                                header('Location: ../views/users/createUsers.php?mensagem=ERRO, dados incompletos!');
                                exit();
                        }
                    }else if ($action === 'login') {
                        session_start();
                        $_SESSION = [];
                        $dados = $_POST; 
                        
                        $resposta = $this->UsuarioController->LoginUsuario($dados);
                        if($resposta['mensagem']=== 'Login realizado com sucesso'){
                            $_SESSION['idUser'] = $resposta['IdUsuario'];

                            // Recuperando as informações do usuário diretamente na sessão
                            $usuarioInfo = $this->UsuarioController->GetByNameId($_SESSION['idUser']);
                            $_SESSION['nomeUsuario'] = $usuarioInfo['nomeUsuario'];
        $_SESSION['emailUsuario'] = $usuarioInfo['emailUsuario'];
        $_SESSION['senhaUsuario'] = $usuarioInfo['senhaUsuario'];
                        header('Location: ../views/users/homeUser.php?mensagem=Login realizado com sucesso');
                        exit();
                        }else {
                            header("Location:  http://localhost/projetoAci/app/views/users/login.php?mensagem=Usuario não enncontrado");
                            exit();
                        }
                    }else if( $action === 'editar'){
                        $dados = $_POST;
                        $resposta= $this->UsuarioController->AtualizarControllerUser($dados);
                        if($resposta['mensagem']=== 'Usuario atualizado com sucesso'){
                            header('Location:  http://localhost/projetoAci/app/views/users/perfil.php?mensagem="Usuario atualizado com sucesso');
                            exit();
                        }else{
                            header("Location: ../views/users/homeUser.php?mensagem= dados incompletos para atualizar");
                        }
                    }else if( $action === 'delete'){
                            $dados = $_POST;
                            $resposta = $this->UsuarioController->deleteUserController($dados);
                            if($resposta['mensagem'] === 'Usuario e suas dependencia deletadas'){
                                header('Location: http://localhost/projetoAci/app/views/users/createUsers.php?mensagem= "Usuario deletado com sucesoso "');
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