<?php

session_start();

$erro = array();

if (empty($_POST['email']) || empty($_POST['senha'])) {

   header("Location: ../login_form.php?status=empty");
   exit();
   
} else if (!empty($_POST['email']) && !empty($_POST['senha'])) {

   require_once '../config.php';

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $senha = mysqli_real_escape_string($conn, $_POST['senha']);

   $qryCheck = "SELECT * FROM usuarios WHERE email = '". $email ."'";
   $result = mysqli_query($conn, $qryCheck);

   if (mysqli_num_rows($result) == 1) {

      $data = $result->fetch_array();

      if ($senha == $data['senha']) {
      // if (password_verify($senha, $data['senha'])) {

         $_SESSION['user_name'] = $data['nome'];
         $_SESSION['user_email'] = $data['email'];
         header("Location: ../adm_func.php");
         // exit();

      } else {
         header("Location: ../login_form.php?status=senha");
         // exit();
      }
      
   } else {
      header("Location: ../login_form.php?status=usuario");
      exit();
   }

}

?>