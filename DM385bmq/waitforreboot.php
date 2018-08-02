<?php 
	include 'language.php';
	error_reporting(1);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $Lan_VOD["WAIT_REBOOT"][$Language_Type] ?></title>
</head>
<script type="text/javascript" src="js/util.js"></script>
<script language="JavaScript" type="text/JavaScript">

	var xmlHttp=getXmlHttpRequest();	
	function sendControlData(data)       //ajax不能跨域访问
	{	
		if(xmlHttp)
		{
			var url = "platformcontrol.php?seed=" + Math.random() + "&action=" + data ;		
		
			xmlHttp.open("GET", url, true);//这里的true代表是异步请求
			xmlHttp.onreadystatechange = rendResult;
			xmlHttp.send(null);			
		}	
	}
	
	function JumpToLoginPage()
	{
		var ip = GetArgsFromHref(document.location.href,"ip");
		time = 0;
		if(ip == "")
		{
			window.location = "index.php";
		}
		else
		{
			var href = "http://" + ip + "/index.php";
			window.location = href;
		}
	}
	
	function rendResult()
	{
		if (xmlHttp.readyState == 4) 
		{
			var response = xmlHttp.responseText;
			if(response == "alive")
			{
				JumpToLoginPage();
			}
		}
	}
	
	
	var time = 80;
	function count()
	{
		if(time > 0)
		{
			setTimeout("count()",1000);
			rest.innerHTML=time; 
			time--;
			if(time == 0)
			{
				JumpToLoginPage();
			}		
		}
		
		if(time < 55)
		{
			sendControlData("alive");
		}
	}

</script>


<body onLoad="window.setTimeout('count()',1)">
	<div align="center">
		<div id="Layer2" style="position:relative; left:8px; top:1px; width:400px; height:34px; z-index:5" class = "style11"> 
		<?php echo $Lan_VOD["WAIT_WAIT"][$Language_Type] ?> <SPAN id=rest style="COLOR: #ff0033">3</SPAN> <?php echo $Lan_VOD["SECOND"][$Language_Type] ?></div>
		</div>	
	</div>
</body>
</html>



