$( document ).ready(function() {
	// Attach even handler for deleting a post
	$(".deletePost").click(function(){
		$.ajax({
		 	type: 'POST',
			url: '/blog/delete_post',
			data: {
				post_id : $(this).data('post-id'),
			}
		}).done(function(response) {
				window.location.href = "/blog/posts";
		});
		//Prevent refresh on page after form submit
		return false;
	});
});
