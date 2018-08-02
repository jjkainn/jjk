<?php
	include "serverport.php";
//	通信
	date_default_timezone_set('PRC');
	
	$address = "192.168.10.1";
	
	$head_tag  	= "FAFAFAF1";
	$version   	= 1;
	$ip       	= $_SERVER["REMOTE_ADDR"];
	$split 		= "\t";
	$localIP	= "";
	$localID	= "";
	$chanNO		= 0;
	$streamtype = 0;
	$reserved	= 0;
	$reserved_len	= 0;
	$reserved_con	= "";
	$g_end  	= "\n\n\n";
	$close 		= "CLOSE";
	$get  		= "GET";
	$set   		= "SET";
	$g_action   = "CMD";
	
	//global $chanNO;

	error_reporting(E_ERROR);
	
	function open_socket()
	{
		global $address;
		global $service_port;
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

		if($socket < 0)
		{
			echo "socket_create() failed: reason: " . socket_strerror($socket) . "\n";
			return -1;
		}
		
		$result = socket_connect($socket, $address, $service_port);

		if ($result < 0)
		{
			echo "socket_connect() failed.\nReason: ($result) " . socket_strerror($result) . "\n";
			return -1;
		}
		
		return $socket;
	}
	
	function send_to_socket($socket,$buf)
	{
		socket_write($socket, $buf, strlen($buf));
		//echo "Sending request >>> '$buf' "."<p>\r\n";
	}
	
	function &build_cmd($cmd)
	{
		global $head_tag;
		global $version;
		global $split;
		global $g_end;
		global $ip;
		$in = $head_tag.$split.$version.$split.$ip.$split;
		$in = $in.$cmd.$g_end;
		return $in;
	}
	
	function &get_close_cmd()
	{
		global $head_tag;
		global $version;		
		global $ip;
		global $g_action;
		global $close;
		global $split;
		global $g_end;

		$in = $head_tag.$split.$version.$split.$ip.$split.$g_action.$split.$close.$g_end;
		
		return $in;
	}
	
	function &recv_socket_to_end($socket)
	{
		$out = "";
		while (1) 
		{
			$ret = socket_read($socket, 8192);
			if(FALSE == $ret)
				break;
				
			$out = $out.$ret;
			//echo "<p>\r\n Reading response,len=".strlen($out).",data=".$out."<p>\r\n";			
		}		
		socket_close($socket);
		return $out;
	}
	
	function &analyze_para($out)
	{
		global $split;
		global $g_end;
	
		$array = array();
		while(1)
		{
			$pos = strpos($out,$split);
			if($pos === false)
			{
				$pos = strpos($out,$g_end);
				if($pos === false)
					break;
					
				$array[] = substr($out,0,$pos);				
				break;		
			}		
			
			$array[] = substr($out,0,$pos);				
			$out = substr($out,$pos+1);
			
			//echo($out."<p>\r\n" );
				
			if($out == $g_end)
				break;				
		}
		
		//foreach ($array as &$value) 
		//{
		//    echo $value.";";
		//}
		
		return $array;
	}
	
	function &get_param_by_cmd($cmd,$close=true)
	{
		global $split;
		if($cmd == "NETLINKTYPE"){
			$cmd = "GET".$split.$cmd;
		}else{
			$cmd = "GET".$split."G2".$cmd;
		}
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		
		$out =& recv_socket_to_end($socket);
		
		$array =& analyze_para($out);
		return $array;
	}
	function &recv_socket_to_end_test($socket)
	{
		$out = "";
		while (1) 
		{
			$ret = "";//socket_read($socket, 8192);
			//$ret = socket_read($socket, 51200); //1024*50
			if(FALSE == $ret)
				break;
				
			$out = $out.$ret;
			//echo "<p>\r\n Reading response,len=".strlen($out).",data=".$out."<p>\r\n";			
		}		
		socket_close($socket);
		return $out;
	}

	function &get_param_by_cmd_test($cmd,$close=true)
	{
		global $split;
		$cmd = "GET".$split."G2".$cmd;
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		
		$out =& recv_socket_to_end($socket);
		
		$array =& analyze_para($out);
		return $array;
	}

	function &get_param_by_cmd2($cmd,$close=true)
	{
		global $split;
		
		$cmd = "CMD".$split."G2".$cmd;
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		if($socket <= 0){
			echo "socket  创建失败";
			die;
		}
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		if(true == $close)
		{
			$out =& recv_socket_to_end_test($socket);
			//$array =& analyze_para($out);
		}
		return $array;
	}
	function clean($input, $maxlength)
	{
		$input = substr($input, 0, $maxlength);
		$input = EscapeShellCmd($input);
		return($input);
	}	
	
	function &set_param_by_cmd($cmd,$close=true)
	{	
		global $split;
		$cmd = "SET".$split."G2".$cmd;
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		
		$out =& recv_socket_to_end($socket);		
		$array =& analyze_para($out);
		return $array;
	}
	
	function get_array_value(&$array,$tag)
	{
		
		$size = count($array);
		if($size > $tag)
			return $array[$tag];
		else
			return -1;
	}
	
	function &do_action_by_cmd($cmd,$close=true,$recv=true)
	{
		global $split;
		
		$cmd = "CMD".$split."G2".$cmd;
		$in =& build_cmd($cmd);

		$socket = open_socket();
		
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		if(true == $close)
		{
			$out =& recv_socket_to_end($socket);		
			$array =& analyze_para($out);
		}
		
		return $array;
	}
	
	function &do_action_by_cmd1($cmd,$close=true,$recv=true)
	{
		global $split;
		
		$cmd = "CMD".$split."G2".$cmd;
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		
		send_to_socket($socket,$in);
		
		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		
		socket_close($socket);
		//return $array;
	}

	function &do_action_by_cmd2($cmd,$close=true,$recv=true)
	{
		global $split;
		
		$cmd = "CMD".$split."G2".$cmd;
		$in =& build_cmd($cmd);
		
		$socket = open_socket();
		send_to_socket($socket,$in);

		if(true == $close)
		{
			$in = &get_close_cmd();
			send_to_socket($socket,$in);//发送命令结束
		}
		if(true == $close)
		{
			$out =& recv_socket_to_end_test($socket);
			$array =& analyze_para($out);
		}
		
		return $array;
	}
	//-------------------------------------------------------------------------------------
	class SocketEntity
	{
		var $socket;
		function SocketEntity()
		{
			$this->socket = open_socket();
		}
		
		function SendCmd($cmd)
		{
			send_to_socket($this->socket,$cmd);	
		}
		
		function SafeClose()
		{
			$in = &get_close_cmd();
			send_to_socket($this->socket,$in);//发送命令结束	
			while (1) 
			{
				$ret = socket_read($this->socket, 8192);
				if(FALSE == $ret)
					break;
	
			}
			socket_close($this->socket);							
		}
		
		function CloseNoWait()
		{
			$in = &get_close_cmd();
			send_to_socket($this->socket,$in);//发送命令结束
			socket_close($this->socket);							
		}
		
		function SendSetParam($cmd)
		{
			//print_R($cmd);
			global $split;
			$cmd = "SET".$split."G2".$cmd;
			//print_R($cmd);die;
			$in =& build_cmd($cmd);
			//print_R($in);
			$this->SendCmd($in);			
		}
		
		function SendCmdAction($cmd)
		{
			global $split;
			$cmd = "CMD".$split."G2".$cmd;	
			$in =& build_cmd($cmd);
			
			$this->SendCmd($in);
		}
	}
	//set_param_by_cmd("123",$close=true);
?>
