<?php

   require_once 'config.php';

   $nome = $ramal = $tel1 = $tel2 = $setor = $email = $cargo = $stats = $endereco = "";
	$nomeErr = $ramalErr = $tel1Err = $tel2Err = $setorErr =  $emailErr = $cargoErr = $statsErr = "";
	
	

	if ($_GET["tipo"] == "func") {
	
		if (isset($_POST["id"]) && !empty($_POST["id"])) {

			$id = $_POST["id"];

			// Validação Name
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

			// Validação Setor
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

			if (empty($nomeErr) && empty($ramalErr) && empty($tel1Err) && empty($tel2Err) && empty($setorErr)
				&& empty($localErr) && empty($emailErr)) {

				$qryUpdate = "UPDATE funcs SET nome=?, ramal=?, tel1=?, tel2=?, setor=?, email=? WHERE id_func=?";

				if($stmt = mysqli_prepare($conn, $qryUpdate)){
					mysqli_stmt_bind_param($stmt, "sissssi", $param_nome, $param_ramal, $param_tel1, $param_tel2, $param_setor, $param_email, $param_id);

					$param_nome = $nome;
					$param_ramal = $ramal;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_setor = $setor;
					$param_email = $email;
					$param_id = $id;

					if(mysqli_stmt_execute($stmt)){
						header("location: adm_func.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}

			}

		} else {

			if(isset($_GET["id"])){
				
				$id =  trim($_GET["id"]);
				$tipo = trim($_GET["tipo"]);

				$qrySelect = "SELECT * FROM funcs WHERE id_func = ?";
				if($stmt = mysqli_prepare($conn, $qrySelect)){
					
					$param_id = $id;
					
					mysqli_stmt_bind_param($stmt, "i", $param_id);

					if(mysqli_stmt_execute($stmt)){
						$result = mysqli_stmt_get_result($stmt);

						if(mysqli_num_rows($result) == 1){
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

							$nome = $row["nome"];
							$ramal = $row["ramal"];
							$tel1 = $row["tel1"];
							$tel2 = $row["tel2"];
							$setor = $row["setor"];
							$email = $row["email"];

						} else{
							header("location: error.php");
							exit();
						}

					} else{
						echo "Oops! Something went wrong. Please try again later.";
					}
				}

				mysqli_stmt_close($stmt);

			} else {
				header("location: error.php");
				exit();
			}
		}
		mysqli_close($conn);

	} else if ($_GET["tipo"] == "cli") {

		if (isset($_POST["id"]) && !empty($_POST["id"])) {

			$id = $_POST["id"];
	
			$nomeInput = trim($_POST["nome"]);
			if (empty($nomeInput)) {
				$nomeErr = "Por favor, insira um nome.";
			} else if (!filter_var($nomeInput, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'-.\s ]+$/")))) {
				$nomeErr = 'Por favor, insira um nome válido.';
			} else {
				$nome = $nomeInput;
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
			
			// Validação Telefone 3
			$tel3Input = trim($_POST["tel3"]);
			$tel3Input = str_replace(" ", "", $tel3Input);
			if(!empty($tel3Input) && !ctype_digit($tel3Input)){
				$tel3Err = "Utilize apenas caracteres numericos.";
			} else if (empty($tel3Input)) {
				$tel3 = NULL;
			} else {
				$tel3 = $tel2Input;
			}
	
			// Validação Telefone 4
			$tel4Input = trim($_POST["tel4"]);
			$tel4Input = str_replace(" ", "", $tel4Input);
			if(!empty($tel4Input) && !ctype_digit($tel4Input)){
				$tel4Err = "Utilize apenas caracteres numericos.";
			} else if (empty($tel4Input)) {
				$tel4 = NULL;
			} else {
				$tel4 = $tel2Input;
			}
	
			//Validação Cargo
			$cargoInput = $_POST["cargo"];
			if ($cargoInput === "0") {
				$cargoErr = "Selecione um cargo.";
			} else {
				$cargo = $cargoInput;
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
	
			if (empty($nomeErr) && empty($tel1Err) && empty($tel2Err) &&empty($tel3Err) &&empty($tel4Err) && empty($cargoErr) && empty($emailErr)) {
	
				$qryUpdate = "UPDATE clientes SET nome=?, tel1=?, tel2=?, tel3=?, tel4=?, cargo=?, email=? WHERE id_cli=?";
	
				if($stmt = mysqli_prepare($conn, $qryUpdate)){
					mysqli_stmt_bind_param($stmt, "sssssssi", $param_nome, $param_tel1, $param_tel2, $param_tel3, $param_tel4, $param_cargo, $param_email, $param_id);
	
					$param_nome = $nome;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_tel3 = $tel3;
					$param_tel4 = $tel4;
					$param_cargo = $cargo;
					$param_email = $email;
					$param_id = $id;
	
					if(mysqli_stmt_execute($stmt)){
						header("location: adm_cliente.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}
	
			}
	
		} else {
	
			if(isset($_GET["id"])){
				
				$id =  trim($_GET["id"]);
				$tipo = trim($_GET["tipo"]);
	
				$qrySelect = "SELECT * FROM clientes WHERE id_cli = ?";
				if($stmt = mysqli_prepare($conn, $qrySelect)){
					
					mysqli_stmt_bind_param($stmt, "i", $param_id);
	
					$param_id = $id;
	
					if(mysqli_stmt_execute($stmt)){
						$result = mysqli_stmt_get_result($stmt);
	
						if(mysqli_num_rows($result) == 1){
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
							$nome = $row["nome"];
							$tel1 = $row["tel1"];
							$tel2 = $row["tel2"];
							$tel3 = $row["tel3"];
							$tel4 = $row["tel4"];
							$cargo = $row["cargo"];
							$email = $row["email"];
	
						} else{
							header("location: error.php");
							exit();
						}
	
					} else{
						echo "Oops! Something went wrong. Please try again later.";
					}
				}
	
				mysqli_stmt_close($stmt);
	
				mysqli_close($conn);
			} else {
				header("location: error.php");
				exit();
			}
		}

	} else {
		
		if (isset($_POST["id"]) && !empty($_POST["id"])) {

			$id = $_POST["id"];
	
			$nomeInput = trim($_POST["nome"]);
			if (empty($nomeInput)) {
				$nomeErr = "Por favor, insira um nome.";
			} else if (!filter_var($nomeInput, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'-.\s ]+$/")))) {
				$nomeErr = 'Por favor, insira um nome válido.';
			} else {
				$nome = $nomeInput;
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
			
			// Validação Telefone 3
			$tel3Input = trim($_POST["tel3"]);
			$tel3Input = str_replace(" ", "", $tel3Input);
			if(!empty($tel3Input) && !ctype_digit($tel3Input)){
				$tel3Err = "Utilize apenas caracteres numericos.";
			} else if (empty($tel3Input)) {
				$tel3 = NULL;
			} else {
				$tel3 = $tel2Input;
			}
	
			// Validação Telefone 4
			$tel4Input = trim($_POST["tel4"]);
			$tel4Input = str_replace(" ", "", $tel4Input);
			if(!empty($tel4Input) && !ctype_digit($tel4Input)){
				$tel4Err = "Utilize apenas caracteres numericos.";
			} else if (empty($tel4Input)) {
				$tel4 = NULL;
			} else {
				$tel4 = $tel2Input;
			}
	
			//Validação Cargo
			$cargoInput = $_POST["cargo"];
			if ($cargoInput === "0") {
				$cargoErr = "Selecione um cargo.";
			} else {
				$cargo = $cargoInput;
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
	
			if (empty($nomeErr) && empty($tel1Err) && empty($tel2Err) &&empty($tel3Err) &&empty($tel4Err) && empty($cargoErr) && empty($emailErr)) {
	
				$qryUpdate = "UPDATE fornecs SET nome=?, tel1=?, tel2=?, tel3=?, tel4=?, cargo=?, email=?, endereco=? WHERE id_fornec=?";
	
				if($stmt = mysqli_prepare($conn, $qryUpdate)){
					mysqli_stmt_bind_param($stmt, "ssssssssi", $param_nome, $param_tel1, $param_tel2, $param_tel3, $param_tel4, $param_cargo, $param_email, $param_endereco, $param_id);
	
					$param_nome = $nome;
					$param_tel1 = $tel1;
					$param_tel2 = $tel2;
					$param_tel3 = $tel3;
					$param_tel4 = $tel4;
					$param_cargo = $cargo;
					$param_email = $email;
					$param_endereco = $endereco;
					$param_id = $id;
	
					if(mysqli_stmt_execute($stmt)){
						header("location: adm_fornec.php");
						exit();
					} else {
						echo "Something went wrong. Please try again later.";
					}
				}
	
			}
	
		} else {
	
			if(isset($_GET["id"])){
				
				$id =  trim($_GET["id"]);
				$tipo = trim($_GET["tipo"]);
	
				$qrySelect = "SELECT * FROM fornecs WHERE id_fornec = ?";
				if($stmt = mysqli_prepare($conn, $qrySelect)){
					
					mysqli_stmt_bind_param($stmt, "i", $param_id);
	
					$param_id = $id;
	
					if(mysqli_stmt_execute($stmt)){
						$result = mysqli_stmt_get_result($stmt);
	
						if(mysqli_num_rows($result) == 1){
							$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	
							$nome = $row["nome"];
							$tel1 = $row["tel1"];
							$tel2 = $row["tel2"];
							$tel3 = $row["tel3"];
							$tel4 = $row["tel4"];
							$cargo = $row["cargo"];
							$email = $row["email"];
							$endereco = $row["endereco"];
	
						} else{
							header("location: error.php");
							exit();
						}
	
					} else{
						echo "Oops! Something went wrong. Please try again later.";
					}
				}
	
				mysqli_stmt_close($stmt);
	
				mysqli_close($conn);
			} else {
				header("location: error.php");
				exit();
			}
		}
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
   $title = "Editar";
   require 'php/header.php';
?>

<div class="row my-4">
	<div class="col col-md-8 offset-md-2">
		<h3>Editar</h3>
	</div>
</div>

<div class="row">
	<div class="col col-md-8 offset-md-2">
		<form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post" class="mb-4">

			<div class="form-group">
				<label for="inputTipo" class="font-weight-bold">Tipo de Cadastro</label>
				<select name="tipo" id="tipoCadastro" class="form-control" disabled>
					<option value="colaborador" <?php echo $tipo == 'func' ? 'selected':'' ?>>Colaborador</option>
					<option value="cliente" <?php echo $tipo == 'cli' ? 'selected':'' ?>>Cliente</option>
					<option value="fornecedor" <?php echo $tipo == 'fornec' ? 'selected':'' ?>>Fornecedor</option>
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
				<input class="form-control <?php echo validClass($cargo, $cargoErr) ?>" id="inputCargo" type="text" name="cargo" value="<?php echo $cargo ?>">

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
            <input type="hidden" name="id" value="<?php echo $id ?>">
				<a href="adm_func.php" class="btn btn-light btnVoltar">Cancelar</a>
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

		var tipoInput = $("#tipoCadastro").val();

		if (tipoInput == "colaborador") {
			$("#groupCargo, #groupEndereco").hide();
		} else if (tipoInput == "cliente") {
			$("#groupRamal, #groupSetor, #groupEndereco").hide();
			$(".btnVoltar").attr("href", "adm_cliente.php");
		} else {
			$("#groupRamal, #groupSetor").hide();
			$(".btnVoltar").attr("href", "adm_fornec.php");
		}
		
	</script>
	
</body>
</html>