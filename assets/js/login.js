$( document ).ready(function() {
	$("#loginSubmit").click(function(){
		$.ajax({
		 	type: 'POST',
			url: '/auth/login',
			data: {
				username: $("#username").val()
			}
		}).done(function(response) {
			if (response == "error"){
				$("#username").css("color", "red");
			} else {
				window.location.href = response;
			}
		});
		//Prevent refresh on page after form submit
		return false;
	});
});
