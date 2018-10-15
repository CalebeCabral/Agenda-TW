<?php
	session_start();

	if (!isset($_SESSION['user_email'])) {
		header("Location: login_form.php");
		exit();
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
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-md bg-primary">
		<div class="container d-flex justify-content-between">
			<a href="#" class="navbar-brand text-light"><img src="assets/img/logo_tw_sigla.png" width="45"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
				<i class="fas fa-bars text-light"></i>
			</button>
			<div class="collapse navbar-collapse ml-3 mt-3 mt-md-0" id="navbarNav">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a href="adm_func.php" class="nav-link text-light">Colaboradores</a>
					</li>
					<li class="nav-item ml-md-2">
						<a href="adm_cliente.php" class="nav-link text-light">Clientes</a>
					</li>
					<li class="nav-item ml-md-2">
						<a href="adm_fornec.php" class="nav-link text-light">Fornecedores</a>
					</li>
				</ul>

				<!-- <ul class="navbar-nav">
					<li class="nav-item dropdown">
						<a href="#" class="nav-link dropdown-toggle text-light" id="navbarDropdown" role="button" data-toggle="dropdown">
							Dropdown
						</a>
						<div class="dropdown-menu">
							<a href="#" class="dropdown-item">Opções</a>
							<div class="dropdown-divider"></div>
							<a href="#" class="dropdown-item">Logout</a>
						</div>
					</li>
				</ul> -->

				<div class="dropdown mr-2">
					<a href="#" class="text-light dropdown-toggle" data-toggle="dropdown" role="button">
						Olá, <?php echo isset($_SESSION['user_email']) ? $_SESSION['user_name'] : 'Usuário' ?>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="add_adm.php" class="dropdown-item">Novo Administrador</a>
						<div class="dropdown-divider"></div>
						<a href="php/logout.php" class="dropdown-item">Sair</a>
					</div>
				</div>
				
			</div>
		</div>
	</nav>
	<!-- Fim Navbar -->

	<div class="container wrapper">