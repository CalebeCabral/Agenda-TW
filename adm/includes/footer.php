	
	<a href="#" class="btn btn-info back-top"><i class="fas fa-angle-double-up"></i></a>

	<!-- <script src="js/bootstrap.bundle.min.js"></script>
	<script src="js/jquery.js"></script> -->

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script src="js/script.js"></script>
	<script src="js/table-functions.js"></script>
	<script src="js/ajax.js"></script>

	<script>

		glossaryFilter();
		tableSorting();
		searchBox();

		$(document).ready(function() {
			
			$("[data-toggle='tooltip']").tooltip();

			$(window).scroll(function() {
				if ($(this).scrollTop() > 600) {
					$(".back-top").fadeIn(400);
				} else {
					$(".back-top").fadeOut(400);
				}
			})

			$(".back-top").on("click", function() {
				var offset = $("#pageTitle").offset();

				$("html, body").animate({ scrollTop: offset.top - 20 }, 500);
				return false;
			})

		});

	</script>
	
</body>
</html>