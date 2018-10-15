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
			margin-top: 90px;
		}

		/* .form-group {
			position: relative;
			margin: 35px auto;
		}

		label {
			position: absolute;
			top: 8px;
			left: 30px;
			color: #bbb;
			transition: all .2s ease-out;
		}

		input.form-control {
			position: relative;
			z-index: 1;
			border: 0;
			border-radius: 0;
			border-bottom: 1px solid #bbb;
			background-color: transparent;
			transition: all .2s ease-out;
		}

		input.form-control:focus {
			outline: none;
			box-shadow: none;
			border-bottom: 2px solid #007bff;
			background-color: transparent;
		}

		input.form-control:focus + label {
			top: -20px;
			left: 28px;
			color: #777;
			font-size: 13px;
		} */

	</style>
   
</head>
<body class="bg-info">

	<div class="container wrapper">

      <div class="row d-flex justify-content-center align-items-center loginForm">
         <div class="col-4 bg-light py-4 mb-3">
            <form action="php/login.php" method="post" autocomplete="off">
               <h3 class="text-center text-dark">Login</h3>
               <h6 class="text-center text-dark">Painel Administrativo</h6>
               <hr>
               <div class="form-group px-4">
                  <label class="" id="emailLogin">E-mail</label>
						<input type="text" class="form-control" name="email">
               </div>
               <div class="form-group px-4">
                  <label class="">Senha</label>
						<input type="password" class="form-control" name="senha">
               </div>
               <div class="form-group d-flex justify-content-start px-4 mt-5 mb-4">
                  <!-- <a href="#" class="btn btn-light">Voltar</a> -->
                  <input type="submit" class="btn btn-primary w-100" name="login" value="Entrar">
               </div>
            </form>
         </div>
      </div>

		<div class="row justify-content-center align-items-center">
			<div class="col-4 d-flex justify-content-center">
				<a href="index.php" class="text-dark">← Voltar para a página anterior</a>
			</div>
		</div>
   	
      <a href="#" class="btn btn-info back-top"><i class="fas fa-angle-double-up"></i></a>

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