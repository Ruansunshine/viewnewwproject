<?php

require_once('../../config/database.php');
require_once('../../app/models/ambientemodels.php');


class AmbienteController {
    private $conexao;

    public function __construct($conexao) {
        $this->conexao = $conexao;
    }

    
    public function RegistrarAmbiente($dados) {
        try {
            if (empty($dados['iluminacao']) || empty($dados['temperatura']) || empty($dados['ConsumoEnergia']) || empty($dados['Sensor_IdSensor'])) {
                return ['mensagem' => 'Todos os campos são obrigatórios'];
            }

          
            $ambiente = new Ambiente($this->conexao);
            $resultadoInsert = $ambiente->InsertAmbiente(
                $dados['iluminacao'],
                $dados['temperatura'],
                $dados['ConsumoEnergia'],
                $dados['Sensor_IdSensor']
            );

            return [
                'mensagem' => $resultadoInsert['mensagem'],
                'id' => $resultadoInsert['id']
            ];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

   
    public function ListarAmbientes() {
        try {
            $ambiente = new Ambiente($this->conexao);
            $resultado = $ambiente->listarAmbiente();

            if (is_array($resultado)) {
                return [
                    'mensagem' => 'Ambientes listados com sucesso',
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
