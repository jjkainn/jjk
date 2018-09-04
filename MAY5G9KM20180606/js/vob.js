var playBGColor="#f8ecac"; // 正在点播文件对应Span的背景颜色
var defaultBGColor="#ffffff"; // 默认视频文件Span的背景颜色
var showDetailBGColor="#bfcdc9"; // 已展开详细信息视频文件Span的背景颜色

var hintJsonArray={"json":				
	{
		"queray_fromTime":"查询起始时间(yyyy-MM-dd hh:mm:ss),按'Enter'查询.","queray_toTime":"查询结束时间(yyyy-MM-dd hh:mm:ss),按'Enter'查询."
	}
}.json;
function showDetail(id){	// 双击显示隐藏 详细信息		
	if(false == show_detail)
	{
		show_detail = true;
		return;
	}
	var detailDivId="video_"+id+"_detailInfo";
	var videoFileNameDivId="video_"+id+"_fileName";				
	var display=$(detailDivId).style.display;
	
	if(display && display=="block"){
		$(detailDivId).style.display="none";
		if(lastPlayVideoId && id==lastPlayVideoId) return;		// 如果是当前正在播放的,则不改变其背景色
		$(videoFileNameDivId).style.backgroundColor=defaultBGColor;
	}else{
		$(detailDivId).style.display="block";
		if(lastPlayVideoId && id==lastPlayVideoId) return;	    // 如果是当前正在播放的,则不改变其背景色
		$(videoFileNameDivId).style.backgroundColor=showDetailBGColor;
	}
}

var lastPlayVideoId;  //上一次点播视频文件Id , 并利用该ID来做自动跳视频

function playVideo(videoId,path,flag){
	if(lastPlayVideoId){
		if(lastPlayVideoId!=videoId){	
			var display=$("video_"+lastPlayVideoId+"_detailInfo").style.display;
			if(display=="block"){
				$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=showDetailBGColor;  // 复位上一次点播的Span背景色
			}else{
				$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=defaultBGColor;  // 复位上一次点播的Span背景色
			}						
		}
	}
	lastPlayVideoId=videoId;
	$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=playBGColor;  //让正在点播的span突出显示
	$("video_"+lastPlayVideoId+"_detailInfo").style.display="block"; //并显示其详细信息
	//alert("点播:"+path);
	if(1 == flag)
	{
		PlayVodFile(path);
	}
	else
	{
		var href = "recordfile/" + path;
		window.open(href);
	}
}

var dateFormat= /^\d{4}-\d{1,2}-\d{1,2}(\s)\d{1,2}:\d{1,2}\d{1,2}$/; 
//根据输入时间筛选


// 做筛选
function doFilter(beginTime,endTime){				
	if(beginTime){
		try{
			beginTime=new Date(Date.parse(beginTime.replace(/-/g,   "/"))); 
			beginTime=beginTime.getTime();						
			if(endTime){
				try{
					endTime=new Date(Date.parse(endTime.replace(/-/g,   "/"))).getTime();   
				}catch(e){
					endTime=undefined;
				}							
			}
			//如果格式中解析的结束时间大于开始时间,则交换两者值
			if(endTime && endTime<beginTime){
				var temp=beginTime; beginTime=endTime;endTime=temp;
			}
			var videoSpans=$("videoListCenter").childNodes;
			if(!videoSpans || videoSpans.length==0)
				return false;
			var length=	videoSpans.length;					
			for(var i=0;i<videoSpans.length;i++){
				var title=videoSpans[i].title;
				if(title){
					try{
						var date=new Date(Date.parse(title.replace(/-/g,   "/"))).getTime(); 
						if(date<beginTime || (endTime && date>endTime)){
							videoSpans[i].style.display="none";
							length--;
							continue;
						}
						videoSpans[i].style.display="block";
					}catch(e){}
				}					
			}
			if(length>0) return true;
		}catch(e){}	 
	}						
	return false;
}
function doQuery(event){
	var e=event||window.event;
	var keynum;
	if(window.event) // IE
	{
	  keynum = e.keyCode
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
	  keynum = e.which
	}
	if(keynum && keynum==13){
		var begin=$("queray_fromTime").value;
		var end=$("queray_toTime").value;
		if(!begin && !end) return;
		if(!doFilter(begin,end)){
			alert("查询结果为空,无满足查询条件的视频文件!");		
		}
		return;
	}
}
function query(){
	var begin=$("queray_fromTime").value;
	if(!begin) 
	{
		alert("请输入开始时间");
		return;
	}
	
	var end=$("queray_toTime").value;
	if(!end) 
	{
		alert("请输入结束时间");
		return;
	}
	if(!doFilter(begin,end)){
		alert("查询结果为空,无满足查询条件的视频文件!");		
	}
}