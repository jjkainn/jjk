var playBGColor="#f8ecac"; // ���ڵ㲥�ļ���ӦSpan�ı�����ɫ
var defaultBGColor="#ffffff"; // Ĭ����Ƶ�ļ�Span�ı�����ɫ
var showDetailBGColor="#bfcdc9"; // ��չ����ϸ��Ϣ��Ƶ�ļ�Span�ı�����ɫ

var hintJsonArray={"json":				
	{
		"queray_fromTime":"��ѯ��ʼʱ��(yyyy-MM-dd hh:mm:ss),��'Enter'��ѯ.","queray_toTime":"��ѯ����ʱ��(yyyy-MM-dd hh:mm:ss),��'Enter'��ѯ."
	}
}.json;
function showDetail(id){	// ˫����ʾ���� ��ϸ��Ϣ		
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
		if(lastPlayVideoId && id==lastPlayVideoId) return;		// ����ǵ�ǰ���ڲ��ŵ�,�򲻸ı��䱳��ɫ
		$(videoFileNameDivId).style.backgroundColor=defaultBGColor;
	}else{
		$(detailDivId).style.display="block";
		if(lastPlayVideoId && id==lastPlayVideoId) return;	    // ����ǵ�ǰ���ڲ��ŵ�,�򲻸ı��䱳��ɫ
		$(videoFileNameDivId).style.backgroundColor=showDetailBGColor;
	}
}

var lastPlayVideoId;  //��һ�ε㲥��Ƶ�ļ�Id , �����ø�ID�����Զ�����Ƶ

function playVideo(videoId,path,flag){
	if(lastPlayVideoId){
		if(lastPlayVideoId!=videoId){	
			var display=$("video_"+lastPlayVideoId+"_detailInfo").style.display;
			if(display=="block"){
				$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=showDetailBGColor;  // ��λ��һ�ε㲥��Span����ɫ
			}else{
				$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=defaultBGColor;  // ��λ��һ�ε㲥��Span����ɫ
			}						
		}
	}
	lastPlayVideoId=videoId;
	$("video_"+lastPlayVideoId+"_fileName").style.backgroundColor=playBGColor;  //�����ڵ㲥��spanͻ����ʾ
	$("video_"+lastPlayVideoId+"_detailInfo").style.display="block"; //����ʾ����ϸ��Ϣ
	//alert("�㲥:"+path);
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
//��������ʱ��ɸѡ


// ��ɸѡ
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
			//�����ʽ�н����Ľ���ʱ����ڿ�ʼʱ��,�򽻻�����ֵ
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
			alert("��ѯ���Ϊ��,�������ѯ��������Ƶ�ļ�!");		
		}
		return;
	}
}
function query(){
	var begin=$("queray_fromTime").value;
	if(!begin) 
	{
		alert("�����뿪ʼʱ��");
		return;
	}
	
	var end=$("queray_toTime").value;
	if(!end) 
	{
		alert("���������ʱ��");
		return;
	}
	if(!doFilter(begin,end)){
		alert("��ѯ���Ϊ��,�������ѯ��������Ƶ�ļ�!");		
	}
}