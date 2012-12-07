<?php

define('__ROOT__', dirname(__FILE__)); 

// include config file
require_once('./library/config.php');

// include mysql library and repositories
require_once('./library/php.inc/db/repository.php');

// include facebook security check
require_once('./library/php.inc/fb-security.php');



	$method = $_POST['method'];
	$params = (array)json_decode($_POST['params']);
	
	$output = call_user_func_array($method , $params);
	
	echo json_encode($output);
	
	die();
	
	
	

function insertModelListItem($title, $architect, $userId) {
	
	$return = '<div class="row-fluid" id="module_item_">
                    <div class="span2">
    						<div class="thumbnail thumb_li">
                                             <img src="http://graph.facebook.com/'.$userId.'/picture" />
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
				
		return $return;
	
}



function searchControlPanel($keyword = null){
	
	global $repository;
	global $facebook;

	$myBuildings = $repository->findAllBuildingsByUser($facebook->getUser(), $keyword);
	$otherBuildings = $repository->findAllBuildingsVisibleToUser($facebook, $keyword);
	
	$outputMyBuildings = "";
	 
	foreach($myBuildings as $building){
		$outputMyBuildings .= insertModelListItem($building['building_name'], $building['user_name'], $building['user_id']);
	}
	
	
	$outputOtherBuildings = "";
	
	foreach($otherBuildings as $building){
		$outputOtherBuildings .= insertModelListItem($building['building_name'], $building['user_name'], $building['user_id']);
	}

		
	return array('otherbuildings' => $outputOtherBuildings, 'mybuildings' => $outputMyBuildings);
	

}

function getModel($id = null){
	
	global $repository;
	global $facebook;

	//building information as assoc array
	$building = $repository->selectBuilding($id);

	return $building;
	
}





?>
