<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/controllers/usersControllers.php');
require_once('../../app/models/usermodels.php');

class controladorUsertest extends TestCase
{

    private $conexao;
    private $UsuarioController;
    private $usuario;
    
    

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
        $this->usuario = new Usuario($this->conexao); 
        $this->UsuarioController = new UsuarioController($this->conexao);

    }
    public function testRegistrar() {
       
        $dadosValidos = [
            'Nome' => 'Usuário Teste',
            'Email' => 'teste@exemplo.com',
            'Senha' => 'senha123'
        ];
    
        $resultado = $this->UsuarioController->Registrar($dadosValidos);
        $this->assertEquals('Inserido com sucesso', $resultado['mensagem']);
    
        $resultadoDuplicado = $this->UsuarioController->Registrar($dadosValidos);
        $this->assertEquals('Email já está em uso.', $resultadoDuplicado['mensagem'], "O sistema não deve permitir o registro de emails duplicados.");

        $dadosIncompletos = [
            'Nome' => '',
            'Email' => '',
            'Senha' => ''
        ];
        
        $resultadoIncompleto = $this->UsuarioController->Registrar($dadosIncompletos);
        $this->assertEquals('Todos os campos são obrigatorias', $resultadoIncompleto['mensagem'], "A validação de campos obrigatórios não está funcionando.");

        $this->conexao->query("DELETE FROM Usuario");
    }
   public function testLogin(){
    $usuario = new Usuario($this->conexao);
    $dados = [
        'Nome' => 'Usuario Teste',
        'Email' => 'usuario@gmail.com',
        'Senha' =>  'senhatest'
    ];

    $resultInsert =  $this->usuario->InsertUsuario($dados['Nome'], $dados['Email'], md5($dados['Senha']));
    $this->assertEquals("Inserido com sucesso", $resultInsert['mensagem']);


    $result = $this->UsuarioController->LoginUsuario([
        'Email' => $dados['Email'],
        'Senha' => $dados['Senha']    
    ]);
    $this->assertEquals('Login realizado com sucesso', $result['mensagem']);
    $this->conexao->query("DELETE FROM Usuario");

    }
    public function testUpdateUserController(){
        $usuario = new Usuario($this->conexao);
        $dados = [
            'Nome' => 'Usuário Teste',
            'Email' => 'teste@exemplo.com',
            'Senha' => 'senha123'
        ];
        $resultInsert =  $this->usuario->InsertUsuario($dados['Nome'], $dados['Email'], md5($dados['Senha']));
        $this->assertEquals("Inserido com sucesso", $resultInsert['mensagem']);
      
        $idUsuario =  $resultInsert['id'];
        $dados = [
            'Nome' => 'Usuário Teste ataualizado',
            'Email' => 'testeatualizado@exemplo.com',
            'Senha' => 'senhaatualizada123'
        ];

        $result = $this->UsuarioController-> AtualizarControllerUser([
            'Nome'  => $dados['Nome'],
            'Email' => $dados['Email'],
            'Senha' => $dados['Senha'],
            'IdUsuario' => $idUsuario
        ]);
        $this->assertEquals('Usuario atualizado com sucesso', $result['mensagem']);
        $this->conexao->query("DELETE FROM Usuario");
    }
    public function testDeleteUserController(){

        $usuario = new Usuario($this->conexao);
        $dados = [
            'Nome' => 'Usuário Teste',
            'Email' => 'teste@exemplo.com',
            'Senha' => 'senha123'
        ];
        $resultInsert =  $this->usuario->InsertUsuario($dados['Nome'], $dados['Email'], md5($dados['Senha']));
        $this->assertEquals("Inserido com sucesso", $resultInsert['mensagem']);
      
        $idUsuario =  $resultInsert['id'];
        $result = $this->UsuarioController->deleteUserController([
            
            'IdUsuario' => $idUsuario
        ]);
        $this->assertEquals('Usuario e suas dependencia deletadas', $result['mensagem']);
    }
    
    }
