<?php
	

require_once(__ROOT__.'/library/php.inc/facebook/facebook.php');
require_once(__ROOT__.'/library/config.php');
require_once(__ROOT__.'/library/php.inc/db/repository.php');


$facebook = new Facebook(array('appId'  => $fb_api_key,'secret' => $fb_app_secret));;

// check if user is already authenticated
if(!isset($_SESSION['IS_AUTHENTICATED']) && $facebook->getUser() > 0){
	// set authentication
	$_SESSION['IS_AUTHENTICATED'] = true;

	// check if this is the first login of the user
	$user = $repository->findUserByFBId($facebook->getUser());
	if(!$user){
		// get user information from facebook
		$user_profile = $facebook->api('/me');
	
		// save user to database
		$dbUser = array('name'=>$user_profile['name'], 'id'=>$facebook->getUser());
		$repository->persistUser($dbUser);
	}
}

// check if the current session to facebook was lost somehow
if(isset($_SESSION['IS_AUTHENTICATED']) && $facebook->getUser() == 0){
	unset($_SESSION['IS_AUTHENTICATED']);
}

?>