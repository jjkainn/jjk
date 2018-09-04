<?php
	include_once ("server_setting.php");
	
	function &SetTargetTime($time)
	{
		global $split;	
		$body = "TARGETTIME".$split.$time;
		return $body;
	}	
	
	//�����
	function &paramExport(){
		global $split;	
		$body = "PARAMEXPORT_BS";
		return $body;
	}  
	//������
	function &paramImport($filename,$coverMethod){
		global $split;
		$body = "PARAMIMPORT_BS".$split.$filename.$split.$coverMethod;
		return $body;
	}


	function SetLogParameter($level,$size)
	{
		global $split;	
		$body = "LOGPARA".$split.$level.$split.$size;
		return $body;
	
		//HEAD VERSION IP LOGPARA RET 	
	}	
	
	function SetUpdateInfo($type,$ip,$port)
	{
		global $split;	
		$body = "UPDATECENTER".$split.$type.$split.$ip.$split.$port;
		return $body;
	
		//HEAD VERSION IP UPDATECENTER RET 	
	}
	
	function GetLogParameter()
	{
		global $split;	
		$body = "LOGPARA";
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET LOGPARA level size
		$s = 6;
		$ret["level"] = get_array_value($array,$s++); 
		$ret["size"] = get_array_value($array,$s++);		
		return $ret; 	
	}	
	
	function GetUpdateParameter()
	{
		global $split;	
		$body = "UPDATECENTER";
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET UPDATECENTER type ip port
		$s = 6;
		$ret["type"] = get_array_value($array,$s++); 
		$ret["ip"] = get_array_value($array,$s++);
		$ret["port"] = get_array_value($array,$s++);		
		return $ret; 	
	}
	
//	function GetDeviceID()
//	{
//	
//		global $split;	
//		$body = "DEVICEID";
//		$array =& get_param_by_cmd($body,true);
//	
//		//HEAD IP VERSION GET DEVICEID id
//		$ret["id"] = get_array_value($array,6); 	
//		return $ret; 			
//	}	
	function GetDeviceID()
	{
		global $split;
		$body = "KERNELDEVINFO";
		$array =& get_param_by_cmd($body,true);
		$s = 6;
		$ret["id"] = get_array_value($array,$s); 
		return $ret;
	}
	function GetVersion()
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "APPVERSION".$split.$localIP.$split.$localID.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET APPVERSION version
		$ret["version"] = get_array_value($array,6); 	
		return $ret; 			
	}
	function GetVideo()
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $devName;

		global $reserved_len;
		global $reserved_con;

		global $reserved;		/*0=GB2312; 1=UTF-8  通道名称如果是中文的话，中文编码方式不同就会出现中文乱码问题 统一中文编码方式问题就解决了。*/
		$encoding = 1;
		$reserved = $encoding & 0xFF;    //低8位表示字符编码类型
		
		$body = "AUDIOCAPTURE".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);

//		$s = 5;
//		$ret["ret"]			= get_array_value($array,$s++);
//		$ret["chan"]		= get_array_value($array,G2DESCRIPTION   $s++); 
//		$ret["devName"]	    = get_array_value($array,$s++);
$ret["version"] = get_array_value($array,8); 	
		return $ret; 

//		return $ret;
	}
	
	function Reboot()
	{
		global $split;	
		$body = "REBOOT";	
		return $body; 			
	}	
	
	
	function ResetParameter()
	{
		global $split;	
		$body = "RESETPARAMETER";	
		return $body; 			
	}
	

?>