<?php
require_once('../../app/models/ambientemodels.php');
require_once('../../app/services/SensorServices.php');
require_once('../../config/database.php');
class serviceController {
    private $conexao;
    private $sensorService;
    public function __construct($conexao) {
        $this->conexao = $conexao;
      
    }
public function controllerSimularDados($idSensor){
   try{
    if (empty($idSensor)) {
        return ['mensagem' => 'O ID do sensor não pode estar vazio.'];
    }
        $resultado = $this->sensorService->processAmbienteParaVariosSensores($idSensor);
        return [
            'mensagem' => $resultado['mensagem'], 
            'dados' => $resultado['dados'] ?? null 
        ];
    }catch (mysqli_sql_exception $e) {
        return ['mensagem' => 'Erro: ' . $e->getMessage()];
    }
}

}
?>