<?php

	require_once 'config.php';

	$tipoCadastro = $nome = $ramal = $tel1 = $tel2 = $setor = $cargo = $email = $endereco = "";
	$nomeErr = $ramalErr = $tel1Err = $tel2Err = $cargoErr = $setorErr = $emailErr = $enderecoErr = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//Tipo de Cadastro
		$tipoCadastro = $_POST["tipo"];

		// Validação Nome
		$nomeInput = trim($_POST["nome"]);
		if (empty($nomeInput)) {
			$nomeErr = "Por favor, insira um nome.";
		} else if (!filter_var($nomeInput, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'-.\s ]+$/")))) {
			$nomeErr = 'Por favor, insira um nome válido.';
		} else {
			$nome = $nomeInput;
		}
	
		// Validação Ramal
		$ramalInput = trim($_POST["ramal"]);
		if(empty($ramalInput)){
			$ramalErr = 'Por favor, insira um ramal.';
		} else if (!ctype_digit($ramalInput)) {
			$ramalErr = "Por favor, insira um ramal válido";
		} else {
			$ramal = $ramalInput;
		}
	
		// Validação Telefone 1
		$tel1Input = trim($_POST["tel1"]);
		$tel1Input = str_replace(" ", "", $tel1Input);
		if(empty($tel1Input)){
			$tel1Err = 'Por favor, insira um telefone.';
		} else if (!ctype_digit($tel1Input)) {
			$tel1Err = "Utilize apenas caracteres numericos.";
		} else {
			$tel1 = $tel1Input;
		}
	
		// Validação Telefone 2
		$tel2Input = trim($_POST["tel2"]);
		$tel2Input = str_replace(" ", "", $tel2Input);
		if(!empty($tel2Input) && !ctype_digit($tel2Input)){
			$tel2Err = "Utilize apenas caracteres numericos.";
		} else if (empty($tel2Input)) {
			$tel2 = NULL;
		} else {
			$tel2 = $tel2Input;
		}

		//Validação Cargo
		$cargoInput = $_POST["cargo"];
		if ($cargoInput === "0") {
			$cargoErr = "Selecione um cargo.";
		} else {
			$cargo = $cargoInput;
		}
	
		//Validação Setor
		$setorInput = $_POST["setor"];
		if ($setorInput === "0") {
			$setorErr = "Selecione um setor.";
		} else {
			$setor = $setorInput;
		}
	
		// Validação E-mail
		$emailInput = $_POST["email"];
		if (empty($emailInput)) {
			$emailErr = "Por favor, insira um e-mail.";
		} else if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Por favor, insira um e-mail válido.";
		} else {
			$email = $emailInput;
		}

		$endereco = $_POST["endereco"];

		if ($tipoCadastro === "colaborador") {

			if (empty($nomeErr) && empty($ramalErr) && empty($tel1Err) && empty($tel2Err) && empty($setorErr) && empty($emailErr)) {

				$qryInsert = "INSERT INTO funcs (nome, ramal, tel1, tel2, setor, email)
				VALUES (?, ?, ?, ?, ?, ?)";

				if ($stmt = mysqli_prepare($conn, $qryInsert)) {
					mysqli_stmt_bind_param($stmt, "sissss", $param_nome, $param_ramal, $param_tel1, $param_tel2, $param_setor, $param_email);

					$param_nome = $nome;
					$param_ramal = $ramal;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_setor = $setor;
					$param_email = $email;

					if (mysqli_stmt_execute($stmt)) {
						header("location: adm_func.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}

				mysqli_stmt_close($stmt);

			}

		} else if ($tipoCadastro === "cliente") {

			if (empty($nomeErr) && empty($tel1Err) && empty($tel2Err) && empty($cargoErr) && empty($emailErr)) {

				$qryInsert = "INSERT INTO clientes (nome, tel1, tel2, cargo, email)
				VALUES (?, ?, ?, ?, ?)";

				if ($stmt = mysqli_prepare($conn, $qryInsert)) {
					mysqli_stmt_bind_param($stmt, "sssss", $param_nome, $param_tel1, $param_tel2, $param_cargo, $param_email);

					$param_nome = $nome;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_cargo = $cargo;
					$param_email = $email;

					if (mysqli_stmt_execute($stmt)) {
						header("location: adm_cliente.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}
				
				mysqli_stmt_close($stmt);
				
			}

		} else if ($tipoCadastro === "fornecedor") {

			if (empty($nomeErr) && empty($tel1Err) && empty($tel2Err) && empty($cargoErr) && empty($emailErr)) {

				$qryInsert = "INSERT INTO fornecs (nome, tel1, tel2, cargo, email, endereco)
				VALUES (?, ?, ?, ?, ?, ?)";

				if ($stmt = mysqli_prepare($conn, $qryInsert)) {
					mysqli_stmt_bind_param($stmt, "ssssss", $param_nome, $param_tel1, $param_tel2, $param_cargo, $param_email, $param_endereco);

					$param_nome = $nome;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_cargo = $cargo;
					$param_email = $email;
					$param_endereco = $endereco;

					if (mysqli_stmt_execute($stmt)) {
						header("location: adm_fornec.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}
				
				mysqli_stmt_close($stmt);
				
			}

		}

		mysqli_close($conn);
		
	}

	function validClass($campo, $erro) {
		if ( !empty($erro) ) {
			return "is-invalid";
		} else {
			if ( !empty($campo) ) {
				return "is-valid";
			} else {
				return "";
			}
		}
	}
	
?>

<?php
	$title = "Cadastrar Colaborador";
	require 'php/header.php'
?>

<div class="row my-4">
	<div class="col col-md-8 offset-md-2">
		<h3>Cadastrar Colaborador</h3>
	</div>
</div>

<div class="row">
	<div class="col col-md-8 offset-md-2">
		<form id="addForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="mb-4">
		
			<div class="form-group">
				<label for="inputTipo" class="font-weight-bold">Tipo de Cadastro</label>
				<select name="tipo" id="tipoCadastro" class="form-control">
					<option value="colaborador">Colaborador</option>
					<option value="cliente">Cliente</option>
					<option value="fornecedor">Fornecedor</option>
				</select>
			</div>

			<div class="form-group" id="groupNome">
				<label for="inputNome" class="font-weight-bold">Nome *</label>
				<input class="form-control <?php echo validClass($nome, $nomeErr) ?>" id="inputNome" type="text" name="nome" value="<?php echo $nome ?>">

				<div class="<?php echo (!empty($nomeErr)) ? 'invalid-feedback' : 'valid-feedback'; ?>">
					<?php echo $nomeErr ?>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-md-2" id="groupRamal">
					<label for="inputRamal" class="font-weight-bold">Ramal *</label>
					<input class="form-control <?php echo validClass($ramal, $ramalErr) ?>" id="inputRamal" type="text" name="ramal" value="<?php echo $ramal ?>">
					
					<div class="<?php echo (!empty($ramalErr)) ? 'invalid-feedback':'valid-feedback'; ?>">
						<?php echo $ramalErr ?>
					</div>
				</div>
				<div class="form-group col-md" id="groupTel1">
					<label for="inputTel1" class="font-weight-bold">Telefone 1 *</label>
					<input class="form-control <?php echo validClass($tel1, $tel1Err) ?>" id="inputTel1" type="text" name="tel1" value="<?php echo $tel1 ?>">

					<div class="<?php echo (!empty($tel1Err)) ? 'invalid-feedback':'valid-feedback'; ?>">
						<?php echo $tel1Err ?>
					</div>
				</div>
				<div class="form-group col-md" id="groupTel2">
					<label for="inputTel2" class="font-weight-bold">Telefone 2</label>
					<input class="form-control <?php echo validClass($tel2, $tel2Err) ?>" id="inputTel2" type="text" name="tel2" value="<?php echo $tel2 ?>">

					<div class="<?php echo (!empty($tel2Err)) ? 'invalid-feedback':'valid-feedback'; ?>">
						<?php echo $tel2Err ?>
					</div>
				</div>
			</div>

			<div class="form-group" id="groupSetor">
				<label for="inputSetor" class="font-weight-bold">Setor *</label>
				<input class="form-control <?php echo validClass($setor, $setorErr) ?>" id="inputSetor" type="text" name="setor" value="<?php echo $setor ?>">

				<div class="<?php echo (!empty($setorErr)) ? 'invalid-feedback':'valid-feedback'; ?>">
					<?php echo $setorErr ?>
				</div>
			</div>

			<div class="form-group mb-4" id="groupCargo">
				<label for="inputCargo" class="font-weight-bold">Cargo *</label>
				<input class="form-control <?php echo validClass($cargo, $cargoErr) ?>" id="inputCargo" type="text" name="cargo" value="<?php $cargo ?>">

				<div class="<?php echo (!empty($cargoErr)) ? 'invalid-feedback':'valid-feedback'; ?>">
					<?php echo $cargoErr ?>
				</div>
			</div>

			<div class="form-group mb-4" id="groupEmail">
				<label for="inputEmail" class="font-weight-bold">E-mail *</label>
				<input class="form-control <?php echo validClass($email, $emailErr) ?>" id="inputEmail" type="text" name="email" value="<?php echo $email ?>">

				<div class="<?php echo (!empty($emailErr)) ? 'invalid-feedback':'valid-feedback'; ?>">
					<?php echo $emailErr ?>
				</div>
			</div>

			<div class="form-group mb-4" id="groupEndereco">
				<label for="inputEndereco" class="font-weight-bold">Endereço</label>
				<input class="form-control" id="inputEndereco" type="text" name="endereco" value="<?php echo $endereco ?>">
			</div>
			
			<div class="form-row d-flex justify-content-around justify-content-md-end">
				<a href="adm_func.php" class="btn btn-light ml-2 btnVoltar">Cancelar</a>
				<input type="submit" class="btn btn-primary ml-md-2" value="Cadastrar">
			</div>
			
		</form>
	</div>
</div>

<a href="#" class="btn btn-info back-top"><i class="fas fa-angle-double-up"></i></a>

<!-- <script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery.js"></script> -->

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

<script src="js/table-functions.js"></script>
<script src="js/ajax.js"></script>

<script>

	$(document).ready(function() {

		$("#groupCargo, #groupEndereco").hide();
		
		$("#tipoCadastro").on("change", function() {

			$("#addForm").children().show();
			$("#addForm").find(".form-row").children().show();

			if ($(this).val() === "cliente") {
				$("#groupRamal, #groupSetor, #groupEndereco").hide();
			} else if ($(this).val() === "fornecedor") {
				$("#groupRamal, #groupSetor").hide();
			} else {
				$("#groupCargo, #groupEndereco").hide();
			}
		});
	});

</script>

</body>
</html>