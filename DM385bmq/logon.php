<?php
    header('Content-type:text/html;charset=utf-8');

	include "func_user_ctrl.php";
	include "language.php";

	session_start();
	date_default_timezone_set('PRC');
	error_reporting(1);
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");

	$user_name  = clean($_REQUEST['username'], 20);
	$user_pwd   = md5($_REQUEST['password']);

	$ret = check_valid_user($user_name,$user_pwd);
	if( $ret > 0)
	{
		//echo("user logon ok");
		$_SESSION['user']=$user_name;
	
		$i = 0;
		while(1)
		{
			$user =& GetUserByIndex($i);

			if($user == -1)
				break;

			if($user["name"] == $user_name)
			{
				$name = $user["name"];
				$level = $user["level"];
				$_SESSION['level'] = $level;
				break;
			}
			$i++;
		}
		
		header("Location: ./common.php");
	}
	else
	{
		echo "<script>
				if(lang == 'CH'){
					var info = '登陆失败，请检查输入的用户名和密码';
				}else{
					var info = 'Login failed,please check your username and password.';
				}
				alert(info);
				window.location.href='index.php';
			</script>";
	}
	$UserRight = 0;
?>