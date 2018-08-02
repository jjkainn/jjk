<?php 
	include 'language.php';
	include_once ("func_common_param.php");
	include_once ("func_advanced_param.php");
	include_once ("func_sys_set.php");
	error_reporting(1);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
?>
<!DOCTYPE html>
<html>
  <head>
  	  	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('#img1,#img2,#img3,#img4,.tabsright1,#img1-1,#img2-1,#img3-1,#img4-1,.logo,.nav2,.nav3,.li1,.li2,.li3,.li4');
    </script>
<![endif]-->

<!-- ie8及更低版本不支持媒体查询-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">    
	<meta name="description" content="">
    <meta name="author" content="MaZhiyu">
    <link rel="shortcut icon" href="./img/login_logo.gif">
	<title><?php echo $Lan_Common["TITLE"][$Language_Type]?></title>
	<!--引入外部js-->
	<script src="./js/jquery-1.7.2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
    <!--引入外部css-->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/focus.css" rel="stylesheet">		<!--访问速度慢是因为focus.css中用到了google字体-->
   	<!--选项卡-->
	<link href="./js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<script type="text/javascript">
		flowplayer.conf = { live: true };
	</script>
			<style>
		.header{
			width: 1000px;
			height: 60px;
			background: #231916;
			margin: auto;
			line-height: 60px;
			line-height: 0px\9;
		}
		.headerleft{
			float: left;
			position: relative;
			/*margin-top:20px;*/
		}
			.headerleft img{
			margin-left: 10px\9;
			margin-top: 10px\9;
		}
		.headerleft span{
			display: none\9;
		}
		.headerright{
			position: relative;
			float：right;
			right: -40%;
			right: -55%\9;
		}
		/*.headerright a:hover{
			background: #24252E;
		}*/
		.headerright img:hover{
			background: #24252E;
		}
		/*.headerleft span{
			display: none\0;

		}*/
		.headerright img{
			margin-left:12px;
		}
		.tabsleft{
			float: left; 
			background: #24252E;
			width:130px;        
		}
		.tabsright{
			float: right;
			background: #231916;
			/*height:1500px;*/
			width:870px;
			height:610px;
		}
		.tabsright1{
			margin-top: 40%;
		}
		.tabsright1 img{
			display: block;
			margin-left: 10%;
			cursor: crosshair;
			-webkit-animation: show 40s infinite linear;
		}
		#showImg1{
			position: absolute;
			top:160px;
			right: 500px;
		}
			#showImg2{
				position: absolute;
			top:660px;
			right: 500px;
		}
			#showImg3{
			height: 200px;
			width: 200px;
			background: #018159;
			position: absolute;
			top:160px;
			right: 500px;
			opacity: 0.15;
		}
		@-webkit-keyframes show{
			0%{transform: rotateZ(0deg);}
			100%{transform: rotateZ(360deg);}
		}
		.tabsright2{
		 margin: 20px;
		 cursor: pointer;
		}
		.showbutton img{
			height: 100px;
			width: 100px;
			margin-left: 40px;
			margin-top: 120px;
		}
		#table {
			text-align: center;
		}
		tr{
			text-align: left;
		}
		table td{
			width: 200px;
	
		}
	
	 input{
			width: 300px;
			*width: 350px;
		}
		.loupe{ 
  position:absolute; 
  pointer-events:none;
  visibility:hidden;
  z-index:999;
  width:100px;
  height:100px;
  border:1px solid #636363;
  border-radius:50%;
}
.tabs1{
	height: 34px;
	background: #a8a8a8;
}
.daohang{
	list-style: none;
	color: #000000;
}
.daohang li{
	color: #000000;
	height: 150px;
	
	margin-left: -25px;
cursor: pointer;
}
.daohang li:hover{
	
	background: #FFFFFF;
	color: #000000;
	
}
.daohang li:hover a{
	color: #000000;
	
}
.showLi{
	background: #ffffff;
}
.daohang li a{
	text-align: center;
	line-height: 60px;
	/*padding-left: 25%;*/
	text-decoration: none;
	margin: auto;
}
.daohang li a:hover{
	color: #000000;
}
.daohang li img{
	margin: auto;
	display: block;
}
#showName{
	display: none\9;
}
.shebei{
	*width: 100px;
}
.f1{
	float: right;
}

