<?php
include_once ("server_setting.php");
// error_reporting(E_ERROR);
header ( "content-type:text/html; charset=utf-8" );

//	获取输入源类型（SDI、HDMI）
function &GetChanInput(){
	global $split;
	global $localIP;
	global $localID;
	global $chanNO;
	global $streamtype;			//表示输入源类型（SDI、HDMI）
	global $reserved;
	global $reserved_len;
	global $reserved_con;

	$body = "CHANINPUT".$split.$localIP.$split.$localID.$split.$chanNO.$split.$reserved.$split.$reserved_len.$split.$reserved_con;

	$array =& get_param_by_cmd($body,true);

	$s = 5;
	$ret["ret"]			= get_array_value($array,$s++);
	$ret["chanNO"]		= get_array_value($array,$s++);
	$ret["ChanType"]	= get_array_value($array,$s++);
	//按照4块板子都插着 目前轮询4遍
	//for($i=0;$i<4;$i++){
			
		$ret["ChanLinkSrc"]		= get_array_value($array,$s++);
		$ret["ChanInput"]		= get_array_value($array,$s++);
	//}
	/*ChanLinkSrc		bit 位	返回值
	 *Media_SrcType_SDI = 0,		1
	 *Media_SrcType_HDMI、DVI,	    2
	 *Media_SrcType_VGA,			4
	 *Media_SrcType_CVBS,			8
	 *Media_SrcType_YUV,
	 *
	 * ChanType   视频源类型  SDI、DVI、VGA、CVBS、YUV
	 *
	 * m_iChanLinkSrc[0] -> 380 A   口:
	 * 数值采用8  4  2  1    的方式表示,    支持源序号从0 开始.
	 * bit[0~4] = Media_SrcType_Max 枚举信息
	 * 比如 : m_iChanLinkSrc[0] = 1  表示Media_SrcType_SDI  插上;
	 * m_iChanLinkSrc[0] = 4  表示Media_SrcType_VGA  插上;
	 * m_iChanLinkSrc[0] = 5  表示同时插上Media_SrcType_SDI  与Media_SrcType_VGA;
	 * 注意:  上面描述的"插上"  与"使用"  不是一个概念，即是说，接上任意视频源不代表采集该视频源
	 * int m_iChanLinkSrc[4]; // 0-> A 口，1-> B 口
	 *
		*/
//	$ret["ChanType"]	= get_array_value($array,8);
	return $ret;
}

function &Get380Sourceinput($streamtype)
{
	global $split;
	global $localIP;
	global $localID;
	global $chanNO;
	global $streamtype;			//表示输入源类型（SDI、HDMI）
	global $reserved;
	global $reserved_len;
	global $reserved_con;

	$body = "380SOURCEINPUT".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
	$array =& get_param_by_cmd($body,true);
	//var_dump($body);
	//HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
	$ret["ret"]			= get_array_value($array,5);
	$ret["chanNO"]		= get_array_value($array,6);
	$ret["streamtype"]  = get_array_value($array,7);
	$ret["width"]		= get_array_value($array,8);
	$ret["height"]		= get_array_value($array,9);
	$ret["FPS"]			= get_array_value($array,10);
	$ret["TYPE"]		= get_array_value($array,11);

	return $ret;
}

