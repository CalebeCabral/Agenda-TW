<?php
   require_once '../../config.php';

   $nome = $ramal = $tel1 = $tel2 = $setor = $email = "";
   $nomeErr = $ramalErr = $tel1Err = $tel2Err = $setorErr = $emailErr = "";
   $erroMsg = array();

   // if ($_SERVER['POST_REQUEST'] == 'POST') {
   if (!empty($_POST)) {

      // Validar Nome
      $nomeInput = trim($_POST["nome"]);
		if (empty($nomeInput)) {
         $nomeErr = "Por favor, insira um nome.";
         array_push($erroMsg, array('erro' => 'nomeErr', 'msg' => $nomeErr));
		} else if (!filter_var($nomeInput, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-ZãÃáÁàÀâÂêÊéÉèÈíÍìÌôÔõÕóÓòÒúÚùÙûÛçÇºª'\-.\s ]+$/")))) {
         $nomeErr = 'Por favor, insira um nome válido.';
         array_push($erroMsg, array('erro' => 'nomeErr', 'msg' => $nomeErr));
		} else {
         $nome = $nomeInput;
      }
      
      // Validar Ramal
      $ramalInput = trim($_POST["ramal"]);
		if(empty($ramalInput)){
         $ramalErr = 'Por favor, insira um ramal.';
         array_push($erroMsg, array('erro' => 'ramalErr', 'msg' => $ramalErr));
		} else if (!ctype_digit($ramalInput)) {
         $ramalErr = "Por favor, insira um ramal válido";
         array_push($erroMsg, array('erro' => 'ramalErr', 'msg' => $ramalErr));         
		} else {
			$ramal = $ramalInput;
      }
      
      // Validar Telefone 1
      $tel1Input = trim($_POST["tel1"]);
		$tel1Input = str_replace(" ", "", $tel1Input);
		if(empty($tel1Input)){
			$tel1Err = 'Por favor, insira um telefone.';
         array_push($erroMsg, array('erro' => 'tel1Err', 'msg' => $tel1Err));
		} else if (!ctype_digit($tel1Input)) {
         $tel1Err = "Utilize apenas caracteres numericos.";
         array_push($erroMsg, array('erro' => 'tel1Err', 'msg' => $tel1Err));
		} else {
			$tel1 = $tel1Input;
      }
      
      // Validar Telefone 2
      $tel2Input = trim($_POST["tel2"]);
		$tel2Input = str_replace(" ", "", $tel2Input);
		if(!empty($tel2Input) && !ctype_digit($tel2Input)){
         $tel2Err = "Utilize apenas caracteres numericos.";
         array_push($erroMsg, array('erro' => 'tel2Err', 'msg' => $tel2Err));
		} else if (empty($tel2Input)) {
			$tel2 = NULL;
		} else {
			$tel2 = $tel2Input;
      }

      // Validar Setor
      $setorInput = $_POST["setor"];
		if ($setorInput === "0") {
         $setorErr = "Selecione uma opção.";
         array_push($erroMsg, array('erro' => 'setorErr', 'msg' => $setorErr));
		} else {
			$setor = $setorInput;
      }
      
      // Validar E-mail
      $emailInput = $_POST["email"];
		if (empty($emailInput)) {
         $emailErr = "Por favor, insira um e-mail.";
         array_push($erroMsg, array('erro' => 'emailErr', 'msg' => $emailErr));
		} else if (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
         $emailErr = "Por favor, insira um e-mail válido.";
         array_push($erroMsg, array('erro' => 'emailErr', 'msg' => $emailErr));
		} else {
			$email = $emailInput;
      }
      
      if(empty($erroMsg)){

			$qryInsert = "INSERT INTO funcionarios (nome, ramal, tel1, tel2, setor, email)
								VALUES (?, ?, ?, ?, ?, ?)";
	
         if ($stmt = mysqli_prepare($conn, $qryInsert)) {
         mysqli_stmt_bind_param($stmt, "sissss", $param_nome, $param_ramal, $param_tel1, $param_tel2, $param_setor, $param_email);

            $param_nome = $nome;
            $param_ramal = $ramal;
            $param_tel1 = $tel1;
            $param_tel2 = $tel2;
            $param_setor = $setor;
            $param_email = $email;

            mysqli_stmt_execute($stmt);
         }
	
			mysqli_stmt_close($stmt);
		 } else {
         echo json_encode($erroMsg);
		 }
		 
		 mysqli_close($conn);
   }

?>