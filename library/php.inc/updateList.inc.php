<?php

if(isset($_POST['ajax'])) { 
	header('Content-type: text/html; charset=ISO-8859-1', true); 
	require_once('../../Connections/db1.php'); 
} else { 
	require_once('Connections/db1.php'); 
}

$search = $_POST['search'];

								mysql_select_db($database_db1, $db1);
								$query_itemlist = sprintf("SELECT * FROM Building LEFT JOIN User ON Building.fk_user = User.id WHERE name='%s' OR title='%s' ORDER BY date_upload DESC", $search, $search);
								$itemlist = mysql_query($query_itemlist, $db1) or die(mysql_error());
								$row_itemlist = mysql_fetch_assoc($itemlist);
								$totalRows_itemlist = mysql_num_rows($itemlist);
								
								if($totalRows_itemlist!=0) { do {
									
									insertModelListItem($row_itemlist['title'], $row_itemlist['name'], "");
									
								} while($row_itemlist = mysql_fetch_assoc($itemlist)); } else { echo "No results found..."; } 				
							
							?>
                    