// 获取视频分辨率(视频采集信息)
function &GetVideoCapture($streamtype) {
	global $split;
	global $localIP;
	global $localID;
	global $chanNO;
    global $streamtype;
	global $reserved;
	global $reserved_len;
	global $reserved_con;
	
	$body = "VIDEOFIXFOCUSIMAGE" . $split . $localIP . $split . $localID . $split . $chanNO . $split . $streamtype . $split . $reserved . $split . $reserved_len . $split . $reserved_con;
	
	$array = & get_param_by_cmd ( $body, true );
	
	// HEAD IP VERSION GET PACKAGESTRATEGY strategy time size
	$s = 5;
	$ret ["ret"] = get_array_value ( $array, $s ++ );
	$ret ["chan"] = get_array_value ( $array, $s ++ );
	$ret ["streamtype"] = get_array_value ( $array, $s ++ );
	$ret ["videoStd"] = get_array_value ( $array, $s ++ );
	$ret ["FPS"] = get_array_value ( $array, $s ++ );
	$ret ["brightness"] = get_array_value ( $array, $s ++ );
	$ret ["contrast"] = get_array_value ( $array, $s ++ );
	$ret ["saturation"] = get_array_value ( $array, $s ++ );
	$ret ["sharpness"] = get_array_value ( $array, $s ++ );
	$ret ["BLCEnable"] = get_array_value ( $array, $s ++ );
	$ret ["BLCLevel"] = get_array_value ( $array, $s ++ );
	$ret ["lightingCondition"] = get_array_value ( $array, $s ++ );
	$ret ["histogram"] = get_array_value ( $array, $s ++ );
	$ret ["stabilization"] = get_array_value ( $array, $s ++ );
	$ret ["LDC"] = get_array_value ( $array, $s ++ );
	$ret ["DREMode"] = get_array_value ( $array, $s ++ );
	$ret ["DREStrength"] = get_array_value ( $array, $s ++ );
	$ret ["_2AEngine"] = get_array_value ( $array, $s ++ );
	$ret ["_2AMode"] = get_array_value ( $array, $s ++ );
	$ret ["priority"] = get_array_value ( $array, $s ++ );
	$ret ["flickerCtrl"] = get_array_value ( $array, $s ++ );
	$ret ["WBMode"] = get_array_value ( $array, $s ++ );
	$ret ["VNFEnable"] = get_array_value ( $array, $s ++ );
	$ret ["VNFMode"] = get_array_value ( $array, $s ++ );
	$ret ["VNFStrength"] = get_array_value ( $array, $s ++ );
	$ret ["mirrormode"] = get_array_value ( $array, $s ++ );
	return $ret;
}

