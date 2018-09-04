<?php
	//接值
	if ($_GET) {
		$endpage = $_GET['endpage'];
		session_start();
		$token = $_SESSION['token'];
		$key = 'Bearer '.$token;
		$json = 'application/json';
		$url = "http://api.mudu.tv/v1/activities?&p=".$endpage;
		$res = http_request($key,$json,$url);
		$data = json_encode($res);
		return $data;
	} else {
		$next_page = $_POST['next_page'];
		session_start();
		$token = $_SESSION['token'];
		$key = 'Bearer '.$token;
		$json = 'application/json';
		$url = "http://api.mudu.tv/v1/activities?p=".$next_page;
		$res = http_request($key,$json,$url);
		$data = json_encode($res);
		return $data;
	}

	//指定频道接口
	function http_request($key,$json,$url){
       $headers = ["Authorization:".$key,"Content-Type:".$json];
      //初始化
	    $curl = curl_init();
	    //设置抓取的url
	    curl_setopt($curl, CURLOPT_URL, $url);
	    //设置头文件的信息作为数据流输出
	    curl_setopt($curl, CURLOPT_HEADER, 0);
	    //设置获取的信息以文件流的形式返回，而不是直接输出。
	    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 0);

	    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	    //执行命令
	    $output = curl_exec($curl);
	    //关闭URL请求
	    curl_close($curl);
	    return $output;
  	}