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
	ob_start();//��ʼ�������
	
	if (isset($_FILES["file"]["size"]) && $_FILES["file"]["size"] < 50*1024*1024)
  	{
		//echo "�ļ�С��50M";
  		if ($_FILES["file"]["error"] > 0)
    	{
    		echo $Lan_Main["UPGRADE_ERROR"][$Language_Type]/*"���ļ�ʧ�ܣ��������="*/ . $_FILES["file"]["error"] . "<br/>";
    	}
  		else
    	{	
			echo $Lan_Main["UPGRADE_AFTER_UPLOADING_FILES"][$Language_Type] . /*"�ϴ��ļ���ϣ�����׼�����̣��ļ���Ϣ���£�*/"<br/>";
			echo $Lan_Main["UPGRADE_FILE_NAME"][$Language_Type]/*"�ļ���:"*/   . $_FILES["file"]["name"] . "<br/>";
			echo $Lan_Main["UPGRADE_FILE_SIZE"][$Language_Type]/*"�ļ���С:"*/ . $_FILES["file"]["size"] . " Byte<br/>";
			echo "<br />";
	
			$dest = "/upgrade/" . $_FILES["file"]["name"];
			move_uploaded_file($_FILES["file"]["tmp_name"], $dest);
			
			echo $Lan_Main["UPGRADE_PREPARATION"][$Language_Type] . /*"��׼����...*/"<br/>";
			echo $Lan_Main["UPGRADE_PATIENCE"][$Language_Type] . /*"���̱Ƚϻ��������ĵȴ�...*/"<br/>";
			echo str_repeat(" ",4096);//4096
			ob_flush();
			flush();
			LocalUpgrade($dest);

			echo $Lan_Main["UPGRADE_BEGIN"][$Language_Type] . /*"��ʼ��...*/"<br/>";
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
					echo $Lan_Main["UPGRADE_SUCCESS"][$Language_Type] . /*"...��ɹ�������*/"<br/>";
					echo $Lan_Main["UPGRADE_RESTART"][$Language_Type] . /*"...�豸�����Ͻ������������Ժ�...*/"<br/>";
					echo str_repeat(" ",4096);//4096
					ob_flush();
					flush();
					break;
				}
				
			}
			sleep(4);	/*avst server �� sleep 5�� ֮��������� ���Ա������server ����֮ǰ��ת���ȴ�ҳ��*/

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
						echo "�����ɹ������ڽ�����ת...<br/>";	
						ob_flush();
						flush();
						break;
					}
					else
					{
						echo "�豸���������У����Ժ�...<br/>";
					}
					ob_flush();
					flush();
					sleep(1);
				}	*/
			}
			else
			{
				echo $Lan_Main["UPGRADE_FAILED"][$Language_Type];		
				echo "<br/><br/>";		
				echo '<a href="./common.php" title="">{$Lan_Main["UPGRADE_BACK"][$Language_Type]}</a>';
			}
			
			/*
			$i = 4;
			while(1)
			{
				if($i == 0)
					break;
					
				$i--;
				echo str_repeat(" ",4096);
				echo $i."��󽫽�����ת��...<br/>";
				
				ob_flush();
				flush();
				sleep(1);
			}	
			echo("<script> window.location='system.php?tabindex=0';</script>");*/
											
    	}
  	}
	else
  	{
		echo $Lan_Main["UPGRADE_FAILED"][$Language_Type];//
		echo "<br/><br/>";		
		echo '<a href="./common.php" title="">{$Lan_Main["UPGRADE_BACK"][$Language_Type]}</a>';
	}
?>