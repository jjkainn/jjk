<?php
	include_once("func_advanced_param.php");
	include_once("func_common_param.php");
	include_once("language.php");
	include_once("func_user_ctrl.php");
	error_reporting(E_ERROR);
	header("content-type:text/html; charset=utf-8");

	if(isset($_GET)){
		if($_GET['action'] == 'setResolution'){
			setResolution();
		}
		if($_GET['action'] == 'setRate'){
			setRate();
		}
		if($_GET['action'] == 'setIframerate'){
			setIframerate();
		}
		if($_GET['action'] == 'setServerIP'){
			setServerIP();
		}
		if($_GET['action'] == 'setStreamName'){
			setStreamName();
		}
		if($_GET['action'] == 'setMirrormode'){
			setMirrormode();
		}
		if($_GET['action'] == 'setFrame'){
			setFrame();
		}
		if($_GET['action'] == 'setTS'){
			setTS();
		}
		if($_GET['action'] == 'setmediaOrch'){
			setmediaOrchParam();
		}
		//主/子码流码率控制
		if($_GET['action'] == 'setControl'){
			setControl();
		}
		//修改描述符
		if($_GET['action'] == 'setorchName'){
			setorchName();
		}
		//修改密码
		if($_GET['action'] == 'change_user_pwd'){
			change_user_pwd();
		}
		//修改密码中当前密码验证
		if($_GET['action'] == 'user_enterpwd'){
			user_enterpwd();
		}
//		if($_GET['action'] == 'GetChanInput'){
//			GetChanInput();
//		}
//修改视频源
		if($_GET['action'] == 'setvideotypeName'){
			setvideotypeName();
		}
	}
	//修改密码中当前密码验证
	function user_enterpwd(){
		$user_name  = clean($_POST['user_name'], 20);
		$user_pwd   = md5($_POST['user_enterpassword']);
		$ret = check_valid_user($user_name,$user_pwd);
		echo $ret;
	}
	
	//修改密码
	function change_user_pwd()
	{
		$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
		$posts         = $_POST;
		$user_name     = $posts['user_name'];
		$user_password = $posts['user_password'];
		if($Language_Type == 'CH'){
			$lang = '密码修改成功';
		}else{
			$lang = 'Successfully changed password';
		}
		if($Language_Type == 'CH'){
			$langerror = '密码修改错误';
		}else{
			$langerror = 'Password change failed';
		}
		if(isset($user_name,$user_password)){
			$ret = &ChangeUserPwd($user_name,$user_password);
			if($ret>=0){
				$_SESSION['user'] = '';
				echo "<script>alert(\"$lang\");window.location.href='./index.php';</script>";
			}else{
				echo "<script>alert(\"$langerror\");history.go(-1);</script>";
			}
		}
	}

	//设置码流分辨率
	function setResolution(){
		if(isset($_POST['resolution'],$_POST['streamtype'])){
			$resolution = $_POST['resolution'];
			$streamtype = $_POST['streamtype'];
			//子码流分辨率
			if($streamtype == 1){
				if($resolution == 0){
					$resolution = "720*576";
				}
				else if($resolution == 1){
					$resolution = "720*480";
				}
				else if($resolution == 2){
					$resolution = "640*360";
				}else if($resolution == 3){
					$resolution = "352*288";
				}else{
					$resolution = "320*240";
				}
				
				$getvalue	= GetVideoParam($streamtype);
				$framerate		= $getvalue["fps"];			//framerate 帧率
				$ratecontrol	= $getvalue["ratecontrol"];
				$bitrate		= $getvalue["bitrate"];
				$qp				= $getvalue["qp"];
				$iframerate		= $getvalue["iframerate"];	//帧间隔
				$encode			= $getvalue["encode"];
			}
			else if($streamtype == 0){	//主码流分辨率
				if($resolution == 0){
					$resolution = "1920*1080";
				}
				else if($resolution == 1){
					$resolution = "1280*720";
				}
				else if($resolution == 2){
					$resolution = "640*360";
				}else{
					$resolution = "640*360";
				}
				
				$getvalue = GetVideoCapture();
				$FPS				= $getvalue["FPS"];
				$brightness			= $getvalue["brightness"];
				$contrast			= $getvalue["contrast"];
				$saturation			= $getvalue["saturation"];
				$sharpness			= $getvalue["sharpness"];
				$BLCEnable			= $getvalue["BLCEnable"];
				$BLCLevel			= $getvalue["BLCLevel"];
				$lightingCondition	= $getvalue["lightingCondition"];
				$histogram			= $getvalue["histogram"];
				$stabilization		= $getvalue["stabilization"];
				$LDC				= $getvalue["LDC"];
				$DREMode			= $getvalue["DREMode"];
				$DREStrength		= $getvalue["DREStrength"];
				$_2AEngine			= $getvalue["_2AEngine"];
				$_2AMode			= $getvalue["_2AMode"];
				$priority			= $getvalue["priority"];
				$flickerCtrl		= $getvalue["flickerCtrl"];
				$WBMode				= $getvalue["WBMode"];
				$VNFEnable			= $getvalue["VNFEnable"];
				$VNFMode			= $getvalue["VNFMode"];
				$VNFStrength		= $getvalue["VNFStrength"];
				$mirrormode			= $getvalue["mirrormode"];
			}
			$SE = new SocketEntity();
			if($streamtype == 1){
				$ret =$SE->SendSetParam(setVideoParam($resolution,$framerate,$ratecontrol,$bitrate,$qp,$iframerate,$encode,$streamtype,$streamtype));
			}else{
				$ret =$SE->SendSetParam(SetVideoCaptureParam($resolution,$FPS,$brightness,$contrast,$saturation,$sharpness,$BLCEnable,$BLCLevel,$lightingCondition,$histogram,$stabilization,$LDC,$DREMode,$DREStrength,$_2AEngine,$_2AMode,$priority,$flickerCtrl,$WBMode,$VNFEnable,$VNFMode,$VNFStrength,$mirrormode,$streamtype));
			}
			$SE->SafeClose();
			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo "error";
			exit;
		}
	}

	//设置图像翻转
	function setMirrormode(){
		if(isset($_POST['mirrormode'],$_POST['streamtype'])){
			$mirrormode = $_POST['mirrormode'];
			$streamtype = $_POST['streamtype'];
			
			if($streamtype == 1){
				$getvalue = GetVideoCapture($streamtype);
			}else{
				$getvalue = GetVideoCapture();
			}
			$videoStd			= $getvalue["videoStd"];
			$FPS				= $getvalue["FPS"];
			$brightness			= $getvalue["brightness"];
			$contrast			= $getvalue["contrast"];
			$saturation			= $getvalue["saturation"];
			$sharpness			= $getvalue["sharpness"];
			$BLCEnable			= $getvalue["BLCEnable"];
			$BLCLevel			= $getvalue["BLCLevel"];
			$lightingCondition	= $getvalue["lightingCondition"];
			$histogram			= $getvalue["histogram"];
			$stabilization		= $getvalue["stabilization"];
			$LDC				= $getvalue["LDC"];
			$DREMode			= $getvalue["DREMode"];
			$DREStrength		= $getvalue["DREStrength"];
			$_2AEngine			= $getvalue["_2AEngine"];
			$_2AMode			= $getvalue["_2AMode"];
			$priority			= $getvalue["priority"];
			$flickerCtrl		= $getvalue["flickerCtrl"];
			$WBMode				= $getvalue["WBMode"];
			$VNFEnable			= $getvalue["VNFEnable"];
			$VNFMode			= $getvalue["VNFMode"];
			$VNFStrength		= $getvalue["VNFStrength"];
			$SE = new SocketEntity();
			if($streamtype == 1){
				$ret =$SE->SendSetParam(SetVideoCaptureParam($videoStd,$FPS,$brightness,$contrast,$saturation,$sharpness,$BLCEnable,$BLCLevel,$lightingCondition,$histogram,$stabilization,$LDC,$DREMode,$DREStrength,$_2AEngine,$_2AMode,$priority,$flickerCtrl,$WBMode,$VNFEnable,$VNFMode,$VNFStrength,$mirrormode,$streamtype));
			}else{
				$ret =$SE->SendSetParam(SetVideoCaptureParam($videoStd,$FPS,$brightness,$contrast,$saturation,$sharpness,$BLCEnable,$BLCLevel,$lightingCondition,$histogram,$stabilization,$LDC,$DREMode,$DREStrength,$_2AEngine,$_2AMode,$priority,$flickerCtrl,$WBMode,$VNFEnable,$VNFMode,$VNFStrength,$mirrormode));
			}
			$SE->SafeClose();
			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo "error";
			exit;
		}
	}

	//设置码流码率
	function setRate(){
		if(isset($_POST['rate'],$_POST['videostd'],$_POST['streamtype'])){
			$rate			= $_POST['rate'];
			$videostd		= $_POST['videostd'];
			$streamtype		= $_POST['streamtype'];
			if($streamtype == 1){
				$getvalue	= GetVideoParam($streamtype);
			}else{
				$getvalue	= GetVideoParam($streamtype);
			}
			$videostd		= $getvalue["videostd"];
			$framerate		= $getvalue["fps"];			//framerate 帧率
			$ratecontrol	= $getvalue["ratecontrol"];
			//$bitrate		= $getvalue["bitrate"];
			$qp				= $getvalue["qp"];
			$iframerate		= $getvalue["iframerate"];	//帧间隔
			$encode			= $getvalue["encode"];

			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$rate,$qp,$iframerate,$encode,$streamtype));
			/*if($streamtype == 1){
				$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$rate,$qp,$iframerate,$encode,$streamtype));
			}else{
				$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$rate,$qp,$iframerate,$encode,$streamtype));
			}*/
			$SE->SafeClose();

			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo "error";
		}
	}

	//设置主码流关键帧间隔
	function setIframerate(){
		if(isset($_POST['iframerate'],$_POST['videostd'],$_POST['streamtype'])){
			$iframerate 	= $_POST['iframerate'];
			$videostd		= $_POST['videostd'];
			$streamtype		= $_POST['streamtype'];
			if($streamtype == 1){
				$getvalue	= GetVideoParam($streamtype);
			}else{
				$getvalue	= GetVideoParam($streamtype);
			}
			$videostd		= $getvalue["videostd"];
			$framerate		= $getvalue["fps"];			//framerate 帧率
			$ratecontrol	= $getvalue["ratecontrol"];
			$bitrate		= $getvalue["bitrate"];
			$qp				= $getvalue["qp"];
			//$iframerate	= $getvalue["iframerate"];	//帧间隔
			$encode			= $getvalue["encode"];

			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$bitrate,$qp,$iframerate,$encode,$streamtype));
			/*if($streamtype == 1){
				$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$bitrate,$qp,$iframerate,$encode,$streamtype));
			}else{
				$ret =$SE->SendSetParam(setVideoParam($videostd,$framerate,$ratecontrol,$bitrate,$qp,$iframerate,$encode,$streamtype));
			}*/
			$SE->SafeClose();
			if($ret >= 0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			echo "error";
		}
	}

	//设置直播服务器地址
	function setServerIP(){
		if(isset($_POST['serverIP'])){
			$newpath	= $_POST['serverIP'];
			print_r($newpath);die;
			$streamtype = $_POST['streamtype'];
			/*$chan = getMediaStreamType();
			$chanNo = $chan['LiveStreamType'];*/
			$chanNo = 0;
			$getvalue =&GetMediaPara('RTMP',$chanNo,$streamtype);
			$media = $getvalue["media"];
			$path = $getvalue["path"];
			$port = $getvalue["port"];
			$used = $getvalue["used"];
			$partPath = substr($path,strrpos($path,":"));
			$newmedia = substr($path,0,strpos($path,":"));
			
			//$newpath = $newmedia."://".$serverIP.$partPath;
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(ChangeMedia($media,$newpath,$port,$used,$streamtype));
			$SE->SendCmdAction(RestartApp('MEDIA_SET'));
			$SE->SafeClose();
			if($ret >= 0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			echo "error";
		}
	}
	function setStreamName(){
		if(isset($_POST['streamName'])){
			$streamName = $_POST['streamName'];
			$streamtype = $_POST['streamtype'];
			/*$chan = getMediaStreamType();
			$chanNo = $chan['LiveStreamType'];*/
			$chanNo = 0;
			$getvalue =&GetMediaPara('RTMP',$chanNo,$streamtype);
			$media = $getvalue["media"];
			$path = $getvalue["path"];
			//$port = $getvalue["port"];
			$used = $getvalue["used"];
			
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(ChangeMedia($media,$path,$streamName,$used,$streamtype));
			$SE->SendCmdAction(RestartApp('MEDIA_SET'));
			$SE->SafeClose();
			if($ret >= 0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			echo "error";
		}
	}

	function setFrame(){
		if(isset($_POST['streamtype'],$_POST['frameType'],$_POST['frameB'])){
			$streamtype = $_POST['streamtype'];
			$frameType	= $_POST['frameType'];
			$frameB		= $_POST['frameB'];
			
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setFrameInfo($streamtype,$frameType,$frameB));
			$SE->SafeClose();
			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo "error";
		}
	}

	function setTS(){
		$TSpath	= $_POST['TSpath'];
		$TSport	= $_POST['TS_port'];
		$SE = new SocketEntity();
		$chanNo = 0;
		$streamtype = 0;
		$getvalue =&GetMediaPara('TS',$chanNo,$streamtype);
		$media = $getvalue["media"];
		$path = $getvalue["path"];
		$port = $getvalue["port"];
		$used = $getvalue["used"];

		if(!$TSpath){
			$TSpath = $path;
		}
		if(!$TSport)
			$TSport = $port;
		$used = 1;
		//echo $TSport;
		$ret =$SE->SendSetParam(ChangeMedia($media,$TSpath,$TSport,$used,$streamtype));
		$SE->SendCmdAction(RestartApp('MEDIA_SET'));
		$SE->SafeClose();
		if($ret >= 0){
			echo 1;
		}else{
			echo 0;
		}
	}
	
	function setmediaOrchParam(){
		if(isset($_POST['username'],$_POST['password'],$_POST['DevID'],$_POST['DevName'],$_POST['url'],$_POST['used'])){
			$username	= $_POST['username'];
			$password	= $_POST['password'];
			$DevID		= $_POST['DevID'];
			$DevName	= $_POST['DevName'];
			$url		= $_POST['url'];
			$used		= $_POST['used'];
				
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setMediaOrch($username,$password,$DevID,$DevName,$url,$used));
			$SE->SafeClose();
			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo "error";
		}
	}
	/*视频主/子码流码率控制*/
	function setControl(){
		$Streamcontrol		= $_POST['Streamcontrol'];
		$streamtype		= $_POST['streamtype'];

		if(isset($Streamcontrol,$streamtype)){ 
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setStreamcontrol($Streamcontrol,$streamtype));
			$SE->SafeClose();
			if($ret >= 0){
				echo 1;
			}else{		 
				echo 0;
			}
		}else{
			echo "error";
		}
	}
	
	
		/*视频源类型*/
