<?php

require_once('../../config/database.php');
require_once('usermodels.php');

class Salas
{
    private $IdSalas;
    private $Nome;
    private $Descricao;
    private $status;
    private $UsuarioId;
    private $conexao;

    public function __construct($conexao)
    {

        $this->conexao = $conexao;
    }
    public function InsertSala($Nome, $Descricao, $status, $UsuarioId)
    {
        $sql = "INSERT INTO Salas (Nome, Descricao, Status, Usuario_IdUsuario) VALUES (?, ?, ?, ?)";
        $consulta = $this->conexao->prepare($sql);

        try {
            $consulta->bind_param("ssii", $Nome, $Descricao, $status, $UsuarioId);
            $consulta->execute();
            $IdSalas = $consulta->insert_id; 
            return [
            'mensagem' => $consulta->affected_rows > 0 ? "Inserido com sucesso" : "Nenhuma linha afetada",
            'id' => $IdSalas ];
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }

    public function ListSalas()
    {
        $sql = "SELECT * FROM Salas";
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
    public function DeleteSala($IdSalas){
     $sqlDeleteSensor= " DELETE FROM Sensor WHERE Salas_idSalas = ?";
     $consultaDelete = $this->conexao->prepare($sqlDeleteSensor);
        
       
        try{
            $consultaDelete->bind_param("i",$IdSalas);
            $consultaDelete->execute();
            $sensorSalas = $consultaDelete->affected_rows>0;
            $sql = "DELETE FROM Salas WHERE idSalas= ?";
            $consulta = $this->conexao->prepare($sql);
            $consulta->bind_param("i",$IdSalas);
            $consulta->execute();
            return $consulta->affected_rows > 0 ? "Sala deletada com sucesso" : "Nenhuma linha afetada";
        }catch(mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
        public function UpdateSalas($Nome, $Descricao, $status, $IdSalas){
            $sql = "UPDATE Salas SET Nome=?, Descricao=?, Status=? WHERE idSalas=?";
            $consulta = $this->conexao->prepare($sql);
            try{
                $consulta->bind_param("ssii",$Nome, $Descricao, $status, $IdSalas );
                $consulta->execute();
                return $consulta->affected_rows > 0 ? "sala atualizada com sucesso" : "nenhuma linha afetada";
            }catch(mysqli_sql_exception $e){
                return "Erro: " . $e->getMessage();
            }
        }
        
}
