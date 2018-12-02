$(function(){

	$("#search").on("click", function(e){

		
		e.preventDefault();


		var start = $('#start').val(),
			end = $("#end").val();


			


		$.post("search.php", {

			start_date: start,
			end_date: end


		}, function(data){


			$("#result").html(data);
		});
	})
});