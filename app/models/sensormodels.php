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
        $_SESSION['idSalas'] = $IdSensor;
        return [
            'mensagem' => $consulta->affected_rows > 0 ? "sensor inserido com sucesso" : "Nenhuma linha afetada",
             'id'=> $IdSensor,
             'sucess' => true
        ];
    }catch(mysqli_sql_exception $e){
        return ['mensagem' => 'Erro: " . $e->getMessage()',
                    'sucess' => false
            ];
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
public function SensorSalasUsers($Salas_idSalas){
    // var_dump($Salas_idSalas);
    // exit();
    $sql = "
SELECT 
    usuario.Nome AS NomeUsuario,
    salas.Nome AS NomeSala,
    salas.Descricao AS DescricaoSala,
    sensor.IdSensor AS IdSensor, 
    sensor.Tipo AS TipoSensor,
    sensor.DataCadastro AS DataCadastroSensor
FROM 
    automacao.usuario
JOIN 
    automacao.salas ON usuario.IdUsuario = salas.Usuario_IdUsuario
JOIN 
    automacao.sensor ON salas.idSalas = sensor.Salas_idSalas
WHERE 
    salas.idSalas = ?;
";
$consulta = $this->conexao->prepare($sql);
try{
    $consulta->bind_param("i", $Salas_idSalas);
    $consulta->execute();

    $resultado = $consulta->get_result();
    $sensores =[];
    if ($resultado->num_rows > 0) {
        while ($sensor = $resultado->fetch_assoc()) {
            $sensores[] = $sensor; 
        }
        return $sensores;  
    } else {
        return [];
    }
}catch(mysqli_sql_exception $e){
        return "Erro: " . $e->getMessage();
    }

}
}
    

?>