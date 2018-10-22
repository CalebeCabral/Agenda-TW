<?php

	require_once 'config.php';
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

		/* .bg-white {
			background-color: #ffffff;
		} */
		
		#addSideModal {
			width: 40%;
			position: fixed;
			top: 0;
			left: -40%;
			height: 100vh;
			z-index: 999;
			transition: all 0.3s;
			box-shadow: 3px 3px 3px rgba(0, 0, 0, 0.2);
		}

		#addSideModal.active {
			left: 0;
		}

		#dismiss {
			width: 35px;
			height: 35px;
			line-height: 35px;
			text-align: center;
			top: 10px;
			right: 10px;
			cursor: pointer;
			font-size: 1.2rem;
			transition: all 0.2s;
		}

		#dismiss:hover {
			background: #e2e2e2;
			border-radius: 4px;
		}

		.overlay {
			display: block;
			visibility: hidden;
			position: fixed;
			width: 100vw;
			height: 100vh;
			top: 0;
			left: 0;
			background: rgba(0, 0, 0, 0.5);
			z-index: 998;
			opacity: 0;
			transition: all .5s;
		}

		.overlay.active {
			visibility: visible;
			opacity: 1;
		}

		.glossary-letter {
			box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,.075);
			background: #ffffff;
			width: 35px;
			line-height: 40px;
			border-radius: 0.15rem;
			text-align: center;
			font-weight: bold;
		}

		.glossary-letter.disabled {
			font-weight: normal;
			cursor: default;
			user-select: none;
			color: #8e8e8e;
		}

		a.glossary-letter:hover,
		.glossary-letter.active {
			background: #007bff !important;
			color: #ffffff;
			text-decoration: none;
			font-weight: normal;
		}

		#functionsTable.sticky {
			position: fixed;
			top: 0;
			left: 0;
		}

		#functionsTable {
			height: 50px;
		}

		#functionsTable td:nth-child(1) {
			width: 45%;
		}
		
		#functionsTable td:nth-child(2) {
			width: 43%;
		}
		
		#functionsTable td:nth-child(3) {
			width: 12%;
		}

		#searchCli {
			width: 100%; 
			min-height: 100%; 
			padding: .7rem; 
			border: none;
		}

		#typeSort {
			width: 100%; 
			min-height: 100%;
			border: none;
		}

		#btnAddSideModal {
			width: 100%;
    		height: 100%;
		}

		.opacity {
			opacity: 0.5;
		}

		#cadastros tbody tr {
			transition: opacity .4s ease-out;
		}

		#cadastros tbody tr td {
			vertical-align: middle;
		}

		#cadastros tbody tr.hidden {
			visibility: collapse;
			opacity: 0;
			transition: none;
		}

		#cadastros td:nth-child(1){
			width: 15%;
		}

		#cadastros td:nth-child(2){
			width: 30%;
		}

		#cadastros td:nth-child(3){
			width: 11%;
		}

		#cadastros td:nth-child(4),
		#cadastros td:nth-child(5) {
			width: 16%;
		}

		#cadastros td:last-child {
			width: 12%;
		}

		.alert {
			position: fixed;
			top: 9%;
			left: 50%;
			border-radius: 0;
			transform: translateX(-50%);
			visibility: collapse;
			opacity: 0;
			transition: all 0.3s ease-out;
			transition-delay: .2s;
			z-index: 99;
		}

		.alert.show {
			top: 13%;
			opacity: 1;
			visibility: visible;
		}

		.alert-add {
			cursor: pointer;
		}

	</style>
	
