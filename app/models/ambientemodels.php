<?php

require_once('../../config/database.php');
require_once('salasmodels.php');
require_once('sensormodels.php');



class ambiente
{
    private $idambiente;
    private $iluminacao;
    private $temperatura;
    private $ConsumoEnergia;
    private $Sensor_IdSensor;
    private $Tipo;
    private $IdSala;
    private $IdUsuario;
    private $conexao;
    public function __construct($conexao)
    {
        $this->conexao = $conexao;
    }
    public function InsertAmbiente($iluminacao, $temperatura, $ConsumoEnergia, $Sensor_IdSensor)
    {
        $sql = "INSERT INTO Ambiente(IiluminacaoEstado, Temperatura, ConsumoEnergia, Sensor_IdSensor) VALUES (?,?,?,?)";
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
    public function listarAmbiente()
    {
        $sql = "SELECT * FROM Ambiente";
        $consulta = $this->conexao->prepare($sql);
        try {

            $consulta = $this->conexao->query($sql);
            if ($consulta->num_rows > 0) {
                $resultambiente = $consulta->fetch_all(MYSQLI_ASSOC);
                return $resultambiente;
            } else {
                return "nenhuma linha afetada";
            }
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function StoredProcedure($Sensor_IdSensorArray, $TipoArray)
    {
        $resultados = [];
        $sql = "CALL SimularDadosAmbiente(?, ?)";



        if (!is_array($Sensor_IdSensorArray) || !is_array($TipoArray)) {
            return ['mensagem' => 'Os parâmetros devem ser arrays.'];
        }
        //     echo "<br>";
        //     echo "DADOS DA RESPOSTA NO MODEL DEPOIS DO IF  =";
        //     var_dump($Sensor_IdSensorArray);
        //    echo "<br>";
        //    echo "DADOS DA RESPOSTA NO MODEL DEPOIS DO IF  =";
        //    var_dump($TipoArray);

        foreach ($Sensor_IdSensorArray as $key => $Sensor_IdSensor) {

            $Tipo = $TipoArray[$key] ?? '';

            $consulta = $this->conexao->prepare($sql);
            try {

                $consulta->bind_param("is", $Sensor_IdSensor, $Tipo);
                $consulta->execute();
                $resultados[] = ['mensagem' => 'StoredProcedure executada com sucesso'];
            } catch (mysqli_sql_exception $e) {
                $resultados[] = ['mensagem' => 'Erro: ' . $e->getMessage()];
            }
        }

        return $resultados;
    }
    public function DadosAmbienteSensor($IdSala)
{
    $sql = "SELECT 
                NomeSala, 
                DescricaoSala, 
                StatusSala, 
                IiluminacaoEstado, 
                Temperatura, 
                ConsumoEnergia, 
                TipoSensor, 
                NomeUsuario, 
                DataCadastro
            FROM 
                view_dados_completos_por_sala
            WHERE 
                IdSala = ?";

    $consulta = $this->conexao->prepare($sql);
    try {
        $consulta->bind_param("i", $IdSala);

      
        if ($consulta->execute()) {
            $result = $consulta->get_result(); 

          
            if ($result && $result->num_rows > 0) {
                $dados = $result->fetch_all(MYSQLI_ASSOC); 
                return $dados;
            } else {
                return ['mensagem' => 'Nenhum dado encontrado'];
            }
        } else {
            return ['mensagem' => 'Falha na execução da consulta'];
        }
    } catch (mysqli_sql_exception $e) {
        return ['mensagem' => 'Erro: ' . $e->getMessage()];
    }
}
  public function AlertaAmbienteSensor($IdUsuario){
  $sql = "SELECT 
    u.IdUsuario AS idUsuario,
    u.Nome AS nomeUsuario,
    a.mensagem AS alerta,
    a.data AS dataAlerta,  
    amb.Idambiente AS idAmbiente,
    se.Tipo AS sensor,
    s.Nome AS sala
FROM 
    automacao.alertas a
JOIN 
    automacao.ambiente amb ON a.idAmbiente = amb.Idambiente
JOIN 
    automacao.sensor se ON amb.Sensor_IdSensor = se.IdSensor
JOIN 
    automacao.salas s ON se.Salas_idSalas = s.idSalas
JOIN 
    automacao.usuario u ON s.Usuario_IdUsuario = u.IdUsuario
WHERE 
    u.IdUsuario = ?;
";
$consulta = $this->conexao->prepare($sql);
   try {
   $consulta->bind_param("i", $IdUsuario);
   if ($consulta->execute()) {
    $result = $consulta->get_result(); 

  
    if ($result && $result->num_rows > 0) {
        $dados = $result->fetch_all(MYSQLI_ASSOC); 
        return $dados;
    } else {
        return ['mensagem' => 'Nenhum dado encontrado'];
    }
} else {
    return ['mensagem' => 'Falha na execução da consulta'];
}
   } catch (mysqli_sql_exception $e) {
    return ['mensagem' => 'Erro: ' . $e->getMessage()];
}
  }
}
?>
