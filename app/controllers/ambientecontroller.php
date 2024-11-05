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
    public function contoleStored($dados){
        if (!isset($dados['IdSensor_IdSensor']) || !is_array($dados['IdSensor_IdSensor'])) {
            return ['mensagem' => 'Id do sensor deve ser um array.'];
        }
        if (!isset($dados['Tipo']) || !is_array($dados['Tipo'])) {
            return ['mensagem' => 'Tipo deve ser um array.'];
        }

    //     echo "<br>";
    //     echo "DADOS  DEPOIS DO IF NO CONTROLADOR  =";
    //     var_dump($dados);
    //    echo "<br>";
        
        $ambiente = new Ambiente($this->conexao);
        $resultado= [];
        try {
            for ($i = 0; $i < count($dados['IdSensor_IdSensor']); $i++) {
                $idSensor = $dados['IdSensor_IdSensor'][$i]; 
                $tipo = $dados['Tipo'][$i]; 
              
                $resultado = $ambiente->StoredProcedure($dados['IdSensor_IdSensor'], $dados['Tipo']);
            //     echo "<br>";
            //     echo "DADOS DA RESPOSTA NO CONTROLADOR  =";
            //     var_dump($resultado);
            //    echo "<br>";
            }
    
        
            return [
                'mensagem' => 'Simulação de dados realizada com sucesso',
                'resultados' => $resultado 
            ];

        } catch(mysqli_sql_exception $e){
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }

    }
    public function ControllerDadosAmbienteSensor($dados) {
     
        if (!isset($dados['IdSalas']) || empty($dados['IdSalas'])) {
            return ['mensagem' => 'ID da sala é obrigatório'];
        }
    
       
        $IdSala = (int) $dados['IdSalas'];
        
        $ambiente = new Ambiente($this->conexao);
        $resultado = $ambiente->DadosAmbienteSensor($IdSala);
        //   var_dump($resultado);
        //   exit();
        
        if (isset($resultado['mensagem'])) {
            return $resultado;
        }
    
        return [
            'mensagem' => 'Dados obtidos com sucesso',
            'dados' => $resultado
        ];
    }
    
}