</head>
<body class="bg-light">

	<div class="alert alert-success shadow alert-add" role="alert">
		<span>Cadastro realizado com sucesso!</span>
	</div>

	<!-- Side Nav -->
	<nav id="addSideModal" class="bg-light">

		<!-- <div id="dismiss">
			<i class="fas fa-times"></i>
		</div> -->

		<div class="sidebar-header d-flex align-items-center justify-content-between px-3 py-2">
			<h3>Adicionar</h3>
			<div id="dismiss">
				<i class="fas fa-times"></i>
			</div>
		</div>

		<hr class="m-0">

		<div class="row p-3">
			<div class="col">

				<form id="sideAddForm" action="" method="post">

					<div class="form-group">
						<label for="inputTipo" class="font-weight-bold">Tipo de Cadastro</label>
						<select name="tipo" id="tipoCadastro" class="form-control">
							<option value="colaborador">Colaborador</option>
							<option value="cliente">Cliente</option>
							<option value="fornecedor">Fornecedor</option>
						</select>
					</div>

					<div class="form-group" id="groupNome">
						<label for="inputAddNome" class="font-weight-bold">Nome *</label>
						<input class="form-control" id="inputAddNome" type="text" name="nome">
						<div id="addNomeFeedback" class="feedback"></div>
					</div>

					<div class="form-group" id="groupEmail">
						<label for="inputAddEmail" class="font-weight-bold">E-mail *</label>
						<input class="form-control" id="inputAddEmail" type="text" name="email">
						<div id="addEmailFeedback" class="feedback"></div>
					</div>

					<div class="form-row">
						<div class="form-group col-md-2" id="groupRamal">
							<label for="inputAddRamal" class="font-weight-bold">Ramal *</label>
							<input class="form-control" id="inputAddRamal" type="text" name="ramal">
							<div id="addRamalFeedback" class="feedback"></div>
						</div>

						<div class="form-group col-md" id="groupTel1">
							<label for="inputAddTel1" class="font-weight-bold">Telefone 1 *</label>
							<input class="form-control" id="inputAddTel1" type="text" name="tel1">
							<div id="addTel1Feedback" class="feedback"></div>
						</div>

						<div class="form-group col-md" id="groupTel2">
							<label for="inputAddTel2" class="font-weight-bold">Telefone 2</label>
							<input class="form-control" id="inputAddTel2" type="text" name="tel2">
							<div id="addTel2Feedback" class="feedback"></div>
						</div>

					</div>

					<div class="form-group" id="groupSetor">
						<label for="inputAddSetor" class="font-weight-bold">Setor *</label>
						<input class="form-control" id="inputAddSetor" type="text" name="setor">
						<div id="addSetorFeedback" class="feedback"></div>
					</div>

					<div class="form-row d-flex justify-content-around justify-content-md-end">
						<button type="button" id="cancelBtn" class="btn btn-light ml-2 btnVoltar">Cancelar</button>
						<button type="submit" id="submitAddForm" class="btn btn-primary ml-md-2">Salvar</button>
					</div>

				</form>
			
			</div>
		</div>
		
	</nav>
	<!-- Fim Side Nav -->

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

		<div class="row d-flex justify-content-start align-items-center my-4 mt-md-4 mb-md-5">
			<div class="col" id="pageTitle">
				<h3>Colaboradores</h3>
			</div>
		</div>

		<div class="row my-4">
			<div class="col">
				<div class="glossary">
					<div class="letters d-flex justify-content-between w-100">
						<a id="glossary-all" class="glossary-letter active" href="#"><strong>#</strong></a>
						<!-- Letras geradas table-functions.js -->
					</div>
				</div>
			</div>
		</div>

		<div class="row mb-5">
			<div class="col">

				<table id="functionsTable" class="table table-bordered shadow-sm mb-3">
					<tr class="bg-white">
						<td class="border-0 p-0">
							<input id="searchCli" class="form-control rounded-0" type="text" placeholder="Buscar nome ou e-mail...">
						</td>
						<td class="border-0 p-0 pl-1">
							<select id="typeSort" class="form-control rounded-0">
								<option value="" disabled selected>Ordenar...</option>
								<option value="nameAsc">Nome</option>
								<option value="nameDesc">Nome - Decrescente</option>
								<option value="deptoAsc">Setor</option>
								<option value="deptoDesc">Setor - Decrescente</option>
							</select>
						</td>
						<td class="border-0 p-0">
							<button id="btnAddSideModal" type="button" class="btn btn-primary rounded-0">
								<span>Adicionar</span><i class="fas fa-plus ml-2"></i>
							</button>
						</td>
					</tr>
				</table>

				<table id="cadastros" class="table table-bordered table-striped shadow-sm table-hover">
					<thead>
						<!-- <tr>
							<td colspan="3">
								<input class="form-control" type="text" placeholder="">
							</td>
							<td colspan="2">Ordenar</td>
							<td>Add</td>
						</tr> -->
						<tr>
							<th>Nome</th>
							<th>E-mail</th>
							<th>Ramal</th>
							<th>Telefone</th>
							<th>Depto.</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php

						// function phone_format($phone) {

						// 	$length = strlen($phone);

						// 	if ($length == 10) {
						// 		$pattern = '/(\d{2})(\d{4})(\d*)/';
						// 	} else if ($length == 11) {
						// 		$pattern = '/(\d{2})(\d{5})(\d*)/';
						// 	}
						// 	$result = preg_replace($pattern, '($1) $2-$3', $phone);
						// 	return $result;
						// }

						// function emptyLink($phone) {
							
						// 	if (empty($phone)) {
						// 		return "#";
						// 	} else {
						// 		$link = "https://api.whatsapp.com/send?phone=55".$phone;
						// 		return $link;
						// 	}
						// }

						// $qrySelect = "SELECT * FROM funcs WHERE stats = 1 ORDER BY nome";
						// $result = $conn->query($qrySelect);
						
						// while($data = $result->fetch_array()) {
						// 	echo '
						// 		<tr class="shadow">
						// 			<td data-title="Nome">'.$data['nome'].'</td>
						// 			<td data-title="E-mail">
						// 				<a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
						// 			</td>
						// 			<td data-title="Ramal">'.$data['ramal'].'</td>
						// 			<td data-title="Tel. 1">
						// 				<a href="'. emptyLink($data['tel1']) .'" target="_blank">' . phone_format($data['tel1']) . '</a>
						// 			</td>
						// 			<td data-title="Depto.">' . $data['setor'] . '</td>
						// 			<td>
						// 				<div class="d-flex justify-content-around">

						// 					<a href="#" class="d-flex flex-column justify-content-center viewButton" data-id="'. $data['id_func'] .'" data-toggle="modal" data-target="#viewModal" data-type="func">
						// 						<i class="far fa-eye d-flex justify-content-center mb-1" data-toggle="tooltip" title="Detalhes"></i>
						// 						<span class="d-md-none">Detalhes</span>
						// 					</a>

						// 					<a href="update.php?id='. $data['id_func'] .'&tipo=func" class="d-flex flex-column justify-content-center ml-md-2">
						// 						<i class="far fa-edit d-flex justify-content-center mb-1" data-toggle="tooltip" title="Editar"></i>
						// 						<span class="d-md-none">Editar</span>
						// 					</a>

						// 					<a href="disable.php?id='. $data['id_func'] .'&tipo=func" class="d-flex flex-column justify-content-center ml-md-2">
						// 						<i class="far fa-trash-alt d-flex justify-content-center mb-1" data-toggle="tooltip" title="Excluir"></i>
						// 						<span class="d-md-none">Excluir</span>
						// 					</a>
											
						// 				</div>
						// 			</td>
						// 		</tr>
						// 	';
						// }

						?>


					</tbody>

				</table>
			</div>
		</div>
	</div>

	<!-- Modal Adicionar -->

	<div class="modal fade" id="addModal" tabindex="-1">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title">Adicionar</h3>
					<button type="button" class="close" data-dismiss="modal">
						<span>&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<div class="container-fluid">

						<form method="post" id="addForm">
							<div class="form-group">
								<label for="inputNome">Nome *</label>
								<input id="inputNome" type="text" name="nome" class="form-control">
							</div>

							<div class="form-row">
								<div class="form-group col-md-2">
									<label for="inputRamal">Ramal *</label>
									<input id="inputRamal" type="text" name="ramal" class="form-control">
								</div>
								<div class="form-group col-md-5">
									<label for="inputTel1">Telefone 1 *</label>
									<input id="inputTel1" type="text" name="tel1" class="form-control">
								</div>
								<div class="form-group col-md-5">
									<label for="inputTel2">Telefone 2</label>
									<input id="inputTel2" type="text" name="tel2" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label for="inputSetor">Setor *</label>
								<select id="inputSetor" name="setor" class="form-control">
									<option value="0"></option>
									<option value="Criação">Criação</option>
									<option value="Atendimento">Atendimento</option>
									<option value="Conteúdo">Conteúdo</option>
								</select>
							</div>

							<div class="form-group">
								<label for="inputEmail">E-mail *</label>
								<input id="inputEmail" type="text" name="email" class="form-control">
							</div>

						</form>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" id="addButton" class="btn btn-primary">Salvar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Fim Modal Add -->

	<!-- View Modal -->

	<div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h3>Detalhes</h3>
				</div>
				<div class="modal-body d-flex justify-content-center align-items-center">
					<!-- Formulário Detalhes -->
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>

	<!-- Fim View Modal -->

	<a href="#" class="btn btn-info back-top"><i class="fas fa-angle-double-up"></i></a>

	<div class="overlay"></div>

	<!-- <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script src="js/table-functions.js"></script>
	<script src="js/ajax.js"></script>

	<script>

		// glossaryFilter();
		tableSorting();
		searchBox();

		$(document).ready(function() {
			
			$("[data-toggle='tooltip']").tooltip();
			$('.alert').alert();
			loadData();

			$("#dismiss, .overlay, #cancelBtn").click(function(event) {

				$("#addSideModal").removeClass("active");
				$(".overlay").removeClass("active");
				$("#sideAddForm input").val("");
				$("#sideAddForm").find(".is-invalid").removeClass("is-invalid");

			});

			$("#btnAddSideModal").click(function() {
				$("#addSideModal").addClass("active");
				$(".overlay").addClass("active");
			});

			// if ($(window).scrollTop() == 235) {

			// }

		});

	</script>
	
</body>
</html>