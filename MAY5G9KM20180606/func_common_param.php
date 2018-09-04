<?php
	include_once ("server_setting.php");
	if($_GET['action'] == GetWiFiState)
	{
		GetWiFiState();
	}
	else if($_GET['action'] == Get4GLinkState)
	{
		Get4GLinkState();
	}
	else if($_GET['action'] == GetIP4GProperty)
	{
		GetIP4GProperty();
	}
	else if($_GET['action'] == Getbatteryinfo)
	{
		Getbatteryinfo();
	}
	//获取直播录像码流类型
	function getMediaStreamType(){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIASTREAMTYPE".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		
		$array =& get_param_by_cmd($body);

		//HEAD IP VERSION CMD HANDRECORD ret
		$s = 5;
		$ret['ret']				= get_array_value($array,$s++);
		$ret['chanNO']			= get_array_value($array,$s++);
		$ret['streamtype']		= get_array_value($array,$s++);
		$ret['LiveStreamType']	= get_array_value($array,$s++);
		$ret['RecordStreamType']= get_array_value($array,$s++);
		return $ret;
	}

	//设置直播录像码流
	function setMediaStreamType($LiveStreamType,$RecordStreamType){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIASTREAMTYPE".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$LiveStreamType.$split.
							$RecordStreamType.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}


	//DM385 开启直播 $state=1 or 停止直播 $state=0
	function setMediaLiveStream($streamtype=0,$state){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIALIVESTREAM".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$state.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}

	//DM385 获取直播状态
	function getMediaLiveStream($streamtype){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIALIVESTREAM".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& get_param_by_cmd($body,true);

		//HEAD IP VERSION GET RECORDSTATUS recording
		$s = 5;
		$ret['ret']			= get_array_value($array,$s++);
		$ret["chanNO"]		= get_array_value($array,$s++);
		$ret["streamtype"]  = get_array_value($array,$s++);
		$ret["status"]		= get_array_value($array,$s++); 
		return $ret;
	}

	//DM385 获取录像状态
	function getMediaRecordStream($streamtype){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIARECORDSTREAM".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& get_param_by_cmd($body,true);

		//HEAD IP VERSION GET RECORDSTATUS recording
		$s = 5;
		$ret['ret']			= get_array_value($array,$s++);
		$ret["chanNO"]		= get_array_value($array,$s++);
		$ret["streamtype"]  = get_array_value($array,$s++);
		$ret["status"]		= get_array_value($array,$s++); 
		return $ret;
	}

	//DM385 开启录像 $state=1 or 停止录像 $state=0
	function mediaRecordStream($streamtype,$state){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "MEDIARECORDSTREAM".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$state.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;

		/*$array = &do_action_by_cmd($body);
		$s = 5;
		$ret['ret']			= get_array_value($array,$s++);
		$ret['chanNO']		= get_array_value($array,$s++);
		$ret['streamtype']	= get_array_value($array,$s++);
		$ret['state']		= get_array_value($array,$s++);*/

		return $body;
	}

	//DM8录像
	function HandRecord()
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$filename = "";

		$body = "HANDRECORD".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$filename.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& do_action_by_cmd($body);
		
		//HEAD IP VERSION CMD HANDRECORD ret
		$s = 5;
		$ret['ret'] = get_array_value($array,$s++);
		$ret['chanNO'] = get_array_value($array,$s++);
		return $ret;
	}
	
	//DM8停止录像
	function StopRecord()
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "STOPRECORD".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}

	//获取录像状态
	function &GetRecordStatus()
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "RECORDSTATUS".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET RECORDSTATUS recording
		$s = 5;
		$ret['ret']			= get_array_value($array,$s++);
		$ret["chanNO"]		= get_array_value($array,$s++);
		$ret["streamtype"]  = get_array_value($array,$s++);
		$ret["status"]		= get_array_value($array,$s++); 
		return $ret;
	}

	// 获取子码流是否开启
	function IsSubStreamExist(){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$streamtype = 1;

		$body =  "ISSUBSTREAMEXIST".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
									$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& do_action_by_cmd($body);
		
		$s = 6;
		$ret["chanNO"]		 = get_array_value($array,$s++);
		$ret["streamtype"]   = get_array_value($array,$s++);
		$ret["sub_state"]     = get_array_value($array,$s++); 
		return $ret;
	}
	
	//设置子码流开关
	function setVideoSubStreamState($state){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$streamtype = 1;

		$body = "VIDEOSUBSTREAMSTATE".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
				$state.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;

		return $body;
	}

	//DM385 开启音频 $state=4 or 停止直播 $state=0
	function setAudioCapture($state){
		global $split;
		global $localIP;
		global $localID;
		//global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$chanNo = 0;
		$streamtype = 0;
		$Frequency = 48000;

		$body = "AUDIOCAPTURE".$split.$localIP.$split.$localID.$split.$chanNo.$split.$streamtype.$split.
							$state.$split.$Frequency.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}

	//DM385 获取音频状态
	function getAudioCapture(){
		global $split;
		global $localIP;
		global $localID;
		//global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$chanNo = 0;
		$streamtype = 0;

		$body = "AUDIOCAPTURE".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& get_param_by_cmd($body,true);

		//HEAD IP VERSION GET RECORDSTATUS recording
		$s = 5;
		$ret['ret']			= get_array_value($array,$s++);
		$ret["chanNO"]		= get_array_value($array,$s++);
		$ret["streamtype"]  = get_array_value($array,$s++);
		$ret["AudioChan"]	= get_array_value($array,$s++);  
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
		$ret["Frequency"]	= get_array_value($array,$s++); //音频采样率 48K
		return $ret;
	}
	
	//使用wifi
	function SetWifiWorkMode($open)
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$wifiMode = 0;	//0 wifista   1 wifiAP
		//$open = 1;	//0 关闭		  1 开启
		
		$body = "WIFIWORKMODE".$split.$localIP.$split.$localID.$split.
				$wifiMode.$split.
				$open.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		
		return $body;
	}
	
	//获取WiFi连接状态
	function GetWiFiState()
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		
		$body = "WIFIWORKMODE".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
		$ret["WiFi"]   = get_array_value($array,7);
		//$ret['WiFiState'] = $ret["WiFi"] & (0x01);
		//return $ret['WiFiState'];
		return $ret['WiFi'];
		
	}

	//获取4G连接状态
	function Get4GLinkState()
	{
//		定义变量
		global $split;
		$body = "4GLINKSTATE";
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
		$ret["4GLinkState"]   = get_array_value($array,6);

		return $ret["4GLinkState"];
	}

	//使用4G
	function CMD4GLink($Enable)
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$body = "4GLINKCMD".$split.$localIP.$split.$localID.$split.
				$Enable.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& do_action_by_cmd($body,false,false);
		//HEAD IP VERSION CMD ZOOMSMALL index
		$s = 5;
		$ret['LinkState'] = get_array_value($array,$s++);/**/
		
		return $ret;
	}

	//获取4GIP信息状态
	function &GetIP4GProperty()
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		
		$body = "IP4GPROPERTY".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET IPPROPERTY mac ip mask gate dns type
		//var_dump($array);die;
		$s = 6;
		$ret["mac"]   = get_array_value($array,$s++);
		$ret["ip"]    = get_array_value($array,$s++);
		$ret["mask"]  = get_array_value($array,$s++);
		$ret["gate"]  = get_array_value($array,$s++);
		$ret["dns"]   = get_array_value($array,$s++);
		$ret["rrssi"] = get_array_value($array,$s++);		//此处表示信号强度
		$ret["ber"]	  = get_array_value($array,$s++);		//此处表示信号强度
		$ret["rsrqsignal"]  = get_array_value($array,$s++);		//此处表示信号强度
		
		return $ret;
	}

	//获取4G运营商信息
	function &GetIP4GCarrier(){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "IP4GCARRIER".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);

		$s = 6;
		$ret["carrier"]   = get_array_value($array,$s++);

		return $ret;
	}

	//获取数据连接通道(4G or wifi)
	function GetLinkType()
	{
		global $split;
		$body = "NETLINKTYPE";
		$array =& get_param_by_cmd($body,true);

		//HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
		// wifi:linkType = 0  4G:linkType = 1;
		$s = 6;
		$ret["LinkType"]   = get_array_value($array,$s++);
		return $ret;
	}

	//获取媒体信息
	function &GetMediaPara($media,$channo,$streamtype=0)
	{
		global $split;
		global $localIP;
		global $localID;
		//global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$body = "MEDIAPARA".$split.$localIP.$split.$localID.$split.$channo.$split.$streamtype.$split.
							$media.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;

		$array =& get_param_by_cmd($body,true);
		// print_r($array);die;
		//HEAD IP VERSION GET MEDIAPARA media path port used
		$ret["ret"]			= get_array_value($array,5);
		$ret["chanNO"]		= get_array_value($array,6);
		$ret["streamtype"]  = get_array_value($array,7);
		$ret["media"]  = get_array_value($array,8); 
		$ret["path"]   = get_array_value($array,9);	
		$ret["port"]   = get_array_value($array,10);	
		// $ret["used"]   = get_array_value($array,11);
		$ret["used"]   = 1;
		// print_r($ret);die;
		return $ret;
	}

	//获取系统模式信息
	function getSystemMode(){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "SYSTEMMODE".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
		
		$s = 5;
		$ret["ret"]			= get_array_value($array,$s++);
		$ret["systemMode"]	= get_array_value($array,$s++);

		return $ret;
	}

	//设置系统模式
	function setSystemMode($systemMode){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "SYSTEMMODE".$split.$localIP.$split.$localID.$split.
				$systemMode.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;

		return $body;
	}

	//获取总共存储空间使用情况
	function GetSDCardSpace()
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "SDCARDSPACE".$split.$localIP.$split.$localID.$split.$channo.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET SDCARDSPACE total used free
		$s = 5;
		$ret["ret"] = get_array_value($array,$s++);
		$ret["total"] = get_array_value($array,$s++);
		$ret["used"]  = get_array_value($array,$s++);
		$ret["free"]  = get_array_value($array,$s++);
		return $ret;
	}

	//获取某通道的存储空间
	function GetRecordChanSpace($chanNo,$streamtype)
	{
		global $split;
		global $localIP;
		global $localID;
		//global $chanNO;
		//global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "RECORDCHANSPACE".$split.$localIP.$split.$localID.$split.$channo.$split.$streamtype.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET SDCARDSPACE total used free
		$s = 5;
		$ret["ret"] = get_array_value($array,$s++);
		$ret['chanNo'] = get_array_value($array,$s++);
		$ret['streamtype'] = get_array_value($array,$s++);
		$ret["total"] = get_array_value($array,$s++);
		$ret["used"]  = get_array_value($array,$s++);
		$ret["free"]  = get_array_value($array,$s++);
		return $ret;
	}

	//获取电池电量
	function Getbatteryinfo(){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "BATTERYINFO".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);

		$s = 5;
		$ret["ret"] = get_array_value($array,$s++);
		$ret["state"] = get_array_value($array,$s++);	//充电状态 ：1 充电 0不充电
		$ret["percent"] = get_array_value($array,$s++); //电量%

		return $ret;
	}
?>