/*自适应*/
@media only screen and (min-width: 976px) and (max-width: 1024px) {

	.header{
		width: 100%;
	}
	.nav-tabs{
		width: 100%;
	}
	.tab-content{
		width: 100%;
	}
	.tabsleft{
		width: 10%;

	}
	 table{
		position: relative;
		/*left: -10%;*/

	}
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
	.tabsright1 img{
		width: 80%;
		height: 80%;
	}
	.tabsright{
		width: 90%;
	}

	.tabsright2 img{
		/*width: 80%;*/
		margin:40px 35px;
		height: 30%;
		width: 30%;
	}
}
@media only screen and (min-width: 768px) and (max-width: 976px) {

	.header{
		width: 100%;
	}
	.nav-tabs{
		width: 100%;
	}
	.tab-content{
		width: 100%;
	}
	.tabsleft{
		width: 10%;
		font-size: 0.8em;

	}
	.daohang li{

	height: 120px;
	

}
	 table{
		position: relative;
		/*left: -1%;*/
		width: 70%;
		font-size: 0.8em;

	}
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}

	.tabsright{
		width: 90%;
	}

}
@media only screen and (min-width: 480px) and (max-width: 768px) {

	.header{
		position: relative;
		width: 100%;
		margin: auto;
		/*left: -25%;*/
	}
	.nav-tabs{
		position: relative;
		width: 100%;
		top:-2px;
		height: auto;
	}
	.nav-tabs li{
		/*width: 60%;*/
		font-size: 0.7em;
	    text-align: left;

	margin-left: -10px;
		/*width: 60%;*/
	}
	.nav-tabs span{
		display: none;
	}
	.headerleft img{
		width: 80%;
		height: 80%;
	}
	.headerleft span{
		/*font-size: 0.7em;*/
		display: none;
	}
	.tab-content{
		width: auto;
		margin: auto;
	    position: relative;
		top: -2px;
		width: 100%;
		height: auto;
		
	}
	.tabsleft{
		width: 12%;
		 margin: auto;
		 font-size: 0.7em;
	}

	table{
        margin: auto;
        width: auto;
        font-size: 0.7em;
        width: 90%;
        height: auto;
        line-height: 1.5em;
	}
	table span{
		width: auto;
		display: inline-block;
	}
	 td{
		width:auto;
		line-height: 5em;
	}

	.tabsright{
		width: 88%;
		height: auto;
		background: #24252E;
	}
	
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
	
}
@media only screen and (max-width: 480px) {
.header{
		position: relative;
		width: auto;
		margin: auto;
	}
	.nav-tabs{
	display: none;
	}

		.headerleft img{
		width: 80%;
		height: 80%;
	}
	.headerleft span{
		/*font-size: 0.7em;*/
		display: none;
	}
	.tab-content{
		width: auto;
		margin: auto;
	    position: relative;
		top: -3px;
		clear: both;
		height: auto;
		
	}
	.tabsleft{
		width: auto;
		 margin: auto;
		 clear: both;
		 height: 70px;

	}
	table{
        margin: left;
        width: auto;
        font-size: 0.7em;
        width:auto;
        line-height: 1em;
	}
	table span{
		width: auto;
		display:block;
	}
	 td{
		width:auto;
		line-height: 20px;
		width: auto;
	}
	table input{
		width: 150px;
	}


	.tabsright{
		width: auto;
        height: auto;
		 clear: both;
		 background: #24252E;
		 margin-left: 10%;
	}
	
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}

	.tabsleft ul li{
		float: left;
		margin-left:28px;
		height: auto;
	}
	.tabsleft a{
		display: none;
	}
	.tabsleft img{
		height: 80%;
		width: 80%;
	}
	.tabsleft ul{
		float: left;
		margin-left: 0%;
	}
	.daohang li:hover{
	
	background: #24252E;
	
}
.showLi{
	background: #24252E;
}
}

	</style>
  </head>
  <?php
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
  ?>
  <body>
<!--导航1-->
<div class="header">
	<div class="headerleft">
	　<a href="http://www.avsolutiontech.com/"><img src="img/logo1.png" class="logo"></a>
		<span style="color: #FFFFFF;">　｜　产品型号：<?php
			 $ret = GetDeviceID(); 
	         if($ret['id']=="4439C4631B764439C4631B75")
	         {
	         	echo "MAYA-IV 8000W";
	         }
	         else{
	         	echo "AURORA-IV 8000W";
	         }	
	         ?>
	    </span>
	</div>
	<div class="headerright">
		<img src="img/nav1.png" />
		<a href="#" onclick="javascript:history.go(-1)"><img src="img/nav2.png" class="nav2"/></a>
		<a href="#" onclick="logout();"><img src="img/nav3.png" class="nav3"/></a>
	</div>
	<script>
		function logout(){
			window.location.href="index.php";
			return false;
		}
	</script>
