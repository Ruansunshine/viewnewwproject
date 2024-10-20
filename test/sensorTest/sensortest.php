<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');
require_once('../../app/models/sensormodels.php');
require_once('../../app/models/salasmodels.php');

class sensortest extends TestCase{


    private $conexao;
    private $sensor;
    private $salas;
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

        $this->sensor= new sensor($this->conexao);

        $this->conexao->query("DELETE FROM Sensor");
        $this->conexao->query("DELETE FROM Salas");
        $this->conexao->query("DELETE FROM Usuario");

    }
   public function testInsertSensor(){
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
    $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
    $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
    $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
    $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");
   }
  public function testList (){
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
    $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
    $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
    $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
    $result = $this->sensor->ListSensor();
    
    $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");
  }
public function testDeletesensor(){
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
    $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
    $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
    $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
    $sensor = $novoresultadoConsulta->fetch_assoc();
    $idsensor = $sensor['IdSensor'];
    $result = $this->sensor->DeleteSensor($idsensor);
    $this->assertEquals("sensor deletado com sucesso", $result);
    $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'tipo teste'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");

}
public function testUpdateSensor(){
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
  $resultsensor = $this->sensor->InsertSensor("tipo teste", $Idsalas);
  $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
  $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
  $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");
  $sensor = $novoresultadoConsulta->fetch_assoc();
  $idsensor = $sensor['IdSensor'];
  $Tipo = 'Tipo atualizado';
  $result = $this->sensor->UpdateSensor($Tipo, $idsensor);
  $this->assertEquals("sensor atualizado com sucesso", $result);
   $this->conexao->query("DELETE FROM Sensor WHERE Tipo = 'Tipo atualizado'");
    $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
    $this->conexao->query("DELETE FROM Usuario  WHERE Nome = 'teste'");
}

}



?>