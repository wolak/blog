$( document ).ready(function() {
	/* 
		In a real application, Comment would be in a separate file, and included with something like Requirejs in comment_controller 
	*/
	var Comment = function(postId, commentId, content, canUpdate, canDelete){
        var $textarea = $("<textarea rows='5' cols='50'></textarea>");
        var $dom = $("<div class='comment'></div>");
        var updateButton, deleteButton;
        //Accepts a jQuery element to attach the comment to
        this.render = function($ele){
            $textarea.append(content);
           	this.disableInput();
            $dom.append($textarea);
            $dom.append(this.getButtons());
            $ele.append($dom);
        };
        this.disableInput = function() {
            $textarea.attr('readonly', true);
        };
        this.enableInput = function() {
            $textarea.attr('readonly', false);
        };
        this.getContent = function() {
            return $textarea.val();
        };
        this.getButtons = function() {
        	var $container = $("<div class='commentButtonContainer'></div>");
        	if (canUpdate) {
        		updateButton = $("<button class='btn'>Update</button>");
        		updateButton.click($.proxy(function(){
        			this.enableUpdate("Complete Update");
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
        this.enableUpdate = function(label) {
        	updateButton.unbind("click");
        	updateButton.html(label);
        	updateButton.click($.proxy(function(){
    			this.completeUpdate();
    		}, this));
        	this.enableInput();
        };
        this.completeUpdate = function(){
        	console.log("SEND THIS TO SERVER", $textarea.val());
        	updateButton.unbind("click");
        	updateButton.html("Update");
        	this.disableInput();
        	updateButton.click($.proxy(function(){
    			this.enableUpdate("Complete Update");
    		}, this));
        };
        this.delete = function() {
        	console.log("deleting. Send to server to delete. on sucess, remove comment.");
        };
        
    };


    /*  
    	Anything below this is a "comment_controller". 
    	Again in a live application this would be modular and would use RequireJS and have Comment above as a dependency
    */

	$(".viewPost").click(function() {
		//Find the commentContainer and make it a jQuery element
		var $commentContainer = $($(this).siblings(".commentContainer")[0]);
		//Remove the View Comment button
		$(this).remove();
		var commentTracker = [], $placeholder, current, comment, $newComment;
		var comments = [
			{
				postId: 1,
				commentId: 2,
				content: "hey There",
				canUpdate: false,
				canDelete: true,
			},
			{
				postId: 1,
				commentId: 2,
				content: "hi friend",
				canUpdate: true,
				canDelete: true,
			}
		];
		for(var i=0; i<comments.length; i++){
			current = comments[i];
			$placeholder = $("<div class='commentPlaceholder'></div>");
			$commentContainer.append($placeholder);
			comment = new Comment(current.postId, current.commentId, current.content, current.canUpdate, current.canDelete);
			comment.render($placeholder);
			commentTracker.push(comment);
		}
		$newComment = $("<button class='btn'>New Comment</button>");
		$newComment.click(function(){
			var comment = new Comment(null, null, "", true, true);
			var $placeholder = $("<div class='commentPlaceholder'></div>");
			$(this).before($placeholder);
			comment.render($placeholder);
			comment.enableUpdate("Save Comment");
			commentTracker.push(comment);
		})
		$commentContainer.append($newComment);
	});

});