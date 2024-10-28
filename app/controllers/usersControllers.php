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
  $resultado = $usuario->InsertUsuario($dados['Nome'], $dados['Email'], $senha);
  if ($resultado['sucess']) {
    return [
        'mensagem' => 'Usuário inserido com sucesso',
        'idUsuario' => $resultado['id'], // Retorna o ID do usuário
        'sucess' => true
    ];
}
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
        $usuario = $resultquery->fetch_assoc();
        $_SESSION['idUser'] = $usuario['IdUsuario']; 
        return [
            'mensagem' => 'Login realizado com sucesso',
           'IdUsuario' => $usuario['IdUsuario']
        ];
    }else {
        return ['mensagem' => 'Email ou senha incorretos'];
    }
      

    }catch (mysqli_sql_exception $e) {
        return ['mensagem' => "Erro: " . $e->getMessage()];  
}
}
public function AtualizarControllerUser($dados) {
    
    try {
        if (empty($dados['IdUsuario'])) {
            return ['mensagem' => 'ID do usuário é obrigatório'];
        } 

        $usuario = new Usuario($this->conexao);
        $usuarioatual = $usuario->GetUserNameById($dados['IdUsuario']);
        
        
        if (is_null($usuarioatual)) {
            return ['mensagem' => 'Usuário não encontrado'];
        }

        
        $nomeAtual = $usuarioatual['Nome'];
        $emailAtual = $usuarioatual['Email'];
        $senhaAtual = $usuarioatual['Senha'];

        
        $nome = !empty($dados['Nome']) ? $dados['Nome'] : $nomeAtual;
        $email = !empty($dados['Email']) ? $dados['Email'] : $emailAtual;
        $senha = !empty($dados['Senha']) ? md5($dados['Senha']) : $senhaAtual;

        
        $resultado = $usuario->UpdateUser($nome, $email, $senha, $dados['IdUsuario']);
        return ['mensagem' => $resultado];

    } catch (mysqli_sql_exception $e) {
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
    public function GetByNameId($idUsuario) {
        try {
            if (empty($idUsuario)) {
                return ['mensagem' => 'Id do usuário é obrigatório'];
            }
    
            
            $usuario = new Usuario($this->conexao);
            
          
            $nomeUsuario = $usuario->GetUserNameById($idUsuario);
    
            if ($nomeUsuario !== null) {
                
                return [
                    
                    'idUsuario' => $nomeUsuario['IdUsuario'],
                    'nomeUsuario' => $nomeUsuario['Nome'],
                    'emailUsuario' => $nomeUsuario['Email'],
                    'senhaUsuario' => $nomeUsuario['Senha']
                ];
            } else {
                return ['mensagem' => 'Usuário não encontrado'];
            }
    
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => "Erro: " . $e->getMessage()];
        }
    }
    
    
}

?>