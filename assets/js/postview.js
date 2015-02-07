$( document ).ready(function() {
	// Attach event handler for deleting a post
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
	});
	// Attach event handler for updating a post
	$(".updatePost").click(function(){
		//Remove the click to update
		$(this).unbind("click");
		//Find the content for this post
		var content = $(this).siblings(".postContent")[0];
		//Change the content to be an editable textarea
		var textarea = $("<textarea class='newContent' cols='100' rows='10'>"+$(content).html()+"</textarea>");
		$(content).html(textarea);
		//Update the button label
		$(this).html("Update");
		//Attach the event to submit the new content to a server
		$(this).click(function(){
			var ele = $(this).siblings(".postContent");
			//Get the content of the textarea
			var newContent = $(ele.children(".newContent")[0]).val()
			updatePost($(this).data('post-id'), newContent)
		});
	});

	function updatePost(postId, content){
		$.ajax({
		 	type: 'POST',
			url: '/blog/update_post',
			data: {
				post_id : postId,
				content : content
			}
		}).done(function(response) {
			window.location.href = "/blog/posts";
		});
	}
});
