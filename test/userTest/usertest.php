<?php

use PHPUnit\Framework\TestCase;

require_once('../../config/database.php');
require_once('../../vendor/autoload.php');

require_once('../../app/models/usermodels.php');

class usertest extends TestCase
{

    private $conexao;
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

        $this->usuario = new Usuario($this->conexao);


        $this->conexao->query("DELETE FROM Salas");
        $this->conexao->query("DELETE FROM Usuario");
    }
    public function testInsert()
    {
        $result = $this->usuario->InsertUsuario("teste", "teste@exemplo.com", "senhateste");
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $this->assertGreaterThan(0, $result['id'], "O ID do usuário inserido deve ser maior que 0");
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Usuario WHERE Email = 'teste@exemplo.com'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "O usuário não foi inserido no banco de dados.");
        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");

    }
    public function testList()
    {
        $this->usuario->InsertUsuario("teste", "teste@exemplo.com", "senhateste");
        $result = $this->usuario->ListUsuario();
        $this->assertIsArray($result, "O resultado não é um array.");
        $this->assertNotEmpty($result, "O array está vazio. Nenhum usuário foi encontrado.");

        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'teste@exemplo.com'");

    }
    public function testDelete()
    {
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
        $this->salas = new Salas($this->conexao);
        $result = $this->salas->InsertSala("sala teste", "sala de teste", 1, $idUsuario );
        $this->assertEquals("Inserido com sucesso", $result['mensagem']);
        $resultadoConsulta = $this->conexao->query("SELECT * FROM Salas WHERE Nome = 'sala teste'");
        $this->assertEquals(1, $resultadoConsulta->num_rows, "A sala não foi inserida no banco de dados");
        $result = $this->usuario->DeleteUser($idUsuario);
        $this->assertEquals("Usuario e suas dependencia deletadas", $result);
        $consulta = $this->conexao->prepare("SELECT * FROM Usuario WHERE IdUsuario= ?");
       $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
       $resultado = $consulta->get_result();
        $this->assertEquals(0, $resultado->num_rows, "usuario ainda está presente");

    }
    public function testUpdate()
    {
        $this->usuario->insertUsuario("teste", "teste@exemplo.com", "senhateste");
        $resultado = $this->conexao->query("SELECT * FROM Usuario WHERE Email='teste@exemplo.com'");
        $usuario = $resultado->fetch_assoc();
        $idUsuario = $usuario['IdUsuario'];
        $nome = "TesteAtualizado";
        $Email = "TesteAtualizado@gmamil.com";
        $Senha = "SenhaTesteAtualizado";
        $result = $this->usuario->UpdateUser($nome, $Email, $Senha, $idUsuario);
        $this->assertEquals("Usuario atualizado com sucesso", $result);

        $consulta = $this->conexao->prepare("SELECT * FROM Usuario WHERE IdUsuario= ?");
        $consulta->bind_param("i", $idUsuario);
        $consulta->execute();
        $consultaAtualizada = $consulta->get_result();
        $usuarioatualizado = $consultaAtualizada->fetch_assoc();

        $this->assertEquals($nome,   $usuarioatualizado['Nome']);
        $this->assertEquals($Email,   $usuarioatualizado['Email']);
        $this->assertEquals($Senha,  $usuarioatualizado['Senha']);
        $this->conexao->query("DELETE FROM Usuario WHERE Email = 'TesteAtualizado@gmamil.com'");

    }
}
