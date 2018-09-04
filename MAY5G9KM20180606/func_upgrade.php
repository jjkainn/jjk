<?php
	include_once ("server_setting.php");
	
	function &LocalUpgrade($file)
	{

		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$body = "LOCALUPGRADE".$split.$localIP.$split.$localID.$split.
				$file.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		get_param_by_cmd2($body,true);
	}
	
	function &GetLocalUpgradeStatus()
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;	
		$body = "LOCALUPGRADE_STATUS".$split.$localIP.$split.$localID.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET LOCALUPGRADE_STATUS status
		$ret["status"]   = get_array_value($array,6); 	
		return $ret; 
	}
	
	function &GetLocalUpgradeProgress()
	{
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;	
		$body = "UPGRADEPROGRESS".$split.$localIP.$split.$localID.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd_test($body,true);
	
		//HEAD IP VERSION GET LOCALUPGRADE_STATUS status
		$ret["progress"]   = get_array_value($array,6); 	
		return $ret; 
	}
?>