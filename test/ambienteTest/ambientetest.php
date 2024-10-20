<?php
use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');
require_once('../../app/models/sensormodels.php');
require_once('../../app/models/salasmodels.php');
require_once('../../app/models/usermodels.php');
require_once('../../app/models/ambientemodels.php');


class ambientetest extends TestCase{


    private $conexao;
    private $sensor;
    private $salas;
    private $usuario;
    private $ambiente;
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

        $this->ambiente= new ambiente($this->conexao);


        $this->conexao->query("DELETE FROM Ambiente");
    }
    public function testinsetambniente(){
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
    $resultAmbiente = $this->ambiente->InsertAmbiente(1, 10.0, 25.6, $idsensor);
    $this->assertEquals("Inserido com sucesso", $resultAmbiente['mensagem']);

    $this->conexao->query("DELETE FROM Ambiente WHERE ConsumoEnergia = 25.6");
    $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");
    }
    public function testListAmbiente()
{
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
    $resultAmbiente = $this->ambiente->InsertAmbiente(1, 10.0, 25.6, $idsensor);
    $this->assertEquals("Inserido com sucesso", $resultAmbiente['mensagem']);
    $resultadoAmbiente = $this->ambiente->listarAmbiente();
    $this->assertGreaterThan(0, count($resultadoAmbiente), "Nenhum ambiente foi encontrado");

    $this->conexao->query("DELETE FROM Ambiente WHERE ConsumoEnergia = 25.6");
    $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");
}
public function testVisualizarView(){
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
    $resultAmbiente = $this->ambiente->InsertAmbiente(1, 31.0, 34.9, $idsensor);
    $this->assertEquals("Inserido com sucesso", $resultAmbiente['mensagem']);
    var_dump( $resultAmbiente);
    $resultadoAmbiente = $this->ambiente->VisualizarView();
    $this->assertGreaterThan(0, count($resultadoAmbiente), "Nenhum ambiente foi encontrado");
    var_dump( $resultAmbiente);
    $this->assertIsArray($resultadoAmbiente, "O retorno não é um array.");
    $this->assertNotNull($resultadoAmbiente, "O método VisualizarView retornou null.");
    $this->assertIsArray($resultadoAmbiente, "O retorno não é um array.");
    if (empty($resultadoAmbiente)) {
        $this->assertTrue(true, "A view não retornou dados, o que é aceitável neste contexto.");
}else {
    $this->assertArrayHasKey('NomeUsuario',$resultadoAmbiente[0], "A chave 'NomeUsuario' não existe no retorno.");
        $this->assertArrayHasKey('NomeSala', $resultadoAmbiente[0], "A chave 'NomeSala' não existe no retorno.");
        $this->assertArrayHasKey('TipoSensor', $resultadoAmbiente[0], "A chave 'TipoSensor' não existe no retorno.");
        $this->assertArrayHasKey('IiluminacaoEstado',$resultadoAmbiente[0], "A chave 'IiluminacaoEstado' não existe no retorno.");
        $this->assertArrayHasKey('Temperatura', $resultadoAmbiente[0], "A chave 'Temperatura' não existe no retorno.");
        $this->assertArrayHasKey('ConsumoEnergia', $resultadoAmbiente[0], "A chave 'ConsumoEnergia' não existe no retorno.");
}
}
}
?>