var lastDisplayDiv;

/*var hintJsonArray_CH={"json":				
	{
		"VIDEO_CAP":"视频输入通道",
		"Audio_CAP":"音频设置。如果不需要音频，请选择关闭音频，这样可以节省系统的资源；线路输入为LINE IN，可以接入拾音器、麦克风等设备; HDMI输入为从HDMI接口中获取音频,HDMI的音频采样率由输入源决定，不能手动修改",
		"audioSR":"音频采样率",
		"CAPTURE_AUDIO_INPUT":"音量输入。最小值为0，最大值为119",
		"CAPTURE_AUDIO_INPUT_Val":"自动增益控制启动",
		"CAPTURE_AUDIO_NOISE_THRESHOLD":"噪声阈值。最小值为0，最大值为31",
		"CAPTURE_AUDIO_MAX_GAIN_ALLOWED":"自动增益。最小值为0，最大值为119"
	}
}.json;

var hintJsonArray_EN={"json":
	{
		"VIDEO_CAP":"Video input channel",
		"Audio_CAP":"Audio input set",
		"audioSR":"Audio sample rate ",
		"CAPTURE_AUDIO_INPUT":"Audio input",
		"CAPTURE_AUDIO_INPUT_Val":"Open AGC",
		"CAPTURE_AUDIO_NOISE_THRESHOLD":"Noise Threshold. min:0 max:31",
		"CAPTURE_AUDIO_MAX_GAIN_ALLOWED":"Automatic Gain min:0 max:119"
	}
}.json;*/

	function switchTable(tableIndex)
	{				
		if(lastDisplayDiv){
			lastDisplayDiv.style.display="none";
		}else{$("AudioCaptureParameter").style.display="none"; }
		switch(tableIndex)
		{
			case 0:
				lastDisplayDiv=$("AudioCaptureParameter");
				lastDisplayDiv.style.display="block";
				break;
			case 1:
				lastDisplayDiv=$("VideoCaptureParameter");
				lastDisplayDiv.style.display="block";
				break;
			case 2:
				lastDisplayDiv=$("ImageCaptureParameter");
				lastDisplayDiv.style.display="block";
				break;
			case 3:
				lastDisplayDiv=$("OSDCaptureParameter");
				lastDisplayDiv.style.display="block";
				break;
		}
	}

	function ChangeAudioFrequency()
	{
		var x = document.getElementById('Audio.CH');	
		var y = document.getElementById('audioSR');
		ClearSelect(y);
		
		if(x.checked)    //单声道
		{
			appendChildOption(y,"8000","8k sps");
			appendChildOption(y,"16000","16k sps");
			
			y.value = 8000;
		}
		else
		{
			appendChildOption(y,"8000","8k sps");
			appendChildOption(y,"16000","16k sps");	
			appendChildOption(y,"24000","24k sps");	
			appendChildOption(y,"44100","44.1k sps");	
			appendChildOption(y,"48000","48k sps");	
			appendChildOption(y,"96000","96k sps");	
			
			y.value = 44100;
		}	
	}
	
	function CheckFrameRate()
	{		
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.FRMRT");
		ClearSelect(y);
		
		if(x.value == "1920*1080")
		{
			appendChildOption(y,"15","15fps");	
			appendChildOption(y,"24","24fps");
			//appendChildOption(y,"25","25fps");
			appendChildOption(y,"30","30fps");
			
			y.value = 30;
		}
		else if(x.value == "1280*720")
		{
			appendChildOption(y,"15","15fps");	
			appendChildOption(y,"24","24fps");
			appendChildOption(y,"30","30fps");
			//appendChildOption(y,"50","50fps"); 暂时不开始50和60
			//appendChildOption(y,"60","60fps");
			
			y.value = 30;
		}
		else if(x.value == "720*576")
		{
			appendChildOption(y,"10","10fps");	
			appendChildOption(y,"25","25fps");
		
			y.value = 25;
		}
		else if(x.value == "720*480")
		{
			appendChildOption(y,"15","15fps");
			appendChildOption(y,"30","30fps");
		
			y.value = 30;
		}
		else if(x.value == "640*480")
		{
			appendChildOption(y,"15","15fps");	
			appendChildOption(y,"30","30fps");
		
			y.value = 30;
		}
	}
	
	function CheckHR()
	{		
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.FRMRT");
		var z = document.getElementById("Video.HR");
		ClearSelect(z);
		if(x.value == "1920*1080")
		{		
			appendChildOption(z,"0","关闭");	
			z.value = 0;
		}
		else if(x.value == "1280*720")
		{
			if(y.value > 30)
			{
				appendChildOption(z,"0","关闭");
				z.value = 0;
			}
			else
			{
				appendChildOption(z,"1","开启");	
				z.value = 1;
			}
		}
		else 
		{
			appendChildOption(z,"0","关闭");
			appendChildOption(z,"1","开启");
			z.value = 1;
		}
		
	}
	function CheckHS()
	{
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.FRMRT");
		var z = document.getElementById("Video.HS");
		ClearSelect(z);
		if(x.value == "1920*1080")
		{
			appendChildOption(z,"0","关闭");
			z.value = 0;
		}
		else if(x.value == "1280*720")
		{
			appendChildOption(z,"0","关闭");
			z.value = 0;
		}
		else 
		{
			appendChildOption(z,"0","关闭");
			appendChildOption(z,"1","开启");
			z.value = 0;
		}
	}
	
	function CheckISS()
	{
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.FRMRT");	
		var z = document.getElementById("Video.ISS");
		ClearSelect(z);
		if(x.value == "1920*1080")
		{		
			if(y.value == 15)
			{				
				appendChildOption(z,"0","关闭");
				appendChildOption(z,"1","开启");
				z.value = "1";
			}
			else
			{
				appendChildOption(z,"0","关闭");
				z.value = "0";
			}
		}
		else if(x.value == "1280*720")
		{
			if(y.value <= 30)
			{				
				appendChildOption(z,"0","关闭");
				appendChildOption(z,"1","开启");
				z.value = "1";
			}
			else
			{
				appendChildOption(z,"0","关闭");
				z.value = "0";
			}
		}
		else if(x.value == "720*576")
		{
			if(y.value >=25)
			{
				appendChildOption(z,"0","关闭");
				z.value = "0";	
			}
			else
			{
				appendChildOption(z,"1","开启");
				z.value = "1";
			}
		}
		else
		{
			appendChildOption(z,"0","关闭");
			appendChildOption(z,"1","开启");
			z.value = "1";
		}
	}
	
	function selectChange1()
	{
		CheckFrameRate();
		CheckHR();
	    CheckHS();
		CheckISS();
	}
	
	function selectChange2()
	{
		CheckHR();
	    CheckHS();
		CheckISS();
	}
	/*
	function selectChange3()
	{
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.HR");
		var z = document.getElementById("Video.HS");
		if(x.value == "720*576" || x.value == "720*480" || x.value == "640*480")
		{
			if(y.value == '1')
			{
				z.value = 0;
			}
			else
			{
				z.value = 1;
			}
		}
	}
	*/
	
	function selectChange4()
	{
		var x = document.getElementById('Video.FRMSZ');	
		var y = document.getElementById("Video.HR");
		var z = document.getElementById("Video.HS");
		if(x.value == "720*576" || x.value == "720*480" || x.value == "640*480")
		{
			if(z.value == '1')
			{
				y.value = 0;
			}
			else
			{
				y.value = 1;
			}
		}	
	}
	
	
	function CheckSceneMode()
	{
		var x = document.getElementById('Video.SCNMD');	
		var y = document.getElementById("Video.SCNIDX");	
		ClearSelect(y);
		if(x.checked == true)
		{
			appendChildOption(y,"2","夜晚1");
			appendChildOption(y,"3","夜晚2");
			appendChildOption(y,"13","自动");
			appendChildOption(y,"14","宽动态");
			appendChildOption(y,"15","高色温");
			y.value = "13";
		}
		else
		{
			appendChildOption(y,"0","关闭");	
		}
			
	}


	document.write("<script language='javascript' src='util.js'></script>");
	


	
	/*function ShowVideoInputInfo(inwidth ,inheight, infps,intype,outwidth ,outheight, outfps,outtype)
	{
		//alert(intype);
		var Type;
		if(intype == "0")
		{
			Type = "p ";
		}
		else if(intype =="1")
		{
			Type = "i ";
		}
		//alert("fsfsf");
		if(outwidth == 736 && outheight == 576){
			outwidth = 720;
			outheight =	576;
		}
		if(outwidth == 736 && outheight == 480){
			outwidth = 720;
			outheight = 480;
		}
		if(outwidth == 800 && outheight == 608){
			outwidth = 800;
			outheight = 600;
		}
		if(outwidth == 1376 && outheight == 768){
			outwidth = 1360;
			outheight = 768;
		}
		if(outwidth == 1440 && outheight == 912){
			outwidth = 1440;
			outheight = 900;
		}
		if(outwidth == 1696 && outheight == 1056){
			outwidth = 1680;
			outheight = 1050;
		}
		if(outwidth == 1920 && outheight == 1088){
			outwidth = 1920;
			outheight = 1080;
		}
		//if(language == "CH")
		//{
			//var msg = "输入分辨率为" + width + "*" + height + "0" + ",帧率" + fps;
			var msg = "输入分辨率为:" + inwidth + "*" + inheight + Type + "帧率:" + infps + "  输出分辨率为:" + outwidth + "*" + outheight + "p" +  "帧率:" + outfps;
			var warnmsg = "提示！当前视频已经接入，但未配置详细信息。请尽快配置";
		/*}
		else
		{
			var msg = "Input Resolution is :" + inwidth + "*" + inheight  + Type + " FPS is :" + infps + " Output Resolution is  :" + outwidth + "*" + outheight + "p" +  "FPS :" + outfps;	
			var warnmsg = "Warning ！Video input not set correctlly !";
		}*
		SetInnerText('V_Detail_Info',msg);
		//alert("fsfsfs");
	
	}*/

	function ChangeAudioInput(val,Audio_Compress_Standard)
	{
		//alert(val);
		//数字音频 Audio_HDMI  var z;
		var x = document.getElementById('Audio_CLOSE');
		var z = document.getElementById("Audio_HDMI");
		var v = document.getElementById("audioSR");

		
		var v = document.getElementById("audioSR");
		if(Audio_Compress_Standard !== 'g711'){
			if(val == 0 || val == 3 || val == 5 || val == 6){
				v.setAttribute('disabled', true);
			}else{
				v.removeAttribute('disabled');
			}
		}else{
			v.setAttribute('disabled', true);
		}

	}
	
	function SetAudioInput(input)
	{
		if(0 == input)
		{
			document.getElementById('Audio_CLOSE').checked = true;
		}
		else if(2 == input)
		{
			document.getElementById('Audio_LINE_IN').checked = true;
		}
		else if(3 == input)
		{
			document.getElementById('Audio_HDMI').checked = true;
		}
		else if(4 == input)
		{
			document.getElementById('Audio_MIC_IN').checked = true;
		}
		else if(5 == input)
		{
			document.getElementById('Audio_HDMI2').checked = true;
		}	
		else if(6 == input)
		{
			document.getElementById('Audio_HDMI3').checked = true;
		}	
	}
	function SetAGC_value(){
		
		a=document.getElementById("CAPTURE_AUDIO_NOISE_THRESHOLD");
		b=document.getElementById("CAPTURE_AUDIO_MAX_GAIN_ALLOWED");
			if(c.checked == true){
			   a.removeAttribute('disabled');
			   b.removeAttribute('disabled');
			}else{
			   a.setAttribute('disabled', true);
			   b.setAttribute('disabled', true);
			}
	}

