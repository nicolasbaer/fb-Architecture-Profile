function changeToggleButtonIcon(icon_id) {
	var icon  = document.getElementById( icon_id );
    if (icon.className == 'icon-chevron-down') {
		icon.className = 'icon-chevron-up'
		$(".collapse").removeClass('collapse');
	}
	else {
		icon.className = 'icon-chevron-down'
	}
}




function viewBuildingDetails(id){	
	clearBuildingDetails();
	getBuildingDetails(id);
}


function clearBuildingDetails(){
	$('#details_well div#details-header').empty();
	$('div#details p#comment-string').empty();
	$('#overall-rating-number').empty();
	$('#overall-rating-value').empty();
	$('#comments-list').empty();
	$('#fb-like-button').empty();
	$('#designer-name').empty();
	$('#designer-image').empty();
}

function loadFbLike($, url){
$(function generateSocMedElements($, url) {
    var id = "socmed",
        $container,
        $fb_root,
        $fb_like;
    if ($("#" + id).length <= 0) {
        $container = $(document.createElement("aside")).
            addClass("socmed").
            attr("id", id);
        $fb_root = $(document.createElement("div")).attr("id", "fb-root");
        $fb_like = $(document.createElement("div")).
            addClass("fb-like").
            attr("data-href", url).
            attr("data-send", "false").
            attr("data-layout", "button_count").
            attr("data-width", 82).attr("data-show-faces", "false");

        $container.
            appendTo($("header").first()).
            append($fb_root).
            append($fb_like);
    }
});
}

function buildBuildingDetails(details){	
	
	// add details title and description
	$('#details-header').append(
		details.building[0].building_name + ' - ' + details.building[0].user_name
    	+ '<a class="accordion-toggle" data-toggle="collapse" data-parent="#details-accordion" href="#details-collapse">'
	    + '   <button class="btn pull-right" id="toggle_button_details" onclick="changeToggleButtonIcon(\'toggle_button_icon_details\')">'
	    + '      <i class="icon-chevron-up" id="toggle_button_icon_details"></i>'
	    + '   </button>'
	    + '</a>'
		);
	$('div#details p#comment-string').append(
			details.building[0].description
			+'<ul class="nav nav-list">'
		       +'	<li class="divider"></li>'
		       +'</ul>'
		);
	
	// add average rating
	updateRating(details.rating_details);
	
	// activate current user rating
	currentUserPoints = details.current_user_rating.points;
	if(currentUserPoints != null){
		$('.user-rating-buttons[value="' + currentUserPoints + '"]').addClass("active");
	}
	
	// add comments
	if(details.comments.length == 0){
		$('#comments-list').append('<p id="comments-list-no-comments">no comments yet</p>');
	} else{
		for(var i = 0; i < details.comments.length; i++) {
			comment = details.comments[i];
			showComment(comment, true);
		}
	}
	
	// add current designer information
	$('#designer-name').append(details.building[0].user_name);
	$('#designer-image').append('<img src="http://graph.facebook.com/'+details.building[0].user_id+'/picture" />');

	// update like button with URL to current model

	var likeURL="http://www.archipublic.com/index.php?building="+details.building[0].building_id;
	loadFbLike($, likeURL);	
	// show details pane, since all content is loaded
	$('#details_well').show();
}



function showComment(comment, append){
	var commentStr = 	'<div class="row-fluid comment">'
       +'   <div class="span3 comment_thumbnail_span">'
       +'        <div class="thumbnail thumb-for-list">'
       +'            <img src="http://graph.facebook.com/'+comment.user_id+'/picture" />'
       +'        </div>'
       +'       </div>'
       +'   <div>'
       +'        <span>'
       +'            ' + comment.user_name
       +'        </span>'
       +'       <span>'
       +'           <time>'
       +'                <small>'
       +'                    ' + comment.postdate
       +'                </small>'
       +'            </time>'
       +'       </span>'
       +'       <p id="comment-string">'
       +'           <small>'
       +'               ' + comment.content
       +'           </small>'
       +'       </p>'
       +'   </div>'
       +'</div>'
	   +'<br/>'
       +'<ul class="nav nav-list">'
       +'	<li class="divider"></li>'
       +'</ul>'
	
	if(append){
		$('#comments-list').append(commentStr);
	} else{
		$('#comments-list').prepend(commentStr);
	}
}

// "overall_building":1,"overall_building_amount":1,"designer":1.5,"designer_amount":2}
function updateRating(rating){
	// update current building rating
	$('#overall-rating-number').empty();
	$('#overall-rating-value').empty();
	if(rating.overall_building_amount == 0){
		$('#overall-rating-number').append('no ratings yet');
		$('#overall-rating-value').append('-');
	} else{
		$('#overall-rating-number').append('Rating of ' + rating.overall_building_amount + ' Users');
		$('#overall-rating-value').append(rating.overall_building);
		$('#overall-rating-value').attr("class",getRatingStyleClass(rating.overall_building));;
	}
	
	// update designer overall rating
	//designer-average-rating-amount
	$('#designer-average-rating-number').empty();
	$('#designer-average-rating-value').empty();
	if(rating.designer_amount == 0){
		$('#designer-average-rating-number').append('no ratings yet');
		$('#designer-average-rating-value').append('-');
	} else{
		$('#designer-average-rating-number').append('Rating of ' + rating.designer_amount + ' Users');
		$('#designer-average-rating-value').append(rating.designer);
		$('#designer-average-rating-value').attr("class",getRatingStyleClass(rating.designer));;
	}
}


function getRatingStyleClass(number){
	number = Math.floor( number );
	if(number == 1){
		return "badge badge-danger pull-right";
	}
	if(number == 2){
		return "badge badge-warning pull-right";
	}
	if(number == 3){
		return "badge badge-primary pull-right";
	}
	if(number == 4){
		return "badge badge-info pull-right";
	}
	if(number == 5){
		return "badge badge-success pull-right";
	}
}


