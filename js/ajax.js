
// View Modal Colaboradores
$(".viewButton").on("click", function(e) {
   e.preventDefault();
   var id = $(this).data("id");
   var tipo = $(this).data("type");
   var $viewBody = $("#viewModal").find(".modal-body");

   $.ajax({
      type: "POST",
      url: "php/modal/read.php",
      data: {
         id: id,
         table: tipo,
         key: "modalRead"
      },
      beforeSend:function() {
         $viewBody.html("<img src='assets/img/load_01.gif' width='64' class='m-5'>");
      },
      success:function(data){
         $viewBody.html(data);
         $("#viewModal").modal("show");
         console.log("Sucesso!");						
      },
      error:function() {
         console.log("Erro!");
         $viewBody.html("<span class='my-4'>Dados não encontrados.</span>");
      }
   });				
});

// // Update
// $(".updateButton").on("click", function(e) {
//    e.preventDefault();
//    var id = $(this).data("id");
//    var tipo = $(this).data("type");

//    $.ajax({
//       type: "POST",
//       url: "../update_func.php",
//       data: {id: id, type: tipo},
//       success:function(data){
//          console.log("Sucesso!");						
//       },
//       error:function() {
//          console.log("Erro!");
//          $viewBody.html("<span class='my-4'>Dados não encontrados.</span>");
//       }
//    });				
// });

// Add Modal
$("#addButton").on("click", function(e) {
   e.preventDefault();

   var nome = $("#inputNome").val();
   var ramal = $("#inputRamal").val();
   var tel1 = $("#inputTel1").val();
   var tel2 = $("#inputTel2").val();
   var setor = $("#inputSetor").val();
   var email = $("#inputEmail").val();

   $.ajax({
      type: "POST",
      url: "php/modal/add.php",
      data: { nome:nome, ramal:ramal, tel1:tel1, tel2:tel2, setor:setor, email:email },
      dataType: "json",
      beforeSend:function() {

      },
      success:function(data) {         
         // console.log("Success: " + data[i].msg);

         $("#addModal .form-control").removeClass("is-invalid").addClass("is-valid");

         if($("#inputTel2").val() == "")
         {
            $("#inputTel2").removeClass("is-valid");
         }

         $.each(data,function(i,val){
            // Nome Erro
            if (data[i].erro == "nomeErr") {
               // console.log(data[i].msg);
               $("#inputNome").addClass("is-invalid");
               $("#inputNome").next().remove();
               $("<div class='invalid-feedback'>" + data[i].msg + "</div>").insertAfter("#inputNome");
            
            // Ramal Erro
            } else if (data[i].erro == "ramalErr") {
               // console.log(data[i].msg);
               $("#inputRamal").addClass("is-invalid");
               $("#inputRamal").next().remove();
               $("<div class='invalid-feedback'>"+ data[i].msg +"</div>").insertAfter("#inputRamal");
            
            // Telefone 1 Erro
            } else if (data[i].erro == "tel1Err") {
               // console.log(data[i].msg);
               $("#inputTel1").addClass("is-invalid");
               $("#inputTel1").next().remove();
               $("<div class='invalid-feedback'>"+ data[i].msg +"</div>").insertAfter("#inputTel1");
            
            // Telefone 2 Erro
            } else if (data[i].erro == "tel2Err") {
               // console.log(data[i].msg);
               $("#inputTel2").addClass("is-invalid");
               $("#inputTel2").next().remove();
               $("<div class='invalid-feedback'>"+ data[i].msg +"</div>").insertAfter("#inputTel2");
            
            // Setor Erro
            } else if (data[i].erro == "setorErr") {
               // console.log(data[i].msg
               $("#inputSetor").addClass("is-invalid");
               $("#inputSetor").next().remove();
               $("<div class='invalid-feedback'>"+ data[i].msg +"</div>").insertAfter("#inputSetor");
            
            // E-mail Erro
            } else if (data[i].erro == "emailErr") {
               // console.log(data[i].msg);
               $("#inputEmail").addClass("is-invalid");
               $("#inputEmail").next().remove();
               $("<div class='invalid-feedback'>"+ data[i].msg +"</div>").insertAfter("#inputEmail");
            } else {
               console.log("Foi");
               
            }

         });
         
      },
      error:function(e) {
         console.log(e);         
      }
   });
   
});