// JavaScript Document

$(document).ready(function() {

						// Model / Architect Search
						$("#search").keyup(function() {
						
						
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
							
								
								var obj = jQuery.parseJSON(content);
								
								
								
							  $("#mymodels_list").html(obj['mybuildings']);
							  $("#allmodels_list").html(obj['otherbuildings']);
							  
							});
						
						
						});
						
								
});