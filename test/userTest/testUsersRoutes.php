<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/controllers/usersControllers.php');
require_once('../../app/routes/routesUsuarios.php');
require_once('../../app/models/usermodels.php');

class testUsersRoutes extends TestCase
{

    private $conexao;
    private $UsuarioController;
    private $routesUsuario;
    
    

    protected function setUp(): void

    {
        $hostname = "127.0.0.1:3306";
        $bancodedados = "automacao";
        $usuario = "root";
        $senha = "";

        $this->conexao = new mysqli($hostname, $usuario, $senha, $bancodedados);


        if ($this->conexao->connect_errno) {
            $this->fail("Falha ao conectar ao banco de dados: " . $this->conexao->connect_error);
        }
        $this->UsuarioController = new UsuarioController($this->conexao);   
    }
    public function testRegistrar() {

}
}
