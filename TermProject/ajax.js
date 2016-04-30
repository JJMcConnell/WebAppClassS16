 	
$('#selection input').on('change', function() {

	var chosen = $('input[name=lizard]:checked', '#selection').val();



	$.ajax({
		url: "liz.php",
		data: chosen,
		type: "GET",
		dataType: "json",

		success: function(json) {
			var $imgEl = $("img");
			if ($imgEl.length === 0) {
				
				$imgEl = $(document.createElement("img") );
				
				$imgEl.insertAfter('h1');
			}

			$imgEl.attr("src", json[chosen - 1].path);
			$imgEl.attr("height", 500);
			$imgEl.attr("width", 500);
		
		},
		
		cache: false,
	
		failure: function ( xhr, status ) {
			alert( "AJAX request failed"); 
		},

		complete: function (xhr, status) {
    			//alert("AJAX request completed");
		},
		

	} );   // end of $ajax(...) 

 	//This line should reset the files chosen so that the onchange listener still fires if the same files are selected twice in a row
	document.getElementById( "fileInputForm" ).reset(); 

} ); 
