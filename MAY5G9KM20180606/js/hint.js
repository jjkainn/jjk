
var ie=document.all;
var ns6=document.getElementById&&!document.all;
var detaultcontents="暂无相关解释!";


//
function getQueryString(queryStringName)
{
 var returnValue="";
 var URLString=new String(document.scripts[document.scripts.length-1].src);
 var serachLocation=-1;
 var queryStringLength=queryStringName.length;
 do
 {
  serachLocation=URLString.indexOf(queryStringName+"\=");
  if (serachLocation!=-1)
  {
   if ((URLString.charAt(serachLocation-1)=='?') || (URLString.charAt(serachLocation-1)=='&'))
   {
    URLString=URLString.substr(serachLocation);
    break;
   }
   URLString=URLString.substr(serachLocation+queryStringLength+1);
  }
 }
 while (serachLocation!=-1)
 if (serachLocation!=-1)
 {
  var seperatorLocation=URLString.indexOf("&");
  if (seperatorLocation==-1)
  {
   returnValue=URLString.substr(queryStringLength+1);
  }
  else
  {
   returnValue=URLString.substring(queryStringLength+1,seperatorLocation);
  } 
 }
 return returnValue;
}
//here to check the language;then to set the default title text;
var lang = getQueryString("lan");
if(lang==""){lang = "EN";detaultcontents="no anymore infomation!";}else{if(lang=="EN"){detaultcontents="no anymore infomation!";}}


//start
function initBK(){
var o = window.document.createElement('iframe');
o.id = 'fram_bk';
window.document.body.appendChild(o);
}

function getXY(e){
var posx=0,posy=0;
if(e==null) e=window.event;
if(e.pageX || e.pageY){
    posx=e.pageX; posy=e.pageY;
    }
else if(e.clientX || e.clientY){
    if(document.documentElement.scrollTop){
        posx=e.clientX+window.document.documentElement.scrollLeft;
        posy=e.clientY+window.document.documentElement.scrollTop;
        }
    else{
        posx=e.clientX+window.document.body.scrollLeft;
        posy=e.clientY+window.document.body.scrollTop;
        }
    }
    return {x:posx,y:posy};
}

//end
/*
var hintJsonArray_CH={"json":				
	{
		"time":"系统时间","LogLevel":"日志等级","LogFileSize":"日志文件大小","RemoteUpdate":"网络远程升级相关",
		"RemoteServerIP":"网络远程升级服务器IP","RemoteServerPort":"网络远程升级服务器升级端口","queray_fromTime":"选择查询录像文件的起始时间;格式:yyyy-MM-dd hh:mm:ss",
		"queray_toTime":"选择查询录像文件的结束时间;格式:yyyy-MM-dd hh:mm:ss"
	}
}.json;

var hintJsonArray_EN={"json":				
	{
		"time":"System Time","LogLevel":"Log Level","LogFileSize":"LogFile Size","RemoteUpdate":"About RemoteUpdate",
		"RemoteServerIP":"RemoteUpdate Server IP","RemoteServerPort":"RemoteUpdate Service Port","queray_fromTime":"Select Which BeginTime to Query the RecordFiles\r\nFormat:yyyy-MM-dd hh:mm:ss","queray_toTime":"Select Which EndTime to Query the RecordFiles\r\nFormat:yyyy-MM-dd hh:mm:ss"
	}
}.json;*/

function showhint(element, e , language)
{
	try
	{
		var content;
		/**
		 *	此处为获取提示信息的接口,您可以自定义其信息 
		 *  但必须保证您的元素具备name属性且最好具备唯一性; 
		 *  您可以将各个页面的显示信息分别写在不同的与各页面对应的 javascript 文件中并引入到该页面
		 *  本页面中的hintJsonArray仅为使用示例,以system.php为例
		 */
		
		if(element.name){ 
			if(language == null){
				if(hintJsonArray_CH!=undefined){
					content=hintJsonArray_CH[element.name];
				}
			}else{
				if(language == "CH" && hintJsonArray_CH)
				{
					content=hintJsonArray_CH[element.name];
				}
				else if(language == "EN" && hintJsonArray_EN)
				{
					content=hintJsonArray_EN[element.name];
				}
			}
		}
		content=(content==undefined || content=="")?detaultcontents:content;
		if ((ie||ns6) && $("hintbox")){
			 if (!$('fram_bk')){initBK();}
			 
			var p = getXY(e);
			 
			hitDiv=$("hintbox");
			hitDiv.innerHTML=content;
			hitDiv.style.left=hitDiv.style.top=-500;
			hitDiv.style.left=e.clientX+10;
			hitDiv.style.top=e.clientY+10;
			hitDiv.style.visibility="visible";
		
			with ($('fram_bk').style){
			  display='block';
			  visibility="visible";
			  top = (e.clientY+10)+"px";
			  left = (e.clientX+10)+"px";
			  height = hitDiv.offsetHeight +"px";
			}		
		}
	}
	catch(failed)
	{
	}
}

function hidetip(e){
	hitDiv=$("hintbox");
	hitDiv.style.visibility="hidden";
	hitDiv.style.left="-500px";
	
	if ($('fram_bk'))
	{
		with ($('fram_bk').style){
		  visibility="hidden";
		  left = "-500px";
		}	
	}
}

function createhintbox(){
	var divblock=document.createElement("div")
	divblock.setAttribute("id", "hintbox")
	
	document.body.appendChild(divblock)
	// 初始化所有input 标签鼠标悬浮事件
	initElementMouseOverEventHandler();
}
// 加载事件
function initElementMouseOverEventHandler(){
	var allInputs=document.getElementsByTagName("INPUT");
	initElement(allInputs);
	var allSelects=document.getElementsByTagName("SELECT");
	initElement(allSelects);
}

function initElement(elements){
	if(elements && elements.length>0){
		for(var i=0;i<elements.length;i++){
			var element=elements[i];
			var name=element.name;
			/**  方式一: 会出现闭包 问题(即element永远都是最后一个循环元素)
			element.onmouseover=function(event){	
				//return new function(){
					return function(){
						showhint.call(element,name,event || window.event);
					}
				//}
			}();
			*/
			/** 方式二: firefox对事件函数的支持不太好用
			if (window.addEventListener){
				alert(0);
				element.addEventListener("mouseover", function(){fn.call(obj||window,param1,param2);}, false);
			}
			else if (window.attachEvent){
				E.on(element,'mouseover',delegate(showhint,name,event || window.event,element));	
			}else{
				alert(2);
			}]
			*/
			//if (window.addEventListener){  // 方式三: 比较通用的解决办法
				element.onmouseover=function(event){
					delegateFirefoxShow(event)
				};
			//}
			//else if (window.attachEvent){  // 方式四: 利用call函数解决IE中方式1的Bug
			//	element.onmouseover=delegate(showhint,element,event || window.event,element);
			//}
			//element.onmouseover=delegate(showhint,name,event || window.event,element);
			element.onmouseout=function(event){				
				return new function(){
					hidetip();
				}
			}
		}
	}
}
function delegateFirefoxShow(event){
	var e=event || window.event;
	var eventSource =e.srcElement||e.target;     
	showhint(eventSource,e,lang);
}

function delegate(fn,param1,param2,obj){
    return function(){ 
        fn.call(obj||window,param1,param2);   
    }   
} 


if (window.addEventListener){
	window.addEventListener("load", createhintbox, false)
}
else if (window.attachEvent){
	window.attachEvent("onload", createhintbox)
}
else if (document.getElementById){
	window.onload=createhintbox
}
