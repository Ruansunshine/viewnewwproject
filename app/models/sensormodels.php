<?php


require_once('../../config/database.php');
require_once('salasmodels.php');


class sensor 
{
    private  $IdSensor;
    private  $Tipo;
    private  $DataCadastro;
    private  $Salas_idSalas; 
    private $conexao;

public function __construct($conexao){
    $this->conexao = $conexao;
}
public function InsertSensor($Tipo, $Salas_idSalas){
    $sql = "INSERT INTO Sensor(Tipo, Salas_idSalas ) VALUES(?,?)";
    $consulta = $this->conexao->prepare($sql);
    try {
        $consulta->bind_param("si", $Tipo,  $Salas_idSalas);
        $consulta->execute();
        $IdSensor = $consulta->insert_id;
        return [
            'mensagem' => $consulta->affected_rows > 0 ? "sensor inserido com sucesso" : "Nenhuma linha afetada",
             'id'=> $IdSensor
        ];
    }catch(mysqli_sql_exception $e){
        return "Erro: " . $e->getMessage();
    }
}
public function  ListSensor(){
    $sql = "SELECT * FROM Sensor ";
   $consulta = $this->conexao->prepare($sql);
   try {
    $consulta = $this->conexao->query($sql);
    if ($consulta->num_rows > 0) {
        $sensores = $consulta->fetch_all(MYSQLI_ASSOC);
        return $sensores;
    }else {
        return "Nenhuma linha encontrada";
    }
           
   } catch(mysqli_sql_exception $e){
    return "Erro: " . $e->getMessage();
   }
}
public function DeleteSensor($IdSensor){
$sql = "DELETE FROM Sensor WHERE IdSensor= ? ";
$consulta = $this->conexao->prepare($sql);
try {
    $consulta->bind_param("i", $IdSensor);
    $consulta->execute();
    return $consulta->affected_rows > 0 ? "sensor deletado com sucesso" : "Nenhuma linha afetada";
}catch(mysqli_sql_exception $e){
    return "Erro: " . $e->getMessage();
}
}

public function UpdateSensor($Tipo,$IdSensor){
    $sql = "UPDATE Sensor  SET Tipo=? WHERE IdSensor = ?";
    $consulta =  $this->conexao->prepare($sql);
    try {
        $consulta->bind_param("si",$Tipo, $IdSensor);
        $consulta->execute();
        return $consulta->affected_rows > 0? "sensor atualizado com sucesso" : "nenhuma linha atualizada";
    }catch(mysqli_sql_exception $e){
        return "Erro: " . $e->getMessage();
    }
}

}

    

?>