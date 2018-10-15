<?php
   require_once "config.php";

   session_start();

	if (!isset($_SESSION['user_email'])) {
		header("Location: login_form.php");
		exit();
	}

   if ($_SERVER['REQUEST_METHOD'] == "POST") {

      $nomeInput = $_POST['nome'];
      $emailInput = $_POST['email'];
      $senhaInput = $_POST['senha'];
      $checkSenhaInput = $_POST['confirmarSenha'];

      $nomeErr = $emailErr = $senhaErr = $checkSenhaErr = "";
      $nome = $email = $senha = $senhaHash = $checkSenha = "";

      if (empty($nomeInput)) {
         $nomeErr = "Por favor, insira um nome";
      } else if (!filter_var($nomeInput, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'-.\s ]+$/")))) {
         $nomeErr = "Por favor, inisra um nome válido";
      } else {
         $nome = $nomeInput;
      }

      if (empty($emailInput)) {
         $emailErr = "Por favor, insira um e-mail";
      } else if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Por favor, insira um e-mail válido";
      } else {
         $email = $emailInput;
      }

      if (empty($senhaInput)) {
         $senhaErr = "Por favor, insira uma senha";
      } else if (strlen($senhaInput) < 6) {
         $senhaErr = "A senha deve conter, no mínimo, 6 caracteres";
      } else {
         // $senhaHash = password_hash($senhaInput, PASSWORD_DEFAULT);
         $senha = $senhaInput;
      }

      if (empty($checkSenhaInput)) {
         $checkSenhaErr = "Por favor, confirme a senha";
      } else if ($checkSenhaInput != $senhaInput) {
         $checkSenhaErr = "As senhas devem ser iguais";
      }
      
      $qrySelect = "SELECT * FROM usuarios WHERE email = '". $email ."'";
      $result = $conn->query($qrySelect);

      if ($result->num_rows == 1) {
         $emailErr = "E-mail já cadastrado";
         header("Location: add_adm.php?erro=email");
         exit();
      } else {
         if (empty($nomeErr) && empty($emailErr) && empty($senhaErr) && empty($checkSenhaErr)) {

            $qryInsert = "INSERT INTO usuarios (nome, email, senha) VALUES (? ,? ,?)";

            if ($stmt = $conn->prepare($qryInsert)) {

               $stmt->bind_param('sss', $param_nome, $param_email, $param_senha);

               $param_nome = $nome;
               $param_email = $email;
               $param_senha = $senha;

               if ($stmt->execute()) {
                  header("Location: adm_func.php");
                  exit();
               } else {
                  header("Location: add_adm.php?erro=stmt_execute");
                  exit();
               }
               header("Location: add_adm.php?erro=param");
               exit();
            }
            $stmt->close();
			}
      }
      $conn->close();
   }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title><?php echo isset($title) ? $title : 'Agenda TW' ?></title>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="css/style.css">

	<style>

		.loginForm {
			margin-top: 1%;
		}

	</style>
   
</head>
<body class="bg-info">

	<div class="container wrapper">

      <div class="row d-flex justify-content-center align-items-center loginForm">
         <div class="col-lg-4 bg-light py-4">

            <div class="row">
               <div class="col">
                  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off">
                     <h3 class="text-center text-dark">Cadastro</h3>
                     <h6 class="text-center text-dark">Usuário Administrativo</h6>
                     <hr>

							<div class="px-4">
								<ul>
									<?php echo (!empty($nomeErr)) ? '<li>'. $nomeErr .'</li>' : '' ?>
									<?php echo (!empty($emailErr)) ? '<li>'. $emailErr .'</li>' : '' ?>
									<?php echo (!empty($senhaErr)) ? '<li>'. $senhaErr .'</li>' : '' ?>
									<?php echo (!empty($checkSenhaErr)) ? '<li>'. $checkSenhaErr .'</li>' : '' ?>
								</ul>
							</div>
                     
                     <div class="form-group px-4">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome" value="<?php echo $nome ?>">
                     </div>
                     <div class="form-group px-4">
                        <label id="emailLogin">E-mail</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $email ?>">
                     </div>
                     <div class="form-group px-4">
                        <label class="">Senha</label>
                        <input type="password" class="form-control" name="senha">
                     </div>
                     <div class="form-group px-4">
                        <label class="">Confirmar senha</label>
                        <input type="password" class="form-control" name="confirmarSenha">
                     </div>
                     <div class="form-group d-flex justify-content-start px-4 mt-5 mb-4">
                        <input type="submit" class="btn btn-primary w-100" name="login" value="Cadastrar">
                     </div>
                  </form>
               </div>
            </div>

            <div class="row">
               <div class="col d-flex justify-content-center">
                  <a href="index.php" class="text-dark">← Voltar para a página anterior</a>
               </div>
            </div>

         </div>
      </div>

		<!-- <div class="row justify-content-center align-items-center">
			<div class="col-4 d-flex justify-content-center">
				<a href="index.php" class="text-dark">← Voltar para a página anterior</a>
			</div>
		</div> -->

   </div>

   <!-- <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery.js"></script> -->

   <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

   <script src="js/table-functions.js"></script>
   <script src="js/ajax.js"></script>

   <script>



   </script>

</body>
</html>