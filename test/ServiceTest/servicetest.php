<?php
//testar os serviçs automatizado para inserção na table ambientes

use PHPUnit\Framework\TestCase;


require_once('../../config/database.php');
require_once('../../vendor/autoload.php');
require_once('../../app/models/sensormodels.php');
require_once('../../app/models/salasmodels.php');
require_once('../../app/models/usermodels.php');
require_once('../../app/models/ambientemodels.php');
require_once('../../app/services/SensorServices.php');


class servicetest extends TestCase{
    private $conexao;
    private $sensor;
    private $salas;
    private $usuario;
    private $ambiente;
    private $sensorService;
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
     $this->salas = new Salas ($this->conexao);
     $this->sensor = new sensor ($this->conexao);
     $this->ambiente = new ambiente ($this->conexao);
     $this->sensorService = new SensorService($this->conexao); 
     $this->conexao->query("DELETE FROM Sensor");
        $this->conexao->query("DELETE FROM Salas");
        $this->conexao->query("DELETE FROM Usuario");
    }
    public function testSimularDados()
    {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "Usuário não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
    
        $this->salas = new Salas($this->conexao);
        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
    
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $salas = $resultadoConsulta->fetch_assoc();
        $Idsalas = $salas['idSalas'];
    
        $sensores = [   
            ['Tipo' => 'iluminacao', 'salaId' => $Idsalas],
            ['Tipo' => 'temperatura', 'salaId' => $Idsalas],
            ['Tipo' => 'Consumo Energia', 'salaId' => $Idsalas],
        ];
    
        $idsensor = [];
        foreach ($sensores as $sensorInfo) {
            $resultsensor = $this->sensor->InsertSensor($sensorInfo['Tipo'], $sensorInfo['salaId']);
            $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
            $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = '{$sensorInfo['Tipo']}'");
            $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor não foi inserido no banco de dados");
            $sensor = $novoresultadoConsulta->fetch_assoc();
            $idsensor[] = ['id' => $sensor['IdSensor'], 'Tipo' => $sensorInfo['Tipo']];
        }
    
        $resultadosSimulacao = $this->sensorService->processAmbienteParaVariosSensores($idsensor);
    
        foreach ($resultadosSimulacao as $dados) {
            $idSensor = $dados['Sensor_IdSensor'];
            $resultadoConsultaAmbiente = $this->conexao->query("SELECT * FROM Ambiente WHERE Sensor_IdSensor = $idSensor");
    
            $this->assertEquals(1, $resultadoConsultaAmbiente->num_rows, "Dados do sensor com ID $idSensor não foram inseridos no banco de dados");
    
         
            $dadosAmbiente = $resultadoConsultaAmbiente->fetch_assoc();
    
            if ($dados['Tipo'] == 'iluminacao') {
                $this->assertArrayHasKey('IiluminacaoEstado', $dadosAmbiente);
            } elseif ($dados['Tipo'] == 'temperatura') {
                $this->assertArrayHasKey('Temperatura', $dadosAmbiente);
            } elseif ($dados['Tipo'] == 'Consumo Energia') {
                $this->assertArrayHasKey('ConsumoEnergia', $dadosAmbiente);
            }
    
            $this->assertArrayHasKey('Sensor_IdSensor', $dadosAmbiente);
        }
    }
    
// public function testProcessAmbient(){
// $this->usuario = new Usuario($this->conexao);
// $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
// $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
// $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
// $usuario = $resultado->fetch_assoc();
// $idUsuario = $usuario['IdUsuario'];
// $this->salas = new Salas($this->conexao);
// $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
// $this->assertEquals("Inserido com sucesso", $result['mensagem']);
// $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
// $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
// $salas = $resultadoConsulta->fetch_assoc();
// $Idsalas = $salas['idSalas'];
// $this->sensor = new Sensor($this->conexao);
// $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
// $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
// $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
// $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
// $sensor = $novoresultadoConsulta->fetch_assoc();
// $idsensor = $sensor['IdSensor'];
// $this->sensorService->processAmbiente($idsensor);

// }

}   



?>