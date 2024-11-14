<?php


require_once(__DIR__ . '/../../config/database.php');
require_once('salasmodels.php');

class Usuario
{
    private $IdUsuario;
    private $Nome;
    private $Email;
    private $Senha;
    private $conexao;

    public function __construct($conexao)
    {

        $this->conexao = $conexao;
    }

    public function InsertUsuario($Nome, $Email, $Senha) // inserir usuario
    {

        $sql = "INSERT INTO Usuario (Nome, Email, Senha) VALUES (?, ?, ?)";
        $consulta = $this->conexao->prepare($sql);

        try {
            $consulta->bind_param("sss", $Nome, $Email, $Senha);
            $consulta->execute();
            $idUsuario = $consulta->insert_id;
            $_SESSION['idUsuario'] = $idUsuario;
            return [
                'mensagem' => $consulta->affected_rows > 0 ? "Inserido com sucesso" : "Nenhuma linha afetada",
                'id' => $idUsuario,
                'sucess' => true
            ];
        } catch (mysqli_sql_exception $e) {
            return [
                'mensagem' => 'Erro: " . $e->getMessage()',
                'sucess' => false
            ];
        }
    }
    public function ListUsuario()
    {
        $sql = "SELECT * FROM Usuario";
        $consulta = $this->conexao->prepare($sql);
        try {

            $consulta->execute();
            $result = $consulta->get_result();

            if ($result->num_rows > 0) {
                $usuarios = $result->fetch_all(MYSQLI_ASSOC);
                return $usuarios;
            } else {
                return "Nenhuma linha encontrada";
            }
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function DeleteUser($IdUsuario)
    {
        $this->conexao->begin_transaction();
        try {
            $sqlAlerta = "DELETE FROM alertas WHERE idAmbiente IN (SELECT Idambiente FROM ambiente WHERE Sensor_IdSensor IN (SELECT IdSensor FROM sensor WHERE Salas_idSalas IN (SELECT idSalas FROM salas WHERE Usuario_IdUsuario = ?)))";
            $consultaAlertas = $this->conexao->prepare($sqlAlerta);
            $consultaAlertas->bind_param("i", $IdUsuario);
            $consultaAlertas->execute();

            $sqlDeleteAmbientes = "DELETE FROM ambiente WHERE Sensor_IdSensor IN (SELECT IdSensor FROM sensor WHERE Salas_idSalas IN (SELECT idSalas FROM salas WHERE Usuario_IdUsuario = ?))";
            $consultaAmbientes = $this->conexao->prepare($sqlDeleteAmbientes);
            $consultaAmbientes->bind_param("i", $IdUsuario);
            $consultaAmbientes->execute();

            $sqlDeleteSensores = "DELETE FROM sensor WHERE Salas_idSalas IN (SELECT idSalas FROM salas WHERE Usuario_IdUsuario = ?)";
            $consultaSensores = $this->conexao->prepare($sqlDeleteSensores);
            $consultaSensores->bind_param("i", $IdUsuario);
            $consultaSensores->execute();
            $sqlDeleteSalas = "DELETE FROM salas WHERE Usuario_IdUsuario = ?";
            $consultaSalas = $this->conexao->prepare($sqlDeleteSalas);
            $consultaSalas->bind_param("i", $IdUsuario);
            $consultaSalas->execute();
            $sqlDeleteUsuario = "DELETE FROM usuario WHERE IdUsuario = ?";
            $consultaUsuario = $this->conexao->prepare($sqlDeleteUsuario);
            $consultaUsuario->bind_param("i", $IdUsuario);
            $consultaUsuario->execute();
            if ($consultaUsuario->affected_rows > 0) {
                // Commitar a transação
                $this->conexao->commit();
                return "Usuário e suas dependências deletadas com sucesso.";
            } else {
                // Desfazer a transação em caso de falha
                $this->conexao->rollback();
                return "Erro ao deletar o usuário, mas suas dependências foram removidas.";
            }
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public function UpdateUser($Nome, $Email, $Senha, $IdUsuario)
    {
        $sql = "UPDATE Usuario SET Nome=?, Email=?, Senha=?  WHERE IdUsuario = ?";
        $consulta = $this->conexao->prepare($sql);
        try {
            $consulta->bind_param("sssi", $Nome, $Email, $Senha, $IdUsuario);
            $consulta->execute();
            return $consulta->affected_rows > 0  ? "Usuario atualizado com sucesso" : "Nenhuma linha atualizada";
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function GetUserNameById($idUsuario)
    {
        $sql = "SELECT IdUsuario, Nome, Email, Senha FROM Usuario WHERE IdUsuario=?";
        $consulta = $this->conexao->prepare($sql);
        try {
            $consulta->bind_param("i", $idUsuario);
            $consulta->execute();
            $result = $consulta->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}
