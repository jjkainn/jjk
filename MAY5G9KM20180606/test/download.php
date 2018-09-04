<?php
header("Content-type:text/html;charset=utf-8");

if($_GET){
	if($_GET['action'] == 'download'){
		download();
	}else{
		echo"<script>alert('请求错误');history.go(-1);</script>";  
		return;
	}
}else{
		echo"<script>alert('请求错误');history.go(-1);</script>";  
		return;
}

function download(){
	if($_POST['file']){
		$new_name = "";
		$file_url = $_POST['file'];
		$file_name=basename($file_url);
        $file_type=explode('.',$file_url);
        $file_type=$file_type[count($file_type)-1];
        $file_name=trim($new_name=='')?$file_name:urlencode($new_name).'.'.$file_type;

		
		//$file_name = iconv("utf-8","gb2312",$file_name);
		$file_sub_path = $_SERVER['DOCUMENT_ROOT']."/recordfile/"; //dirname(__file__);
		$file_path = $file_sub_path.$file_url;
		/**/if(!file_exists($file_path)){
			echo "<script>alert('该文件不存在');history.go(-1);</script>";
			return;
		}else{
			//var_dump($file_path);die;
			$fp = fopen($file_path,"r");
			$filesize = filesize($file_path);
			$buffer=1024;   //定义1KB的缓存空间
			$file_count=0;  //计数器,计算发送了多少数据
			Header("Content-type:application/octet-stream");
			Header("Accept-Ranges:bytes");
			Header("Accept-Length:".$filesize);
			Header("Content-Disposition:attachment;filename=".$file_name);
			while(!feof($fp) && ($filesize>$file_count)){
				$file_con=fread($fp,$buffer);
				$file_count+=$buffer;
				echo $file_con;
			}
			fclose($fp);
			exit;
		}
	}else{
		echo"<script>alert('没写文件名吧');history.go(-1)</script>";
		return;
	}
}

?>
