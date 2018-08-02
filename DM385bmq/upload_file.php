<?php
	@header('Content-type: text/html; charset=utf-8');
	//include 'loginfilter.php';
	include "func_upgrade.php";
	include "func_sys_set.php";
	include 'language.php';

	ignore_user_abort(true);
	set_time_limit(0);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
	var_dump($_SESSION,$Language_Type);
	ob_end_clean();
	ob_start();//开始缓冲数据
	
	if (isset($_FILES["file"]["size"]) && $_FILES["file"]["size"] < 50*1024*1024)
  	{
		//echo "文件小于50M";
  		if ($_FILES["file"]["error"] > 0)
    	{
    		echo $Lan_Main["UPGRADE_ERROR"][$Language_Type]/*"升级文件失败，错误代码="*/ . $_FILES["file"]["error"] . "<br/>";
    	}
  		else
    	{	
			echo $Lan_Main["UPGRADE_AFTER_UPLOADING_FILES"][$Language_Type] . /*"上传文件完毕，正在准备升级过程，文件信息如下：*/"<br/>";
			echo $Lan_Main["UPGRADE_FILE_NAME"][$Language_Type]/*"文件名:"*/   . $_FILES["file"]["name"] . "<br/>";
			echo $Lan_Main["UPGRADE_FILE_SIZE"][$Language_Type]/*"文件大小:"*/ . $_FILES["file"]["size"] . " Byte<br/>";
			echo "<br />";
	
			$dest = "/upgrade/" . $_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], $dest);
			
			echo $Lan_Main["UPGRADE_PREPARATION"][$Language_Type] . /*"升级准备中...*/"<br/>";
			echo $Lan_Main["UPGRADE_PATIENCE"][$Language_Type] . /*"升级过程比较缓慢，请耐心等待...*/"<br/>";
			echo str_repeat(" ",4096);//4096
			ob_flush();
			flush();
			LocalUpgrade($dest);

			echo $Lan_Main["UPGRADE_BEGIN"][$Language_Type] . /*"开始升级...*/"<br/>";
			echo str_repeat(" ",4096);//4096
			ob_flush();
			flush();
			$i = 0;
			$upgrade = 0;

			echo str_repeat(" ",4096);//4096
			
			ob_flush();
			flush();

			while($i < 60){
				sleep(1);
					
				$i++;
				$progress = GetLocalUpgradeProgress();
				if($progress['progress'] == 10){
					echo ".";
					echo str_repeat(" ",4096);//4096
					ob_flush();
					flush();
				}
				if($progress['progress'] >= 45 && $progress['progress']<=90){
					echo ". .";
					echo str_repeat(" ",4096);//4096
					ob_flush();
					flush();
				}
				if ($progress['progress'] >= 99){
					$upgrade = 1;
					echo $Lan_Main["UPGRADE_SUCCESS"][$Language_Type] . /*"...升级成功！！！*/"<br/>";
					echo $Lan_Main["UPGRADE_RESTART"][$Language_Type] . /*"...设备将马上进行重启，请稍后...*/"<br/>";
					echo str_repeat(" ",4096);//4096
					ob_flush();
					flush();
					break;
				}
				
			}
			sleep(4);	/*avst server 端 sleep 5秒 之后会重启， 所以必须的在server 重启之前跳转到等待页面*/

			if($upgrade == 1)
			{
				$SE = new SocketEntity();
				$SE->SendCmdAction(Reboot());
				$SE->CloseNoWait();
				echo("<script> window.location='waitforreboot.php';</script>");	
				
				
				/*
				while(1)
				{
					echo str_repeat(" ",4096);		
					$socket = open_socket();
					if($socket > 0)
					{
						socket_close($socket);
						echo "重启成功，正在进行跳转...<br/>";	
						ob_flush();
						flush();
						break;
					}
					else
					{
						echo "设备正在重启中，请稍后...<br/>";
					}
					ob_flush();
					flush();
					sleep(1);
				}	*/
			}
			else
			{
				echo $Lan_Main["UPGRADE_FAILED"][$Language_Type];//设备升级失败		
				echo "<br/><br/>";		
				echo '<a href="./main.php" title="返回设备页面">{$Lan_Main["UPGRADE_BACK"][$Language_Type]}</a>';
			}
			
			/*
			$i = 4;
			while(1)
			{
				if($i == 0)
					break;
					
				$i--;
				echo str_repeat(" ",4096);
				echo $i."秒后将进行跳转，...<br/>";
				
				ob_flush();
				flush();
				sleep(1);
			}	
			echo("<script> window.location='system.php?tabindex=0';</script>");*/
											
    	}
  	}
	else
  	{
		echo $Lan_Main["UPGRADE_FAILED"][$Language_Type];//设备升级失败		
		echo "<br/><br/>";		
		echo '<a href="./main.php" title="返回设备页面">{$Lan_Main["UPGRADE_BACK"][$Language_Type]}</a>';
	}
?>