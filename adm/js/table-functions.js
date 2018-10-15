
function glossaryFilter() {
	var alfabeto = "abcdefghijklmnopqrstuvwxyz";
	var tmp = "";
	for (var i = 0; i < 26; i++) {
		var letra = alfabeto[i].toUpperCase();
		var z = 0;
		for (var x = 0; x < $("#cadastros tbody tr").length; x++) {
			var nome = $("#cadastros tbody tr td:first-child").eq(x).text();
			var reg = RegExp("^"+ letra +".*$", "i").test(nome.toUpperCase());

			if(reg) {
				z++;
			}
		}

		if (z > 0) {
			tmp += "<a class='glossary-letter' href='#'>"+ letra +"</a>";
		}else {
			tmp += "<span class='glossary-letter__disabled'>"+ letra +"</span>";
		}
	}

	$(".glossary").find(".letters").append(tmp);

	var $rows = $("#cadastros tbody tr");

	$(".glossary").find("#glossary-all").on("click", function(e) {
		e.preventDefault();
		$rows.show();
	});

	$(".glossary .glossary-letter").on("click", function(e) {
		e.preventDefault();
		var alpha = $(this).text();

		$rows.hide().filter(function() {
			var $td = $("td:first-child", $(this));
			return RegExp("^" + alpha + ".*$", "i").test($td.text().toLowerCase());
		}).show();
	});
}

// function searchBox() {

// 	$("#searchBox").on("keyup", function() {
// 		var value = $(this).val().toUpperCase();
// 		var $noResult = $("<tr class='bg-secondary'><td colspan='6'>Nenhum Resultado Encontrado</td></tr>");

// 		$("#cadastros tbody tr").each(function() {
// 			$row = $(this);

// 			var tdOne = $row.find("td:first-child").text().toUpperCase();
// 			var tdFive = $row.find("td:nth-child(5)").text().toUpperCase();

// 			if (tdOne.indexOf(value) === -1) {
// 				$(this).hide();
// 			} else {
// 				$(this).show();
// 			}

// 		});
// 	});
// }

function searchBox() {

	$("#searchCli").on("keyup", function() {
		var value = $(this).val().toUpperCase();

		$("#cadastros tbody tr").filter(function() {
			$(this).toggle($(this).text().toUpperCase().indexOf(value) > -1);
		})
		
	})
	
} 

function tableSorting() {
	var $table = $("#cadastros");
	var $tableBody = $table.find("tbody");
	var rows, sortedRows, sortAscending, firstName, secondName;

	function nameSortRows(a, b) {

		firstName = $(a).find("td:first-child").text();
		secondName = $(b).find("td:first-child").text();

		if ( firstName < secondName ) {

			return (sortAscending) ? -1 : 1 ;

		} else if ( firstName > secondName ) {

			return (sortAscending) ? 1 : -1 ;

		} else {

			return 0;

		}
	}

	function deptoSortRows(a, b) {

		firstName = $(a).find("td:nth-child(5)").text();
		secondName = $(b).find("td:nth-child(5)").text();

		if ( firstName < secondName ) {

			return (sortAscending) ? -1 : 1 ;

		} else if ( firstName > secondName ) {

			return (sortAscending) ? 1 : -1 ;

		} else {

			return 0;

		}
	}

	function sortOrder() {

		$("#typeSort").on("change", function() {

			var $selectValue = $("#typeSort").val();

			rows = $tableBody.find("tr");

			if ( $selectValue === "nameAsc" ) {
				sortAscending = true;
				sortedRows = rows.sort(nameSortRows);
			} else if ( $selectValue === "nameDesc" ) {
				sortAscending = false;
				sortedRows = rows.sort(nameSortRows);
			} else if ( $selectValue === "deptoAsc") {
				sortAscending = true;
				sortedRows = rows.sort(deptoSortRows);
			} else {
				sortAscending = false
				sortedRows = rows.sort(deptoSortRows);
			}

			$tableBody.empty();
			$tableBody.append(sortedRows);

		});
	}
	sortOrder();
}