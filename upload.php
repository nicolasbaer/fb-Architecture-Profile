

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
<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
<tr>

<form action="upload_ac.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
<td>

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
</tr>
<tr>
<td><strong>Upload Model</strong></td>
</tr>

<tr>
<td>Model name:</td> <td><input type="text" name="name"><br></td>
</tr>

<tr>
<td>Visibility:</td> <td>
<select name="visibility">
  <option value="1">private</option>}
  <option value="2">public</option>
  <option value="3">friends</option>
</select>

</td>
</tr>

<tr>
<td>Description:</td> <td><textarea name="description"></textarea><br></td>
</tr>


<tr>
<td>Select ZIP-file</td>

<td><input name="ufile" type="file" id="ufile" size="5" /></td>
</tr>

<tr>
<td></td>
<td align="center"><input type="submit" name="Submit" value="Upload" /></td>
</tr>

</table>
</td>
</form>

</tr>
</table> 
</body>
</html>
