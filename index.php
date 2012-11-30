<?php	

	define('__ROOT__', dirname(__FILE__)); 
	session_start();
	
	// include config file
	require_once('./library/config.php');
	
	// include mysql library and repositories
	require_once('./library/php.inc/db/repository.php');

	// include facebook security check
	require_once('./library/php.inc/fb-security.php');


?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Sceno Graph</title>
		
		<!-- jquery -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
		
		<!-- twitter bootstrap -->
		<link rel="stylesheet" type="text/css" media="all" href="library/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="library/bootstrap/css/bootstrap-responsive.min.css" />
		<script type="text/javascript" src="library/bootstrap/js/bootstrap.min.js"></script>
		
		<!-- Google Earth standard library -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		
		<!-- ScenoGraph javascripts -->
		<script type="text/javascript" src="library/javascript/js-ajax.js"></script>
		<script type="text/javascript" src="library/javascript/js-earth.js"></script>
		<script type="text/javascript" src="library/javascript/js-scenograph.js"></script>
		
		<!-- ScenoGraph style -->
		<link rel="stylesheet" type="text/css" media="all" href="library/css/styles.css" />
		
		<?php if(!isset($_SESSION['IS_AUTHENTICATED'])): ?>
			<!-- facebook login redirect -->
			<script type="text/javascript">
		  		window.top.location = '<?php echo $fb_oauth_url ?>';
			</script>
		<?php endif; ?>
		
	</head>

	<body onload='init()'>
	
		<!-- create google earth container -->
		<div id="map3d" style="height: 100%; width: 100%;"></div>
	
		<!-- include control panel -->
		<?php require_once('./library/php.inc/control.inc.php');?>
	
	</body>
</html>