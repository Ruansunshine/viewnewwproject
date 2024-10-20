<?php
require_once('../../config/database.php');
require_once('salasmodels.php');

class Usuario
{
    private $IdUsuario;
    private $Nome;
    private $Email;
    private $Senha;
    private $conexao;

    public function __construct($conexao)
    {

        $this->conexao = $conexao;
    }

    public function InsertUsuario($Nome, $Email, $Senha) // inserir usuario
    {
        $sql = "INSERT INTO Usuario (Nome, Email, Senha) VALUES (?, ?, ?)";
        $consulta = $this->conexao->prepare($sql);

        try {
            $consulta->bind_param("sss", $Nome, $Email, $Senha);
            $consulta->execute();
            $idUsuario = $consulta->insert_id; 
            return [
                'mensagem' => $consulta->affected_rows > 0 ? "Inserido com sucesso" : "Nenhuma linha afetada",
                'id' => $idUsuario,
                'sucess' => true
            ];
        } catch (mysqli_sql_exception $e) {
            return ['mensagem' => 'Erro: " . $e->getMessage()',
                 'sucess' => false
        ];
        }
    }
    public function ListUsuario()
    {
        $sql = "SELECT * FROM Usuario";
        $consulta = $this->conexao->prepare($sql);
        try {

            $consulta->execute();
            $result = $consulta->get_result();

            if ($result->num_rows > 0) {
                $usuarios = $result->fetch_all(MYSQLI_ASSOC);
                return $usuarios;
            } else {
                return "Nenhuma linha encontrada";
            }
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function DeleteUser($IdUsuario)
    {
        $sqlDeleteSala ="DELETE FROM Salas WHERE Usuario_IdUsuario = ?"; 
        $consultaSalas = $this->conexao->prepare($sqlDeleteSala); 
       
        try {
            $consultaSalas->bind_param("i", $IdUsuario);
            $consultaSalas->execute();
           $salaDeletada = $consultaSalas->affected_rows>0;
            $sql = "DELETE FROM Usuario WHERE IdUsuario= ?";
            $consulta = $this->conexao->prepare($sql);
            $consulta->bind_param("i", $IdUsuario);
            $consulta->execute();
         if ($consulta->affected_rows > 0 ){
            return $salaDeletada ?
             "Usuario e suas dependencia deletadas" : "Nenhuma linha afetada";
         }else {
            return $salaDeletada ? 
            "Nenhuma linha afetada ao deletar o usuário, mas as dependências foram removidas." :
            "Nenhuma linha afetada ao deletar o usuário e suas dependências.";
         }

        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
    public function UpdateUser($Nome, $Email, $Senha, $IdUsuario)
    {
        $sql = "UPDATE Usuario SET Nome=?, Email=?, Senha=?  WHERE IdUsuario = ?";
        $consulta = $this->conexao->prepare($sql);
        try {
            $consulta->bind_param("sssi", $Nome, $Email, $Senha, $IdUsuario);
            $consulta->execute();
            return $consulta->affected_rows > 0  ? "Usuario atualizado com sucesso" : "Nenhuma linha atualizada";
        } catch (mysqli_sql_exception $e) {
            return "Erro: " . $e->getMessage();
        }
    }
}
