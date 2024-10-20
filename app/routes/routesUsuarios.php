    <?php
    require_once('../../config/database.php');
    require_once('../../app/controllers/usersControllers.php');

  
    class routesUsuarios{
       
        private $conexao;
        private $UsuarioController;
        public function __construct($conexao){
            $this->conexao = $conexao; 
            $this->UsuarioController = new UsuarioController($this->conexao); 
        }
        public function Requests(){
         
        $method= $_SERVER['REQUEST_METHOD'];
        $action = $_GET['action'] ?? '';
        switch ($method){
            case 'POST':
                try{
                if($action === 'cadastrar'){
                    $dados = $_POST;
                   
                    $resposta = $this->UsuarioController->Registrar($dados);
                    if($resposta['mensagem'] === 'Inserido com sucesso'){
                        header('Location: ../views/users/homeUser.php?mensagem=Cadastro realizado com sucesso!');
                        exit();
                        }else{
                            header('Location: ../views/users/createUsers.php?mensagem=ERRO, dados incompletos!');
                            exit();
                    }
                }else if ($action === 'login') {
                    $dados = $_POST;
                    $resposta = $this->UsuarioController->LoginUsuario($dados);
                    if($resposta['mensagem']=== 'Login realizado com sucesso'){
                    header('Location: ../views/users/homeUser.php?mensagem=Login realizado com sucesso');
                    exit();
                    }else {
                        header("Location:  ../views/users/login.html?mensagem=Usuario não enncontrado");
                    }
                }      
            }catch (mysqli_sql_exception $e) {
                header('Location:  ../views/users/createUsers.php?mensagem=ERRO, ' . urlencode("Erro: " . $e->getMessage()));
                exit();
        }
    break;
    
        }
    }
    
    }
    $routes = new routesUsuarios($conexao);
   $routes->Requests();
    ?>