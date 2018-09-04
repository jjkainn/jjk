<?php
	include_once("func_wifi_param.php");
	include 'language.php';
	header("Content-type: text/html; charset=utf-8");
	error_reporting(1);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
	
	if($_GET['action'] == "WifiConnect"){
		WifiConnect();
	}
	function WifiConnect(){
		$SSID = $_POST['wifiSSID'];
		$Pwd = $_POST['wifiPWD'];
		$Encrypt = $_POST['wifiencypt'];
		if($Encrypt == "NULL"){
			$Pwd = "NULL";
		}
		
		if($Encrypt !== "NULL" && $Pwd == ''){
			echo "<script>
				var info = 'The password can not be empty';
					if(lang == 'CH'){
						info = '密码不能为空';
					}
				alert(info);
				window.location.href='common.php';
			</script>";
		}
		
		$ret = cmdWifiConnect($SSID,$Pwd,$Encrypt);

		if($ret['ret'] < 0){
			echo "<script>
					var info = 'Connection failed';
					if(lang == 'CH')
					{
						info = '连接失败';
					}
					alert(info);
				</script>";
		}else{
			echo "<script>
					var info = 'Success';
					if(lang == 'CH')
					{
						info = '连接成功';
					}
					alert(info);
				</script>";
		}
		echo "<script>window.location.href='common.php'</script>";
	}
?>