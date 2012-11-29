// JavaScript Document

$(document).ready(function() {

						// Model / Architect Search
						$("#search").keyup(function() {
						
						   $.ajax({
						   type: "POST",
						   url: "library/php.inc/updateList.inc.php",
						   data: "&ajax=true&search=" + $(this).val(),
							error: function(){
									
										alert("An error occurred...!");
										return false;
									
									},
							
							timeout: function(){
									
										alert("Error: Server timeout");
										return false;
									
									}
								
						
							}).done(function( content ) {
							  $("#allmodels_list").html(content);
							});
						
						
						});
						
								
});