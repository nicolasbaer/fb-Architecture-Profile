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

function getBuildingDetails($id = null){
	if($id != null){
		
		global $repository;
		global $facebook;
		
		$details = $repository->findBuildingDetails($id);
		
		// calculate rating details
		if($details['ratings']){
			foreach($details['ratings'] as $rating){
				$number = $rating['points'];
				$details['rating_overall'] += $number;
			}
			$details['rating_overall'] /= sizeof($details['ratings']);
		} else{
			$details['rating_overall'] = false;
		}
		
		return $details;
	}
	
	return null;
}


function getModel($id = null){
	
	global $repository;
	global $facebook;

	//building information as assoc array
	$building = $repository->selectBuilding($id);

	return $building;
	
}

function saveComment($comment = null, $buildingId = null){
	if($comment != null && $buildingId != null){
		global $repository;
		global $facebook;
		
		$c = array();
		$c['fk_building'] = $buildingId;
		$c['fk_user'] = $facebook->getUser();
		$c['content'] = $comment;
		$c['postdate'] = date('Y-m-d H:i:s');
		
		$repository->saveComment($c);
		
		// load user
		$userDetails = $repository->findUserByFBId($facebook->getUser());
		$c['user_name'] = $userDetails[0]['name'];
		
		return $c;
	}
	
}

function saveRating($rating = null, $buildingId = null){
	if($rating != null && $buildingId != null){
		global $repository;
		global $facebook;
		
		$r = array();
		$r['fk_building'] = $buildingId;
		$r['fk_user'] = $facebook->getUser();
		$r['points'] = $rating;
		
		// if entry exists, update it, since no user can vote twice for one model
		$existingRating = $repository->findRating($buildingId, $facebook->getUser());
		if($existingRating == null){
			$repository->saveRating($r);
		} else{
			$existingRating['points'] = $r['points'];
			$repository->updateRating($existingRating);
		}
		
		
	}
	
}

?>
