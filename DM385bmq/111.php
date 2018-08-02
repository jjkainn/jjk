<?php 
	include 'language.php';
	include_once ("func_common_param.php");
	include_once ("func_advanced_param.php");
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
    DD_belatedPNG.fix('#img1,#img2,#img3,#img4,.tabsright1,#img1-1,#img2-1,#img3-1,#img4-1,.logo,.nav2,.nav3,.li1,.li2,li3,li4');
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
	
	</head>
  <?php
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
  ?>
  <body style="overflow:-Scroll;overflow-x:hidden;margin: 0px auto;">
  	 <div style="margin: auto;">
  	
<!--导航2-->
                  
					
						<table style="text-align:left; line-height:4em;margin:auto;margin-top: 0.5em;">
		
		<!------------------------------------------------------------------------------------------------->
								
									<!--视频源接口类型-->
								  
								    
								    <!--<tr><div>
									<td><span> <?php echo $Lan_Main["TypeofVideo"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><input type="text" name="TypeofVideo" id="TypeofVideo" class="form-control" placeholder="testapp" value="testapp" onchange="setVideoType(value)"></td>
									<script>
										function setVideoType(orchDevName){
											$.post("ctl_advanced_param.php?action=setvideotypeName",{"orchDevName":orchDevName},function(msg){
												alert(orchDevName);
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
								</div></tr>-->
								
								<tr><div>
									<td><span style="color: #000000;"> <?php echo $Lan_Main["TypeofVideo"][$Language_Type];?><font class="f1">：</font></span> &nbsp;&nbsp;</td>
									<td><span style="color: #000000;">
										<?php 
											
											include_once ("func_sys_set.php"); 
											$ret = GetVideo(); 
//											echo $ret['version'];
											if($ret['version']==4){
												echo "HDMI";
											}
											if($ret['version']==3)
			                                    echo "SDI";
										?>
										</span>
									</td>
								</div></tr>
				
							</table>

  </body>
</html>
<?php

		
		//385编码器获取视频源类型
//		$ret = &GetChanInput();
//		
//		$ChanType = $ret['ChanType'];
//      
//		if ($ChanType == '0'){ 
//			echo 1;
//			echo "<script>$('#SDI').attr('selected','selected');</script>";
//		}
//		if($ChanType  == '1'){
//			echo 2;
//			echo "<script>$('#HDMI').attr('selected','selected');</script>";
//		}
		
//		//获取视频源类型
//		$ret = &getVideoName();
//		$orchDevName	= $ret['chan'];
//		 echo $orchDevName;
//		echo("<script>$('#TypeofVideo').val(\"{$orchDevName}\");</script>");
?>
<script src="js/waitWindow.js"></script>


