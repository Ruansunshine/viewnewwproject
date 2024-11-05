<?php
 require_once('../../config/database.php');
 require_once('../../app/models/salasmodels.php');

class salasController{
    private $conexao;
public function __construct($conexao){
    $this->conexao = $conexao;      
}
public function RegistrarSalas($dados){
 try{
    $usuarioId = $dados['Usuario_IdUsuario'];

    if(empty($dados['Nome']) || empty($dados['Descricao']) || !isset($dados['Status']) || empty($usuarioId)){
        return ['mensagem' => 'Todos os campos são obrigatorias'];  
         }
         $query = "SELECT * FROM Salas WHERE Descricao=?";
         $consulta = $this->conexao->prepare($query);
         $consulta->bind_param("s", ($dados['Descricao']));
         $consulta->execute();
         $resultquery = $consulta->get_result();
         if($resultquery->num_rows > 0){
          return ['mensagem' => 'Descricao já está em uso.'];
         }
         $salas = new Salas($this->conexao);
         $resultadoInsert = $salas->InsertSala($dados['Nome'],$dados['Descricao'],$dados['Status'], $usuarioId);
         if ($resultadoInsert['sucess'])  {

            return [
                'mensagem' => 'Inserido com sucesso',
                'idSalas' => $resultadoInsert['id'],
                'sucess' => true  
            ];
        }
        
        }catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
}
    public function AtualizarSalasController($dados) {
        
   
        try {
        
            if (empty($dados['idSalas'])) {
                return ['mensagem' => 'ID da sala é obrigatório'];
            }
           
        
            $Salas = new Salas($this->conexao);

        
            $Salas->UpdateSalas(
                $dados['Nome'],
                $dados['Descricao'],
                $dados['Status'],
                $dados['idSalas']
            );

            return ['mensagem' => 'Sala atualizada com sucesso'];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: ' . $e->getMessage()];
        }
    }

public function deleteSalaController($dados){
    try{
        if (empty($dados['idSalas'])){
            return ['mensagem' => 'Todos os campos são obrigatorias'];  
             }

           
            $Salas = new Salas($this->conexao);
            $Salas-> DeleteSala( $dados['idSalas']);
            return ['mensagem' => 'Sala deletada com sucesso'];
}catch (mysqli_sql_exception $e) {
    return "Erro: " . $e->getMessage();
}
}
public function ListarSalas() {
    try {
        $salas = new Salas($this->conexao);
        $resultado = $salas->ListSalas(); 
        
       
        if (is_array($resultado)) {
            return [
                'mensagem' => '',
                'dados' => $resultado 
            ];
        } else {
            return [
                'mensagem' => $resultado 
            ];
        }
    } catch (mysqli_sql_exception $e) {
        return ['mensagem' => 'Erro: ' . $e->getMessage()];
    }
}
public function SalasUsersControll(){
    try{
        $salas = new Salas($this->conexao);
        $resultado = $salas->SalasUsuarios(); 
        
       
        if (is_array($resultado)) {
            return [
                'mensagem' => '',
                'dados' => $resultado 
            ];
        } else {
            return [
                'mensagem' => $resultado 
            ];
            
        }
    } catch (mysqli_sql_exception $e) {
        return ['mensagem' => 'Erro: ' . $e->getMessage()];
    }
}
public function salaUserEspecif($usuarioId){
      try{
        if(!$usuarioId){
            return ['mensagem' => 'o id do usuario é obrigatorio'];

        }
        $salas = new Salas($this->conexao);
        $resultado = $salas->SalasUser($usuarioId);
        if (is_array($resultado) && count($resultado) > 0) {
            return [
                'mensagem' => '',
                'dados' => $resultado,
                'sucesso' => true
            ];
        } else {
            return [
                'mensagem' => 'Nenhuma sala encontrada para o usuário especificado',
                'dados' => [],
                'sucesso' => false
            ];
        }
      }catch (mysqli_sql_exception $e) {
        return ['mensagem' => 'Erro: ' . $e->getMessage()];
    }
}


}
?>