// 设置视频码流分辨率
	function &SetVideoCaptureParam($videoStd,$FPS,$brightness,$contrast,$saturation,$sharpness,$BLCEnable,$BLCLevel,$lightingCondition,$histogram,$stabilization,$LDC,$DREMode,$DREStrength,$_2AEngine,$_2AMode,$priority,$flickerCtrl,$WBMode,$VNFEnable,$VNFMode,$VNFStrength,$mirrormode,$streamtype)
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;


		$body  =  "VIDEOFIXFOCUSIMAGE".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
								$videoStd.$split.
								$FPS.$split.
								$brightness.$split.
								$contrast.$split.
								$saturation.$split.
								$sharpness.$split.
								$BLCEnable.$split.
								$BLCLevel.$split.
								$lightingCondition.$split.
								$histogram.$split.
								$stabilization.$split.
								$LDC.$split.
								$DREMode.$split.
								$DREStrength.$split.
								$_2AEngine.$split.
								$_2AMode.$split.
								$priority.$split.
								$flickerCtrl.$split.
								$WBMode.$split.
								$VNFEnable.$split.
								$VNFMode.$split.
								$VNFStrength.$split.
								$mirrormode.$split.
								$reserved.$split.$reserved_len.$split.$reserved_con;

		return $body;
	}

	//获取视频主码流码率、关键帧间隔
	function GetVideoParam($streamtype)
	{
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body = "VIDEOCOMPRESS".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);
	
		//HEAD IP VERSION GET VIDEOCOMPRESS chan videostd fps ratecontrol bitrate qp iframerate encode
		$s = 5;
		$ret["ret"]			= get_array_value($array,$s++);
		$ret["chan"]		= get_array_value($array,$s++); 
		$ret["streamtype"]	= get_array_value($array,$s++);
		$ret["videostd"]    = get_array_value($array,$s++); 
		$ret["fps"]         = get_array_value($array,$s++);
		$ret["ratecontrol"] = get_array_value($array,$s++);	
		$ret["bitrate"]     = get_array_value($array,$s++);	
		$ret["qp"]          = get_array_value($array,$s++);		
		$ret["iframerate"]  = get_array_value($array,$s++);
		$ret["encode"]      = get_array_value($array,$s++);
		return $ret;
	}

	//设置视频主码流码率、关键帧间隔
	function setVideoParam($videostd,$framerate,$ratecontrol,$bitrate,$qp,$iframerate,$encode,$streamtype){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body =  "VIDEOCOMPRESS".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
												$videostd.$split.
												$framerate.$split.
												$ratecontrol.$split.
												$bitrate.$split.
												$qp.$split.
												$iframerate.$split.
												$encode.$split.
												$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}

	//获取码流码率控制
	function &getStreamcontrol($streamtype){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body  = "BITRATECTRL".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array = &get_param_by_cmd($body,true);

		$s = 5;
		$ret["ret"]				= get_array_value($array,$s++);
		$ret["chan"]			= get_array_value($array,$s++);
		$ret["Streamtype"]		= get_array_value($array,$s++);
		$ret["bitrate"]     	= get_array_value($array,$s++);
		return $ret;
	}


	//设置码流码率控制
	function &setStreamcontrol($Streamcontrol,$streamtype){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body =  "BITRATECTRL".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$Streamcontrol.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}
	//获取主码流B帧
	function &getFrameInfo($streamtype,$frameType){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

	/*
	 * 帧类型
	 * FRAME_TYPE_I 0
	 * FRAME_TYPE_P 1
	 * FRAME_TYPE_IDR 2
	 * FRAME_TYPE_AUDIO 3
	 * FRAME_TYPE_PCM 4
	 * FRAME_TYPE_YUV420 5
	 * FRAME_TYPE_OSD 6
	 * FRAME_TYPE_B 7
	 */
	
	$body = "FRAMEINFO" . $split . $localIP . $split . $localID . $split . $chanNO . $split . $streamtype . $split . $frameType . $split . $reserved . $split . $reserved_len . $split . $reserved_con;
	$array = & get_param_by_cmd ( $body, true );
	
	$s = 5;
	$ret ["ret"] = get_array_value ( $array, $s ++ );
	$ret ["chan"] = get_array_value ( $array, $s ++ );
	$ret ["streamtype"] = get_array_value ( $array, $s ++ );
	$ret ["frameType"] = get_array_value ( $array, $s ++ );
	$ret ["frameCount"] = get_array_value ( $array, $s ++ );
	
	return $ret;
}

	//设置主码流B帧
	function &setFrameInfo($streamtype,$frameType,$frameCount){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		global $reserved;
		global $reserved_len;
		global $reserved_con;

		$body =  "FRAMEINFO".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$frameType.$split.
							$frameCount.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}


// 设置直播服务器地址
function &ChangeMedia($media, $path, $port, $used, $streamtype) {
	global $split;
	global $localIP;
	global $localID;
	global $chanNO;
	global $streamtype;
	global $reserved;
	global $reserved_len;
	global $reserved_con;
	
	// $server_ip = $_SERVER["SERVER_ADDR"];
	// $reserved = "browser_".$server_ip;
	
	$body = "MEDIAPARA" . $split . $localIP . $split . $localID . $split . $chanNO . $split . $streamtype . $split . $media . $split . $path . $split . $port . $split . $used . $split . $reserved . $split . $reserved_len . $split . $reserved_con;
	return $body;
}

//获取设备是否向第三方服务器注册
function &getMediaOrch() {
	global $split;
	global $localIP;
	global $localID;
	//global $chanNO;
	global $streamtype;
	global $reserved;
	global $reserved_len;
	global $reserved_con;

	$body = "MEDIAORCH" . $split . $localIP . $split . $localID . $split . $chanNO . $split . $streamtype . $split . $reserved . $split . $reserved_len . $split . $reserved_con;
	$array = & get_param_by_cmd ( $body, true );

	$s = 7;
	$ret ["ret"] = get_array_value ( $array, $s ++ );
	$ret ["DevID"] = get_array_value ( $array, $s ++ );
	$ret ["DevName"] = get_array_value ( $array, $s ++ );
	$ret ["url"] = get_array_value ( $array, $s ++ );
	$ret ["username"] = get_array_value ( $array, $s ++ );
	$ret ["password"] = get_array_value ( $array, $s ++ );
	$ret ["used"] = get_array_value ( $array, $s ++ );

	return $ret;
}

