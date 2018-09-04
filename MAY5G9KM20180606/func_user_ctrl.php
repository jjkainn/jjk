<?php
include_once ("server_setting.php");
$chanNO = $_COOKIE['chanNO'];
	if($chanNO == null || $chanNO == ""){
		$chanNO = 0;
	}

error_reporting(4);
//对于数据库的增删改差
function check_valid_user($user,$pwd)
{
	global $split;	
	$body = "LOGON".$split.$user.$split.$pwd;

	$array =& do_action_by_cmd($body);
	
	//HEAD VERSION IP CMD LOGON RET
	$ret = get_array_value($array,5);
	return $ret;
}

function &GetUserByIndex($index)
{
	global $split;
	$body = "USERINFO".$split.$index;
	$array =& get_param_by_cmd($body,true);
	
	//HEAD VERSION IP GET USERINFO user_id username pwd level createtime
	$s = 6;
	$id = get_array_value($array,$s++);
	if($id == $index)
	{
		$ret["name"] = get_array_value($array,$s++); 
		$s++;
		$ret["level"] = get_array_value($array,$s++);		
		$ret["time"] = get_array_value($array,$s++);		
		return $ret;
	}

	$i = -1;
	return $i;
}

function ChangeUserRight($user,$right)
{
	global $split;
	$body = "USERRIGHT".$split.$user.$split.$right;
	$array =& set_param_by_cmd($body);

    //HEAD VERSION IP SET USERRIGHT RET 
	$ret = get_array_value($array,5);
	return $ret;
}

function add_user($user,$right,$pwd)
{
	global $split;
	$body = "ADDUSER".$split.$user.$split.$right.$split.$pwd;
	$array =& do_action_by_cmd($body);

	//HEAD VERSION IP CMD ADDUSER RET
	$ret = get_array_value($array,5);
	return $ret;
}

function del_user($user)
{
	global $split;
	$body = "DELUSER".$split.$user;
	$array =& do_action_by_cmd($body);

	//HEAD VERSION IP CMD DELUSER RET
	$ret = get_array_value($array,5);
	return $ret;
}

function ChangeUserPwd($user,$pwd)
{
	global $split;
	global $localIP;
	global $localID;
	global $reserved;
	global $reserved_len;
	global $reserved_con;
	
	$body = "USERPWD".$split.$localIP.$split.$localID.$split.
				$user.$split.$pwd.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
	
	$array =& set_param_by_cmd($body);

    //HEAD VERSION IP CMD USERPWD RET 
	$ret = get_array_value($array,5);
	return $ret;
}
?>












