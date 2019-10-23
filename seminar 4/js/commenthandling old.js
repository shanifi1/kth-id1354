
$(document).ready(function() {
var recipestr = window.location.pathname.substring(1);

 
	$.get("/login_status",null, function(loggedInUser){
		if(loggedInUser == "none"){
			$.post("/get_comments",{recipe: recipestr}, function(comments){
				$("#commentsection").append(comments);
				
			});
		}
		else{
			$.post("/get_comments",{recipe: recipestr}, function(comments){
				$("#comments").empty();
				$("#comments").append(comments);
				$("#commentsection").append("<div id=\"postcommentsection\"><p>Comment:</p><form action=\"/post_comment\" method=\"post\" id=\"postcomment\"><input type=\"text\" name=\"commentText\" value=\"Write your review!\"><br><input type=\"hidden\" name=\"recipe\" value=\""+ recipestr + "\"><input type=\"submit\" value=\"send!\"></form></div>");
				
				$("#postcomment").submit(function(event){
				event.preventDefault(); //prevent default action 
				var post_url = $(this).attr("action"); //get form action url
				var form_data = $(this).serialize(); //Encode form elements for submission
		
					$.post( post_url, form_data, function(asd) {
						$.post("/get_comments",{recipe: recipestr}, function(comments){
							$("#comments").empty();
							$("#comments").append(comments);
						});	
					});
				});
				
				$("form[action=\"/delete_comment\"]").submit(function(event){
				event.preventDefault(); //prevent default action 
				var post_url = $(this).attr("action"); //get form action url
				var form_data = $(this).serialize(); //Encode form elements for submission
		
					$.post( post_url, form_data, function(asd) {
						$.post("/get_comments",{recipe: recipestr}, function(comments){
							$("#comments").empty();
							$("#comments").append(comments);
						});	
					});
				});
				
				
			});

			$("#logoutButton").click(function(){
				$.get("/logout",null,function(response){
					$("#postcommentsection").remove();
					$("#loginField").html("<a id=\"loginButton\" href=\"/login\"><strong>Login</strong></a>");
				
				});
			});	
		}
		
		
		
		
				$("form[action=\"/delete_comment\"]").submit(function(event){
				event.preventDefault(); //prevent default action 
				var post_url = $(this).attr("action"); //get form action url
				var form_data = $(this).serialize(); //Encode form elements for submission
		
					$.post( post_url, form_data, function(asd) {
						$.post("/get_comments",{recipe: recipestr}, function(comments){
							$("#comments").empty();
							$("#comments").append(comments);
						});	
					});
				});
		
		
		
		
		
	});
	
	
	
});
