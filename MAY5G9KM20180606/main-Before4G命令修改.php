<?php 
	include 'language.php';
	include_once ("func_common_param.php");
	include_once ("func_advanced_param.php");
	include_once ("func_wifi_param.php");
	error_reporting(1);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
?>
<!DOCTYPE html>
<html>
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">    
	<meta name="description" content="">
    <meta name="author" content="MaZhiyu">
    <link rel="shortcut icon" href="./img/login_logo.gif">
	<title><?php echo $Lan_Common["TITLE"][$Language_Type]?></title>
	
	<script src="./js/jquery-1.7.2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script href="./js/placeholder.js"></script><!---->
	<script src="./js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
	<script src="./flowplayer/flowplayer.js"></script>
	<script src="./flowplayer/flowplayer-3.2.13.min.js"></script>

	<script src="./flowplayer/flowplayer.js"></script>
	<script src="./flowplayer/flowplayer.js"></script>

	
	<link href="./css/newbutton.css" rel="stylesheet">
    <link href="./css/bootstrap.css" rel="stylesheet">
	<!--<link href="./css/bootstrap3.0.3.css" rel="stylesheet">-->
	<link href="./css/bootstrap-responsive.css" rel="stylesheet">
    <link href="./css/focus.css" rel="stylesheet">		<!--访问速度慢是因为focus.css中用到了google字体-->
    <link href="./css/focus-responsive.css" rel="stylesheet">
	<link href="./js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="./flowplayer/skin/functional.css" />

	<style>
		body{background:#fff;}
	</style>
	<script type="text/javascript">
		flowplayer.conf = { live: true };
	</script>
	<script>
		function CheckSubVideo(subStatus){
			if(subStatus == true){//直播码流为主码流
				document.getElementById('subResolution').disabled = true;
				//document.getElementById('subMirrormode').disabled = true;
				document.getElementById('subRate').disabled = true;
				document.getElementById('subIframerate').disabled = true;
				document.getElementById('subServerIP').disabled = true;
				document.getElementById('subStreamName').disabled = true;
				document.getElementById('frameB').disabled = false;
			}else{//直播码流为子码流
				document.getElementById('subResolution').disabled = false;
				//document.getElementById('subMirrormode').disabled = false;
				document.getElementById('subRate').disabled = false;
				document.getElementById('subIframerate').disabled = false;
				document.getElementById('subServerIP').disabled = false;
				document.getElementById('subStreamName').disabled = false;
				document.getElementById('frameB').disabled = true;
				// 主码流B帧显示为0
				$("#frameB").val("0"); 	
				
			}
		}
	</script>
  </head>
  <?php
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
  ?>
  <body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<div class="tabbable" id="tabs-463037">
					<ul class="nav nav-tabs">
						<li class="active">
							<a href="#panel-471576" data-toggle="tab"><?php echo $Lan_Main["Common"][$Language_Type];?></a>
						</li>
						<li>
							<a href="#panel-47111" data-toggle="tab"><?php echo $Lan_Main["Advanced"][$Language_Type];?></a>
						</li>
						<li>
							<a href="#panel-47112" data-toggle="tab">Orchestrator</a>
						</li>
						<li>
							<a href="#panel-47113" data-toggle="tab"><?php echo $Lan_Main["Wifi"][$Language_Type];?></a>
						</li>
					</ul>
					<div class="tab-content" style="text-align:center;">
						<div class="tab-pane active" id="panel-471576" style="margin:0 auto;">
							<table style="text-align:center; margin-top:2em; line-height:4em;">
							<tr>
								<td></td>
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
												$path = "http://115.29.148.122/avst1/Public/evostreamms-1.6.3.2411-i686-Windows_2008/media/autoHLS/".$stream."/".$stream.".m3u8";
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
							<tr><div>
								<td><span> <?php echo $Lan_Main["Live"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="liveIsTurn" name='liveIsTurn' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100"/></td>
							<script>
								$("[name='liveIsTurn']").bootstrapSwitch();

								
							</script>
							</div></tr>
							<tr><div id="test">
								<td><span> <?php echo $Lan_Main["Record"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id='vodIsTurn' name='vodIsTurn' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100"/></td>
								<script>
									$("[name='vodIsTurn']").bootstrapSwitch();
								</script>
							</div></tr>
							<tr><div>
								<td><span> <?php echo $Lan_Main["StreamType"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="liveType" name='liveType' data-on-text="<?php echo $Lan_Main["STREAM_MAIN"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["STREAM_SUB"][$Language_Type];?>" data-handle-width="100"/></td>
								<script>
									$("[name='liveType']").bootstrapSwitch();
									$('input[name="liveType"]').on('switchChange.bootstrapSwitch', function(event, state){
										var status = state; // true | false
										CheckSubVideo(status);
									});
									
								</script>
							</div></tr>
							<tr><div>
								<td><span> <?php echo $Lan_Main["Audio"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="Audio" name='Audio' data-on-text="<?php echo $Lan_Common["ON"][$Language_Type];?>" data-off-text="<?php echo $Lan_Common["OFF"][$Language_Type];?>" data-handle-width="100"/></td>
							<script>
								$("[name='Audio']").bootstrapSwitch();
							</script>
							</div></tr>
							<!-- wifi 开关 -->
							<tr><div>
								<td><span> <?php echo $Lan_Main["WiFi"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
								<td><input type="checkbox" id="WiFiState" name='WiFiState' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="100"/></td>
							<script>
								$("[name='WiFiState']").bootstrapSwitch();

								$('input[name="WiFiState"]').on('switchChange.bootstrapSwitch', function(event, state){
										var status = state; // true | false
									});
							</script>
							</div></tr>

							<tr><div>
								<td><span> <?php echo $Lan_Main["4G"][$Language_Type];?></span> &nbsp;&nbsp;</td>
								<td></td>
									<tr><td><span><?php echo $Lan_Main["LinKState"][$Language_Type];?>：</span></td><td><input type="checkbox" id='4Gstate' name='4Gstate' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="100"/></td></tr>
									<tr><td><span><?php echo $Lan_Main["Signal"][$Language_Type];?>：</span></td>
									<td>
										<input type="text" id="signalStrength" name="signalStrength" class="form-control" placeholder="" readonly="readonly">
										<!--<div style="height:12px; background:#ebedef; border-radius:32px; box-shadow:none; position:relative; height:12px; padding:0; margin:0;cursor:pointer !important;">
												<div id="rrssi" style="line-height:12px; background:#1abc9c; width:10%;"></div>
											</div>-->
									</td></tr>
									<tr><td><span><?php echo $Lan_Main["carrier"][$Language_Type];?>：</span></td><td><input type="text" name="carrier" id="carrier" class="form-control" placeholder="" readonly="readonly"></td></tr>
									<tr><td><span><?php echo $Lan_Main["DataLeft"][$Language_Type];?>：</span></td><td><input type="text" name="dataRemaining" class="form-control" placeholder="" readonly="readonly"></td></tr>
								<script>
									$("[name='4Gstate']").bootstrapSwitch();

									$('input[name="4Gstate"]').on('switchChange.bootstrapSwitch', function(event, state){
									  //console.log(this); // DOM element  
									  //console.log(event); // jQuery event
										var status = state; // true | false

										//href = "ctl_common_param.php?action=set4GLinkState&status="+status;
										//window.location.href=href;
									});
								</script>
							</div></tr>
							<tr><div>
								<td><span> <?php echo $Lan_Main["EquState"][$Language_Type];?></span> &nbsp;&nbsp;</td>
								<td></td></tr>
									<tr><div>
									<td><span> <?php echo $Lan_Main["SystemMode"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="systemMode" id="systemMode" onchange="setSystemMode(value)">
											<!--<option class="form-control" value=0>睡眠模式</option>-->
											<option class="form-control" value=1><?php echo $Lan_Main["Charge"][$Language_Type];?></option>
											<option class="form-control" value=2 selected="selected"><?php echo $Lan_Main["Operating"][$Language_Type];?></option>
										</select>
									</td>
									<script>
										function setSystemMode(value){
											var systemMode = value;
											$.post("ctl_common_param.php?action=systemMode",{"systemMode":systemMode},function(msg){
												
												if(lang == 'CH'){
													var info = "系统模式修改成功";
													var errorInfo = "修改未成功";
												}else{
													var info = "seting System Mode done";
													var errorInfo = "seting System Mode failed";
												}
												if(msg == 1){
													alert(info);
												}else{
													alert(errorInfo);
												}
											});
										}
									</script>
								</div></tr>
									<tr><td><span> <?php echo $Lan_Main["StreamName"][$Language_Type];?>：</span></td><td><input type="text" id="liveName" name="liveName" class="form-control" placeholder="livestream1" readonly="readonly"></td></tr>
									<tr><td><span> <?php echo $Lan_Main["DataChannel"][$Language_Type];?>：</span></td><td>
									<!--<input type="checkbox" id="dataChannel" name='dataChannel' data-on-text="4G" data-off-text="WiFi" data-handle-width="100"/>-->
									<input type="text"  id="dataChannel" name='dataChannel' class="form-control" readonly="readonly">
									</td></tr>
									<tr><td><span><?php echo $Lan_Main["Battery"][$Language_Type];?>：</span></td><td><input type="text" name="batteryinfo" id="batteryinfo" class="form-control" placeholder="" readonly="readonly"></td></tr>
									<script>
										//$("[name='dataChannel']").bootstrapSwitch();
									</script>
							</div></tr>
								<td><span> <?php echo $Lan_Main["Storage"][$Language_Type];?></span> &nbsp;&nbsp;</td>
								<td>
									<tr><td><span> <?php echo $Lan_Main["StoreFREE"][$Language_Type];?>:</span> &nbsp;&nbsp;</td><td><input type="text" id="freeSpace" name="freeSpace" class="form-control" readonly="readonly"></td></tr>
									<tr><td><span> <?php echo $Lan_Main["StoreUsed"][$Language_Type];?>:</span> &nbsp;&nbsp;</td><td><input type="text" id="usedSpace" name="usedSpace" class="form-control" readonly="readonly"></td></tr>
								</td>
							</div></tr>
							</table>
						</div>
						<div class="tab-pane" id="panel-47111" style="margin:0 auto;">
							<table style="text-align:center; margin-top:2em; line-height:4em;">
								<tr><div>
									<td><span> <?php echo $Lan_Main["ImageFlip"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="mainMirrormode" id="mainMirrormode" onchange="setmainMirrormode(value)">
											<option class="form-control" value=0 selected="selected"><?php echo $Lan_Common["OFF"][$Language_Type];?></option>
											<option class="form-control" value=1><?php echo $Lan_Main["Horizontal"][$Language_Type];?></option>
											<option class="form-control" value=2><?php echo $Lan_Main["Vertical"][$Language_Type];?></option>
											<option class="form-control" value=3><?php echo $Lan_Main["Totally"][$Language_Type];?></option>
										</select>
									</td>
									<script>
										function setmainMirrormode(value){
											var mainMirrormode = value;
											$.post("ctl_advanced_param.php?action=setMirrormode",{"mirrormode":mainMirrormode,"streamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "图像翻转设置成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainResolution"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="mainResolution" id="mainResolution" onchange="setmainResolution(value)">
											<option class="form-control" value=0>1080P</option>
											<option class="form-control" value=1>720P</option>
											<option class="form-control" value=2 selected="selected">360P</option>
										</select>
									</td>
									<script>
										function setmainResolution(value){
											var mainResolution = value;
											$.post("ctl_advanced_param.php?action=setResolution",{"resolution":mainResolution,"streamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "主码流分辨率修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainRate"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="mainRate" id="mainRate" class="form-control" placeholder="100 - 4000" value="500" onchange="setMainRate(value)"></td>
									<script>
										function setMainRate(value){
											var mainRate = value;
											var videostd = $("#mainResolution").val();
											$.post("ctl_advanced_param.php?action=setRate",{"rate":mainRate,"videostd":videostd,"streamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "主码流码率修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "参数错误";
													var error2Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Parameter error";
													var error2Info = "Modification is not successful";
												}
												if(msg == 1){
													alert(info);
												}else if(msg == 'error'){
													alert(errorInfo);
												}else if(msg == -1){
													alert(error1Info);
												}
												else{
													alert(error2Info);
												}
											});
										}
									</script>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainFrameInterval"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="mainIframerate" id="mainIframerate" class="form-control" placeholder="0 - 90" value="30" onchange="setMainIframerate(value)"></td>
									<script>
										function setMainIframerate(value){
											var mainIframerate = value;
											var videostd = $("#mainResolution").val();
											$.post("ctl_advanced_param.php?action=setIframerate",{"iframerate":mainIframerate,"videostd":videostd,"streamtype":0}, function(msg){
												if(lang == 'CH'){
													var info = "主码流关键帧间隔修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainStreamPath"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="mainServerIP" id="mainServerIP" class="form-control" placeholder="rtmp://127.0.0.1:1935/live" value="rtmp://127.0.0.1:1935/live" onchange="setMainServerIP(value)"></td>
									<script>
										function setMainServerIP(serverIP){
											//var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
											$.post("ctl_advanced_param.php?action=setServerIP",{"serverIP":serverIP,"streamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "主码流服务器地址修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainStreamName"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="mainStreamName" id="mainStreamName" class="form-control" placeholder="livestream1" value="livestream1" onchange="setmainStreamName(value)"></td>
									<script>
										function setmainStreamName(streamName){
											$.post("ctl_advanced_param.php?action=setStreamName",{"streamName":streamName,"steamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "主码流流名修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<!--主码流B帧-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["B-Frame"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="frameB" id="frameB" onchange="setframeB(value)">
											<option class="form-control" value=0 selected="selected"><?php echo $Lan_Common["OFF"][$Language_Type];?></option>
											<option class="form-control" value=1>1</option>
											<option class="form-control" value=2>2</option>
										</select>
									</td>
									<script>
										function setframeB(value){
											var frameB = value;
											$.post("ctl_advanced_param.php?action=setFrame",{"streamtype":0,"frameType":'7',"frameB":frameB,},function(msg){
												if(lang == 'CH'){
													var info = "B帧修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubResolution"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="subResolution" id="subResolution" onchange="setSubResolution(value)" disabled=true><!--480p 320p 240p-->
											<option class="form-control" value=0>720*576P</option>
											<option class="form-control" value=1>720*480P</option>
											<option class="form-control" value=2>640*360P</option>
											<option class="form-control" value=3>352*288P</option>
											<option class="form-control" value=4>320*240P</option>
										</select>
									</td>
									<script>
										function setSubResolution(value){
											var subResolution = value;
											$.post("ctl_advanced_param.php?action=setResolution",{"resolution":subResolution,"streamtype":1},function(msg){
												if(lang == 'CH'){
													var info = "子码流分辨率修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<!--<tr><div>
									<td><span> 图像翻转:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="subMirrormode" id="subMirrormode" onchange="setsubMirrormode(value)"  disabled=true>
											<option class="form-control" value=0 selected="selected">关闭</option>
											<option class="form-control" value=1>水平翻转</option>
											<option class="form-control" value=2>垂直翻转</option>
											<option class="form-control" value=3>完全翻转</option>
										</select>
									</td>
									<script>
										function setsubMirrormode(value){
											var subMirrormode = value;
											$.post("ctl_advanced_param.php?action=setMirrormode",{"mirrormode":subMirrormode,"streamtype":1},function(msg){
												if(msg == 1){
													alert("子码流图像翻转设置成功");
												}else if(msg == 'error'){
													alert("修改未成功，请检查参数");
												}else{
													alert("未能修改成功");
												}
											});
										}
									</script>
								</div></tr>-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubRate"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="subRate" id="subRate" class="form-control" placeholder="100 - 4000" value="500" onchange="setSubRate(value)" disabled=true></td>
									<script>
										function setSubRate(value){
											var subRate = value;
											var videostd = $("#subResolution").val();
											$.post("ctl_advanced_param.php?action=setRate",{"rate":subRate,"videostd":videostd,"streamtype":1},function(msg){
												if(lang == 'CH'){
													var info = "子码流码率修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubFrameInterval"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="subIframerate" id="subIframerate" class="form-control" placeholder="0 - 90" value="30" onchange="setSubIframerate(value)" disabled=true></td>
									<script>
										function setSubIframerate(value){
											var subIframerate = value;
											var videostd = $("#subResolution").val();
											$.post("ctl_advanced_param.php?action=setIframerate",{"iframerate":subIframerate,"videostd":videostd,"streamtype":1}, function(msg){
												if(lang == 'CH'){
													var info = "子码流关键帧间隔修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubStreamPath"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="subServerIP" id="subServerIP" class="form-control" placeholder="127.0.0.1" value="127.0.0.1" onchange="setSubServerIP(value)" disabled=true></td>
									<script>
										function setSubServerIP(serverIP){
											//var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
											$.post("ctl_advanced_param.php?action=setServerIP",{"serverIP":serverIP,"streamtype":1},function(msg){
												if(lang == 'CH'){
													var info = "子码流服务器地址修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubStreamName"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="subStreamName" id="subStreamName" class="form-control" placeholder="livestream1_1" value="livestream1_1" onchange="setsubStreamName(value)" disabled=true></td>
									<script>
										function setsubStreamName(streamName){
											$.post("ctl_advanced_param.php?action=setStreamName",{"streamName":streamName,"streamtype":1},function(msg){
												if(lang == 'CH'){
													var info = "子码流流名修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<!--TS 流-->
								<tr>
									<td><?php echo $Lan_Main["TS"][$Language_Type];?></td>
									<td><span id="TSinfo"></span></td>
								</tr>
								<tr><div>
									<td><span><?php echo $Lan_Main["TSPath"][$Language_Type];?></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="TSpath" id="TSpath" class="form-control" placeholder="127.0.0.1" value="127.0.0.1" onchange="setTSpath(value)"></td>
									<script>
										function setTSpath(TSpath){
											//var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
											$.post("ctl_advanced_param.php?action=setTS",{"TSpath":TSpath},function(msg){
												if(lang == 'CH'){
													var info = "TS流修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<tr><div>
									<td><span> <?php echo $Lan_Main["TSPort"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="TS_port" id="TS_port" class="form-control" placeholder="3000" value="3000" onchange="setTSport(value)"></td>
									<script>
										function setTSport(TS_port){
											//var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/;
											$.post("ctl_advanced_param.php?action=setTS",{"TS_port":TS_port},function(msg){
												if(lang == 'CH'){
													var info = "TS流修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<!--设备版本号-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["Equipment Version"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><span class="param_standardvalue"><?php include_once ("func_sys_set.php"); $ret = GetVersion(); echo $ret['version'] ?></span></td>
								</div></tr>
								<!--升级-->
								<form id="system_set" name="system_set" action="upload_file.php" method="post" enctype="multipart/form-data">
								<tr><div>
									<td><span> <?php echo $Lan_Main["Upgrede File"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="file" value="" id="file" name="file" class="form-control"></td>
								</div></tr>
								<tr><div>
									<td><span></span> &nbsp;&nbsp;</td>
									<td><a href="#" onClick="javascript:openLocalFileDialog(); return true;"  class="btn btn-success"><?php echo $Lan_Main["Upgrede"][$Language_Type];?></a></td>
									<script>
										function lastname(filepath)
										{
											//为了避免转义反斜杠出问题，这里将对其进行转换
											var re = /(\\+)/g;
											var filename=filepath.replace(re,"#");
											//对路径字符串进行剪切截取
											var one=filename.split("#");
											//获取数组中最后一个，即文件名
											var two=one[one.length-1];
											//再对文件名进行截取，以取得后缀名
											var three=two.split(".");
											 //获取截取的最后一个字符串，即为后缀名
											var last=three[three.length-1];
											
											return last;			
										}

										function openLocalFileDialog()
										{
											var fileInput=$("#file");
											//alert(fileInput);
											var path = fileInput.val();
											if(path)
											{
												var last = lastname(path);
												if(last != "bin")
												{
													alert("升级文件格式不正确!");
													return;
												}
												
												document.system_set.submit();
											}
											else
											{
												alert("请点击浏览，输入本地升级文件的路径!");
											}
										}
									</script>
								</div></tr>
								</form>
							</table>
						</div>
						<div class="tab-pane" id="panel-47112" style="margin:0 auto;">
							<table style="text-align:center; margin-top:2em; line-height:4em;">
								<!--注册设备
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_State"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
									<select class="form-control" name="RegisterCamera" id="RegisterCamera" onchange="RegisterCamera(value)">
											<option class="form-control" value=0 selected="selected"><?php echo $Lan_Common["OFF"][$Language_Type];?></option>
											<option class="form-control" value=1>Nokia</option>
										</select>
									</td>
									<script>
										function RegisterCamera(value){
											var RegisterCamera = value;
											$.post("ctl_advanced_param.php?action=RegisterCamera",{"RegisterCamera":RegisterCamera,},function(msg){
												if(lang == 'CH'){
													var info = "推送设备成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
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
								<!--设备版本号-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_State"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="checkbox" id="OrchState" name='OrchState' data-on-text="<?php echo $Lan_Main["Connection"][$Language_Type];?>" data-off-text="<?php echo $Lan_Main["Disconnect"][$Language_Type];?>" data-handle-width="100"/></td>
								<script>
									$("[name='OrchState']").bootstrapSwitch();
								</script>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Username"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="username" id="username" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Password"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="password" id="password" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_DevID"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="DevID" id="DevID" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_DevName"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="DevName" id="DevName" class="form-control" placeholder="" value=""></td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_Url"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
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
						<div class="tab-pane" id="panel-47113" style="text-align:center;">
							<table class="table" style="margin-top:2em; width:80%;" align="center">
							<a class="btn btn-lg btn-success" href="javascript:location.reload();"><?php echo $Lan_Main["RefreshWifiList"][$Language_Type];?></a>
								<thead>
									<tr>
										<td><?php echo $Lan_Main["WifiID"][$Language_Type];?></td>
										<td>SSID</td>
										<td><?php echo $Lan_Main["Signal"][$Language_Type];?></td>
										<td><?php echo $Lan_Main["Encryption"][$Language_Type];?></td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td><h4><?php echo $Lan_Main["UsingWLAN"][$Language_Type];?></h4></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<?php 
										$ret = getWifiConnNode();
									?>
									<tr>
										<td>0</td>
										<td><?php echo $ret['SSID'];?></td>
										<td><?php 
												if($ret['rank'] == 0)
												{
											?>
													<img src="img/wifi0.png" width='20' height='20'>
											<?php
												}
												else if($ret['rank'] == 1)
												{
											?>
													<img src="img/wifi2.png" width='20' height='20'>
											<?php
												}
												else if($ret['rank'] == 2)
												{
											?>
													<img src="img/wifi3.png" width='20' height='20'>
											<?php
												}
												else if($ret['rank'] == 3)
												{
											?>
													<img src="img/wifi4.png" width='20' height='20'>
											<?php
												}
												else if($ret['rank'] == 4)
												{
											?>
													<img src="img/wifi5.png" width='20' height='20'>
											<?php	
												}
												else if($ret['rank'] == 5)
												{
											?>
													<img src="img/wifi5.png" width='20' height='20'>
											<?php	
												}
												else{
											?>
													<img src="img/wifi0.png" width='20' height='20'>
											<?php
												}
											?>
											<!--	进度条
											<div style="height:12px; background:#ebedef; border-radius:32px; box-shadow:none; position:relative; height:12px; padding:0; margin:0;cursor:pointer !important;">
												<div style="line-height:12px; background:#1abc9c; box-shadow:none;width:<?php $signal = $ret['rank']; echo $signal/5*100?>%;"></div>
											</div>-->
										</td>
										<td><?php //echo $ret['encypt'];
												if ($ret['encypt'] == 'NULL'){
													echo $Lan_Main["Unencrypted"][$Language_Type];
												}else{
													echo $ret['encypt'];
												}
											?></td>
									</tr>
									<tr>
										<td></td>
										<td><h4><?php echo $Lan_Main["NearbyWLAN"][$Language_Type];?></h4></td>
										<td></td>
										<td></td>
										<td></td>
									</tr>
								<?php
									$wifiList = &getWifiScanList(10);
									echo iconv("GB2312","UTF-8",'中文');
									//var_dump($wifiList);
									$wifiNum = $wifiList['Num'];
									for($i=0;$i<$wifiNum;$i++){
								?>
								
									<tr class="success" style="height:3em;">
										<td>
											<?php echo $i+1;?>
										</td>
										<td>
											<a id="modal-43898<?php echo $i;?>" href="#modal-container-43898<?php echo $i;?>" data-toggle="modal">
												<?php echo $wifiList[$i]['SSID'];?>
											</a>
										</td>
										<td>
											<?php 
												if($wifiList[$i]['rank'] == 0)
												{
											?>
													<img src="img/wifi0.png" width='20' height='20'>
											<?php
												}
												else if($wifiList[$i]['rank'] == 1)
												{
											?>
													<img src="img/wifi1.png" width='20' height='20'>
											<?php
												}
												else if($wifiList[$i]['rank'] == 2)
												{
											?>
													<img src="img/wifi2.png" width='20' height='20'>
											<?php
												}
												else if($wifiList[$i]['rank'] == 3)
												{
											?>
													<img src="img/wifi3.png" width='20' height='20'>
											<?php
												}
												else if($wifiList[$i]['rank'] == 4)
												{
											?>
													<img src="img/wifi4.png" width='20' height='20'>
											<?php
												}
												else if($wifiList[$i]['rank'] == 5)
												{
											?>
													<img src="img/wifi5.png" width='20' height='20'>
											<?php	
												}
												else{
											?>
													<img src="img/wifi0.png" width='20' height='20'>
											<?php
												}
											?>
										</td>
										<td>
											<?php 
												if ($wifiList[$i]['encypt'] == 'NULL'){
													echo $Lan_Main["Unencrypted"][$Language_Type];
												}else{
													echo $wifiList[$i]['encypt'];
												}
											;?>
										</td>
									</tr>
									<div id="modal-container-43898<?php echo $i;?>" class="modal hide" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-header">
											<h3 id="myModalLabel"><?php echo $Lan_Main["WIFIConnection"][$Language_Type];?></h3>
										</div>
										<div class="modal-body" style=" margin-left:0;">
											<span style="margin-left:0px;">SSID：</span>
											<span><?php echo $wifiList[$i]['SSID'];?></span><br>
											<span style=""><?php echo $Lan_Main["Encryption"][$Language_Type];?>：</span>
											<span>
											<?php
												if ($wifiList[$i]['encypt'] == 'NULL'){
											?>
													<span><?php echo $Lan_Main["Unencrypted"][$Language_Type];?></span><br>
											<?php
												}else{
											?>
													<span><?php echo $wifiList[$i]['encypt'];?></span><br>
											<?php
												}
											?>
											</tr>
											<form action='ctl_wifi_param.php?action=WifiConnect' method='post'>
												<input type="hidden" name="wifiSSID" value="<?php echo $wifiList[$i]['SSID'];?>">
												<input type="hidden" name="wifiencypt" value="<?php echo $wifiList[$i]['encypt'];?>">
												<?php if($wifiList[$i]['encypt'] !== 'NULL'){?>
												<span><?php echo $Lan_Main["WifiPwd"][$Language_Type];?>：</span>
												<span><input type="password" name="wifiPWD" class="form-control"/></span><br>
											<?php }?>
										</div>
										<div class="modal-footer">
											 <button class="btn" data-dismiss="modal" aria-hidden="true"><?php echo $Lan_Common["OFF"][$Language_Type];?></button> <input type='submit' class="btn btn-primary" value='<?php echo $Lan_Main["Connection"][$Language_Type];?>'/>
										</div>
										</form>
									</div>
								<?php
									}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
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
		
		//获取当前系统模式
		$ret = &getSystemMode();
		//var_dump($ret);
		$systemMode = $ret['systemMode'];
		echo "<script>$('#systemMode').val(\"{$systemMode}\");</script>";

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

		//获取直播流名
		$chan = getMediaStreamType();
		$chanNo = $chan['chanNO'];
		$media =& GetMediaPara('RTMP',$chanNo,0);
		if($media['port'] == -1){
			$media['port'] = "暂无直播流";
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
			$media['port'] = "暂无直播流";
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
	//高级参数
		//视频主码流分辨率
		$ret = &GetVideoCapture($streamtype=0);
		if($ret['videoStd'] == '1920*1080'){
			$mainResolution = 0;
			echo "<script>$('#mainResolution').val(\"{$mainResolution}\");</script>";
		}
		else if($ret['videoStd'] == '1280*720'){
			$mainResolution = 1;
			echo "<script>$('#mainResolution').val(\"{$mainResolution}\");</script>";
		}
		else if($ret['videoStd'] == '640*360'){
			$mainResolution = 2;
			echo "<script>$('#mainResolution').val(\"{$mainResolution}\");</script>";
		}else{
			$mainResolution = 3;
			echo "<script>$('#mainResolution').val(\"2\");</script>";
		}
		
		//图像翻转
		//0 正常	1左右 		2 上下		3 上下+左右
		$mainMirrormode = $ret['mirrormode'];
		echo "<script>$('#mainMirrormode').val(\"{$mainMirrormode}\");</script>";
		
		//视频主码流码率、关键帧间隔
		$ret = &GetVideoParam($streamtype=0);
		$mainRate	= $ret['bitrate'];
		$iframerate = $ret['iframerate'];
		echo "<script>$('#mainRate').val(\"{$mainRate}\");</script>";
		echo "<script>$('#mainIframerate').val(\"{$iframerate}\");</script>";

		//视频子码流分辨率
		$ret = &GetVideoParam($streamtype=1);
		if($ret['videostd'] == '720*576'){
			$subResolution = 0;
			echo "<script>$('#subResolution').val(\"{$subResolution}\");</script>";
		}
		else if($ret['videostd'] == '720*480'){
			$subResolution = 1;
			echo "<script>$('#subResolution').val(\"{$subResolution}\");</script>";
		}
		else if($ret['videostd'] == '640*360'){
			$subResolution = 2;
			echo "<script>$('#subResolution').val(\"{$subResolution}\");</script>";
		}
		else if($ret['videostd'] == '352*288'){
			$subResolution = 3;
			echo "<script>$('#subResolution').val(\"{$subResolution}\");</script>";
		}
		else if($ret['videostd'] == '320*240'){
			$subResolution = 4;
			echo "<script>$('#subResolution').val(\"{$subResolution}\");</script>";
		}else{
			$subResolution = 2;
			echo "<script>$('#subResolution').val(\"2\");</script>";
		}

		//图像翻转
		$subMirrormode = $ret['mirrormode'];
		echo "<script>$('#subMirrormode').val(\"{$subMirrormode}\");</script>";
		
		//视频子码流码率、关键帧间隔
		$ret = &GetVideoParam($streamtype=1);
		$subRate		= $ret['bitrate'];
		$subIframerate	= $ret['iframerate'];
		echo "<script>$('#subRate').val(\"{$subRate}\");</script>";
		echo "<script>$('#subIframerate').val(\"{$subIframerate}\");</script>";

		//主码流服务器地址
		$chanNo = 0;
		$ret = &GetMediaPara("RTMP",$chanNo,$streamtype=0);
		$path = $ret['path'];
		//$serverIPtmp = substr($path,strpos($path,"//")+2);
		//$n = strpos($serverIPtmp,':');
		//$mainServerIP = substr($serverIPtmp,0,$n);
		echo "<script>$('#mainServerIP').val(\"{$path}\");</script>";

		//子码流服务器地址
		$ret = &GetMediaPara("RTMP",$chanNo,$streamtype=1);
		$path = $ret['path'];
		//$serverIPtmp = substr($path,strpos($path,"//")+2);
		//$n = strpos($serverIPtmp,':');
		//$subServerIP = substr($serverIPtmp,0,$n);
		echo "<script>$('#subServerIP').val(\"{$path}\");</script>";

		//获取主码流B帧
		$ret = getFrameInfo($streamtype=0,$frameType = 7);
		$frameCount = $ret['frameCount'];
		echo "<script>$('#frameB').val(\"{$frameCount}\");</script>";
		//获取子码流B帧
		$ret = getFrameInfo($streamtype=1,$frameType = 7);
		//$frameCount = $ret['frameCount'];
		//echo "<script>$('#SubframeB').val(\"{$frameCount}\");</script>";
		
		//
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
<script>
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
			if(ajaxflag == false){
				return;
			}

			//WiFi连接状态
			$.ajax({
				url : "func_ajax_param.php?action=GetWiFiState",
				type : 'POST',
				success : function(msg){
					if(msg > 0){
						$('input[name=\"WiFistate\"]').bootstrapSwitch('state', true);
					}else{
						$('input[name=\"WiFistate\"]').bootstrapSwitch('state', false);
					}
				}
			});

				//4G连接状态
				$.ajax({
					url : "func_ajax_param.php?action=Get4GLinkState",
					type : 'POST',
					success : function(msg){
						if(msg > 0){
							$('input[name=\"4Gstate\"]').bootstrapSwitch('state', true);
						}else{
							$('input[name=\"4Gstate\"]').bootstrapSwitch('state', false);
						}
					}
				});
				//4GIP信息
				$.ajax({
					url : "func_ajax_param.php?action=GetIP4GProperty",
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
			url : "func_ajax_param.php?action=Getbatteryinfo",
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
		//console.log(this); // DOM element
		//console.log(event); // jQuery event
		//var status = state; // true | false
		if($('input[name="liveIsTurn"]').is(':checked')){
			var status = true;
		}else{
			var status = false;
		}
		$.post('ctl_common_param.php?action=setLiveState',{'state':status},function(msg){
			if(msg == "error"){
				alert("注意：开启直播未成功！");
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "success"){
				alert("开启直播成功");
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', true);
			}
			else if(msg == "stoplive_ok"){
				alert("关闭直播成功");
				$('input[name=\"liveIsTurn\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "param error"){
				alert("参数传递出错");
			}
			else{
				alert("遇到未知错误，操作未完成！");
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
				alert("没有内存卡，无法录像");
				$("[name='vodIsTurn']").bootstrapSwitch('state', false);
			}
			else if(msg == "handrecord_ok"){
				alert("录像成功");
				$("[name='vodIsTurn']").bootstrapSwitch('state', true);
			}
			else if(msg == "stoprecord_ok"){
				alert("结束录像");
				$("[name='vodIsTurn']").bootstrapSwitch('state', false);
			}
			else{
				alert("遇到未知错误，操作未完成！");
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
				alert("关闭子码流成功");
				$("[name='liveType']").bootstrapSwitch('state', true);
			}
			else if(msg == "close_fail"){
				alert("关闭子码流失败");
				$("[name='liveType']").bootstrapSwitch('state', false);
			}
			else if(msg == "open_ok"){
				alert("开启子码流成功");
				$("[name='liveType']").bootstrapSwitch('state', false);
			}
			else if(msg == "open_fail"){
				alert("开启子码流失败");
				$("[name='liveType']").bootstrapSwitch('state', true);
			}
			else{
				alert("遇到未知错误，操作未完成！");
			}
		});
	});

	/*设置音频状态*/
	$('input[name="Audio"]').on('switchChange.bootstrapSwitch', function(event, state){

		if($('input[name="Audio"]').is(':checked')){
			var status = true;
		}else{
			var status = false;
		}
		$.post('ctl_common_param.php?action=setAudioState',{'state':status},function(msg){
			if(msg == "error"){
				alert("注意：开启音频未成功！");
				$('input[name=\"Audio\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "success"){
				alert("开启音频成功");
				$('input[name=\"Audio\"]').bootstrapSwitch('state', true);
			}
			else if(msg == "CloseAudio_ok"){
				alert("关闭音频成功");
				$('input[name=\"Audio\"]').bootstrapSwitch('state', false);
			}
			else if(msg == "param error"){
				alert("参数传递出错");
			}
			else{
				alert("遇到未知错误，操作未完成！");
			}
		});
	});

	//设置WiFi
	$('input[name="WiFiState"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($("[name='WiFiState']").is(':checked')){
			status = true;
		}else{
			status = false;
		}
		//alert(status);return;
		$.ajax({
			type : "POST",
			url : "ctl_common_param.php?action=setWiFiState",
			data : {'state':status},
			async : true,
			success : function(msg){
				if(msg == 1){
					alert("设置成功");
				}else{
					alert("设置失败");
				}
			}
		});
	});

	//设置4G
	$('input[name="4Gstate"]').on('switchChange.bootstrapSwitch', function(event, state){
		if($("[name='4Gstate']").is(':checked')){
			status = true;
		}else{
			status = false;
		}
		$.ajax({
			type : "POST",
			url : "ctl_common_param.php?action=set4GLinkState",
			data : {'state':status},
			async : true,
			success : function(msg){
				/*if(msg == 1){
					alert("4G连接成功");
					$("[name='4Gstate']").bootstrapSwitch('state', true);
				}
				else if(msg == 2){
					alert("4G连接失败");
					$("[name='4Gstate']").bootstrapSwitch('state', false);
				}
				else if(msg == 3){
					alert("断开4G成功");
					$("[name='4Gstate']").bootstrapSwitch('state', false);
				}
				else if(msg == 4){
					alert("断开4G失败");
					$("[name='4Gstate']").bootstrapSwitch('state', true);
				}*/
				if(msg == 1){
					alert("设置成功");
				}else{
					alert("设置失败");
				}
			}
		});
	});

	function setLiveState(){
	}

	function setVodState(){
	}

	function setLiveType(){
	}

	//判断是否支持H.264解码
	/*var myVid=document.createElement('video');
	var isSupp = myVid.canPlayType('video/mp4');
	alert(isSupp);
	//添加重启server命令：$SE->SendCmdAction(RestartApp('MEDIA_SET'));
	*/
</script>

