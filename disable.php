<?php

   require_once 'config.php';

   if ($_GET["tipo"] == "func") {
      if (isset($_POST["id"]) && !empty($_POST["id"])) {

         $id = $_POST["id"];

         $status = $_POST["status"];

         if ($status != "0") {

            $qryUpdate = "UPDATE funcs SET stats=0 WHERE id_func=?";

            if($stmt = mysqli_prepare($conn, $qryUpdate)){

               mysqli_stmt_bind_param($stmt, "i", $param_id);

               $param_id = $id;

               if(mysqli_stmt_execute($stmt)){
                  header("location: adm_func.php");
                  exit();
               } else {
                  echo "Something went wrong. Please try again later.";
               }

            }

         } else {
            echo "Cadastro já está destivado";
         }

      } else {
         if(isset($_GET["id"])){
            $id =  trim($_GET["id"]);
            $tipo = trim($_GET["tipo"]);

            $qrySelect = "SELECT * FROM funcs WHERE id_func = ?";
            if($stmt = mysqli_prepare($conn, $qrySelect)){
               mysqli_stmt_bind_param($stmt, "i", $param_id);

               $param_id = $id;

               if(mysqli_stmt_execute($stmt)){
                  $result = mysqli_stmt_get_result($stmt);

                  if(mysqli_num_rows($result) == 1){
                     $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

							$status = $row["stats"];
							$nome = $row["nome"];
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

   } else if ($_GET["tipo"] == "cli") {

      if (isset($_POST["id"]) && !empty($_POST["id"])) {

         $id = $_POST["id"];
   
         $status = $_POST["status"];
   
         if ($status != "0") {
   
            $qryUpdate = "UPDATE clientes SET stats=0 WHERE id_cli=?";
   
            if($stmt = mysqli_prepare($conn, $qryUpdate)){
   
               mysqli_stmt_bind_param($stmt, "i", $param_id);
   
               $param_id = $id;
   
               if(mysqli_stmt_execute($stmt)){
                  header("location: adm_cliente.php");
                  exit();
               } else {
                  echo "Something went wrong. Please try again later.";
               }
   
            }
   
         } else {
            echo "Cadastro já está destivado";
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
   
                     $status = $row["stats"];
   
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
   
         $status = $_POST["status"];
   
         if ($status != "0") {
   
            $qryUpdate = "UPDATE fornecs SET stats=0 WHERE id_fornec=?";
   
            if($stmt = mysqli_prepare($conn, $qryUpdate)){
   
               mysqli_stmt_bind_param($stmt, "i", $param_id);
   
               $param_id = $id;
   
               if(mysqli_stmt_execute($stmt)){
                  header("location: adm_fornec.php");
                  exit();
               } else {
                  echo "Something went wrong. Please try again later.";
               }
   
            }
   
         } else {
            echo "Cadastro já está destivado";
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
   
							$status = $row["stats"];
   
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
?>

<?php
   $title = "Desativar";
   require 'php/header.php'
?>

<div class="row my-4">
	<div class="col col-md-8 offset-md-2">
		<h3>Desativar</h3>
	</div>
</div>

<div class="row">
   <div class="col col-md-8 offset-md-2">
      <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
         <div class="alert alert-danger">
            <input hidden type="text" name="id" value="<?php echo trim($_GET['id']); ?>" />
            <input hidden type="text" name="status" value="<?php echo $status ?>" />
            <input hidden type="text" name="tipo" id="tipoCadastro" value="<?php echo $tipo ?>" />
            <h5>Você tem certeza que deseja desativar este cadastro?</h5>

            <h6 class="mb-4"><?php echo $nome ?> - <?php echo $email ?></h6>

            <div class="form-row d-flex justify-content-around justify-content-md-start">
               <a href="adm_func.php" class="btn btn-light w-25 btnVoltar">Não</a>
               <input type="submit" class="btn btn-danger w-25 ml-3" value="Sim">
            </div>
            
         </div>
      </form>
   </div>
</div>

	<!-- <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script src="js/table-functions.js"></script>
	<script src="js/ajax.js"></script>

	<script>

      var tipoInput = $("#tipoCadastro").val();
      
      if (tipoInput == "cli") {
         $(".btnVoltar").attr("href", "adm_cliente.php");
      } else if (tipoInput == "fornec") {
         $(".btnVoltar").attr("href", "adm_fornec.php");
      }

	</script>
	
</body>
</html>