//	function setVideoType(){
//		$VideoType		= $_POST['VideoType'];
//		$streamtype		= $_POST['streamtype'];
//
//		if(isset($VideoType,$streamtype)){ 
//			$SE = new SocketEntity();
//			$ret =$SE->SendSetParam(setVideoType($VideoType,$streamtype));
//			$SE->SafeClose();
//			if($ret >= 0){
//				echo 1;
//			}else{		 
//				echo 0;
//			}
//		}else{
//			echo "error";
//		}
//	}
		//描述符
	function setorchName(){
		if(isset($_POST['orchDevName'])){
			$orchDevName = $_POST['orchDevName'];
			//$streamtype = $_POST['streamtype'];
			$chanNo = 0;
			$getvalue =&Getorchname('RTMP',$chanNo,$orchDevName);
			$media = $getvalue["media"];
			$path = $getvalue["path"];
			//$port = $getvalue["port"];
			$used = $getvalue["used"];
			
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setDescribeName($orchDevName));
			$SE->SafeClose();
			if($ret >= 0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			echo "error";
		}
	}
			//描述符
	function setvideotypeName(){
		if(isset($_POST['orchDevName'])){
			$orchDevName = $_POST['orchDevName'];
			//$streamtype = $_POST['streamtype'];
			$chanNo = 0;
			$getvalue =&Getorchname('RTMP',$chanNo,$orchDevName);
			$media = $getvalue["media"];
			$path = $getvalue["path"];
			//$port = $getvalue["port"];
			$used = $getvalue["used"];
			
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setVideoName($orchDevName));
			$SE->SafeClose();
			if($ret >= 0){
					echo 1;
				}else{
					echo 0;
				}
		}else{
			echo "error";
		}
	}
?>