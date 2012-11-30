<?php


// include config file
require_once('./library/config.php');

// include mysql library and repositories
require_once('./library/php.inc/db/repository.php');

// include facebook security check
require_once('./library/php.inc/fb-security.php');


$isXmlHttpRequest = array_key_exists('X_REQUESTED_WITH', $_SERVER) &&
$_SERVER['X_REQUESTED_WITH'] == 'XMLHttpRequest';


if ($isXmlHttpRequest) {
	
	$method = $_POST['method'];
	$params = $_POST['params'];
	
	call_user_func_array($method , $params );
}
else {
    echo "nothing to do here";
}
							



function searchControlPanel($keyword = null){
	
	$myBuildings = $repository->findAllBuildingsByUser($facebook->getUser(), $keyword);
	$otherBuildings = $repository->findAllBuildingsVisibleToUser($facebook, $keyword);
	
	$outputMyBuildings = "";
	
	foreach(){
		
	}
	
	
	
	
	$outputOtherBuildings = "";
	
	
	
	
}



function insertModelListItem($title, $architect, $userId) {
	
	echo '<div class="row-fluid" id="module_item_">
                    <div class="span2">
    						<div class="thumbnail thumb_li">
                                             http://graph.facebook.com/'.$userId.'/picture
                                                </div>
                       </div>
                    <div class="span6">'.$title.'<br />
'.$architect.'</div>
            <div class="span4">
                       <div class="btn-group">
                          <a class="btn" href="#"><i class="icon-eye-open icon-black"></i></a>
                          <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">Fly to Model</a></li>
                            <li><a href="#">Unload Model</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Manage Model</a></li>
                          </ul>
                        </div> <!-- /btn group-->
                    </div>
                </div>';
	
}


?>
