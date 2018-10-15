<?php

//    function phone_format($phone) {
//       $pattern = '/(\d{2})(\d{5})(\d*)/';
//       $result = preg_replace($pattern, '($1) $2-$3', $phone);
//       return $result;
//    }

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
			if (strlen($phone) < 11) {
				return "#";
			} else {
				$link = "https://api.whatsapp.com/send?phone=55".$phone;
				return $link;
			}
      }
   }
   
   require_once '../config.php';

   if ($_POST['key'] == "onLoadRead") {

      $table = $_POST['table'];
      $qrySelect = "";

      switch ($table) {
         case "func":
            // code ..
            $qrySelect = "SELECT * FROM funcs WHERE stats = 1 ORDER BY nome";
            $result = $conn->query($qrySelect);

            if ($result->num_rows > 0) {

               $row = "";
               
               while($data = $result->fetch_array()) {
                  $row .= '
                     <tr>
                        <td data-title="Nome">'.$data['nome'].'</td>
								<td data-title="E-mail">
									<a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
								</td>
                        <td data-title="Ramal">'.$data['ramal'].'</td>
                        <td data-title="Tel. 1">
                           <a href="https://api.whatsapp.com/send?phone=55'.$data['tel1'].'" target="_blank">' . phone_format($data['tel1']) . '</a>
                        </td>
                        <td data-title="Depto.">' . $data['setor'] . '</td>
                        <td>            
                           <div class="d-flex justify-content-around">
                              <a href="#" class="viewButton" data-id="'. $data['id_func'] .'" data-type="func">Visualizar <i class="far fa-eye"></i></a>
                           </div>
                        </td>
                     </tr>
                  ';
               }
      
               echo $row;
      
            } else {
               $row .= '<td colspan="6">Nenhum cadastro encontrado!</td>';
               echo $row;
            }
            break;

         case "cliente":
            // code ..
            $qrySelect = "SELECT * FROM clientes WHERE stats = 1 ORDER BY nome";
            $result = $conn->query($qrySelect);

            if ($result->num_rows > 0) {

               $data = "";
               
               while($row = $result->fetch_array()) {
                  $data .= '
                     <tr>
                        <td data-title="Nome">'.$row['nome'].'</td>
                        <td data-title="E-mail">
                           <a href="mailto:'. $row['email'] .'">'.$row['email'].'</a>
                        </td>
                        <td data-title="Tel. 1">
                           <a href="'. emptyLink($row['tel1']) .'" target="_blank">' . isEmpty($row['tel1']) . '</a>
                        </td>
                        <td data-title="Tel. 2">
                           <a href="'. emptyLink($row['tel2']) .'" target="_blank">' . isEmpty($row['tel2']) . '</a>
                        </td>
                        <td data-title="Cargo">' . $row['cargo'] . '</td>
                        <td>            
                           <div class="d-flex justify-content-around">
                              <a href="#" class="viewButton" data-id="'. $row['id_cli'] .'" data-type="cliente">Visualizar <i class="far fa-eye"></i></a>
                           </div>
                        </td>
                     </tr>
                  ';
                  // $data = $row;
               }
      
               echo $data;
      
            } else {
               $row .= '<td colspan="6">Nenhum cadastro encontrado!</td>';
               echo $row;
            }
            break;
         case "fornec":
            // code ..
            $qrySelect = "SELECT * FROM fornecs WHERE stats = 1 ORDER BY nome";
            $result = $conn->query($qrySelect);

            if ($result->num_rows > 0) {

               $row = "";
               
               while($data = $result->fetch_array()) {
                  $row .= '
                     <tr>
                        <td data-title="Nome">'.$data['nome'].'</td>
                        <td data-title="Ramal">'.$data['ramal'].'</td>
                        <td data-title="Tel. 1">
                           <a href="https://api.whatsapp.com/send?phone=55'.$data['tel1'].'" target="_blank">' . phone_format($data['tel1']) . '</a>
                        </td>
                        <td data-title="E-mail">
                           <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
                        </td>
                        <td data-title="Depto.">' . $data['setor'] . '</td>
                        <td>            
                           <div class="d-flex justify-content-around">
                              <a href="#" class="viewButton" data-id="'. $data['id_fornec'] .'" data-type="fornec">Visualizar <i class="far fa-eye"></i></a>
                           </div>
                        </td>
                     </tr>
                  ';
               }
      
               echo $row;
      
            } else {
               $row .= '<td colspan="6">Nenhum cadastro encontrado!</td>';
               echo $row;
            }
            break;
      }
   
      // $qrySelect = "SELECT * FROM funcs WHERE stats = 1 ORDER BY nome";
      // $result = $conn->query($qrySelect);

      // if ($result->num_rows > 0) {

      //    $row = "";
         
      //    while($data = $result->fetch_array()) {
      //       $row .= '
      //          <tr>
      //             <td data-title="Nome">'.$data['nome'].'</td>
      //             <td data-title="Ramal">'.$data['ramal'].'</td>
      //             <td data-title="Telefone 1">'. $data['tel1'] .'</td>
      //             <td data-title="E-mail">
      //                <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
      //             </td>
      //             <td data-title="Depto.">' . $data['setor'] . '</td>
      //             <td>            
      //                <div class="d-flex justify-content-around">
      //                   <a href="#" class="viewButton" data-id="'. $data['id_func'] .'" data-type="func">Visualizar <i class="far fa-eye"></i></a>
      //                </div>
      //             </td>
      //          </tr>
      //       ';
      //    }

      //    echo $row;

      // } else {
      //    $row .= '<td colspan="6">Nenhum cadastro encontrado!</td>';
      //    echo $row;
      // }

   } else {

   }
	
?>