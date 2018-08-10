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
    DD_belatedPNG.fix('#img1,#img2,#img3,#img4,.tabsright1,#img1-1,#img2-1,#img3-1,#img4-1,.logo,.nav2,.nav3');
    </script>
<![endif]-->
  <!--[if IE 6]>
    <style>
    body {behavior: url("csshover.htc");}
    </style>
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
	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="flowplayer/flowplayer.js"></script>
	<script src="flowplayer/flowplayer-3.2.13.min.js"></script>

	<script src="flowplayer/flowplayer.js"></script>
	<script src="flowplayer/flowplayer.js"></script>
	<script type="text/javascript">
		flowplayer.conf = { live: true };
	</script>
	<script>
		function CheckSubVideo(subStatus){
			if(subStatus == true){//直播码流为主码流
//				subResolution子码流
				document.getElementById('subResolution').disabled = true;
				//document.getElementById('subMirrormode').disabled = true;
//				subRate子码流码率
				document.getElementById('subRate').disabled = true;
//				subIframerate关键帧间隔
				document.getElementById('subIframerate').disabled = true;
//				subServerIP子码流服务器
				document.getElementById('subServerIP').disabled = true;
//				subStreamName子码流流名
				document.getElementById('subStreamName').disabled = true;
//				frameB主码流b帧
				document.getElementById('frameB').disabled = false;
				
				document.getElementById('SubControl').disabled = true;
			}else{//直播码流为子码流
				document.getElementById('subResolution').disabled = false;
				//document.getElementById('subMirrormode').disabled = false;
				document.getElementById('subRate').disabled = false;
				document.getElementById('subIframerate').disabled = false;
				document.getElementById('subServerIP').disabled = false;
				document.getElementById('subStreamName').disabled = false;
				document.getElementById('frameB').disabled = true;
				document.getElementById('SubControl').disabled = false;
				// 主码流B帧显示为0
				$("#frameB").val("0"); 	
				
			}
		}
	</script>
	<script src="js/DD_belatedPNG.js"></script>
    <!--引入外部css-->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/focus.css" rel="stylesheet">		<!--访问速度慢是因为focus.css中用到了google字体-->
   <!-- <link href="./css/style.css" rel="stylesheet">-->
   	<!--选项卡-->
	<link href="./js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./flowplayer/skin/functional.css" />
	<style>
		body,html{
			overflow-x:hidden;
		}
		.conn::-webkit-scrollbar{
	display: none;
}
		.header{
			width: 100%;
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
		.headerright img:hover{
			background: #24252E;
		}
		.headerright img{
			margin-left:12px;
		}
		.tab-content{
			_width:1000px;
			/*height:890px;*/
			background: #292B3A;
			_background:#292B3A;
		}
		.tabsleft{
			float: left; 
			background: #292B3A;
			width: 40%; 
			/*height:890px;*/
			_margin-left:100px;
           
		}
		.tabsleft table{
			_width: 600px;
			/*_font-size:24px;*/
		}
		.tabsright{
			float: right;
			background: #231916;
			height:890px;
		    *height: auto;
			width:60%;
			_display:none;
			/*overflow: hidden;*/

		}
		.tabsright1{
			margin-top: 40%;
			
		}
		.tabsright1 img{
			display: block;
			margin:auto;
			cursor: crosshair;
			-webkit-animation: show 40s infinite linear;
			/*_clear:both;*/
		}
		.tabsright1 img{
			_clear:both;
		}
		#img1{

		}
		#showImg1{
			/*height: 200px;
			width: 200px;
			background: #018159;*/
			position: absolute;
			top:160px;
			right: 500px;

		}
			#showImg2{
				position: absolute;
			top:700px;
			right: 500px;
		}
			#showImg3{
				position: absolute;
			top:160px;
			right: 500px;
		}
			#showImg4{
				position: absolute;
			top:700px;
			right: 500px;
		}
		

		@-webkit-keyframes show{
			0%{transform: rotateZ(0deg);}
			/*50%{transform: rotateZ(180deg);}*/
			100%{transform: rotateZ(360deg);}
		}
		.tabsright2{
		 margin: 12px;
		 cursor: pointer;
		}
		.showbutton img{
			height: 100px;
			width: 100px;
			margin-left: 40px;
			margin-top: 120px;

			
		}

		#table span{
			padding-right: 0px;
		}

		table tr td{
			*width: 120px;
			_width:150px;
            
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
#showName{
	display: none\9;
}
input[type="checkbox"]{
	_background:transparent;
	border:none;
}
.f1{
	float: right;
}

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
		width: 50%;

	}
	 table{
		position: relative;
		left: 8%;

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
		width: 50%;
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
		width: 45%;

	}
	 table{
		position: relative;
		left: 8%;

	}
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
	/*.tabsright{
		width:480px;
	}*/
	.tabsright1 img{
		width: 20%;
		height: 20%;
		margin:auto;
		margin-top: -100px;
		margin-left: 10%;
		
	}
	.tabsright{
		width: 55%;
	}
	.tabsright2 img{
		/*width: 80%;*/
		margin:20px 150px;
		height: 15%;
		width: 15%;
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
		/*left: -25%;*/
	}
	.nav-tabs li{
		/*width: 60%;*/
		font-size: 0.8em;
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
		/*background: #292B3A;*/
		top: -2px;
		/*display: table;*/
		width: 100%;
		height: auto;
	/*left: -25%;*/
		
	}
	.tabsleft{
		width: 35%;
		 margin: auto;
		 /*display: table-cell;*/
		/* width:80%;*/
       /* margin-left: 10%;*/
	}
	table{
        /* width: 100%;*/
        margin: auto;
        width: auto;
        font-size: 0.8em;
	}

	.tabsright1{
		display: none;
		
	}
	.tabsright{
		width: 65%;
		height: auto;
	}
	.tabsright2{
		height: auto;
	}
	.tabsright2 img{
		/*width: 80%;*/
		/*margin:41px 0px;*/
		height: 17%;
		width: 17%;
		display: block;
		margin: 70px auto;
		margin-left: 2%;
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
		width: 100%;
		margin: auto;
		/*left: -25%;*/
	}
	.nav-tabs{
		position: relative;
		width: 100%;
		top:-2px;
		height: auto;
		/*left: -25%;*/
	}
	.nav-tabs li{
		/*width: 60%;*/
		font-size: 0.8em;
	    text-align: left;

	margin-left: -10px;
		/*width: 60%;*/
	}
	.nav-tabs span{
		display: none;
	}
	/*.headerleft{
		overflow: hidden;
	}*/
	.headerleft img{
		width: 80%;
		height: 80%;
	}
	.headerleft span{
		/*font-size: 0.8em;*/
		display: none;
	}
	.tab-content{
		width: auto;
		margin: auto;
	    position: relative;
		/*background: #292B3A;*/
		top: -2px;
		/*display: table;*/
		width: 100%;
		height: auto;
	/*left: -25%;*/
		
	}
	.tabsleft{
		width: 100%;
		 margin: auto;
		
	}
	table{
        /* width: 100%;*/
        margin: auto;
        width: auto;
        font-size: 0.8em;
	}

	.tabsright{
		display: none;
	}

	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
}
	</style>
  </head>
  <?php
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
  ?>
  <body style="overflow:-Scroll;overflow-x:hidden;margin: 0px auto;">
  <div style="margin: auto;width: 1000px;" class="conn">
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
		<a href="#"><img src="img/nav1.png" /></a>
		<a href="#" onclick="javascript:history.go(-1)"><img src="img/nav2.png" class="nav2"/></a>
		<a href="#" onclick="logout();"><img src="img/nav3.png"  class="nav3"/></a>
	</div>
	<script>
		function logout(){
			window.location.href="index.php";
			return false;
		}
	</script>
    <!-- <form action="witness_lg.php" method="post"> -->
		<div style="margin-left: 25em; margin-top: 10em; background-color: #FF4500; background-color: 1px; display: none" id="none">
			<table bgcolor="1">
				<tr>
					<td>目睹用户名</td>
					<td><input type="text" name="email" id="mdemail" value=""></td>
				</tr>
					<tr>
					<td>目睹密码</td>
					<td><input type="password" name="password" id="mdpassword" value=""></td>
				</tr>
					<tr>
					<td></td>
					<td><!-- <input type="submit" value="登录"> --><button id="mddl">登录</button></td>
				</tr>
			</table>
		</div>
	<!-- </form> -->