</div>
<!--导航2-->
                 
					
					<div class="tab-content" style="margin: auto;background: #24252E;">
						
						<div class="tabsleft">
						<ul class="daohang" style="text-align: center;">
						<li style="color: #FFFFFF;" onclick="javascript:window.location.href='common.php'">
							<br />
							<img src="img/li1.png" class="li1"/>
							<a href="#"><?php echo $Lan_Main["Common"][$Language_Type];?></a>
						</li>
						<li onclick="javascript:window.location.href='advanced.php'">
							<br />
							<img src="img/li2.png" class="li2"/>
							<a><?php echo $Lan_Main["Advanced"][$Language_Type];?></a>
						</li>
						<li class="showLi" onclick="javascript:window.location.href='orchestrator.php'">
							<br />
							<img src="img/li3.png" class="li3"/>
							<a style="color: #000000;"><?php echo $Lan_Main["Orchestrator"][$Language_Type];?></a>
						</li>
						<li onclick="javascript:window.location.href='wifi.php'">
							<br />
							<img src="img/li4.png" class="li4"/>
							<a><?php echo $Lan_Main["Wifi"][$Language_Type];?></a>
						</li>
					
					    </ul>
						</div>
						
						<div class="tabsright">
								<div style="background:#24252e;height: 40px;line-height: 40px;" id="showName"><span style="color: #F36609;margin-left: 500px;"><?php echo $Lan_Main["User"][$Language_Type];?></span>
								　登录日期：<span id="jnkc"></span>
								 
                        <script>setInterval("jnkc.innerHTML=new Date().toLocaleString();",1000);
 
                        </script>
                        </div>
                        <br /><br />
							<table style="text-align:right; margin-top:20px; line-height:4em;margin: auto;">
								
								<!--设备状态-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_State"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="checkbox" id="OrchState" name='OrchState' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="76"/></td>
								<script>
									$("[name='OrchState']").bootstrapSwitch();
								</script>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Username"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="username" id="username" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Password"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="password" name="password" id="password" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_DevID"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="DevID" id="DevID" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_DevName"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="DevName" id="DevName" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Url"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="url" id="url" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td></td>
									<td><a class="btn btn-lg btn-primary form-control" href="#" onclick="setmediaOrch()"><?php echo $Lan_Common["SUBMIT"][$Language_Type];?></a></td>
									<script>
										function setmediaOrch(){
											//var OrchState = $('#OrchState').val();
											var username = $('#username').val();
											var password = $('#password').val();
											var DevID = $('#DevID').val();
											var DevName = $('#DevName').val();
											var url = $('#url').val();

											var switchObj = $('#OrchState');
											var OrchState = Number(switchObj.is(":checked"));
											

											$.post('ctl_advanced_param.php?action=setmediaOrch',
													{
														"username":username,
														"password":password,
														"DevID":DevID,
														"DevName":DevName,
														"url":url,
														"used":OrchState
													},
												function(msg){
													if(lang == 'CH'){
														var info = "成功";
														var errorInfo = "配置未成功，请检查参数";
														var error1Info = "未能配置成功";
													}else{
														var info = "Success";
														var errorInfo = "Configuration is not successful, please check the parameter";
														var error1Info = "Configuration is not successful";
													}
													if(msg == 1){
														alert(info);
													}else if(msg == 'error'){
														alert(errorInfo);
													}else{
														alert(error1Info);
													}
											});											
										}
									</script>
								</div></tr>
							</table>
						</div>
				</div>

  </body>
</html>
<?php
     //高级参数
		
		//获取描述符
		$ret = &Getorchname();
		$orchDevName	= $ret['devName'];
		echo("<script>$('#orchDevName').val(\"{$orchDevName}\");</script>");
		
		//获取Nokia推流信息
		$ret = getMediaOrch();
		$DevID = $ret['DevID'];
		$DevName = $ret['DevName'];
		$url = $ret['url'];
		$username = $ret['username'];
		$password = $ret['password'];
		$OrchState = $ret ['used'];
		
		if($OrchState > 0){
			echo("<script>$('input[name=\"OrchState\"]').bootstrapSwitch('state', true);</script>");
		}else{
			echo("<script>$('input[name=\"OrchState\"]').bootstrapSwitch('state', false);</script>");
		}
		
		echo "<script>$('#username').val(\"{$username}\");</script>";
		echo "<script>$('#password').val(\"{$password}\");</script>";
		echo "<script>$('#DevID').val(\"{$DevID}\");</script>";
		echo "<script>$('#DevName').val(\"{$DevName}\");</script>";
		echo "<script>$('#url').val(\"{$url}\");</script>";
?>
<!--<script src="js/waitWindow.js"></script>-->