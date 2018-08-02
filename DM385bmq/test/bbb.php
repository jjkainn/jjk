<?php 
	include 'language.php';
//	include_once ("func_common_param.php");
//高级参数
	include_once ("func_advanced_param.php");
//	include_once ("func_wifi_param.php");
	include_once ("func_user_ctrl.php");
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
  </head>
  <?php
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
  ?>
  <body>
					<ul class="nav nav-tabs">
						<li>
							<a href="aaa.php"><?php echo $Lan_Main["Common"][$Language_Type];?></a>
						</li>
						<li  class="active">
							<a href="bbb.php"><?php echo $Lan_Main["Advanced"][$Language_Type];?></a>
						</li>
						<li>
							<a href="ccc.php"><?php echo $_Lan_Main["Orchestrator"[$Language_Type];?></a>
						</li>
						<li>
							<a href="ddd.php"><?php echo $Lan_Main["Wifi"][$Language_Type];?></a>
						</li>
					
					</ul>
					<div class="tab-content" style="text-align:center;">
				        <div class="tab-pane active" style="margin:0 auto;">
							<table style="text-align:center; margin-top:2em; line-height:4em;">
		<!-- 385编码器源类型 -------------------------------------------------------------------------------->
								<!--<tr><div>
									<td><span> <?php echo $Lan_Main["TypeofVideo"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="TypeofVideo" id="TypeofVideo" onchange="setVideoType(value)" disabled = 'true'>
											<option class="form-control" value=0 selected="selected">SDI</option>
											<option class="form-control" value=1>HDMI</option>
										</select>
									</td>
								</div></tr>
								<tr><div>
									<td><span> <?php echo $Lan_Main["CaptrueInfo"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<input type="text" id="captrueInfo" name="captrueInfo" class="form-control" readonly="readonly" value="1080P@60">
									</td>
								</div></tr>-->
		<!------------------------------------------------------------------------------------------------->
								<tr><div>
									<td><span><?php echo $Lan_Main["ImageFlip"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
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

								<!--视频主码流码率控制-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["MainControl"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="MainControl" onchange="setmaincontrol(value)">
											<option class="form-control" id="Main_Constra_CBR" value="1">CBR</option>
											<option class="form-control" id="Main_Constra_VBR" value="4">CVBR</option>		
										</select>
									</td>
									<script>
											function setmaincontrol(value){
												var maincontrol = value;
												$.post("ctl_advanced_param.php?action=setControl",{"Streamcontrol":maincontrol,"streamtype":0},function(msg){
													if(lang == 'CH'){
														var info = "主码流码率控制修改成功";
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
											RTMPreg = /^rtmp\:\/\/(.){1,}\:(.){1,}\/(.){1,}$/;
											var info = "rtmp stream format is not correct, please refer to the following format: rtmp://127.0.0.1:1935/live";
											if(!RTMPreg.test(serverIP)){
												if(lang == 'CH'){
													info = "RTMP流格式不正确，请参考以下格式：rtmp://127.0.0.1:1935/live";
												}
												alert(info);return;
											}
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

								<!--视频子码流码率控制-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["SubControl"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td>
										<select class="form-control" name="mainResolution" name="SubControl" id="SubControl" onchange="setsubcontrol(value)" disabled=true>
											<option class="form-control" id="Sub_Constra_CBR" value="1">CBR</option>
											<option class="form-control" id="Sub_Constra_VBR" value="4">CVBR</option>											
										</select>
									</td>
									<script>
										function setsubcontrol(value){
											var maincontrol = value;
											$.post("ctl_advanced_param.php?action=setControl",{"Streamcontrol":maincontrol,"streamtype":1},function(msg){
												if(lang == 'CH'){
													var info = "子码流码率控制修改成功";
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
											RTMPreg = /^rtmp\:\/\/(.){1,}\:(.){1,}\/(.){1,}$/;
											var info = "rtmp stream format is not correct, please refer to the following format: rtmp://127.0.0.1:1935/live";
											if(!RTMPreg.test(serverIP)){
												if(lang == 'CH'){
													info = "RTMP流格式不正确，请参考以下格式：rtmp://127.0.0.1:1935/live";
												}
												alert(info);return;
											}
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
								<!--设备描述符-->
								<tr><div>
									<td><span> <?php echo $Lan_Main["Orch_DevName"][$Language_Type];?>:</span> &nbsp;&nbsp;</td>
									<td><input type="text" name="orchDevName" id="orchDevName" class="form-control" placeholder="testapp" value="testapp" onchange="setorchDevName(value)"></td>
									<script>
										function setorchDevName(orchDevName){
											$.post("ctl_advanced_param.php?action=setorchName",{"orchDevName":orchDevName},function(msg){
												//alert(orchDevName);
												if(lang == 'CH'){
													var info = "设备描述符修改成功";
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
								<!--修改密码-->
								<tr>
									<div>
										<td>
											<span>
												<?php echo $Lan_Main["ChangePwd"][$Language_Type];?>:
											</span> &nbsp;&nbsp;
										</td>
										<td>
											<a id="modal-438186" href="#modal-container-438186" role="button" class="btn btn-info" data-toggle="modal"><?php echo $Lan_Main["ChangePwd"][$Language_Type];?>
											</a>
										</td>
										<div id="modal-container-438186" class="modal hide" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-header">
												 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
												<h3 id="myModalLabel">
													<?php echo $Lan_Main["ChangePwd"][$Language_Type];?>
												</h3>
											</div>
											<form action="ctl_advanced_param.php?action=change_user_pwd" name="change_pwd" method="post">
												<div class="modal-body">
													<div>
														<p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $Lan_Main["Orch_Username"][$Language_Type];?>：<input type="text" name="user_name" id="user_name" value="<?php echo $_SESSION['user']; ?>" readonly='true'></p>
														<p><?php echo $Lan_Main["USER_ENTERPWD"][$Language_Type];?>：<input type="text" type="text" name="user_enterpassword" id="user_enterpassword" placeholder="<?php echo $Lan_Main['USER_ENTERPASSWORD'][$Language_Type];?>" value="" required="required"></p>
														<p><?php echo $Lan_Main["USER_PASSWORD"][$Language_Type];?>：<input type="text" type="text" name="user_password" id="user_password" placeholder="<?php echo $Lan_Main['USER_PASSWORD'][$Language_Type];?>" value="" required="required"></p>
														<p><?php echo $Lan_Main["USER_ENTERPWDAGAIN"][$Language_Type];?>：<input type="text" type="text" name="user_enterpasswordagain" id="user_enterpasswordagain" placeholder="<?php echo $Lan_Main['USER_ENTERPASSWORDAGAIN'][$Language_Type];?>" value="" required="required"></p>
														<input type="hidden" id="changepwdpost" value="" />
													</div>
												</div>
												<div class="modal-footer">
													<button class="btn btn-primary" id="changeuser" type="button" onClick="ChangeUserInfo()"><?php echo $Lan_Common["SUBMIT"][$Language_Type];?></button>
												</div>
											</form>
											
										</div>
										<script type="text/javascript">
											function ChangeUserInfo(){
												var user_name = document.getElementById('user_name').value;
												var user_enterpassword = document.getElementById('user_enterpassword').value;
												var user_password = document.getElementById('user_password').value;
												var user_enterpasswordagain = document.getElementById('user_enterpasswordagain').value;
												if(user_enterpassword == '' || user_password == '' || user_enterpasswordagain == ''){
													if(lang == 'CH'){
														alert("表格不能为空");
													}else{
														alert("Form cannot be empty");
													}
												}else{
													if(user_enterpassword != ''){
															$.ajax({
																type : "POST",
																url  : "ctl_advanced_param.php?action=user_enterpwd",
																data : {"user_enterpassword":user_enterpassword,"user_name":user_name},
																async: false,
																success:function(msg){
																	data = msg;
																}
															});
															if(data<0){
																var info = "当前密码错误";
																if(lang == 'EN'){
																	var info = "You have the wrong password";
																}
																alert(info);
																return false;
															}
													}
													if(user_password != user_enterpasswordagain){
														if(lang == 'CH'){
															alert("两次输入的密码不一样");
														}else{
															alert("Two passwords are not the same");
														}
														return false;
													}
													document.change_pwd.submit();
												}
											}
										</script>
								</tr>
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
													var info = "Upgrade file format is not correct!";
													if(lang == 'CH'){
														info = "升级文件格式不正确!";
													}
													alert(info);
													return;
												}
												
												document.system_set.submit();
											}
											else
											{
												var info = "Click Browse, enter the path of the local upgrade file!";
												if(lang == 'CH'){
													info = "请点击浏览，输入本地升级文件的路径!";
												}
												alert(info);
											}
										}
									</script>
								</div></tr>
								</form>
							</table>
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
		
		//获取当前系统模式
		/*$ret = &getSystemMode();
		$systemMode = $ret['systemMode'];
		echo "<script>$('#systemMode').val(\"{$systemMode}\");</script>";*/

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
		
		/*echo("<script>
				var ChanLinkSrcContent = {$ret['ChanLinkSrc']};
				var ChanInputContent   = {$ret['ChanInput']};
				//alert(ChanLinkSrcContent);
				for(j=0;j<2;j++){
						if((ChanLinkSrcContent & (0x01 << j)) <=0){			//是否支持sdi >0 表支持SDI
							$('#TypeofVideo').val(1);
							break;
						}
						if(((ChanLinkSrcContent & 0xFF) >> (j+1)) == 0){
							$('#TypeofVideo').val(0);
							break;
						}
						
							/*if( (ChanLinkSrcContent & (0x01 << j)) > 0)			//支持sdi
							{
								if(ChanInputContent & (0x01 << j)) > 0)		//sdi 是否有源
								{
									$('#TypeofVideo').val(0);
								}
							}
							else if((ChanLinkSrcContent & (0x01 << j)) <=0)		//支持HDMI
							{
								if(ChanInputContent & (0x01 << j)) <= 0)		//HDMI 是否有源
								{
									$('#TypeofVideo').val(1);
								}
							}*
					}
				
		</script>");*/
		//$('#TypeofVideo').val(\"{$ret['ChanType']}\");
		//获取采集视频源信息
		/*$InPutVideo = Get380Sourceinput($ChanInput);
		if($InPutVideo["TYPE"] == 0)
		{
			$Type = "p";
		}
		else if($InPutVideo["TYPE"] == 1)
		{
			$Type = "i";
			$InPutVideo["height"] = $InPutVideo["height"] * 2;
		}
		
		$Resolution = $InPutVideo["width"]."*".$InPutVideo["height"].$Type;
		$FPS = $InPutVideo["FPS"];
		if($Resolution  == '0*0p' || $Resolution  == '0*0i'){
			echo("<script>
					var info = 'No Video Source';
					if(lang == 'CH'){
						info = '暂无视频源';
					}
					$('#captrueInfo').val(info);</script>");
		}else{
			$res = $Resolution. '@' . $FPS;
			echo("<script>$('#captrueInfo').val(\"{$res}\");</script>");
		}*/
			
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



		//视频主码流码率控制
		$ret = &getStreamcontrol($streamtype = 0);
		$Streamcontrol	= $ret['bitrate'];

		if ($Streamcontrol == '4'){   //Constra_VBR
			echo "<script>$('#Main_Constra_VBR').attr('selected','selected');</script>";
		}
		if($Streamcontrol  == '1'){	//Constra_CBR
			echo "<script>$('#Main_Constra_CBR').attr('selected','selected');</script>";
		}
		//视频子码流码率控制
		$ret = &getStreamcontrol($streamtype = 1);
		$Streamcontrol	= $ret['bitrate'];

		if ($Streamcontrol == '4'){   //Constra_VBR
			echo "<script>$('#Sub_Constra_VBR').attr('selected','selected');</script>";
		}
		if($Streamcontrol  == '1'){	//Constra_CBR
			echo "<script>$('#Sub_Constra_CBR').attr('selected','selected');</script>";
		}

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

			//WiFi连接状态
			$.ajax({
				url : "func_ajax_param.php?action=GetWiFiState",
				type : 'POST',
				success : function(msg){
					if (operationParamWifi == 1 || beingprocessed == 1)		//operationParamWifi = 1 失败   beingprocessed = 1 正在处理
						return;

				if($("[name='WiFiState']").is(':checked')){
					status = true;
				}else{
					status = false;
				}
				if(msg == status){	//如果网页中状态和设备返回状态一致 那么什么都不执行
				
				}else{
					operationParamWifi = 2;
					if(msg > 0)
						$("input[name='WiFiState']").bootstrapSwitch('state', true);
					else
						$("input[name='WiFiState']").bootstrapSwitch('state', false);
				}
				
			}
		});
								
		//4G连接状态
		$.ajax({
			url : "func_ajax_param.php?action=Get4GLinkState",
			type : 'POST',
			success : function(msg){
				if (operationParam4G == 1 || beingprocessed == 1)		//operationParam4G = 1 失败   beingprocessed = 1 正在处理
					return;

				//获取网页中状态
				if($("[name='4Gstate']").is(':checked')){
					status = true;
				}else{
					status = false;
				}
				if(msg == status){	//如果网页中状态和设备返回状态一致 那么什么都不执行
				
				}else{
					operationParam4G = 2;
					if(msg > 0)
						$("input[name='4Gstate']").bootstrapSwitch('state', true);
					else
						$("input[name='4Gstate']").bootstrapSwitch('state', false);
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

	/*设置音频状态*/
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

	
	
	//设置WiFi
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
							url : "func_ajax_param.php?action=GetWiFiState",
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

	
	//设置4G
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
							url : "func_ajax_param.php?action=Get4GLinkState",
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
</script>
