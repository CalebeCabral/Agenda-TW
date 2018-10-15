<?php

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

   if ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['key'] == "modalRead") {
      
      require_once '../../config.php';

      $row = "";

      if($_POST["table"] == "func") {

         $qryRead = "SELECT * FROM funcs WHERE id_func = '". $_POST["id"] ."'";
         $result = $conn->query($qryRead);


         $row .= '<table class="table table-striped table-bordered">';

         while($data = $result->fetch_array())
         {
            $tel1 = $data['tel1'];
            $tel2 = $data['tel2'];

            $row .= '
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Nome</td>
               <td width="80%%">'. $data['nome'] .'</td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">E-mail</td>
               <td width="80%%">
                  <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Ramal</td>
               <td width="80%%">'. $data['ramal'] .'</td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 1</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel1) .'" target="_blank">' . isEmpty($tel1) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 2</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel2) .'" target="_blank">' . isEmpty($tel2) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Depto.</td>
               <td width="80%%">'. $data['setor'] .'</td>
            </tr>
            ';
         }

         $row .= '</table>';

         echo $row;

      } else if ($_POST["table"] == "cliente") {

         $qryRead = "SELECT * FROM clientes WHERE id_cli = '". $_POST["id"] ."'";
         $result = $conn->query($qryRead);

         $row .= '<table class="table table-striped table-bordered">';

         while($data = $result->fetch_array())
         {
            $tel1 = $data['tel1'];
            $tel2 = $data['tel2'];
            $tel3 = $data['tel3'];
            $tel4 = $data['tel4'];
            
            $row .= '
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Nome</td>
               <td width="80%%">'. $data['nome'] .'</td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">E-mail</td>
               <td width="80%%">
                  <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 1</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel1) .'" target="_blank">' . isEmpty($tel1) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 2</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel2) .'" target="_blank">' . isEmpty($tel2) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 3</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel3) .'" target="_blank">' . isEmpty($tel3) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 4</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel4) .'" target="_blank">' . isEmpty($tel4) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Cargo</td>
               <td width="80%%">'. $data['cargo'] .'</td>
            </tr>
            ';
         }

         $row .= '</table>';
         echo $row;

      } else if ($_POST["table"] == "fornec") {
         
         $qryRead = "SELECT * FROM fornecs WHERE id_fornec = '". $_POST["id"] ."'";
         $result = $conn->query($qryRead);

         $row .= '<table class="table table-striped table-bordered">';

         while($data = $result->fetch_array())
         {
            $tel1 = $data['tel1'];
            $tel2 = $data['tel2'];
            $tel3 = $data['tel3'];
            $tel4 = $data['tel4'];
            
            $row .= '
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Nome</td>
               <td width="80%%">'. $data['nome'] .'</td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">E-mail</td>
               <td width="80%%">
                  <a href="mailto:'. $data['email'] .'">'.$data['email'].'</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 1</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel1) .'" target="_blank">' . isEmpty($tel1) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 2</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel2) .'" target="_blank">' . isEmpty($tel2) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 3</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel3) .'" target="_blank">' . isEmpty($tel3) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Tel. 4</td>
               <td width="80%%">
                  <a href="'. emptyLink($tel4) .'" target="_blank">' . isEmpty($tel4) . '</a>
               </td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Cargo</td>
               <td width="80%%">'. $data['cargo'] .'</td>
            </tr>
            <tr>
               <td width="20%" class="d-none d-md-table-cell">Endereço</td>
               <td width="80%%">'. $data['endereco'] .'</td>
            </tr>
            ';
         }

         $row .= '</table>';
         echo $row;
         
      }
   }
?>