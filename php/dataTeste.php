<?php 
   require_once '../config.php';

   // if (isset($_POST['id'])) {
   //    $query = "SELECT * FROM funcs WHERE id_func = '". $_POST['id'] ."'";
   //    $result = mysqli_query($conn, $query);
   //    while($row = mysqli_fetch_assoc($result)) {

   //       $nome = $row['nome'];
   //       $ramal = $row['ramal'];
   //       $tel1 = $row['tel1'];
   //       $tel2 = $row['tel2'];
   //       $setor = $row['setor'];
   //       $email = $row['email'];
         
   //       $data['status'] = "ok";
   //       $data['result'] = $row;
   //    }
   //    echo json_encode($data);
	// }
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

      $nome = $email = $ramal = $tel1 = $tel2 = $setor = "";
      $erro = array();
      $data = array();

		// Validação Nome
      $nomeTmp = $_POST['nome'];
      if (empty($nomeTmp)) {
         $erro['inputAddNome'] = "Insira um nome.";
      } else if (!filter_var($nomeTmp, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'-.\s ]+$/")))) {
         $erro['inputAddNome'] = "Nome inválido.";
      } else {
         $nome = $nomeTmp;
      }

		// Validação E-mail
      $emailTmp = $_POST['email'];
      if (empty($emailTmp)) {
         $erro['inputAddEmail'] = "Insira um e-mail.";
      } else if (!filter_var($emailTmp, FILTER_VALIDATE_EMAIL)) {
         $erro['inputAddEmail'] = "E-mail inválido.";
      } else {
         $email = $emailTmp;
      }

		// Validação Ramal
      $ramalTmp = $_POST['ramal'];
		if(empty($ramalTmp)){
         $erro['inputAddRamal'] = "Insira um ramal.";
		} else if (!ctype_digit($ramalTmp)) {
			$erro['inputAddRamal'] = "Ramal inválido.";
		} else {
			$ramal = $ramalTmp;
      }
		
		// Validação Telefone 1
      $tel1Tmp = $_POST["tel1"];
		$tel1Tmp = str_replace(" ", "", $tel1Tmp);
		if(empty($tel1Tmp)){
         $erro['inputAddTel1'] = "Insira um telefone.";
		} else if (!ctype_digit($tel1Tmp)) {
         $erro['inputAddTel1'] = "Utilize apenas caracteres numéricos.";
		} else {
			$tel1 = $tel1Tmp;
      }
		
		// Validação Telefone 2
      $tel2Tmp = $_POST["tel2"];
		$tel2Tmp = str_replace(" ", "", $tel2Tmp);
		if(!empty($tel2Tmp) && !ctype_digit($tel2Tmp)){
         $erro['inputAddTel2'] = "Utilize apenas caracteres numéricos.";
		} else if (empty($tel2Tmp)) {
         $tel2 = NULL;
		} else {
			$tel2 = $tel2Tmp;
      }
		
		// Validação Setor
      $setorTmp = $_POST["setor"];
		if (empty($setorTmp)) {
			$erro['inputAddSetor'] = "Insira um setor.";
		} else {
			$setor = $setorTmp;
		}


		// Verifição Erros
      if (empty($erro)) {

			$qryInsert = 
				"INSERT INTO funcs (nome, ramal, tel1, tel2, setor, email) VALUES (?, ?, ?, ?, ?, ?)";
			
			if ($stmt = $conn->prepare($qryInsert)) {
				$stmt->bind_param('sissss', $param_nome, $param_ramal, $param_tel1, $param_tel2, $param_setor, $param_email);

				$param_nome = $nome;
				$param_ramal = $ramal;
				$param_tel1 = $tel1;
				$param_tel2 = $tel2;
				$param_setor = $setor;
				$param_email = $email;

				if ($stmt->execute()) {
					$data = array('status' => true, 'msg' => "Sucesso!");
					echo json_encode($data);
					exit;
					
				} else {
					exit("Algo deu errado. Tente novamente mais tarde.");
				}
				exit("Algo deu errado. Tente novamente mais tarde.");
			}
			$stmt->close();
         
      } else {
			$data = array('status' => false, 'erro' => $erro);
			echo json_encode($data);
			exit;
      }

		// echo json_encode($data);
		$conn->close();
	}
   
?>