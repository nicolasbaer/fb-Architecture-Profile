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
	
	
	

function insertModelListItem($title, $architect, $userId, $kml, $latitude, $longitude) {

    global $facebook;
        $fbUser=$facebook->getUser();
		
		$manageButton="";
		if ($fbUser==$userId) {
			
			$manageButton='<a class="btn" onClick="#"><i class="icon-wrench icon-black"></i></a>"';
		}
		$userData = $facebook->api($userId);
		
		$return='<div class="row-fluid" id="module_item_">
                  <div class="span2">

                           <a href='.$userData['link'].' class="thumbnail thumb_li" target="_top">
                                 <img src="http://graph.facebook.com/'.$userId.'/picture" /> 
                           </a>
                   
                  </div>
                  <div class="span6">'.$title.'<br />
                  <a href='.$userData['link'].' target="_top">
                  '.$architect.'
                  </a>
                  </div>
                  <div class="span4">
                     <div class="btn-group pull-right">'
                           	.$manageButton.
                            '<a class="btn" onClick="setKmlAndPlacemark(\''.$kml.'\', '.$latitude.', '.$longitude.', \'#\')"><i class="icon-eye-open icon-black"></i></a>
                     </div> <!-- /btn group-->
                  </div>
             </div>
             <!-- separator between list entries sterts -->
             
             <ul class="nav nav-list">
                 <li class="divider"></li>
             </ul>
             <!-- separator between list entries ends-->';
	
				
		return $return;
	
}



function searchControlPanel($keyword = null){
	
	global $repository;
	global $facebook;

	$myBuildings = $repository->findAllBuildingsByUser($facebook->getUser(), $keyword);
	$otherBuildings = $repository->findAllBuildingsVisibleToUser($facebook, $keyword);
	
	$outputMyBuildings = "";
	 
	foreach($myBuildings as $building){
		$outputMyBuildings .= insertModelListItem($building['building_name'], $building['user_name'], $building['user_id'], $building['kml_ref'], $building['x_coordinate'], $building['y_coordinate']);
	}
	
	
	$outputOtherBuildings = "";
	
	foreach($otherBuildings as $building){
		$outputOtherBuildings .= insertModelListItem($building['building_name'], $building['user_name'], $building['user_id'], $building['kml_ref'], $building['x_coordinate'], $building['y_coordinate']);
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
