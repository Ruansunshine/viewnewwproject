<?php
//serviços do sensor(simular dados pra inserir na tabela ambiente)
require_once('../../app/models/sensormodels.php');
require_once('../../config/database.php');
require_once('../../app/models/ambientemodels.php');
require_once('../../app/models/salasmodels.php');
require_once('../../app/models/usermodels.php');



class SensorService {
    private $ambiente;
    private $conexao;

    public function __construct($conexao) {
       
        $this->conexao = $conexao;
        $this->ambiente = new ambiente($this->conexao);
    }
    // public function simularDadosSensor($idSensor, $tipoSensor) {
       
    //     switch ($tipoSensor) {
    //         case 'temperatura':
    //             $temperatura = rand(15, 30);
    //             return [
    //                 'Temperatura' => $temperatura,
    //                 'IiluminacaoEstado' => null,
    //                 'ConsumoEnergia' => null,
    //                 'Sensor_IdSensor' => $idSensor 
    //             ];
    //         case 'Consumo Energia':
    //             $consumoEnergia = rand(0, 100);
    //             return [
    //                 'Temperatura' => null,
    //                 'IiluminacaoEstado' => null,
    //                 'ConsumoEnergia' => $consumoEnergia,
    //                 'Sensor_IdSensor' => $idSensor 
    //             ];
    //         case 'iluminacao':
    //             $estadoIluminacao = rand(0, 1);
    //             return [
    //                 'Temperatura' => null,
    //                 'IiluminacaoEstado' => $estadoIluminacao,
    //                 'ConsumoEnergia' => null,
    //                 'Sensor_IdSensor' => $idSensor 
    //             ];
    //         default:
    //             return null;
    //     }
    // }
    public function simularDadosSensor($idSensor, $tipoSensor) {
        $sql = "CALL SimularDadosAmbiente(?, ?)";
        $consulta = $this->conexao->prepare($sql);
        
        if (!$consulta) {
            return "Erro na preparação da consulta: " . $this->conexao->error;
        }

        $consulta->bind_param("is", $idSensor, $tipoSensor);
        
        if ($consulta->execute()) {
            return [
                'mensagem' => 'Dados simulados e inseridos com sucesso.',
                'idSensor' => $idSensor,
                'tipoSensor' => $tipoSensor
            ];
        } else {
            return "Erro ao simular e inserir dados: " . $consulta->error;
        }
    }
//     
    public function processAmbienteParaVariosSensores(array $sensores) {
        $resultados = [];

        foreach ($sensores as $sensor) {
            $idSensor = $sensor['id'];
            $tipoSensor = $sensor['Tipo'];
            $resultado = $this->simularDadosSensor($idSensor, $tipoSensor);

            $resultados[] = [
                'Sensor_IdSensor' => $idSensor,
                'resultado' => $resultado
            ];
        }

        return $resultados; 
    }
} 
 

?>