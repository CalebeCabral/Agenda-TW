<?php	
	require_once 'config.php';
	$title = "Agenda TW - Colaboradores";
	require 'php/header.php'
?>

<div class="row d-flex justify-content-start align-items-center my-4 mt-md-4 mb-md-5">
	<div class="col" id="pageTitle">
		<h3>Colaboradores</h3>
	</div>

	<div class="col d-flex justify-content-end align-items-center">
		<a href="add.php" class="btn btn-primary d-md-none rounded-circle shadow mr-2">+</a>
		<a href="add.php" class="btn btn-primary d-none d-md-block w-25 shadow mr-2">Cadastrar</a>
		<!-- <button type="button" id="addBtnModal" class="btn btn-primary d-none d-md-block w-25 shadow mr-2" data-toggle="modal" data-target="#addModal">Add (Modal)</button> -->
	</div>
</div>

<div class="row clearfix my-4">
	<div class="col-md-6 col-xs-12 d-md-flex justify-content-start search-filter">
		<form class="form-inline px-1">
			<div class="input-group">
				<div class="input-group-prepend">
					<label for="searchCli" class="d-none d-md-block ml-2 input-group-text"><i class="fas fa-search"></i></label>
				</div>
				<input id="searchCli" type="text" class="form-control search-mob" placeholder="Nome ou Depto.">
			</div>
		</form>
	</div>

	<div class="col-md-6 col-xs-12 d-none d-md-flex justify-content-end select-filter">
		<form class="form-inline pr-2">
			<div class="input-group">
				<select id="typeSort" class="form-control float-right">
					<option value="nameAsc">Nome</option>
					<option value="nameDesc">Nome - Decrescente</option>
					<option value="deptoAsc">Setor</option>
					<option value="deptoDesc">Setor - Decrescente</option>
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

      <table class="table table-bordered shadow-sm mb-1">
         <tr>
            <td style="padding: 0;">
               <input class="form-control rounded-0" type="text" placeholder="Buscar nome ou e-mail..." style="width: 100%; min-height: 100%; padding: .7rem; border: none;">
            </td>
            <td>Ordenar</td>
            <td>Add</td>
         </tr>
      </table>

		<table id="cadastros" class="table table-bordered table-striped shadow table-hover">
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

				function emptyLink($phone) {
					
					if (empty($phone)) {
						return "#";
					} else {
						$link = "https://api.whatsapp.com/send?phone=55".$phone;
						return $link;
					}
				}

				$qrySelect = "SELECT * FROM funcs WHERE stats = 1 ORDER BY nome";
				$result = $conn->query($qrySelect);
				
				while($data = $result->fetch_array()) {
					echo '
						<tr class="shadow">
							<td data-title="Nome">'.$data['nome'].'</td>
                     <td data-title="E-mail">
                        <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
                     </td>
							<td data-title="Ramal">'.$data['ramal'].'</td>
							<td data-title="Tel. 1">
								<a href="'. emptyLink($data['tel1']) .'" target="_blank">' . phone_format($data['tel1']) . '</a>
							</td>
							<td data-title="Depto.">' . $data['setor'] . '</td>
							<td>
								<div class="d-flex justify-content-around">

									<!-- <a href="read.php?id='. $data['id_func'] .'">
										<i class="far fa-eye d-flex justify-content-center mb-1" data-toggle="tooltip" title="Vizualizar"></i>
										<span class="d-md-none">Vizualizar</span>
									</a> -->

									<a href="#" class="d-flex flex-column justify-content-center viewButton" data-id="'. $data['id_func'] .'" data-toggle="modal" data-target="#viewModal" data-type="func">
										<i class="far fa-eye d-flex justify-content-center mb-1" data-toggle="tooltip" title="Detalhes"></i>
										<span class="d-md-none">Detalhes</span>
									</a>

									<a href="update.php?id='. $data['id_func'] .'&tipo=func" class="d-flex flex-column justify-content-center ml-md-2">
										<i class="far fa-edit d-flex justify-content-center mb-1" data-toggle="tooltip" title="Editar"></i>
										<span class="d-md-none">Editar</span>
									</a>

									<a href="disable.php?id='. $data['id_func'] .'&tipo=func" class="d-flex flex-column justify-content-center ml-md-2">
										<i class="far fa-trash-alt d-flex justify-content-center mb-1" data-toggle="tooltip" title="Excluir"></i>
										<span class="d-md-none">Excluir</span>
									</a>
									
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

<?php require 'php/footer.php' ?>