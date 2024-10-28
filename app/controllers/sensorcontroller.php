<?php
require_once('../../config/database.php');
require_once('../../app/models/sensormodels.php');

class sensorController {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;  
    }

    public function RegistrarSensor($dados) {
        try {
            if (empty($dados['Tipo']) || empty($dados['Salas_idSalas'])) {
                return ['mensagem' => 'Todos os campos são obrigatórios'];
            }

            $sensor = new sensor($this->conexao);
            $resultadoInsert = $sensor->InsertSensor($dados['Tipo'], $dados['Salas_idSalas']);
            if($resultadoInsert('sucess'))
            return [
                'mensagem' => 'Usuário inserido com sucesso',
                'idSalas' => $resultadoInsert['id'], // Retorna o ID do sensor
                'sucess' => true
            ];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

    public function AtualizarSensor($dados) {
        try {
            if (empty($dados['Tipo']) || empty($dados['IdSensor'])) {
                return ['mensagem' => 'Todos os campos são obrigatórios'];
            }

            $sensor = new sensor($this->conexao);
            $resultadoUpdate = $sensor->UpdateSensor($dados['Tipo'], $dados['IdSensor']);

            return ['mensagem' => $resultadoUpdate];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

    public function DeleteSensor($dados) {
        try {
            if (empty($dados['IdSensor'])) {
                return ['mensagem' => 'O campo IdSensor é obrigatório'];
            }

            $sensor = new sensor($this->conexao);
            $resultadoDelete = $sensor->DeleteSensor($dados['IdSensor']);

            return ['mensagem' => $resultadoDelete];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

    public function ListarSensores() {
        try {
            $sensor = new sensor($this->conexao);
            $resultado = $sensor->ListSensor();

            if (is_array($resultado)) {
                return [
                    'mensagem' => 'Sensores listados com sucesso',
                    'dados' => $resultado 
                ];
            } else {
                return ['mensagem' => $resultado];
            }
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }
}
?>
