<?php
use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/controllers/ambientecontroller.php');
require_once('../../app/models/sensormodels.php');
require_once('../../app/models/usermodels.php');
require_once('../../app/models/salasmodels.php');
require_once('../../app/models/ambientemodels.php');


class ambienteControllerstest extends TestCase
{
   
    private $conexao;
    private $sensor;
    private $salas;
    private $usuario;
    private $ambiente;
    private $ambienteController;
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

        $this->ambienteController = new AmbienteController($this->conexao);



       
        
       
        $this->conexao->query("DELETE FROM Ambiente");
        $this->conexao->query("DELETE FROM Sensor");
        $this->conexao->query("DELETE FROM Salas");
        $this->conexao->query("DELETE FROM Usuario");
    }

public function testRegisterControllerAmbiente(){
    $this->usuario = new Usuario($this->conexao);
    $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
    $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
    $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
    $usuario = $resultado->fetch_assoc();
    $idUsuario = $usuario['IdUsuario'];
    $this->salas = new Salas($this->conexao);
    $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
    $this->assertEquals("Inserido com sucesso", $result['mensagem']);
    $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
    $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
    $salas = $resultadoConsulta->fetch_assoc();
    $Idsalas = $salas['idSalas'];
    $this->sensor = new Sensor($this->conexao);
    $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
    $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
    $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
    $sensor = $novoresultadoConsulta->fetch_assoc();
    $idsensor = $sensor['IdSensor'];
    $dadosAmbiente = [
        'iluminacao' => 1,
        'temperatura' => 10.0,
        'ConsumoEnergia' => 25.6,
        'Sensor_IdSensor' => $idsensor
    ];
    $resultAmbiente = $this->ambienteController->RegistrarAmbiente($dadosAmbiente);
    $this->assertEquals("Inserido com sucesso", $resultAmbiente['mensagem']);
}
public function testListAmbiente(){
    $resultado = $this->ambienteController->ListarAmbientes();
    
   
    $this->assertArrayHasKey('mensagem', $resultado, "A resposta deve conter uma mensagem");
    
   
    if ($resultado['mensagem'] === 'Ambientes listados com sucesso') {
        $this->assertIsArray($resultado['dados'], "Os dados devem ser um array");
        $this->assertNotEmpty($resultado['dados'], "Os dados não devem estar vazios quando há ambientes listados");
    } else {
        
        $this->assertEquals('nenhuma linha afetada', $resultado['mensagem'], "Deve retornar mensagem apropriada se não houver ambientes");
    }
}
}
?>