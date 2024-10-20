<?php
use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/controllers/sensorController.php');
require_once('../../app/models/sensormodels.php');
require_once('../../app/models/usermodels.php');
require_once('../../app/models/salasmodels.php');


class sensorcontrollertest extends TestCase
{
    private $conexao;
    private $sensorController;
    private $sensor;
    private $usuario;
    private $salas;

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

        $this->sensor = new Sensor($this->conexao);
        $this->sensorController = new SensorController($this->conexao);
    }

    public function testRegistrarSensor()
    {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];

        $this->salas = new Salas($this->conexao);
        $result = $this->salas->InsertSala("sala de teste", "sala de teste description", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala de teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $salas = $resultadoConsulta->fetch_assoc();
        $Idsalas = $salas['idSalas'];
        $dadosValidos = [
            'Tipo' => 'Tipo teste',
            'Salas_idSalas' => $Idsalas
        ];

        $resultado = $this->sensorController->RegistrarSensor($dadosValidos);
        $this->assertEquals('sensor inserido com sucesso', $resultado['mensagem']);

        $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'Tipo teste'");
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala de teste'");
        $this->conexao->query("DELETE FROM Usuario WHERE Nome = 'teste'");
    }
    public function testlistarController(){
        $resultado = $this->sensorController->ListarSensores();
        $this->assertArrayHasKey('mensagem', $resultado, "A resposta deve conter uma mensagem");
        
        if ($resultado['mensagem'] === 'Salas listadas com sucesso') {
            $this->assertIsArray($resultado['dados'], "Os dados devem ser um array");
        } else {
            $this->assertEquals('Nenhuma linha encontrada', $resultado['mensagem'], "Deve retornar mensagem de erro se não houver salas");
        }
    }
    public function testAtualizarSensor(){
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];

        $this->salas = new Salas($this->conexao);
        $result = $this->salas->InsertSala("sala de teste", "sala de teste description", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala de teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $salas = $resultadoConsulta->fetch_assoc();
        $Idsalas = $salas['idSalas'];
        $dadosValidos = [
            'Tipo' => 'Tipo teste',
            'Salas_idSalas' => $Idsalas
        ];

        $resultado = $this->sensorController->RegistrarSensor($dadosValidos);
        $this->assertEquals('sensor inserido com sucesso', $resultado['mensagem']);
        $Idsensor = $resultado['id'];

   $dados = [
    'Tipo' => 'Tipo teste atualizado',
    'IdSensor' =>  $Idsensor
   ];
  

        $result = $this->sensorController->AtualizarSensor($dados);
        $this->assertEquals('sensor atualizado com sucesso', $result['mensagem']);
        $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'Tipo teste atualizado'");
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala de teste'");
        $this->conexao->query("DELETE FROM Usuario WHERE Nome = 'teste'");
   
        
    }
    public function testDeleteSensor(){
       //unico parametro é id do sensor 
       $this->usuario = new Usuario($this->conexao);
       $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
       $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
       $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
       $usuario = $resultado->fetch_assoc();
       $idUsuario = $usuario['IdUsuario'];

       $this->salas = new Salas($this->conexao);
       $result = $this->salas->InsertSala("sala de teste", "sala de teste description", 1, $idUsuario);
       $this->assertEquals("Inserido com sucesso", $result['mensagem']);
       $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala de teste'");
       $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
       $salas = $resultadoConsulta->fetch_assoc();
       $Idsalas = $salas['idSalas'];
       $dadosValidos = [
           'Tipo' => 'Tipo teste',
           'Salas_idSalas' => $Idsalas
       ];

       $resultado = $this->sensorController->RegistrarSensor($dadosValidos);
       $this->assertEquals('sensor inserido com sucesso', $resultado['mensagem']);
       $Idsensor = $resultado['id'];

  $dados = [
   'IdSensor' =>  $Idsensor
  ];
 

       $result = $this->sensorController->DeleteSensor($dados);
       $this->assertEquals('sensor deletado com sucesso', $result['mensagem']);
       
       
    }
    
}

    ?>