
// View Modal Colaboradores
$(".viewButton").on("click", function(e) {
   e.preventDefault();
   var id = $(this).data("id");
   var tipo = $(this).data("type");
   var $viewBody = $("#viewModal").find(".modal-body");

   $.ajax({
      type: "POST",
      url: "../php/modal/read.php",
      data: {
         id: id,
         type: tipo
      },
      beforeSend:function() {
         $viewBody.html("<img src='../assets/img/load_01.gif' width='64' class='m-5'>");
      },
      success:function(data){
         $viewBody.html(data);
         $("#viewModal").modal("show");
         // console.log("Sucesso!");
      },
      error:function() {
         // console.log("Erro!");
         $viewBody.html("<span class='my-4'>Dados não encontrados.</span>");
      }
   });				
});