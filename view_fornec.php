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
</head>
<body>

	<!-- Navbar -->
	<nav class="navbar navbar-expand-md bg-primary">
		<div class="container d-flex justify-content-between">
			<a href="#" class="navbar-brand text-light"><img src="assets/img/logo_tw_sigla.png" width="45"></a>
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

		<div class="row mt-5">
			<div class="col align-items-center clearfix">
				<h2 class="mb-4 float-left">Colaboradores</h2>
			</div>
		</div>

		<div class="row clearfix mt-3">
			<div class="col-md-6 col-xs-12 d-md-flex justify-content-start search-filter">
				<form class="form-inline px-1">
					<div class="input-group">
						<div class="input-group-prepend">
							<label for="searchCli" class="d-none d-md-block ml-2 input-group-text"><i class="fas fa-search"></i></label>
						</div>
						<input id="searchCli" type="text" class="form-control search-mob" placeholder="Nome ou Cargo">
					</div>
				</form>
			</div>

			<div class="col-md-6 col-xs-12 d-none d-md-flex justify-content-end select-filter">
				<form class="form-inline pr-2">
					<div class="input-group">
						<select id="typeSort" class="form-control float-right">
							<option value="nameAsc">Nome</option>
							<option value="nameDesc">Nome - Decrescente</option>
							<option value="deptoAsc">Cargo</option>
							<option value="deptoDesc">Cargo - Decrescente</option>
						</select>
						<div class="input-group-append">
							<label for="typeSort" class="input-group-text mr-2"><i class="fas fa-sort"></i></label>
						</div>
					</div>
				</form>
			</div>
		</div>

		<div class="row my-3">
			<div class="col">
				<div class="glossary d-flex justify-content-around px-2">
					<a id="glossary-all" href="#"><strong>Todos</strong></a>
					<div class="letters d-flex justify-content-around">
						<!-- Letras geradas table-functions.js -->
					</div>
				</div>
			</div>
		</div>											

		<div class="row mb-5">
			<div class="col">
				<table id="cadastros" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Ramal</th>
							<th>Telefone</th>
							<th>E-mail</th>
							<th>Depto.</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php

                  function phone_format($phone) {

                     $length = strlen($phone);

                     if ($length == 10) {
                        $pattern = '/(\d{2})(\d{4})(\d*)/';
                     } else if ($length == 11) {
                        $pattern = '/(\d{2})(\d{5})(\d*)/';
                     }
                     $result = preg_replace($pattern, '($1) $2-$3', $phone);
                     return $result;
                  }

                  function isEmpty($data) {
                     if (!empty($data)) {
                        return phone_format($data);
                     } else {
                        return " - ";
                     }
                  }

                  function emptyLink($phone) {
                     
                     if (empty($phone)) {
                        return "#";
                     } else {
                        $link = "https://api.whatsapp.com/send?phone=55".$phone;
                        return $link;
                     }
                  }

                  $qrySelect = "SELECT * FROM fornecs WHERE stats = 1 ORDER BY nome";
	               $result = $conn->query($qrySelect);

                  while($data = $result->fetch_array()) {
                     echo '
                        <tr>
                           <td data-title="Nome">'.$data['nome'].'</td>
                           
                           <td data-title="E-mail">
                              <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
                           </td>
                           
                           <td data-title="Tel. 1">
                              <a href="'. emptyLink($data['tel1']) .'" target="_blank">' . isEmpty($data['tel1']) . '</a>
                           </td>
                           
                           <td data-title="Tel. 2">
                              <a href="'. emptyLink($data['tel2']) .'" target="_blank">' . isEmpty($data['tel2']) . '</a>
                           </td>
                           
                           <td data-title="Cargo">' . $data['cargo'] . '</td>
                           
                           <td>                              
                              <div class="d-flex justify-content-around">
                                 <a href="#" class="viewButton" data-id="'. $data['id_fornec'] .'" data-toggle="modal" data-target="#viewModal" data-type="fornec">Vizualizar <i class="far fa-eye"></i></a>
                              </div>
                           </td>
                        </tr>
                     ';
                  }
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

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

	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script src="js/table-functions.js"></script>
	<script src="js/ajax.js"></script>

	<script>

		glossaryFilter();
		tableSorting();
		searchBox();

		$(document).ready(function() {
			$("[data-toggle='tooltip']").tooltip();

		});

	</script>
	
</body>
</html>