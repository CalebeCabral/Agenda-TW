<?php
   header("content-type:text/html; charset=utf-8");

   // Credenciais do Banco
   define('DB_SERVER', 'agendatw.mysql.dbaas.com.br');
   define('DB_USERNAME', 'agendatw');
   define('DB_PASSWORD', 'f7bk9a3');
   define('DB_NAME', 'agendatw');
   
   // Conexão com Banco de Dados
   $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
   
   // Checagem da conexão com Banco de Dados
   if (!$conn) {
      die("ERROR: Não foi possível conectar-se ao banco de dados. " . mysqli_connect_error());
   }
   
   $conn->set_charset("UTF8");
?>