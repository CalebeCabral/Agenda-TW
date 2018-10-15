<?php 
	require_once '../config.php';
	$title = "Agenda TW - Clientes";
	require 'includes/header.php';
?>

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

					$qrySelect = "SELECT * FROM clientes WHERE stats = 1 ORDER BY nome";
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
										<a href="#" class="viewButton" data-id="'. $data['id_cli'] .'" data-toggle="modal" data-target="#viewModal" data-type="cliente">Vizualizar <i class="far fa-eye"></i></a>
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

<?php
	require 'includes/footer.php'
?>