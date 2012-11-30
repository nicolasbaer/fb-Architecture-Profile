
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
		
		
		
	</head>

	<body onload='init()'>
	
		<!-- create google earth container -->
		<div id="map3d" style="height: 500px; width: 500px;"></div>
	
		<!-- include control panel -->
		<?php require_once('./library/php.inc/control.inc.php');?>
	
	</body>
</html>