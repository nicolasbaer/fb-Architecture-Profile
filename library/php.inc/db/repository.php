<?php
/**
 *
 *
 *
 *
**/

require_once(__ROOT__.'/library/php.inc/db/edb.class.php');
require_once(__ROOT__.'/library/php.inc/fb-security.php');

class Repository{
	
	private $db;
	
	
	function __construct($mysql_config){
		// connect to database
		$this->db = new edb($mysql_config);
	}

	//----- user queries -----//
	public function findAllUsers(){
		return $this->db->q("select * from User");
	}
	
	public function findUserByFBId($fbId){
		return $this->db->q("select * from User u where u.id = '".$fbId."'");
	}

	public function persistUser($user){
		return $this->db->insert("User", $user);
	}
	
	
	
	//----- building queries -----//
	public function findAllBuildingsVisibleToUser($keyword = null){
		$networkIds = $this->getUserNetworkIds();
		
		// build where statement
		$where = "";
		$first = true;
		foreach($networkIds as $id){
			if(!$first){
				$where .= ' OR ';
			} else{
				$frist = false;
			}
			$where = " building.fk_user = '".$id."' ";
		}
		
		$whereKeyword = "";
		if(isset($keyword)){
			$whereKeyword = " AND (building.name like '%".$keyword."%' OR user.name like '%".$keyword."%') ";
		}
		
		return $this->db->q("select building.*, user.* from Building building join User user on building.fk_user = user.id where (".$where." OR building.visibility = 2) ".$whereKeyword." order by building.name, user.name;");		
	}
	
	
	
	//----- helper functions ------//
	private function getUserNetworkIds(){
		// init array for all relatives
		$networkIds = array();
		
		// add user itself to network
		$networkIds[] = $facebook->getUser();
		
		// add friends to network
		$friends = $facebook->api('/me/friends');
		if($friends){
			foreach($friends['data'] as $friend){
				$networkIds[] = $friend['id'];
			}
		}
		
		return $networkIds;
	}

	
}


// create new repository
$repository = new Repository($mysql_config);

?>