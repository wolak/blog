$( document ).ready(function() {
	/* 
		In a real application, Comment would be in a separate file, and included with something like Requirejs in comment_controller 
	*/
	var Comment = function(postId, commentId, content, canUpdate, canDelete){
        var $textarea = $("<textarea rows='5' cols='50'></textarea>");
        var $dom = $("<div class='comment'></div>");
        var updateButton, deleteButton;
        //Accepts a jQuery element to attach the comment to. Create the dom then attaches.
        this.render = function($ele){
            $textarea.append(content);
           	this.disableInput();
            $dom.append($textarea);
            $dom.append(this.getButtons());
            $ele.append($dom);
        };
        //makes the textarea not editable
        this.disableInput = function() {
            $textarea.attr('readonly', true);
        };
        //enables editing on the text area
        this.enableInput = function() {
            $textarea.attr('readonly', false);
        };
        // returns the content of the comment
        this.getContent = function() {
            return $textarea.val();
        };
        this.getButtons = function() {
        	var $container = $("<div class='commentButtonContainer'></div>");
        	if (canUpdate) {
        		updateButton = $("<button class='btn'>Update</button>");
        		updateButton.click($.proxy(function() {
        			this.enableUpdate("Save Update");
        		}, this));
        		$container.append(updateButton);
        	}
        	if (canDelete) {
        		deleteButton = $("<button class='btn'>Delete</button>");
        		deleteButton.click($.proxy(this.delete, this));
        		$container.append(deleteButton);
        	}
        	return $container;
        };
        // Enable updates to be sent to the server
        this.enableUpdate = function(label) {
        	updateButton.unbind("click");
        	updateButton.html(label);
        	updateButton.click($.proxy(function() {
    			this.completeUpdate();
    		}, this));
        	this.enableInput();
        };
        // Send the update to the server with the new content
        this.completeUpdate = function() {
        	updateButton.unbind("click");
        	var saveComments = $.ajax({
			 	type: 'POST',
				url: '/blog/save_comment',
				data: {
					post_id : postId,
					comment_id: commentId,
					comment: $textarea.val()
				}
			});
        	$.when(saveComments).done($.proxy(function(){
	        	updateButton.html("Update");
	        	this.disableInput();
	        	updateButton.click($.proxy(function() {
	    			this.enableUpdate("Save Update");
	    		}, this));
        	}, this));
        };
        // Sends the comment to be deleted to the server and then removes the element from the dom
        this.delete = function() {
        	console.log("deleting. Send to server to delete. on sucess, remove comment.");
        	var deleting  = $.ajax({
			 	type: 'POST',
				url: '/blog/delete_comment',
				data: {
					comment_id : commentId,
				}
			});
			$.when(deleting).done(function(){
				$textarea.parent().remove();
			});
        };
        
    };


    /*  
    	Anything below this is a "comment_controller". 
    	Again in a live application this would be modular and would use RequireJS and have Comment above as a dependency
    */

	$(".viewComments").click(function() {
		//Find the commentContainer and make it a jQuery element
		var $commentContainer = $($(this).siblings(".commentContainer")[0]);
		var postId = $(this).data('post-id');
		//Remove the View Comment button
		$(this).remove();
		var commentTracker = [], $placeholder, current, comment, $newComment;
		//Makes a request to the server for the comments for this post
		var getComments = $.ajax({
		 	type: 'POST',
			url: '/blog/get_comments',
			dataType: 'json',
			data: {
				post_id : postId,
			}
		});
		$.when(getComments).done(function(comments){
			for(var i=0; i<comments.length; i++){
				current = comments[i];
				$placeholder = $("<div class='commentPlaceholder'></div>");
				$commentContainer.append($placeholder);
				comment = new Comment(current.postId, current.commentId, current.content, current.canUpdate, current.canDelete);
				comment.render($placeholder);
				commentTracker.push(comment);
			}
			$newComment = $("<button class='btn newCommentBtn'>New Comment</button>");
			$newComment.click(function() {
				var comment = new Comment(postId, null, "", true, true);
				var $placeholder = $("<div class='commentPlaceholder'></div>");
				$(this).before($placeholder);
				comment.render($placeholder);
				comment.enableUpdate("Save Comment");
				commentTracker.push(comment);
			})
			$commentContainer.append($newComment);
		});
	});

});