<?php
	include_once('func_common_param.php');
	header("Content-type: text/html; charset=utf-8");

	if(isset($_GET)){
		if($_GET['action'] == 'setLiveState'){
			setLiveState();
		}
		if($_GET['action'] == 'setVodState'){
			setVodState();
		}
		if($_GET['action'] == 'setAudioState'){
			setAudioState();
		}
		if($_GET['action'] == 'setWiFiState'){
			setWiFiState();
		}
		if($_GET['action'] == 'set4GLinkState'){
			set4GLinkState();
		}
		if($_GET['action'] == 'setLiveType'){
			setLiveType();
		}
		if($_GET['action'] == 'systemMode'){
			systemMode();
		}
	}

	//设置直播状态
	function setLiveState(){
		//echo json_encode($_POST);die;
		if(isset($_POST['state'])){
			$ret = getMediaStreamType();
			$streamtype = $ret['LiveStreamType'];
			if($_POST['state'] == 'true'){
				//开启直播
				$SE = new SocketEntity();
				$ret['ret'] = $SE->SendSetParam(setMediaLiveStream($streamtype,1));
				$SE->SafeClose();
				if($ret['ret'] == 0)
				{
					echo "success";
				}
				else if($ret['ret'] < 0)
				{
					//echo json_encode($ret['ret']);
					echo "error";
				}
			}
			else if($_POST['state'] == 'false'){
				//关闭直播
				$SE = new SocketEntity();
				$SE->SendSetParam(setMediaLiveStream($streamtype,0));
				$SE->SafeClose();
				echo "stoplive_ok";
			}else{
				echo "param error";
			}
		}
	}

	//设置录像状态
	function setVodState(){
		if(isset($_POST['state'])){
			//echo json_encode($_POST['state']);
			$ret = getMediaStreamType();
			$streamtype = $ret['RecordStreamType'];
			if($_POST['state'] == 'true'){
				//开启录像
				$SE = new SocketEntity();
				$ret =$SE->SendSetParam(mediaRecordStream($streamtype,1));
				$SE->SafeClose();
				if($ret['ret'] >= 0)
				{
					echo "handrecord_ok";
				}
				else if($ret['ret'] < 0)
				{
					//echo json_encode($ret['ret']);
					echo "no_sd_card";
				}
			}
			else if($_POST['state'] == 'false'){
				//关闭录像
				$SE = new SocketEntity();
				$SE->SendSetParam(mediaRecordStream($streamtype,0));
				$SE->SafeClose();
				echo "stoprecord_ok";
			}
		}
	}

	//设置子码流状态
	function setLiveType(){
		if(isset($_POST['state'])){
			$state = $_POST['state'];
			$SE = new SocketEntity();
			if($state == "true"){
				$state = 0;
				$ret =$SE->SendSetParam(setVideoSubStreamState(0));
				if($ret >=0){
					echo "close_ok";
				}else{
					echo "close_fail";
				}
			}else if($state == "false"){
				$state = 1;
				$ret =$SE->SendSetParam(setVideoSubStreamState(1));
				if($ret >=0){
					echo "open_ok";
				}else{
					echo "open_fail";
				}
			}
			
			$SE->SafeClose();
			/*echo json_encode($ret);die;
			if($ret['ret'] >= 0)
			{
				echo "1";
			}
			else if($ret['ret'] < 0)
			{
				//echo json_encode($ret['ret']);
				echo "0";
			}*/
		}
	}

	//设置音频状态
	function setAudioState(){
		//echo json_encode($_POST);die;
		if($_POST['state'] == 'true'){
			//开启音频
			$SE = new SocketEntity();
			/*
			 #define AUDIO_INPUT_NONE    0
			 #define AUDIO_INPUT_FRONT   1
			 #define AUDIO_INPUT_BACK    2
			 #define AUDIO_INPUT_LINE_IN AUDIO_INPUT_BACK
			 #define AUDIO_INPUT_HDMI    3
			 #define AUDIO_INPUT_MIC    4 // 无源MIC,      
			 #define AUDIO_INPUT_HDMI_2    5
			 #define AUDIO_INPUT_SDI AUDIO_INPUT_HDMI_2
			 #define AUDIO_INPUT_HDMI_3    6
			 ---------------
			 由于DM385只有外置MIC 所以音频关闭为0 音频开启为4
			*/
			$ret['ret'] = $SE->SendSetParam(setAudioCapture(4));
			$SE->SafeClose();
			if($ret['ret'] == 0)
			{
				echo "success";
			}
			else if($ret['ret'] < 0)
			{
				//echo json_encode($ret['ret']);
				echo "error";
			}
		}
		else if($_POST['state'] == 'false'){
			//关闭音频
			$SE = new SocketEntity();
			$SE->SendSetParam(setAudioCapture(0));
			$SE->SafeClose();
			echo "CloseAudio_ok";
		}else{
			echo "param error";
		}
	}
	
	//设置WiFi连接状态
	function setWiFiState(){
		if(isset($_POST['state'])){
			$WiFiState = $_POST['state'];
			$SE = new SocketEntity();
	
			if($WiFiState == 'true')
			{
				$SE = new SocketEntity();
				$ret = $SE->SendSetParam(SetWifiWorkMode(1));	// 开启wifi sta
				$SE->SafeClose();
			}
			else if($WiFiState == 'false')
			{
	
				$SE = new SocketEntity();
				$ret = $SE->SendSetParam(SetWifiWorkMode(0));	// 关闭wifi sta
				$SE->SafeClose();
			}
			echo $ret;
		}
	}

	//设置4G连接状态
	function set4GLinkState(){
		if(isset($_POST['state'])){
			$Enable4G = $_POST['state'];
			$SE = new SocketEntity();

			if($Enable4G == 'true')
			{
				$SE = new SocketEntity();
				$ret = $SE->SendSetParam(CMD4GLink(1));
				$SE->SafeClose();
			}
			else if($Enable4G == 'false')
			{	
				$SE = new SocketEntity();
				$ret = $SE->SendSetParam(CMD4GLink(0));			//关闭4G
				$SE->SafeClose();
			}
			echo $ret;
		}
	}

	//设置系统模式
	function systemMode(){
		if(isset($_POST['systemMode'])){
			$systemMode = $_POST['systemMode'];
			$SE = new SocketEntity();
			$ret =$SE->SendSetParam(setSystemMode($systemMode));
			$SE->SafeClose();

			if($ret >= 0){
				echo 1;
			}else{
				echo 0;
			}
		}
	}
?>