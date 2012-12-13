// JavaScript Document

$(document).ready(function() {

						// Model / Architect Search
						$("#search").keyup(function() {
						
							getModel(1);
						
							searchkey = $(this).val();
							
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
						
						
						});
						
								
});


/*
 * Fetches all details of a building by an ajax request.
 */
function getBuildingDetails(id){
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
		var obj = jQuery.parseJSON(content);
		
		buildBuildingDetails(obj);
		
	});
}



function getModel(id) {
	
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
								
								
		return obj;					
		
							  
		});
						
						
		
	
}
