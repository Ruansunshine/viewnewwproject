<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');
require_once('../../app/models/usermodels.php');
require_once('../../app/models/sensormodels.php');


require_once('../../app/models/salasmodels.php');

class salastest extends TestCase
{

    private $conexao;
    private $salas;
    private $usuario;
    private $sensor;
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

        $this->salas = new Salas($this->conexao);


        $this->conexao->query("DELETE FROM Salas");
        $this->conexao->query("DELETE FROM Usuario");
    }
    public function testInsertsalas()
    {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $this->assertGreaterThan(0, $result['id'], "O ID da sala inserido deve ser maior que 0");

        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");

        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");
    }
    public function testListsalas()
    {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $result = $this->salas->ListSalas();
        $this->assertIsArray($result, "O resultado não é um array.");
        $this->assertNotEmpty($result, "O array está vazio. Nenhum sala foi encontrado.");
        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'sala teste'");
        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");
    }
    public function testDeleteSalas()
    {
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];

        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $salas = $resultadoConsulta->fetch_assoc();
        $idSalas = $salas['idSalas'];
          $this->sensor = New sensor($this->conexao);
          $resultsensor = $this->sensor->InsertSensor("tipo teste", $idSalas);
          $this->assertEquals("sensor inserido com sucesso", $resultsensor['mensagem']);
          $novoresultadoConsulta = $this->conexao->query("SELECT * FROM Sensor WHERE Tipo = 'tipo teste'");
         $this->assertEquals(1, $novoresultadoConsulta->num_rows, "O sensor  não foi inserida no banco de dados");



        $result = $this->salas->DeleteSala($idSalas);
        $this->assertEquals("Sala deletada com sucesso", $result);
        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");
    }
    public function testUpdateTest(){
        $this->usuario = new Usuario($this->conexao);
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $this->assertEquals(1, $resultado->num_rows, "usuario não foi inserido");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];

        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario);
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $salas = $resultadoConsulta->fetch_assoc();
        $idSalas = $salas['idSalas'];
        $Nome = "Sala atualizada";
        $Descricao = " Descricão da sala atualizada";
        $status = 1;

        $result = $this->salas->UpdateSalas($Nome, $Descricao, $status, $idSalas);
        $this->assertEquals("sala atualizada com sucesso", $result);
        $resultadoConsultaAtualizada = $this->conexao->query("SELECT * FROM Salas WHERE idSalas = $idSalas");
        $salaAtualizada = $resultadoConsultaAtualizada->fetch_assoc();
        $this->assertEquals($Nome, $salaAtualizada['Nome'], "O nome da sala não foi atualizado corretamente");
        $this->assertEquals($Descricao, $salaAtualizada['Descricao'], "A descrição da sala não foi atualizada corretamente");
        $this->assertEquals($status, $salaAtualizada['Status'], "O status da sala não foi atualizado corretamente");

        $this->conexao->query("DELETE FROM Salas WHERE Nome = 'Sala atualizada'");
        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");
    }
 
}
