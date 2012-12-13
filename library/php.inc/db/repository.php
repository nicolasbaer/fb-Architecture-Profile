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
		$this->db->s('SET CHARACTER SET utf8');
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
	public function findBuildingById($id){
		return $this->db->line("select * from Building building where building.id = ". $id);
	}
	
	public function findAllBuildingsByUser($fbId, $keyword = null){
		$whereClause = "";
		
		if(isset($keyword) && $keyword != "" && !empty($keyword)){
			$whereClause = ' and (building.name like "%'.$keyword.'%" or user.name like "%'.$keyword.'%") '; 
		}

		return $this->db->q("select building.name as building_name, user.name as user_name, user.id as user_id, building.id as building_id, user.*, building.* from Building building left join User user on user.id = building.fk_user where building.fk_user = '".$fbId."' ". $whereClause);
	}
	
	public function findAllBuildingsVisibleToUser($facebook, $keyword = null){
		$networkIds = $this->getUserNetworkIds($facebook);
		
		// build where statement
		$where = "";
		$first = true;
		foreach($networkIds as $id){
			if(!$first){
				$where .= ' OR ';
			} else{
				$first = false;
			}
			$where .= " building.fk_user = '".$id."' ";
		}
		
		$whereKeyword = "";
		if(isset($keyword) && $keyword != "" && !empty($keyword)){
			$whereKeyword = " AND (building.name like '%".$keyword."%' OR user.name like '%".$keyword."%') ";
		}
		
		return $this->db->q("select building.name as building_name, user.name as user_name, user.id as user_id, building.id as building_id, building.*, user.* from Building building join User user on building.fk_user = user.id where (".$where." OR building.visibility = 2) ".$whereKeyword." order by building.name, user.name;");		
	}
	
	public function selectBuilding($id = null){
		$whereClause = "";
		
		if(isset($id)){
			$whereClause = ' where id = '.$id; 
		}
		return $this->db->q("select * from Building". $whereClause);
	}
	
	
	//----- comments ----//
	public function saveComment($comment){
		return $this->db->insert("Comment", $comment);
	}
	
	
	//------ rating ----//
	public function findRating($buildingId, $userId){
		return $this->db->line("select * from Rating rating where rating.fk_building = ". $buildingId ." and rating.fk_user = ".$userId);
	}
	
	public function findRatingsByUser($userId){
		return $this->db->q("select rating.* from Rating rating join Building building on rating.fk_building = building.id where building.fk_user = ".$userId);
	}
	
	public function findRatingsByBuilding($buildingId){
		return $this->db->q("select * from Rating rating where rating.fk_building = ". $buildingId);
	}
	
	public function updateRating($rating){
		return $this->db->s("update Rating rating set rating.points = ".$rating['points'] ." where rating.fk_user = ".$rating['fk_user'] ." and rating.fk_building = ". $rating['fk_building']);
	}
	
	public function saveRating($rating){
		return $this->db->insert("Rating", $rating);
	}
	
	
	/**
	  * Returns an array of building details.
	  *
	  */
	public function findBuildingDetails($id){
		$details = array();
		
		$details['building'] = $this->db->q("select building.name as building_name, user.name as user_name, user.id as user_id, building.id as building_id, building.*, user.* from Building building join User user on building.fk_user = user.id where building.id = ".$id);
		$details['comments'] = $this->db->q("select comment.*, user.name as user_name, user.id as user_id from Comment comment join User user on comment.fk_user = user.id where fk_building = ".$id." order by id desc");
		$details['ratings'] = $this->db->q("select rating.* from Rating rating where fk_building = ". $id);
		$details['media'] = $this->db->q("select media.* from Media media where fk_building = ". $id);
		
		return $details;
		
	}
	
	
	
	//----- helper functions ------//
	private function getUserNetworkIds($facebook){
		if(!isset($_SESSION['USER_NETWORK'])){
			// init array for all relatives
			$networkIds = array();

			// add friends to network
			$friends = $facebook->api('/me/friends?fields=id');
			if($friends){
				foreach($friends['data'] as $friend){
					$networkIds[] = $friend['id'];
				}
			}
			
			$_SESSION['USER_NETWORK'] = $networkIds;
		}
		
		
		return $_SESSION['USER_NETWORK'];
	}

	
}


// create new repository
$repository = new Repository($mysql_config, $facebook);

?>