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
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-md bg-primary">
		<div class="container d-flex justify-content-between">
			<a href="#" class="navbar-brand text-light"><img src="../assets/img/logo_tw_sigla.png" width="45"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
				<i class="fas fa-bars text-light"></i>
			</button>
			<div class="collapse navbar-collapse mt-3 mt-md-0" id="navbarNav">
				<ul class="navbar-nav ml-2 mr-auto">
					<li class="nav-item">
						<a href="view_func.php" class="nav-link text-light">Colaboradores</a>
					</li>
					<li class="nav-item ml-md-2">
						<a href="view_cliente.php" class="nav-link text-light">Clientes</a>
					</li>
					<li class="nav-item ml-md-2 mr-auto">
						<a href="view_fornec.php" class="nav-link text-light">Fornecedores</a>
					</li>
				</ul>
				<hr>
				<ul class="nav navbar-nav ml-2 mr-4">
					<li>
						<a href="login_form.php" class="text-light nav-link"><i class="fas fa-sign-in-alt"></i> Login</a>
					</li>
				</ul>

			</div>
		</div>
	</nav>
	<!-- Fim Navbar -->

	<div class="container wrapper">