</div>
<!--导航2-->
					<div class="header2">
					<ul class="nav nav-tabs" style="clear: both;overflow: hidden;">
						<li style="float: left\9;_margin-top:20px">
							<!--<ul><li><a href="common.php"><b><?php echo $Lan_Main["Common"][$Language_Type];?></b></a>　<span style="color:#f0f0f0">｜</span>　</li></ul>-->
							　<a href="common.php"><b><?php echo $Lan_Main["Common"][$Language_Type];?></b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left\9;_margin-top:20px">
							<a href="advanced.php"><b><?php echo $Lan_Main["Advanced"][$Language_Type];?></b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left\9;_margin-top:20px">
							<a href="orchestrator.php"><b><?php echo $Lan_Main["Orchestrator"][$Language_Type];?></b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left\9;_margin-top:20px">
							<a href="wifi.php"><b><?php echo $Lan_Main["Wifi"][$Language_Type];?></b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="margin-left: 120px;" id="showName">
							<span style="color: #F36609;"><?php echo $Lan_Main["User"][$Language_Type];?></span>
								　登录日期：<span id="jnkc"></span>
								 
                        <script>setInterval("jnkc.innerHTML=new Date().toLocaleString();",1000);
 
                        </script>
						</li>
					
					</ul>
					
					</div>
					<div class="tab-content" style="margin: auto;">
						<div class="tabsleft">
							<!--常用功能-->
							<table style="text-align:left; margin-top:2em; line-height:4em;margin-left:1em;*font-size: 13px;*line-height: 4.45em;_line-height:3.5em;_font-size:16px">
								<tbody id="table1">
