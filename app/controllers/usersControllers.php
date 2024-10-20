<?php
 require_once('../../config/database.php');
 require_once('../../app/models/usermodels.php');

class UsuarioController{
    private $conexao;
public function __construct($conexao){
    $this->conexao = $conexao;  
}
public function Registrar($dados){
    
    try{

    if(empty($dados['Nome']) || empty($dados['Email']) || empty($dados['Senha'])){
   return ['mensagem' => 'Todos os campos são obrigatorias'];  
    }
   $query = "SELECT * FROM Usuario WHERE Email=?";
   $consulta = $this->conexao->prepare($query);
   $consulta->bind_param("s", ($dados['Email']));
   $consulta->execute();
   $resultquery = $consulta->get_result();
   if($resultquery->num_rows > 0){
    return ['mensagem' => 'Email já está em uso.'];
   }

   $senha = md5($dados['Senha']);
   $usuario = new Usuario($this->conexao);
   $usuario->InsertUsuario($dados['Nome'], $dados['Email'], $senha);
   return ['mensagem' => 'Inserido com sucesso'];

    
}catch (mysqli_sql_exception $e) {
    return "Erro: " . $e->getMessage();
}

}
public function LoginUsuario($dados){
    try {
      if(empty($dados['Email']) || empty($dados['Senha'])){
        return ['mensagem' => 'Todos os campos são obrigatorias'];
      }  
        $senha = md5($dados['Senha']);
    $query = "SELECT * FROM Usuario WHERE Email=? AND Senha = ?";
    $consulta = $this->conexao->prepare($query);
    $consulta->bind_param("ss", ($dados['Email']), $senha);
    $consulta->execute();
    $resultquery = $consulta->get_result();
    if($resultquery->num_rows > 0){
          return ['mensagem' => 'Login realizado com sucesso'];
    }else {
        return ['mensagem' => 'Email ou senha incorretos'];
    }
      

    }catch (mysqli_sql_exception $e) {
        return ['mensagem' => "Erro: " . $e->getMessage()];  
}
}
    public function AtualizarControllerUser($dados){
        try{
            if(empty($dados['Nome']) || empty($dados['Email']) || empty($dados['Senha']) || empty($dados['IdUsuario'])){
                return ['mensagem' => 'Todos os campos são obrigatorias'];
            }  

                $senha = md5($dados['Senha']);
                $usuario = new Usuario($this->conexao);
                $usuario->UpdateUser($dados['Nome'], $dados['Email'], $senha, $dados['IdUsuario']);
                return ['mensagem' => 'Usuario atualizado com sucesso'];

    }catch (mysqli_sql_exception $e) {
            return ['mensagem' => "Erro: " . $e->getMessage()];  
    }
    }
    public function deleteUserController($dados){
        try{

     
        if(empty($dados['IdUsuario'])){
            return ['mensagem' => 'Todos os campos são obrigatorias'];
        } 
        $senha = md5($dados['Senha']);
        $usuario = new Usuario($this->conexao);
        $usuario->DeleteUser( $dados['IdUsuario']);
        return ['mensagem' => 'Usuario e suas dependencia deletadas'];

    }catch (mysqli_sql_exception $e) {
        return ['mensagem' => "Erro: " . $e->getMessage()]; 
    }
    }
}
?>