<?php
header("Content-type: text/html; charset=utf-8"); 
	//接值
	$email = $_POST['email'];
	$password = $_POST['password'];
	//定义访问接口
	$url = "http://mudu.tv/session.php?a=ajaxGetToken";
	//接口需要的数据
	$post_data = array(
	"email" => $email,
	"password" => $password
	);
	//调用接口方法
	$data = curl_requset($url,$post_data);
	//解析返回json数据
	$date = json_decode($data,true);

	$flag = $date['flag'];
	//根据状态值判断并返回前台
	if ($flag !== 100) {
		echo $flag;
	} else {
		$token = $date['token'];
		session_start();
		$_SESSION['token'] = $token;
		$key = 'Bearer '.$token;
		$json = 'application/json';
		$url = "http://api.mudu.tv/v1/activities";
		$res = http_request($key,$json,$url);
		$data = json_encode($res);
		return $data;
	}
	//频道接口
	function http_request($key,$json,$url){
       $headers = array("Authorization".":".$key,
       					"Content-Type".":".$json
       					);
       // print_r($headers);die;
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
		//curl调用接口
	function curl_requset($url,$post_data) {
		//初始化
		$curl = curl_init();
		//设置抓取的url
		curl_setopt($curl, CURLOPT_URL, $url);
		//设置获取的信息以文件流的形式返回，而不是直接输出。
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		//设置post方式提交
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		//执行命令
		$data = curl_exec($curl);
		//关闭URL请求
		curl_close($curl);
		return $data;
	}