<!--									观看直播视频-->
							<tr id="Livebutton">
								<td><a id="loginlist" href="javascript:vivo(0)" role="button" class="btn btn-info" data-toggle="modal"><?php echo $Lan_Main["Getlist"][$Language_Type];?></a></td>
								<td> <a id="modal-438185" href="#modal-container-438185" role="button" class="btn btn-info" data-toggle="modal"><?php echo $Lan_Main["Watch"][$Language_Type];?></a></td>
							</tr>
							<!--视频窗口-->
							<div id="modal-container-438185" class="modal hide" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								
								<div class="modal-header">
									 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h3 id="myModalLabel">
										<?php echo $Lan_Main["Watch"][$Language_Type];?>
									</h3>
								</div>
								
								<div class="modal-body">
									<div>
									<!--直播设置-->
									
									<?php
										$mediaType = getMediaStreamType();
										$channo = $mediaType['chanNO'];
										$LiveStreamType = $mediaType['LiveStreamType'];
										$media =& GetMediaPara('RTMP',$channo,$LiveStreamType);
										$stream = $media['port'];
										$originalPath = $media['path'];
										$used = $media['used'];
										$RTMPpath = $media['path'];

										if(substr($originalPath,strlen("rtmp://"),strlen("127.0.0.1")) == "127.0.0.1"){
											$server_ip = $_SERVER["SERVER_ADDR"];
											$path = "rtmp://".$server_ip.substr($originalPath,strlen("rtmp://127.0.0.1"))."/".$stream;
										}else{
											$path = $originalPath."/".$stream;
										}
										$Platform = explode(";",$_SERVER["HTTP_USER_AGENT"]);
										$AndroidPlatform = "rtmp";

										$FindPlatForm = 0;
										$FindBrowser = 0;
										
										for($i=0;$i<count($Platform);$i++)
										{

											if($FindPlatForm == 0)
											{
												if(stristr($Platform[$i],'Android')){
														$FindPlatForm = 1;
														$AndroidPlatform = "Mobile";
														continue;
												}
												else if(stristr($Platform[$i],'iPhone') ||
													stristr($Platform[$i],'iPad') ||
													stristr($Platform[$i],'iOS') ||
													stristr($Platform[$i],'iPod') ||
													stristr($Platform[$i],'iWatch') ||
													stristr($Platform[$i],'BlackBerry')){
														$FindPlatForm = 1;
														$AndroidPlatform = "HLS";
														continue;
												}
											}

											if($FindBrowser == 0)
											{
												if(strstr($Platform[$i],'MQQBrowser') || strstr($Platform[$i],'UCBrowser')){
														$FindBrowser = 1;
														$videoStream = "http";
														continue;
												}
											}

											if($FindPlatForm == 1 && $FindPlatBrowser == 1)
												break;
										}

										if($AndroidPlatform == 'Mobile'){//android
											
											if(substr($originalPath,strlen("http://"),strlen("115.29.148.122")) == "115.29.148.122")
											{
												$path = "http://115.29.148.122/avst1/Public/evostreamms-1.6.5.2959-i686-Windows_2008/media/autoHLS/".$stream."/".$stream.".m3u8";
											}
											else if(substr($originalPath,strlen("http://"),strlen("115.28.66.155")) == "115.28.66.155")
											{
												$path = "http://115.28.66.155:8080/hls/".$stream.".m3u8";
											}
											else if(substr($originalPath,strlen("http://"),strlen("127.0.0.1")) == "127.0.0.1")
											{
												$path = "http://".$server_ip."/hls/".$stream.".m3u8";
											}

									?>
												<div data-live="true" data-ratio="0.5625" class="flowplayer">
													<video>
														<source type="application/x-mpegurl" src="<?php echo $path;?>">
													</video>
												</div>
									<?php
										}else{
									?>
									<!--pc端-->
											<div data-live="true" data-ratio="0.5625" class="flowplayer">
												<video autoplay>
													<source type="video/flash" src="<?php echo $path;?>">
												</video>
											</div>
									<?php
										}
									?>
									
								</div>
								</div>
								<div class="modal-footer">
									 <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $Lan_Common["OFF"][$Language_Type];?></button>
								</div>
							</div>
							
							<!--直播开启-->
							
							<tr><div>
								<td><span> <?php echo $Lan_Main["Live"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="liveIsTurn" name='liveIsTurn' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100" style="*width:200px;"/></td>
							<script>
								$("[name='liveIsTurn']").bootstrapSwitch();

								
							</script>
							</div>
							</tr>
							
							
							
							<!--录像开启-->
							<tr><div id="test">
								<td><span> <?php echo $Lan_Main["Record"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id='vodIsTurn' name='vodIsTurn' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100"/></td>
								<script>
									$("[name='vodIsTurn']").bootstrapSwitch();
								</script>
							</div>
							</tr>
							
							
							<!--直播码流-->
							<tr><div>
								<td><span> <?php echo $Lan_Main["StreamType"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="liveType" name='liveType' data-on-text="<?php echo $Lan_Main["STREAM_MAIN"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["STREAM_SUB"][$Language_Type];?>" data-handle-width="100"/></td>
								<script>
									$("[name='liveType']").bootstrapSwitch();
									$('input[name="liveType"]').on('switchChange.bootstrapSwitch', function(event, state){
										var status = state; // true | false
										CheckSubVideo(status);
									});
									
								</script>
							</div>
							</tr>
							<!--音频开关-->
							<tr><div>
								<td><span> <?php echo $Lan_Main["Audio"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="Audio" name='Audio' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100"/></td>
							<script>
								$("[name='Audio']").bootstrapSwitch();
							</script>
							</div>
							</tr>
							<!-- wifi 连接状态-->
							<tr><div>
								<td><span> <?php echo $Lan_Main["WiFi"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="WiFiState" name='WiFiState' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="100"/></td>
							<script>
								$("[name='WiFiState']").bootstrapSwitch();

								$('input[name="WiFiState"]').on('switchChange.bootstrapSwitch', function(event, state){
										var status = state; // true | false
									});
							</script>
							</div>
							</tr>
                           
                            <!--4g拨号状态-->
							<!--<tr>
							<div>
								<td><span> <?php echo $Lan_Main["4G"][$Language_Type];?></span> &nbsp;&nbsp;</td>
								<td></td>
							</div>
							</td>-->
							
							<!--连接状态-->
						    <tr>
						    <div>
						        <td><span><?php echo $Lan_Main["LinKState"][$Language_Type];?><font class="f1">：</font></span></td>
						    	<td><input type="checkbox" id='4Gstate' name='4Gstate' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="100"/></td>
							    <script>
										$("[name='4Gstate']").bootstrapSwitch();
	
										$('input[name="4Gstate"]').on('switchChange.bootstrapSwitch', function(event, state){
											var status = state; // true | false

										});
									</script>
							</div>			
							</tr>
									
							<!--信号强度-->
							<tr><div>
								<td><span><?php echo $Lan_Main["Signal"][$Language_Type];?><font class="f1">：</font></span></td>
							    <td><input type="text" id="signalStrength" name="signalStrength" class="form-control" placeholder="" readonly="readonly" style="*width:246px"></td>
							    </div>
							</tr>
							
							<!--运营商信息-->
							<tr><div>
								<td><span><?php echo $Lan_Main["carrier"][$Language_Type];?><font class="f1">：</font></span></td>
								<td><input type="text" name="carrier" id="carrier" class="form-control" placeholder="" readonly="readonly" style="*width:246px"></td>
								</div>
							</tr>
							
							<!--剩余流量-->
							<!--<tr><div>
								<td><span><?php echo $Lan_Main["DataLeft"][$Language_Type];?>：</span></td>
								<td><input type="text" name="dataRemaining" class="form-control" placeholder="" readonly="readonly"></td>
							    </div>
							</tr>-->
							
							<tr><div>
								<td><span> <?php echo $Lan_Main["StreamName"][$Language_Type];?><font class="f1">：</font></span></td>
								<td><input type="text" id="liveName" name="liveName" class="form-control" placeholder="livestream1" readonly="readonly" style="*width:246px"></td>
							    </div>
							</tr>
							
							<tr><div>
								<td><span> <?php echo $Lan_Main["DataChannel"][$Language_Type];?><font class="f1">：</font></span></td>
								<td><input type="text"  id="dataChannel" name='dataChannel' class="form-control" readonly="readonly" style="*width:246px"></td>
							    </div>
							</tr>
							
							<tr><div>
								<td><span><?php echo $Lan_Main["Battery"][$Language_Type];?><font class="f1">：</font></span></td>
								<td><input type="text" name="batteryinfo" id="batteryinfo" class="form-control" placeholder="" readonly="readonly" style="*width:246px"></td>
							    </div>
							</tr>
<!--							
							<tr>
								<div>    
							    <td><span> <?php echo $Lan_Main["Storage"][$Language_Type];?></span> &nbsp;&nbsp;</td>
							    <td></td>
							    </div>
						    </tr>-->
						   
						    <tr><div>
						    	<td><span> <?php echo $Lan_Main["StoreFREE"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
							    <td><input type="text" id="freeSpace" name="freeSpace" class="form-control" readonly="readonly" style="*width:246px"></td>
							    </div>
							</tr>
							
							<!--<tr><div>
								<td><span> <?php echo $Lan_Main["StoreUsed"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
							    <td><input type="text" id="usedSpace" name="usedSpace" class="form-control" readonly="readonly"></td>
							    </div>
						    </tr>-->
							</tbody>
							</table>
							
                           
           
			
						
						
						
					</div>
					<div class="tabsright">
						
							
						<div class="tabsright1" id="tabsright1" style="display: none;">
							<img src="img/camera1.png" style="height:50%;width: 50%;display: block;" id="img1" onclick="changeImg()"/>
							<img src="img/camera2.png" style="height:50%;width: 50%;display: none;" id="img2"/>
							<img src="img/camera3.png" style="height:50%;width: 50%;display: none;" id="img3"/>
							<img src="img/camera4.png" style="height:50%;width: 50%;display: none;" id="img4"/>
							<br />
							
						</div>
						
						<div class="tabsright1" id="encoder1" style="display: none;">
							<img src="img/encode1.png" style="height:50%;width: 50%;display: block;" id="img5" onclick="changeImg()"/>
							<img src="img/encode2.png" style="height:50%;width: 50%;display: none;" id="img6"/>
							<img src="img/encode3.png" style="height:50%;width: 50%;display: none;" id="img7"/>
							<img src="img/encode4.png" style="height:50%;width: 50%;display: none;" id="img8"/>
							<br />
							
						</div>
					
					    <div id="bbb">
						<img id="showImg1" style="display: none;" src="img/123.PNG"></img>
						<img id="showImg2" style="display: none;" src="img/456.PNG"></img>
						</div>
						
						
						<div id="ccc">
						<img id="showImg3" style="display: none;" src="img/789.png"></img>
						<img id="showImg4" style="display: none;" src="img/000.png"></img>
						</div>
						<!--<div id="showImg3" style="display: none;">123</div>-->
					    <div class="tabsright2" id="tabsright2" style="display: none;">
					    <span class="showbutton"  onmouseover="show1()"><img src="img/camera1.png" id="img1-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show2()"><img src="img/camera2.png" id="img2-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show3()"><img src="img/camera3.png" id="img3-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show4()"><img src="img/camera4.png" id="img4-1" style="_height:100px;_width:100px"></span>
					    </div>
					    
					     <div class="tabsright2" style="display: none;" id="encoder2">
					    <span class="showbutton"  onmouseover="show5()"><img src="img/encode1.png" id="enc1-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show6()"><img src="img/encode2.png" id="enc2-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show7()"><img src="img/encode3.png" id="enc3-1" style="_height:100px;_width:100px"></span>
					    <span class="showbutton" onmouseover="show8()"><img src="img/encode4.png" id="enc4-1" style="_height:100px;_width:100px"></span>
					    </div>
					    <div class="loupe"></div>
					</div>
					
				</div>
				
</div>
  </body>
</html>
<script>
var i=0;
$(document).ready(function(){
$("#img1").click(function(){
	i++;
	if(i==1){
		$("#showImg1").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg1").fadeIn(1000);
    	$("#showImg2").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg1").fadeOut("fast");
    	$("#showImg2").fadeOut("fast");
    }

});
$("#img2").click(function(){
	i++;
	if(i==1){
		$("#showImg1").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg1").fadeIn(1000);
    	$("#showImg2").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg1").fadeOut("fast");
    	$("#showImg2").fadeOut("fast");
    }

});
$("#img3").click(function(){
	i++;
	if(i==1){
		$("#showImg1").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg1").fadeIn(1000);
    	$("#showImg2").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg1").fadeOut("fast");
    	$("#showImg2").fadeOut("fast");
    }

});
$("#img4").click(function(){
	i++;
	if(i==1){
		$("#showImg1").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg1").fadeIn(1000);
    	$("#showImg2").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg1").fadeOut("fast");
    	$("#showImg2").fadeOut("fast");
    }

});
$("#img5").click(function(){
	i++;
	if(i==1){
		$("#showImg3").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg3").fadeIn(1000);
    	$("#showImg4").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg3").fadeOut("fast");
    	$("#showImg4").fadeOut("fast");
    }

});
$("#img6").click(function(){
	i++;
	if(i==1){
		$("#showImg3").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg3").fadeIn(1000);
    	$("#showImg4").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg3").fadeOut("fast");
    	$("#showImg4").fadeOut("fast");
    }

});
$("#img7").click(function(){
	i++;
	if(i==1){
		$("#showImg3").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg3").fadeIn(1000);
    	$("#showImg4").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg3").fadeOut("fast");
    	$("#showImg4").fadeOut("fast");
    }

});
$("#img8").click(function(){
	i++;
	if(i==1){
		$("#showImg3").fadeIn(1000);
	}
    else if(i==2){
    	$("#showImg3").fadeIn(1000);
    	$("#showImg4").fadeIn(1000);
    }
    else{
    	i=0;
    	
    	$("#showImg3").fadeOut("fast");
    	$("#showImg4").fadeOut("fast");
    }

});

});

</script>
<!--引入外部js-->

	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>

	
<script>
	function show1(){

document.getElementById("img1").style.display="block";
document.getElementById("img2").style.display="none";
document.getElementById("img3").style.display="none";
document.getElementById("img4").style.display="none";
	}
		function show2(){

document.getElementById("img1").style.display="none";
document.getElementById("img2").style.display="block";
document.getElementById("img3").style.display="none";
document.getElementById("img4").style.display="none";
	}
		function show3(){

document.getElementById("img1").style.display="none";
document.getElementById("img2").style.display="none";
document.getElementById("img3").style.display="block";
document.getElementById("img4").style.display="none";
	}
		function show4(){

document.getElementById("img1").style.display="none";
document.getElementById("img2").style.display="none";
document.getElementById("img3").style.display="none";
document.getElementById("img4").style.display="block";
	}
	
	function show5(){

document.getElementById("img5").style.display="block";
document.getElementById("img6").style.display="none";
document.getElementById("img7").style.display="none";
document.getElementById("img8").style.display="none";
	}
		function show6(){

document.getElementById("img5").style.display="none";
document.getElementById("img6").style.display="block";
document.getElementById("img7").style.display="none";
document.getElementById("img8").style.display="none";
	}
		function show7(){

document.getElementById("img5").style.display="none";
document.getElementById("img6").style.display="none";
document.getElementById("img7").style.display="block";
document.getElementById("img8").style.display="none";
	}
		function show8(){

document.getElementById("img5").style.display="none";
document.getElementById("img6").style.display="none";
document.getElementById("img7").style.display="none";
document.getElementById("img8").style.display="block";
	}
</script>
<?php
	//常用参数
		//获取直播或录像流类型（主码流or子码流）
		$ret = getMediaStreamType();
		$LiveStreamType	= $ret['LiveStreamType'];
		$RecordStreamType = $ret['RecordStreamType'];

		//获取直播状态
		$ret =& getMediaLiveStream($LiveStreamType);
		if($ret["status"] != 1){
			echo("<script>$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', false);</script>");
		}else{
			echo("<script>$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', true);</script>");
		}
		

		//获取录像状态
		$ret =& getMediaRecordStream($RecordStreamType);
		if($ret["status"] == 1){
			echo("<script>$('input[name=\"vodIsTurn\"]').bootstrapSwitch('state', true);</script>");
		}else{
			echo("<script>$('input[name=\"vodIsTurn\"]').bootstrapSwitch('state', false);</script>");
		}

		//获取子码流是否开启
		$ret = IsSubStreamExist();
		//$video = GetVideoParam($streamtype);
		//var_dump($ret);
		if($ret["sub_state"] == 1){
			echo("<script>$('input[name=\"liveType\"]').bootstrapSwitch('state', false);
				document.getElementById('subResolution').disabled = false;
				//document.getElementById('subMirrormode').disabled = false;
				document.getElementById('subRate').disabled = false;
				document.getElementById('SubControl').disabled = false;
				document.getElementById('subIframerate').disabled = false;
				document.getElementById('subServerIP').disabled = false;
				document.getElementById('subStreamName').disabled = false;
				//开启子码流 B帧失效
				document.getElementById('frameB').disabled = true;
			</script>");
		}else{
			echo("<script>$('input[name=\"liveType\"]').bootstrapSwitch('state', true);
				document.getElementById('subResolution').disabled = true;
				//document.getElementById('subMirrormode').disabled = true;
				document.getElementById('subRate').disabled = true;
				document.getElementById('SubControl').disabled = true;
				document.getElementById('subIframerate').disabled = true;
				document.getElementById('subServerIP').disabled = true;
				document.getElementById('subStreamName').disabled = true;
				document.getElementById('frameB').disabled = false;
			</script>");
		}

		//获取音频状态
		$ret =& getAudioCapture();
		//var_dump($ret);
		if($ret["AudioChan"] == 0){
			echo("<script>$('input[name=\"Audio\"]').bootstrapSwitch('state', false);</script>");
		}else{
			echo("<script>$('input[name=\"Audio\"]').bootstrapSwitch('state', true);</script>");
		}
		
		//获取WiFi连接状态
		$ret = GetWiFiState();
		if($ret['WiFi'] > 0){
			echo("<script>$('input[name=\"WiFiState\"]').bootstrapSwitch('state', true);</script>");
		}else{
			echo("<script>$('input[name=\"WiFiState\"]').bootstrapSwitch('state', false);</script>");
		}
		
		//获取4G连接状态
			$ret = Get4GLinkState();
			if($ret > 0){
				echo("<script>$('input[name=\"4Gstate\"]').bootstrapSwitch('state', true);</script>");
			}else{
				echo("<script>$('input[name=\"4Gstate\"]').bootstrapSwitch('state', false);</script>");
			}
		
		
		
		//获取4G信号强度
			$netpara = GetIP4GProperty();
		
			if($netpara["rrssi"] < 2 || $netpara["rrssi"] == 99)
			{
				$netpara["rrssi"] = 0;
			}
			else if($netpara["rrssi"] >= 2 && $netpara["rrssi"] < 7)
			{
				$netpara["rrssi"] = 1;
			}
			else if($netpara["rrssi"] >= 7 && $netpara["rrssi"] < 12)
			{
				$netpara["rrssi"] = 2;
			}
			else if($netpara["rrssi"] >= 12 && $netpara["rrssi"] < 17)
			{
				$netpara["rrssi"] = 3;
			}
			else if($netpara["rrssi"] >= 17 && $netpara["rrssi"] < 22)
			{
				$netpara["rrssi"] = 4;
			}
			else if($netpara["rrssi"] >= 22)
			{
				$netpara["rrssi"] = 5;
			}else{
				$netpara["rrssi"] = 0;
			}
			echo("<script>$('#signalStrength').val(\"{$netpara['rrssi']}\");</script>");

		//获取4G运营商信息
		$carrier = GetIP4GCarrier();
		if($carrier['carrier'] == 'NULL'){
			echo("<script>$('#carrier').val(\"\");</script>");
		}else{
			echo("<script>$('#carrier').val(\"{$carrier['carrier']}\");</script>");
		}

		//获取当前数据连接通道
		$linkType = GetLinkType();
		//var_dump($linkType);
		if($linkType['LinkType'] == 0){//wifi
			//echo("<script>$('input[name=\"dataChannel\"]').bootstrapSwitch('state', false);</script>");
			echo "<script>$('#dataChannel').val(\"wifi\");</script>";
		}
		else if($linkType['LinkType'] == 1){//4G
			//echo("<script>$('input[name=\"dataChannel\"]').bootstrapSwitch('state', true);</script>");
			echo "<script>$('#dataChannel').val(\"4G\");</script>";
		}
		
		//385编码器获取视频源类型
		$ret = &GetChanInput();
		
		$ChanType = $ret['ChanType'];
			
			
		//获取直播流名
		$chan = getMediaStreamType();
		$chanNo = $chan['chanNO'];
		$media =& GetMediaPara('RTMP',$chanNo,0);
		if($media['port'] == -1){
			$media['port'] = $Lan_Main["NoStream"][$Language_Type];//"暂无直播流"
		}
		echo("<script>$('#liveName').val(\"{$media['port']}\");</script>");
		echo("<script>$('#mainStreamName').val(\"{$media['port']}\");</script>");	//主码流流名

		//获取TS流名
		$chan = getMediaStreamType();
		$chanNo = $chan['chanNO'];
		$media =& GetMediaPara('TS',$chanNo,0);

		/*if($media['port'] == -1){
			$media['port'] = "暂无直播流";
		}*/
		echo("<script>$('#TSpath').val(\"{$media['path']}\");</script>");
		echo("<script>$('#TS_port').val(\"{$media['port']}\");</script>");	//主码流流名
		echo("<script>document.getElementById('TSinfo').innerText = 'udp://@{$media['path']}:{$media['port']}';</script>");

		//获取子码流流名
		$chan = getMediaStreamType();
		$chanNo = $chan['chanNo'];
		$media =& GetMediaPara('RTMP',$chanNo,1);
		if($media['port'] == -1){
			$media['port'] = $Lan_Main["NoStream"][$Language_Type];//"暂无直播流"
		}
		echo("<script>$('#subStreamName').val(\"{$media['port']}\");</script>");

		//获取电池电量
		$battery = Getbatteryinfo();
		echo("<script>$('#batteryinfo').val(\"{$battery['percent']}%\");</script>");

		//获取存储空间使用情况
		//$diskpara =& GetSDCardSpace();
		$chan = getMediaStreamType();
		$chanNo = $chan['chanNo'];
		$streamtype = $chan['streamtype'];
		$diskpara =& GetRecordChanSpace($chanNo,$streamtype);
		echo("<script>	var totalSpace = parseInt({$diskpara['total']});
						var usedSpace = parseInt({$diskpara['used']});
						var freeSpace = totalSpace - usedSpace;
					   $('#usedSpace').val(usedSpace);
					   $('#freeSpace').val(freeSpace);
			  </script>");
?>
<script src="js/waitWindow.js"></script>
<script>

	var operationParamWifi = 0;		//wifi 处理级别		0 手动触发onchange函数执行（需执行发送命令操作）  1  操作失败返回false  2 自动触发onchange函数（不需要执行发送命令操作）
	var operationParam4G = 0;		//4G 处理级别		0 手动触发onchange函数执行（需执行发送命令操作）  1  操作失败返回false  2 自动触发onchange函数（不需要执行发送命令操作）
	var beingprocessed = 0;			//函数是否正在处理	0 未在处理  1 正在处理


		//(当鼠标焦点在浏览器之外的情况下，页面就不会向设备发送命令)
		var ajaxflag = true;
		//添加鼠标焦点移入浏览器窗口事件 
		window.addEventListener('focus', function() {
				ajaxflag = true;
		},false);
		  
		//添加鼠标焦点移开浏览器窗口事件  
		window.addEventListener('blur', function() {  
				ajaxflag = false;
		},false);

		setInterval(function(){
			if(ajaxflag == false)
				return;
			
								

		//4GIP信息
		$.ajax({
			url : "func_common_param.php?action=GetIP4GProperty",
			type : 'POST',
			success : function(netpara){
				var msg = eval('('+netpara+')');

						if(msg.rrssi < 2 || msg.rrssi == 99)
						{
							var rrssi = 0;
						}
						else if(msg.rrssi >= 2 && msg.rrssi < 7)
						{
							var rrssi = 1;
						}
						else if(msg.rrssi >= 7 && msg.rrssi < 12)
						{
							var rrssi = 2;
						}
						else if(msg.rrssi >= 12 && msg.rrssi < 17)
						{
							var rrssi = 3;
						}
						else if(msg.rrssi >= 17 && msg.rrssi < 22)
						{
							var rrssi = 4;
						}
						else if(msg.rrssi >= 22)
						{
							var rrssi = 5;
						}else{
							var rrssi = 0;
						}

						//$('#rrssi').style.width = rrssi*10+"%";
						$('#signalStrength').val(rrssi);
					}
				});
			},10000);

	//获取电池电量
	setInterval(function(){
		$.ajax({
			url : "func_common_param.php?action=Getbatteryinfo",
			type : 'POST',
			success : function(batteryinfo){
				var msg = eval('('+batteryinfo+')');
				var percent = msg.percent;
				$('#batteryinfo').val(percent+'%');
			}
		});
	},60000);


	/*设置直播状态*/
	$('input[name="liveIsTurn"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($('input[name="liveIsTurn"]').is(':checked')){
			var status = true;
		}else{
			var status = false;
		}
		
		$.post('ctl_common_param.php?action=setLiveState',{'state':status},function(msg){
			if(msg == "error"){
				var info = "Note: On live failed!";
				if(lang == 'CH'){
					info = "注意：开启直播未成功！";
				}
				alert(info);
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "success"){
				var info = "Open Live Success!";
				if(lang == "CH"){
					info = "开启直播成功";
				}
				alert(info);
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', true);
			}
			else if(msg == "stoplive_ok"){
				var info = "Close Live Success";
				if(lang == "CH"){
					info = "关闭直播成功";
				}
				alert(info);
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "param error"){
				var info = "Parameter passing wrong";
				if(lang == "CH"){
					info = "参数传递出错";
				}
				alert(info);
			}
			else{
				var info = "Encountered an unknown error!";
				if(lang == "CH"){
					info = "遇到未知错误，操作未完成！";
				}
				alert(info);
			}
		});
	});

	//设置录像状态
	$('input[name="vodIsTurn"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($("[name='vodIsTurn']").is(':checked')){
			status = true;
		}else{
			status = false;
		}
		$.post('ctl_common_param.php?action=setVodState',{'state':status},function(msg){
			if(msg == "no_sd_card"){
				var info = "No memory card, you can not record!";
				if(lang == "CH"){
					info = "没有内存卡，无法录像";
				}
				alert(info);
				$("[name='vodIsTurn']").bootstrapSwitch('state', false);
			}
			else if(msg == "handrecord_ok"){
				var info = "Recording Success";
				if(lang == "CH"){
					info = "录像成功";
				}
				alert(info);
				$("[name='vodIsTurn']").bootstrapSwitch('state', true);
			}
			else if(msg == "stoprecord_ok"){
				var info = "End recording";
				if(lang == "CH"){
					info = "结束录像";
				}
				alert(info);
				$("[name='vodIsTurn']").bootstrapSwitch('state', false);
			}
			else{
				var info = "Encountered an unknown error!";
				if(lang == "CH"){
					info = "遇到未知错误，操作未完成！";
				}
				alert(info);
			}
		});
	});

	//设置直播流类型
	$('input[name="liveType"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($("[name='liveType']").is(':checked')){
			status = true;
		}else{
			status = false;
		}
		$.post('ctl_common_param.php?action=setLiveType',{'state':status},function(msg){
			if(msg == "close_ok"){
				var info = "success";
				if(lang == "CH"){
					info = "关闭子码流成功";
				}
				alert(info);
				$("[name='liveType']").bootstrapSwitch('state', true);
			}
			else if(msg == "close_fail"){
				var info = "operation failed";//操作失败
				if(lang == "CH"){
					info = "关闭子码流失败";
				}
				alert(info);
				$("[name='liveType']").bootstrapSwitch('state', false);
			}
			else if(msg == "open_ok"){
				var info = "success";
				if(lang == "CH"){
					info = "开启子码流成功";
				}
				alert(info);
				$("[name='liveType']").bootstrapSwitch('state', false);
			}
			else if(msg == "open_fail"){
				var info = "operation failed";//操作失败
				if(lang == "CH"){
					info = "开启子码流失败";
				}
				alert(info);
				$("[name='liveType']").bootstrapSwitch('state', true);
			}
			else{
				var info = "Encountered an unknown error!";
				if(lang == "CH"){
					info = "遇到未知错误，操作未完成！";
				}
				alert(info);
			}
		});
	});

	/*设置音频状态上传服务器反馈内容*/
	$('input[name="Audio"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($('input[name="Audio"]').is(':checked')){
			var status = true;
		}else{
			var status = false;
		}
		$.post('ctl_common_param.php?action=setAudioState',{'state':status},function(msg){
			if(msg == "error"){
				var info = "operation failed";//操作失败
				if(lang == "CH"){
					info = "注意：开启音频未成功！";
				}
				alert(info);
				$('input[name=\"Audio\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "success"){
				var info = "success";//操作失败
				if(lang == "CH"){
					info = "开启音频成功！";
				}
				alert(info);
				$('input[name=\"Audio\"]').bootstrapSwitch('state', true);
			}
			else if(msg == "CloseAudio_ok"){
				var info = "success";//操作失败
				if(lang == "CH"){
					info = "关闭音频成功";
				}
				alert(info);
				$('input[name=\"Audio\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "param error"){
				var info = "Parameter passing wrong";
				if(lang == "CH"){
					info = "参数传递出错";
				}
				alert(info);
			}
			else{
				var info = "Encountered an unknown error!";
				if(lang == "CH"){
					info = "遇到未知错误，操作未完成！";
				}
				alert(info);
			}
		});
	});

	
	
	//设置WiFi上传服务器
	function Switch_ProcessWifi(event, state){
		if(beingprocessed == 1)
			return;

		
		if(operationParamWifi == 1 || operationParamWifi == 2)
		{
			operationParamWifi = 0;
			return;
		}

		beingprocessed = 1;

		if($("[name='WiFiState']").is(':checked'))
			status = true;
		else
			status = false;
		showdiv();
		$.ajax({
			type : "POST",
			url : "ctl_common_param.php?action=setWiFiState",
			data : {'state':status},
			async : false,
			success : function(msg){
				//showdiv();
				var countdown = 20;
				setInterval(function()
				{
					countdown --;
					if(countdown == 1)
					{
						//WiFi连接状态
						$.ajax({
							url : "func_common_param.php?action=GetWiFiState",
							type : 'POST',
							success : function(msg){
								if(msg >= 0){
									operationParamWifi = 0;
									operationParam4G = 2;		//非手动改变4G switch 状态
									
									$("[name='4Gstate']").bootstrapSwitch('state', status);
									var info = "success";//操作成功
									if(lang == "CH"){
										info = "设置成功";
									}
								}else{
									operationParamWifi = 1;		//wifi switch 状态修改失败

									$('input[name=\"WiFiState\"]').bootstrapSwitch('state', (status+1)%2);// (status+1)%2 与status值取反

									var info = "operation failed:"+msg;//操作失败
									if(lang == "CH"){
										info = "设置失败:"+msg;
									}
								}
								
								closediv();
								beingprocessed = 0;		//处理完成。修改处理状态
								alert(info);

							}
						});
					}
					
				},1000);
			}
		});
	}
	$('input[name="WiFiState"]').on('switchChange.bootstrapSwitch', Switch_ProcessWifi);

	
	//设置4G上传服务器
	function Switch_Process4G(event, state){
		if(beingprocessed == 1)
			return;

		if(operationParam4G == 1 || operationParam4G == 2){
			operationParam4G = 0;
			return;
		}

		beingprocessed = 1;
		
		if($("[name='4Gstate']").is(':checked')){
			status = true;
		}else{
			status = false;
		}
		showdiv();
		$.ajax({
			type : "POST",
			url : "ctl_common_param.php?action=set4GLinkState",
			data : {'state':status},
			async : false,
			success : function(msg){
				
				
				var countdown = 20;
				var iCount = setInterval(function()
				{

					countdown --;
					if(countdown == 1)
					{
						//4G连接状态
						$.ajax({
							url : "func_common_param.php?action=Get4GLinkState",
							
							type : 'POST',
							async : false,
							success : function(msg){
								clearInterval(iCount);
								if(msg >= 0){
									operationParam4G = 0;
									operationParamWifi = 2;		//非手动改变wifi switch 状态
									$('input[name=\"WiFiState\"]').bootstrapSwitch('state', status);

									var info = "success";//操作失败
									if(lang == "CH"){
										info = "设置成功";
									}
								}else{
									operationParam4G = 1;
									operationParamWifi = 1;
									$('input[name=\"WiFiState\"]').bootstrapSwitch('state', (status+1)%2);
									$('input[name=\"4Gstate\"]').bootstrapSwitch('state', status);
									var info = "operation failed,error info:" + msg;//操作失败
									if(lang == "CH"){
										info = "设置失败,错误信息:" + msg;
									}
								}
								closediv();
								beingprocessed = 0;
								alert(info);
							}
							
						});
					}
					
				},1000);
			}
		});
	}
	$('input[name="4Gstate"]').on('switchChange.bootstrapSwitch', Switch_Process4G);

	//登录调用目睹接口
	$("#loginlist").click(function(){
		$("#none").toggle();
	})
</script>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
		//登录接口传值调用
	$("#mddl").click(function(){
		var email = $("#mdemail").val();
		var password = $("#mdpassword").val();
		$.ajax({
				type:'post',
				url:"witness_lg.php",
				data:{email:email,password:password},
				dataType:'json',
				success:function(data){
					if (data == 102) {
						alert("不存在该用户,请重新输入");
					} else if (data == 103) {
						alert("密码错误,请重新输入");
					} else if (data == 101) {
						alert("参数错误,请重新输入");
					} else {
						// window.location.href="Channel.php?data="+data;
						alert(data)
					}			
				}
		})
	})
</script>
<?php
	$ret = GetDeviceID(); 
	if($ret['id']=="4439C4631B764439C4631B75")
	{
	echo '<script language="javascript">

		document.getElementById("tabsright1").style.display="block";
		document.getElementById("tabsright2").style.display="block";
	</script>'; 
									
	}
    else{
	echo '<script language="javascript">

		document.getElementById("encoder1").style.display="block";
		document.getElementById("encoder2").style.display="block";
	</script>'; 
	} 
?>