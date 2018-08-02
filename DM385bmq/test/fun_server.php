<?php
	include_once '../func_common_param.php';
	include_once '../func_advanced_param.php';
	header("Content-type: text/html; charset=utf-8");
	if(isset($_GET)){
		//往数据库添加设备
		if($_GET['action'] == 'setserveradd'){
			setserveradd();
		}
	}
	function setserveradd(){
		$posts    = $_POST;
		//服务器IP
		$div_ip_1 = $posts['dev_ip_1'];
		$div_ip_2 = $posts['dev_ip_2'];
		$div_ip_3 = $posts['dev_ip_3'];
		$div_ip_4 = $posts['dev_ip_4'];
		$server_ips = $div_ip_1.'.'.$div_ip_2.'.'.$div_ip_3.'.'.$div_ip_4;
		//mysql数据库用户名
		$db_user  = $posts['db_user'];
		//mysql数据库密码
		$db_pwd     = $posts['db_pwd'];
		//mysql数据库端口号
		$db_port    = $posts['db_port'];
		//mysql数据库名称
		$db_name   = 'avstapp';
		//mysql数据库编码
		$db_charset = 'utf8';
		//mysql地址

		$db_site = $div_ip_1.'.'.$div_ip_2.'.'.$div_ip_3.'.'.$div_ip_4.':'.$db_port;

		$conn = @mysql_connect($db_site,$db_user,$db_pwd);
		$sel  = mysql_select_db($db_name,$conn);
		$set  = mysql_set_charset($db_charset,$conn);


		//主码流路径
		$chanNo = 0;
		$ret    = &GetMediaPara("RTMP",$chanNo,$streamtype=0);
		$path   = $ret['path'];

		//主码流名称
		$chan   = getMediaStreamType();
		$chanNo = $chan['chanNO'];
		$media  = &GetMediaPara('RTMP',$chanNo,0);

		//id
		$equip = &getequipmentid();
		$eid = $equip['devName'];

		//标识符
		$ret         = &Getorchname();
		$orchDevName = $ret['devName'];


		//liveRTMP 
		$liveRTMP = $path.'/'.$media['port'];
		//tag
		$tag      = $orchDevName;


		if(!$conn || !$sel || !$set){
			echo "<script>alert('数据库连接失败')</script>";
		}else{
			//查询是否已存在
			$sql = "select id from equipment where id='$eid'";
			$list = mysql_query($sql);
			$num = mysql_num_rows($list);
			if($num<=0){
				//插入设备
				$ins = "insert into equipment(id,tag,liveRTMP)values('$eid','$orchDevName','$liveRTMP')";
				$lists = mysql_query($ins);
			}else{
				$ins = "update equipment set tag='$orchDevName',liveRTMP='$liveRTMP' where id='$eid'";
				$lists = mysql_query($ins);
			}
			if($lists == ture){
				echo "<script>alert('添加设备成功！');</script>";
			}else{
				echo "<script>alert('添加设备失败！');</script>";
			}
		}
		echo "<script>window.location.href='./serveradds.php';</script>";
	}
?>