// 设置设备向第三方服务器注册or取消注册
function &setMediaOrch($username,$password,$DevID,$DevName,$url,$used) {
	global $split;
	global $localIP;
	global $localID;
	global $chanNO;
	global $streamtype;
	global $reserved;
	global $reserved_len;
	global $reserved_con;

	$body = "MEDIAORCH" . $split . $localIP . $split . $localID . $split . $chanNO . $split . $streamtype . $split . 
	$DevID . $split .
	$DevName . $split .
	$url . $split .
	$username . $split . 
	$password . $split .
	$used . $split .
	$reserved . $split . $reserved_len . $split . $reserved_con;
	return $body;
}

	//重启server
	function RestartApp($reason)
	{
		global $split;
		$body = "RESTARTAPP".$split.$reason;
		return $body;
	}
	
	
	/**/
	//获取描述符
	function &getVideoName(){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $devName;

		global $reserved_len;
		global $reserved_con;

		global $reserved;		/*0=GB2312; 1=UTF-8  通道名称如果是中文的话，中文编码方式不同就会出现中文乱码问题 统一中文编码方式问题就解决了。*/
		$encoding = 1;
		$reserved = $encoding & 0xFF;    //低8位表示字符编码类型
		
		$body = "DESCRIPTION".$split.$localIP.$split.$localID.$split.
				
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);

		$s = 5;
		$ret["ret"]			= get_array_value($array,$s++);
		$ret["chan"]		= get_array_value($array,$s++); 
		$ret["devName"]	    = get_array_value($array,$s++);

		return $ret;
	}
	//设置描述符
	function &setVideoName($devName){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		//global $devName;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		
		//global $reserved;		/*0=GB2312; 1=UTF-8  通道名称如果是中文的话，中文编码方式不同就会出现中文乱码问题 统一中文编码方式问题就解决了。*/
		$encoding = 1;
		$reserved = $encoding & 0xFF;    //低8位表示字符编码类型

		$body =  "DESCRIPTION".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$devName.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}
	
	
	//获取描述符
	function &getorchname(){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $devName;

		global $reserved_len;
		global $reserved_con;

		global $reserved;		/*0=GB2312; 1=UTF-8  通道名称如果是中文的话，中文编码方式不同就会出现中文乱码问题 统一中文编码方式问题就解决了。*/
		$encoding = 1;
		$reserved = $encoding & 0xFF;    //低8位表示字符编码类型
		
		$body = "DESCRIPTION".$split.$localIP.$split.$localID.$split.
				
				$reserved.$split.$reserved_len.$split.$reserved_con;
		$array =& get_param_by_cmd($body,true);

		$s = 5;
		$ret["ret"]			= get_array_value($array,$s++);
		//$ret["chan"]		= get_array_value($array,$s++); 
		$ret["devName"]	    = get_array_value($array,$s++);

		return $ret;
	}
	//设置描述符
	function &setDescribeName($devName){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $streamtype;
		//global $devName;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		
		//global $reserved;		/*0=GB2312; 1=UTF-8  通道名称如果是中文的话，中文编码方式不同就会出现中文乱码问题 统一中文编码方式问题就解决了。*/
		$encoding = 1;
		$reserved = $encoding & 0xFF;    //低8位表示字符编码类型

		$body =  "DESCRIPTION".$split.$localIP.$split.$localID.$split.$chanNO.$split.$streamtype.$split.
							$devName.$split.
							$reserved.$split.$reserved_len.$split.$reserved_con;
		return $body;
	}
	
	//获取ID
	function &getequipmentid(){
		global $split;
		global $localIP;
		global $localID;
		global $chanNO;
		global $devName;
		global $reserved;
		global $reserved_len;
		global $reserved_con;
		$body  = "DEVICEID".$split.$localIP.$split.$localID.$split.
			   	 $reserved.$split.$reserved_len.$split.$reserved_con;
		$array = &get_param_by_cmd($body,true);
		$s = 5;
		$ret["ret"]			= get_array_value($array,$s++);
		//$ret["chan"]		= get_array_value($array,$s++);
		$ret["devName"]	    = get_array_value($array,$s++);
		return $ret;
	}

	
?>