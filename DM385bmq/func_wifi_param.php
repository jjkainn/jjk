<?php
	include_once("server_setting.php");
	
	//获取当前wifi连接信息
	function getWifiConnNode(){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body =	"WIFICONNNODE".$split.$localIP.$split.$localID.$split.$reserved.$split.$reserved_len.$split.$reserved_con;

		$array = & get_param_by_cmd($body);
		
		$s = 6;
		$ret["SSID"]	= get_array_value($array,$s++);
		$ret["Pwd"]		= get_array_value($array,$s++);
		$ret["encypt"]	= get_array_value($array,$s++);
		$ret["rank"]	= get_array_value($array,$s++);
		return $ret;
	}

	//获取wifi列表
	function getWifiScanList($SSIDNum){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "WIFISCANLIST".$split.$localIP.$split.$localID.$split.
								$SSIDNum.$split.
								$reserved.$split.$reserved_len.$split.$reserved_con;

		$array = & get_param_by_cmd($body);

		$s = 6;
		$ret["Num"]	= get_array_value($array,$s++);
		for($i=0;$i<$ret["Num"];$i++){
			$ret[$i]["SSID"]	= get_array_value($array,$s++);
			$ret[$i]["Pwd"]		= get_array_value($array,$s++);
			$ret[$i]["encypt"]	= get_array_value($array,$s++);
			$ret[$i]["rank"]	= get_array_value($array,$s++);
		}
		return $ret;
	}

	//wifi连接
	function cmdWifiConnect($SSID,$Pwd,$Encrypt){
		global $split;
		global $localIP;
		global $localID;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "WIFICONNECT".$split.$localIP.$split.$localID.$split.
								$SSID.$split.
								$Pwd.$split.
								$Encrypt.$split.
								$reserved.$split.$reserved_len.$split.$reserved_con;

		
		$array = do_action_by_cmd($body);

		$s = 5;
		$ret["ret"]	= get_array_value($array,$s++);

		return $ret;
	}
?>