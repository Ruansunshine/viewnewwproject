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
            $_SESSION['idSalas'] = $IdSalas;
            return [
            'mensagem' => $consulta->affected_rows > 0 ? "Inserido com sucesso" : "Nenhuma linha afetada",
            'id' => $IdSalas,
            'sucess' => true    ];
        } catch (mysqli_sql_exception $e) {
            return [
                'mensagem' => 'Erro: ' . $e->getMessage(),
                'sucess' => false
            ];
    
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
    public function DeleteSala($IdSalas) {
        // Primeiro, delete os registros associados na tabela ambiente
        $sqlDeleteAmbiente = "DELETE FROM ambiente WHERE Sensor_IdSensor IN (SELECT IdSensor FROM Sensor WHERE Salas_idSalas = ?)";
        $consultaDeleteAmbiente = $this->conexao->prepare($sqlDeleteAmbiente);
        
        try {
           
            $consultaDeleteAmbiente->bind_param("i", $IdSalas);
            $consultaDeleteAmbiente->execute();
    
            
            $sqlDeleteSensor = "DELETE FROM Sensor WHERE Salas_idSalas = ?";
            $consultaDeleteSensor = $this->conexao->prepare($sqlDeleteSensor);
            $consultaDeleteSensor->bind_param("i", $IdSalas);
            $consultaDeleteSensor->execute();
        
            $sql = "DELETE FROM Salas WHERE idSalas = ?";
            $consulta = $this->conexao->prepare($sql);
            $consulta->bind_param("i", $IdSalas);
            $consulta->execute();
    
            
            return $consulta->affected_rows > 0 ? "Sala deletada com sucesso" : "Nenhuma linha afetada";
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    
        public function UpdateSalas($Nome, $Descricao, $status, $IdSalas){
            $sql = "UPDATE Salas SET Nome=?, Descricao=?, Status=? WHERE idSalas=?";
            $consulta = $this->conexao->prepare($sql);
            
            try{
                $consulta->bind_param("ssii",$Nome, $Descricao, $status, $IdSalas );
                $consulta->execute();
                return $consulta->affected_rows > 0 ? "Sala atualizada com sucesso" : "nenhuma linha afetada";
            }catch(mysqli_sql_exception $e){
                return "Erro: " . $e->getMessage();
            }
        }
        public function SalasUsuarios(){
            $sql = "SELECT 
    u.IdUsuario AS IdUsuario,
    u.Nome AS NomeUsuario,
    u.Email AS EmailUsuario,
    s.idSalas AS IdSala,
    s.Nome AS NomeSala,
    s.Descricao AS DescricaoSala,
    s.Status AS StatusSala
FROM 
    automacao.usuario u
INNER JOIN 
    automacao.salas s ON u.IdUsuario = s.Usuario_IdUsuario;";

        $consulta  = $this->conexao->prepare($sql);
        try {
            $consulta->execute();
            $result = $consulta->get_result();

            if ($result->num_rows > 0) {
                $usuarios = $result->fetch_all(MYSQLI_ASSOC);
                return $usuarios;
            } else {
                return "Nenhuma linha encontrada";
            }
        }catch(mysqli_sql_exception $e){
                return "Erro: " . $e->getMessage();
            }
        }
        public function SalasUser($UsuarioId){
            $sql = "SELECT 
    u.IdUsuario AS IdUsuario,
    u.Nome AS NomeUsuario,
    u.Email AS EmailUsuario,
    s.idSalas AS IdSalas,
    s.Nome AS NomeSala,
    s.Descricao AS DescricaoSala,
    s.Status AS StatusSala
FROM 
    automacao.usuario u
LEFT JOIN 
    automacao.salas s ON u.IdUsuario = s.Usuario_IdUsuario
WHERE 
    u.IdUsuario = ?;";
    $consulta = $this->conexao->prepare($sql);
    try{
       $consulta->bind_param("i", $UsuarioId);
       $consulta->execute();
       
       $result = $consulta->get_result();

       if ($result->num_rows > 0) {
           $usuarios = $result->fetch_all(MYSQLI_ASSOC);
           return $usuarios;
       } else {
           return "Nenhuma linha encontrada";
       }
           
    }catch(mysqli_sql_exception $e){
        return "Erro: " . $e->getMessage();
    }

        }


                
}
