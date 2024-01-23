$(document).ready(function(){  
	// code to get delivery charges  from table via select box
	$("#delivery").change(function() {    
		var id = $(this).find(":selected").val();
		var dataString = 'deliveryid='+ id;    
		$.ajax({
			url: './functions/getcharges.php',
			dataType: "json",
			data: dataString,  
			cache: false,
			success: function(deliveryData) {
			   if(deliveryData) {
                $("#errorMassage").addClass('hidden').text("");
                $("#recordListing").removeClass('hidden');						
				$("#delivery_charges").text(deliveryData.charges);
						 
				} else {
					$("#recordListing").addClass('hidden');	
					$("#errorMassage").removeClass('hidden').text("No record found!");
				}   	
			} 
		});
 	}) 
});