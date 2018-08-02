<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>DM385视频流测试</title>
	<script src="./js/jquery-1.7.2.min.js"></script>
    <script src="./js/flowplayer-3.2.4.min.js"></script>
  </head>
	<!----><script>
		//var livestreamName = prompt("请输入直播流名","");
		/*function getlivestreamName(){
			var livestreamName = document.getElementById('livestreamName');
			var submit = document.getElementById('submit');
			var livestreamNameValue = livestreamName.value;
			$.post("test.php",{livestreamNameValue:livestreamNameValue},function(msg){
				if(msg == 1){
					livestreamName.style.display='none';
					submit.style.display='none';
				}
			})
		}*/

	</script>
<body>
		<!--<input type="text" value='' name='livestreamName' id='livestreamName'>
		<input type="button" onclick="getlivestreamName()" id="submit" value="获取流名">-->
		<div class="row-fluid">
			<div class="span12">
					<?php
						error_reporting(E_ERROR);
						$Platform = explode(";",$_SERVER["HTTP_USER_AGENT"]);
						$AndroidPlatform = "rtmp";
						for($i=0;$i<count($Platform);$i++){
							if(stristr($Platform[$i],'Android') || 
								stristr($Platform[$i],'iPhone') ||
								stristr($Platform[$i],'iPad') ||
								stristr($Platform[$i],'iOS') ||
								stristr($Platform[$i],'iPod') ||
								stristr($Platform[$i],'iWatch') ||
								stristr($Platform[$i],'BlackBerry')){
									$AndroidPlatform = "http";
									break;
							}
						}

						$liveName = "DM385_0_0";
						$liveAddr = "rtmp://127.0.0.1:1935/live";
						$serverIP = $_SERVER['HTTP_HOST'];
						//$serverIP = "192.168.1.105";
						$liveAddrForRTMP = str_replace("127.0.0.1",$serverIP,$liveAddr);
						$liveAddrForHTTP = "http://127.0.0.1/hls/DM385_0_0.m3u8";
						$liveAddrForHTTP = str_replace("127.0.0.1",$serverIP,$liveAddrForHTTP);

						if($AndroidPlatform == 'http'){
					?>

						<div class="flowplayer" data-swf="flowplayer.swf" data-ratio="0.417" class="fluid">
							<video height="480px" width='640px' autoplay="autoplay" controls="controls" style="margin-top:300px; margin-left:150px;">
								<source type="video/flv" src="<?php echo $liveAddrForHTTP;?>"/>
								<source type="video/webm"src="<?php echo $liveAddrForHTTP;?>"/>
								<source type="video/mp4" src="<?php echo $liveAddrForHTTP;?>"/>
								<source type="video/ogv" src="<?php echo $liveAddrForHTTP;?>"/>
							</video>
						</div>
					<?php
						}else{
					?>

						<div style="margin:0 auto; text-align:center; width:1300px; height:800px; line-height:800px;"><!--直播-->
							<!--width:540px;height:380px;-->
							<a style="display:block;width:1280px;height:720px;" id="live"></a> 
							<script>
								$f("live", {src:"./js/flowplayer-3.2.18.swf",wmode:"direct"}, {
									buffering : true,
									clip: {
										url: '<?php echo $liveName;?>',
										live: true,
										bufferLength: 0.5,
										//bufferLength: 0,
										autoPlay: true,
										autoBuffering: false,
										accelerated: true,
										provider: 'influxis'
									},
					
									plugins: {
										influxis: {
											url: './js/flowplayer.rtmp.swf',
											netConnectionUrl: '<?php echo $liveAddrForRTMP;?>'
										}
									}
								});
							</script>
						</div> <!--直播-->
					<?php
						}
					?>
					
			</div>
		</div>
				
</body>
</html>
<script>
	var flagA = 0;
	var flagB = 0;
	var show_detail = true;
	function open(){
		if(flagA == 0){
			$('#vod').css("display","block");
			$('#VideoBg').css("display","block");
			//$('#VODdiv').css("display","none");
			flagA = 1;
			var aobj = document.getElementById("switch");
			aobj.innerHTML = "关闭";
		}else{
			$('#vod').css("display","none");
			$('#VideoBg').css("display","none");
			$('#VODdiv').css("display","none");
			flagA = 0;
			var aobj = document.getElementById("switch");
			aobj.innerHTML = "展开";
		}
	}
	function VODConvert(){
		alert("暂不支持");die;
		if(flagB == 0){
			$('#VODdiv').css("display","block");
			$('#VideoBg').css("display","none");
			flagB = 1;
			//alert(document.getElementsByName('player2').id);
			//document.getElementsByName('player2').id="player1";
			//alert(document.getElementsByName('player1').id);
			var aobj = document.getElementById("vod");
			aobj.innerHTML = "转换为直播";
		}else{
			$('#VODdiv').css("display","none");
			$('#VideoBg').css("display","block");
			flagB = 0;
			var aobj = document.getElementById("vod");
			aobj.innerHTML = "转换为点播";
		}
	}
	function PlayVodFile()
	{
		//var EMSIP = '115.29.148.122';
		flowplayer().stop();
		show_detail = false;
		//var url = document.location;
		var path = "http://www.avsolutiontech.com/avsolutiontech/video/M.flv"; //浏览器地址
		flowplayer().play(path);

	}
</script>