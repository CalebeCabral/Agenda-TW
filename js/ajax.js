// Load Data
function loadData() {
   $.ajax({
      type: "POST",
      url: "php/read.php",
      data: {
         key: "onLoadRead",
         table: "func"
      },
      success: function(data) {
         $("#cadastros tbody").html(data);
         glossaryFilter();
      }
   });
}

// Adicionar (Side Modal)
$("#sideAddForm").submit(function(event) {
   event.preventDefault();

   var inputNome = $("#inputAddNome");
   var inputEmail = $("#inputAddEmail");
   var inputRamal = $("#inputAddRamal");
   var inputTel1 = $("#inputAddTel1");
   var inputTel2 = $("#inputAddTel2");
   var inputSetor = $("#inputAddSetor");

   $.ajax({
      type: "POST",
      url: "php/dataTeste.php",
      data: {
         nome: inputNome.val(),
         email: inputEmail.val(),
         ramal: inputRamal.val(),
         tel1: inputTel1.val(),
         tel2: inputTel2.val(),
         setor: inputSetor.val(),
      },
      dataType: "JSON",
      beforeSend: function() {
         $("#submitAddForm").text("Salvando...").addClass("opacity");
      },
      success: function(data) {
         console.log(data);
         $("#submitAddForm").text("Salvar").removeClass("opacity");
         $("#sideAddForm").find(".is-invalid").removeClass("is-invalid");

         if (data.status) {
            $("#addSideModal").removeClass("active");
            $(".overlay").removeClass("active");
            $("#sideAddForm input").val("");
            
            createAlert(".alert-add");
            loadData();
         } else {
            var erros = data.erro;

            $.each(erros, function(i,val){
               // console.log(i);
               $("#sideAddForm").find("input#" + i).addClass("is-invalid");
               $("#sideAddForm").find("input#" + i).siblings(".feedback").addClass("invalid-feedback").text(val);
            });
         }
      },
      error: function(error) {
         console.log(error);
      }
   });
});


// View Modal Colaboradores
$("body").on("click", ".viewButton", function(e) {
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