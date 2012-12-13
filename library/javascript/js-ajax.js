// JavaScript Document

var currentBuildingId;


$(document).ready(function() {

						var timer;
						var isPanelActive=false;
						// Model / Architect Search
						$("#search").keyup(function() {
							
								if(isPanelActive==false) {
									
									$(".collapse").removeClass('collapse');
									changeToggleButtonIcon('toggle_button_icon_control');
									
									isPanelActive = true;
									
								
								}
								
								clearTimeout(timer);
								timer = setTimeout(function(){
									performSearch();	  
								}, 200);
						  
	  
							//clearTimeout(timer);
							//timer = setTimeout(alert("sdjflksjdf"), 1000);
							
						
						});
						
								
});

function performSearch() {
	
	searchkey = $("#search").val();
							
							var json = '{"keyword":"'+searchkey+'"}';
							
						   $.ajax({
						   type: "POST",
						   url: "/ajax.php",
						   data: "&method=searchControlPanel&params="+json,
							error: function(){
									
										alert("An error occurred...!");
										return false;
									
									},
							
							timeout: function(){
									
										alert("Error: Server timeout");
										return false;
									
									}
								
						
							}).done(function( content ) {
								//content is encoded as JSON object
								//alert(content);
								
								var obj = jQuery.parseJSON(content);
								
								
								
							  $("#mymodels_list").html(obj['mybuildings']);
							  $("#allmodels_list").html(obj['otherbuildings']);
							  
							});
}	


/*
 * Fetches all details of a building by an ajax request.
 */
function getBuildingDetails(id){
	currentBuildingId = id;
	var json = '{"id":"'+id+'"}';
	$.ajax({type: "POST", url: "/ajax.php", data: "&method=getBuildingDetails&params="+json,
		error: function(){
			alert("An error occurred...!");
			return false;			
		},
		timeout: function(){			
			alert("Error: Server timeout");
			return false;		
		}
	}).done(function( content ) {	
		//content is encoded as JSON object
		//alert(content);
		var obj = jQuery.parseJSON(content);
		
		buildBuildingDetails(obj);
		
	});
}


function saveComment(){
	var comment_text = $('#comment-textarea').val();
	$('#comment-textarea').val("");
	var json = '{"comment":"'+comment_text+'", "buildingId": "'+currentBuildingId+'"}';
	$.ajax({type: "POST", url: "/ajax.php", data: "&method=saveComment&params="+json,
		error: function(){
			alert("An error occurred...!");
			return false;			
		},
		timeout: function(){			
			alert("Error: Server timeout");
			return false;		
		}
	}).done(function( content ) {	
		//content is encoded as JSON object
		var obj = jQuery.parseJSON(content);
		obj.user_id = obj.fk_user;
		showComment(obj, false);
		$('#comments-list .comment:first').effect("highlight", {color: '#EDF0FA'}, 3000);
	});
}

function saveRating(rating){
	var json = '{"rating":"'+rating+'", "buildingId": "'+currentBuildingId+'"}';
	$.ajax({type: "POST", url: "/ajax.php", data: "&method=saveRating&params="+json,
		error: function(){
			alert("An error occurred...!");
			return false;			
		},
		timeout: function(){			
			alert("Error: Server timeout");
			return false;		
		}
	}).done(function( content ) {	
		//content is encoded as JSON object
		//alert(content);
		var obj = jQuery.parseJSON(content);
		updateRating(obj);
	});
}

function loadModelFromURL(id) {
	
	/* Function required an id of a model. It fetches the entire 
	database entry for the specified model via ajax and returns 
	a JSON-encoded array */ 
	
							
	var json = '{"id":"'+id+'"}';
							
	$.ajax({
		type: "POST",
		url: "/ajax.php",
		data: "&method=getModel&params="+json,
		error: function(){
									
			alert("An error occurred...!");
			return false;
									
		},
		timeout: function(){
									
			alert("Error: Server timeout");
			return false;
									
		}
	}).done(function( content ) {
								
		//content is encoded as JSON object	
		
		var obj = jQuery.parseJSON(content);
		
		setKmlAndPlacemark(obj[0].kml_ref, obj[0].y_coordinate, obj[0].x_coordinate, "");
								
							  
		});
						
						
		
	
}
