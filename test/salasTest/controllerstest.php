<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/controllers/salasControllers.php');
require_once('../../app/models/salasmodels.php');
require_once('../../app/models/usermodels.php');

class  controllerstest extends TestCase
{

    private $conexao;
    private $SalaController;
    private $Salas;
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
        $this->Salas = new Salas($this->conexao); 
        $this->SalaController = new salasController($this->conexao);

    }
    public function testRegistrarSala() {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
       
        $dadosValidos = [
            'Nome' => 'Sala Teste Controlador',
            'Descricao' => 'teste de sala controlador ',
            'Status' => 1,
            'Usuario_IdUsuario' => $idUsuario
        ];
    
        $resultado = $this->SalaController->RegistrarSalas($dadosValidos);
        $this->assertEquals('Inserido com sucesso', $resultado['mensagem']);
    
        $resultadoDuplicado = $this->SalaController->RegistrarSalas($dadosValidos);
        $this->assertEquals('Nome já está em uso.', $resultadoDuplicado['mensagem'], "O sistema não deve permitir o registro de nomes duplicados.");

        $dadosIncompletos = [
            'Nome' => '',
            'Descricao' => '',
            'Status' => 1,
            'Usuario_IdUsuario' => $idUsuario
        ];
        
        $resultadoIncompleto = $this->SalaController->RegistrarSalas($dadosIncompletos);
        $this->assertEquals('Todos os campos são obrigatorias', $resultadoIncompleto['mensagem'], "A validação de campos obrigatórios não está funcionando.");
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'Sala Teste Controlador'");
        $this->conexao->query("DELETE FROM Usuario WHERE Nome = 'teste'");
    
    }
    public function testAtualizarSala(){
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
       
        $dadosValidos = [
            'Nome' => 'Sala Teste Controlador',
            'Descricao' => 'teste de sala controlador ',
            'Status' => 1,
            'Usuario_IdUsuario' => $idUsuario
        ];
    
        $resultado = $this->SalaController->RegistrarSalas($dadosValidos);
        $this->assertEquals('Inserido com sucesso', $resultado['mensagem']);
   $IdSalas = $resultado['id'];

   $dados = [
            'Nome' => 'Sala Teste Controlador atualizado',
            'Descricao' => 'teste de sala controlador  atualizado',
            'Status' => 1,
            'Usuario_IdUsuario' => $idUsuario,
            'idSalas' => $IdSalas
   ];
  

        $result = $this->SalaController-> AtualizarSalasController($dados);
        $this->assertEquals('sala atualizada com sucesso', $result['mensagem']);
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'Sala Teste Controlador atualizado'");
        $this->conexao->query("DELETE FROM Usuario WHERE Nome = 'teste'");
    
    }
    public function testDeleteSalas(){
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
       
        $dadosValidos = [
            'Nome' => 'Sala Teste Controlador',
            'Descricao' => 'teste de sala controlador ',
            'Status' => 1,
            'Usuario_IdUsuario' => $idUsuario
        ];
    
        $resultado = $this->SalaController->RegistrarSalas($dadosValidos);
        $this->assertEquals('Inserido com sucesso', $resultado['mensagem']);
   $IdSalas = $resultado['id'];
   $resultado = $this->SalaController->deleteSalaController([
    'idSalas' =>  $IdSalas
   ]);
   $this->assertEquals('Sala deletada com sucesso', $resultado['mensagem']);
   $this->conexao->query("DELETE FROM Usuario WHERE Nome = 'teste'");
    }

    public function testListarSalas()
    {
        
        $resultado = $this->SalaController->ListarSalas();
        $this->assertArrayHasKey('mensagem', $resultado, "A resposta deve conter uma mensagem");
        
        if ($resultado['mensagem'] === 'Salas listadas com sucesso') {
            $this->assertIsArray($resultado['dados'], "Os dados devem ser um array");
        } else {
            $this->assertEquals('Nenhuma linha encontrada', $resultado['mensagem'], "Deve retornar mensagem de erro se não houver salas");
        }
    }
    
}
    ?>