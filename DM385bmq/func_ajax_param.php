<?php
	include_once "server_setting.php";
	
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
	
		echo $ret['WiFi'];
	}
	
	//获取4G连接状态
	function Get4GLinkState()
	{
		global $split;
		$body = "4GLINKSTATE";
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
		$ret["4GLinkState"]   = get_array_value($array,6);

		echo $ret['4GLinkState'];
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
		
		echo json_encode($ret);
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

		echo json_encode($ret);
	}



?>