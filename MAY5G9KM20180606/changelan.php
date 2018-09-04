<?php

//中英文切换代码
 session_start();
 $lan = $_GET['language'];

if($lan == "CH")
{
	$_SESSION['LAN'] = "CH";
}
else
{
	$_SESSION['LAN'] = "EN";
}
 
 
 header("Location: index.php");
?>
