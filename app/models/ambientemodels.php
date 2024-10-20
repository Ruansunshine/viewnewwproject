<?php

require_once('../../config/database.php');
require_once('salasmodels.php');
require_once('sensormodels.php');



class ambiente {
private $idambiente;
private $iluminacao;
private $temperatura;
private $ConsumoEnergia;
private $Sensor_IdSensor;
private $conexao;
public function __construct($conexao){  
    $this->conexao=$conexao;

}
public function InsertAmbiente($iluminacao, $temperatura, $ConsumoEnergia, $Sensor_IdSensor){
    $sql= "INSERT INTO Ambiente(IiluminacaoEstado, Temperatura, ConsumoEnergia, Sensor_IdSensor) VALUES (?,?,?,?)";
    $consulta = $this->conexao->prepare($sql);

    if (!$consulta) {
        return "Erro na preparação da consulta: " . $this->conexao->error;
    } 
        
    try {
        $consulta->bind_param("iddi", $iluminacao, $temperatura, $ConsumoEnergia, $Sensor_IdSensor);
        $consulta->execute();
        $idambiente = $consulta->insert_id;

        return [
           'mensagem' => $consulta->affected_rows > 0 ? "Inserido com sucesso" : "Nenhuma linha afetada",
           'id' => $idambiente

        ];
    } catch (mysqli_sql_exception $e) {
        return "Erro: " . $e->getMessage();
    }
}
public function listarAmbiente(){
$sql= "SELECT * FROM Ambiente";   
 $consulta = $this->conexao->prepare($sql);
    try {
       
        $consulta = $this->conexao->query($sql);
    if ($consulta->num_rows > 0) {
        $resultambiente = $consulta->fetch_all(MYSQLI_ASSOC);
        return $resultambiente;
    }else {
        return "nenhuma linha afetada";
    }
           
   } catch(mysqli_sql_exception $e){
    return "Erro: " . $e->getMessage();
   }
}
public function VisualizarView(){
    $sqlView = "SELECT * FROM salas_sensores_ambiente;";
    $consulta = $this->conexao->prepare($sqlView);
    try {
        if($consulta){
            $consulta->execute();
            $result = $consulta->get_result();
            if( $result->num_rows>0){       
                $dados =  $result->fetch_all(MYSQLI_ASSOC);
                return $dados;
            }else{
                return [];
        }
        }else {
            return "Erro na preparação da consulta: " . $this->conexao->error;
        }

    }catch(mysqli_sql_exception $e){
    return "Erro: " . $e->getMessage();
   }
}
}


?>