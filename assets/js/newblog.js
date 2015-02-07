$( document ).ready(function() {
	$("#postSubmit").click(function(){
		$.ajax({
		 	type: 'POST',
			url: '/blog/new_post',
			data: {
				title: $("#blogtitle").val(),
				content: $("#blogcontent").val()
			}
		}).done(function(response) {
				window.location.href = "/blog/posts";
		});
		//Prevent refresh on page after form submit
		return false;
	});
});
