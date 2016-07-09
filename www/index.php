<?php

// Define your username and password
$username = "name";
$password = "password";

if ($_POST['txtUsername'] != $username || $_POST['txtPassword'] != $password) {

?>

<style type="text/css">
.bigbutton {
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf) );
	background:-moz-linear-gradient( center top, #ededed 5%, #dfdfdf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf');
	background-color:#ededed;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #dcdcdc;
	display:inline-block;
	color:#777777;
	font-family:arial;
	font-size:55px;
	font-weight:bold;
	font-style:normal;
	height:200px;
	line-height:200px;
	width:400px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #ffffff;
}
.bigbutton:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed) );
	background:-moz-linear-gradient( center top, #dfdfdf 5%, #ededed 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed');
	background-color:#dfdfdf;
}.bigbutton:active {
	position:relative;
	top:1px;
}

input, select, textarea {
font-size: 200%;
}

</style>

<font size="6">
<h1>Login</h1>

<form name="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <p><label for="txtUsername">Username:</label>

    <br /><input type="text" title="Enter your Username" name="txtUsername" /></p>

    <p><label for="txtpassword">Password:</label>

    <br /><input type="password" title="Enter your password" name="txtPassword" /></p>

    <p><input type="submit" name="Submit" class="bigbutton" value="Login" /></p>

</form>
</font>

<?php

}

else {

?>

<p>

<?php
$which_door = $_GET['door'];
//echo 'which door? ' .  $which_door;

if (isset($_POST['RightOPEN']))
{
exec("sudo python /home/pi/garagedoorright.py");
}
if (isset($_POST['LeftOPEN']))
{
exec("sudo python /home/pi/garagedoorleft.py");
}

unset($_POST);
//echo "<hr />";
//echo "<strong>Right = ".isset($_POST['RightOPEN'])."</strong><br /><strong>Left = ".isset($_POST['LeftOPEN'])."</strong>";
?>

<!doctype html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <title></title>
  
  <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
</head>

<body>

<table align="center" cellpadding="25"><tr><td>
	<form method="post" action="javascript:callLeft()">
		<input type="submit" class="classname" value="OPEN LEFT" />
	</form>
</td><td>
	<form method="post" action="javascript:callRight()">
		<input type="submit" class="classname" value="OPEN RIGHT" />
	</form>
</td></tr></table>

<div id="garageHolder" class=""></div>

<script type="text/javascript">

var theDoor = "<?= $which_door; ?>";
$('#garageHolder').attr('class', '');
switch(theDoor)
{
	case 'left' :
		$('#garageHolder').addClass('open left')
	break;
	
	case 'right' :
		$('#garageHolder').addClass('open right')
	break;
}
 
function callLeft()
{
	$.ajax({
		url: 'left.php',
		success: loadDataSuccess,
		error : loadError
	});
}

function callRight()
{
	$.ajax({
		url: 'right.php',
		success: loadDataSuccess,
		error : loadError
	});
	
}

function loadError(jqXHR, textStatus, errorThrown)
{
	loadDataError(errorThrown);
}

function loadDataError(error)
{
	console.log('Load Error : ' + error);
}

function loadDataSuccess(data)
{
	// Confirm the door was closed
	//alert(data);
	
	// Refresh the page (clears headers)
	//location.reload();
	location.href = '?door='+data;
}
</script>
</body>
</html>


</p>

<?php

}

?>
