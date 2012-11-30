<?php

// include config file
require_once('./library/config.php');

// include mysql library and repositories
require_once('./library/php.inc/db/repository.php');

// include facebook security check
require_once('./library/php.inc/fb-security.php');


if(isset($_POST['ajax'])) { 
	header('Content-type: text/html; charset=ISO-8859-1', true); 
	
	
	$search = $_POST['search'];

									mysql_select_db($database_db1, $db1);
									$query_itemlist = sprintf("SELECT * FROM Building LEFT JOIN User ON Building.fk_user = User.id WHERE name='%s' OR title='%s' ORDER BY date_upload DESC", $search, $search);
									$itemlist = mysql_query($query_itemlist, $db1) or die(mysql_error());
									$row_itemlist = mysql_fetch_assoc($itemlist);
									$totalRows_itemlist = mysql_num_rows($itemlist);

									if($totalRows_itemlist!=0) { do {

										insertModelListItem($row_itemlist['title'], $row_itemlist['name'], "");

									} while($row_itemlist = mysql_fetch_assoc($itemlist)); } else { echo "No results found..."; } 				

}
							
							?>
                    