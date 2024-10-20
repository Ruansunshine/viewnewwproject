<?php


   $hostname="127.0.0.1:3306";
   $bancodedados="automacao";
   $usuario="root";
   $senha="";

      $conexao = new mysqli($hostname, $usuario, $senha,$bancodedados );
      if($conexao->errno){
        echo "falha ao conectar: (". $conexao->connect_errno .")". $conexao->connect_errno;
      }else {
        echo "conectado<br>";
      }


      
?>