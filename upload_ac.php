<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- twitter bootstrap -->
		<link rel="stylesheet" type="text/css" media="all" href="library/bootstrap/css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" media="all" href="library/bootstrap/css/bootstrap-responsive.min.css" />
		<script type="text/javascript" src="library/bootstrap/js/bootstrap.min.js"></script>
		<!-- ScenoGraph style -->
		<link rel="stylesheet" type="text/css" media="all" href="library/css/styles.css" />

</head>	

</html>

<?php
//set where you want to store files
//in this example we keep file in folder upload
//$HTTP_POST_FILES['ufile']['name']; = upload file name
//for example upload file name cartoon.gif . $path will be upload/cartoon.gif

$path= "models/".$HTTP_POST_FILES['ufile']['name'];
if($ufile !=none)
{
if(copy($HTTP_POST_FILES['ufile']['tmp_name'], $path))
{
echo "Successful<BR/>";

//$HTTP_POST_FILES['ufile']['name'] = file name
//$HTTP_POST_FILES['ufile']['size'] = file size
//$HTTP_POST_FILES['ufile']['type'] = type of file

echo "File Name :".$HTTP_POST_FILES['ufile']['name']."<BR/>";
//echo "File Size :".$HTTP_POST_FILES['ufile']['size']."<BR/>";
//echo "File Type :".$HTTP_POST_FILES['ufile']['type']."<BR/>";
//echo "<img src=\"$path\" width=\"150\" height=\"150\">";
}
else
{
echo "Error";
}
}
$x = 1;
		$filename = "models/".$x."/doc.kml";
//echo "The directory $x exists";
//echo $filename;

while (file_exists($filename)) {
	
	     //echo "The directory $dirname exists";
      $x = $x + 1; 
		$filename = "models/".$x."/doc.kml";

} 

     $zip = new ZipArchive;
     $res = $zip->open($path);
     if ($res === TRUE) {
         $zip->extractTo('models/'.$x);
         $zip->close();
       //  echo'ok! ';
         echo ' ZIP File is extracted to: '.'http://www.archipublic.com/models/'.$x.'<BR/>';
     } else {
         echo 'failed';
     }

$contents = file_get_contents("models/".$x."/doc.kml");


$x_co = substr($contents, strpos($contents, "<latitude>") + 10, 10);
$y_co = substr($contents, strpos($contents, "<longitude>") + 11, 10);

$name =  $_POST["name"];
$description = $_POST["description"];
$visibility = $_POST["visibility"];

//$x_co = substr($contents, strpos($contents, "<latitude>") + 10, strpos($contents, "</latitude>") - strpos($contents, "<latitude>") - 10);
//$y_co = substr($contents, strpos($contents, "<longitude>") + 11, strpos($contents, "</longitude>") - strpos($contents, "<longitude>") - 11);

echo ' x: '.$x_co.' y: '.$y_co; 
$conn = mysql_connect("127.0.0.1:3306", "root", "db") or die(mysql_error());
mysql_select_db("scenograph", $conn) or die(mysql_error());



mysql_query(sprintf("INSERT INTO `Building`(id, fk_user, name, description, visibility, date_upload, kml_ref, x_coordinate, y_coordinate) VALUES  ('%s','575919189','%s', '%s', '%s','0000-00-00 00:00:00','%s', '%s', '%s');", $x, $name, $description, $visibility, 'http://www.archipublic.com/models/'.$x.'/doc.kml', $x_co, $y_co));


echo '<BR/> MySQL db is updated. Last item has id:'.$x;


?>