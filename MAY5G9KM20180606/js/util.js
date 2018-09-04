

function SwitchBGImg(obj,imgPath,isRepeatX,isRepeatY){
	var backgroundImage="url('"+imgPath+"')";
	if(IsBool(isRepeatX) && isRepeatX){
		backgroundImage+=" repeat-x";
	}
	if(IsBool(isRepeatY) && isRepeatY){
		backgroundImage+=" repeat-y";
	}
	obj.style.backgroundImage=backgroundImage;
}

function getXmlHttpRequest(){
	var xmlHttp = false;
	try {
		xmlHttp = new XMLHttpRequest();
	} catch (trymicrosoft) {
		try {
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (othermicrosoft) {
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (failed) {
				xmlHttp = false;
			}
		}
	}
	if (!xmlHttp){
		alert("无法创建 XMLHttpRequest 对象！");
	}
	return xmlHttp;
}

function IsBool(value){
	if(value!=undefined && typeof(value)==typeof(true))
		return true;
	return false;
}

/****
 * 获取页面中id=@param id的元素 (简化document.getElementById(id)代码)
 * @param id    :需要获取的元素id
 * @param doc() :若传入了doc参数,则使用该document获取元素
 */
function $(id,doc){
	if(arguments.length==1){
		return document.getElementById(id);
	}else if(arguments.length==2){
		return doc.getElementById(id);
	}
}
/****
 * 获取页面中name=@param name的元素 (简化document.getElementsByName(name)代码)
 * @param name  : 需要获取的元素name
 * @param doc	: 若传入了document对象,则使用传入的document
 */
function $n(name,doc){
	if(arguments.length==1){
		return document.getElementsByName(name);
	}else if(arguments.length==2){
		return doc.getElementsByName(name);
	}
}

/*
==================================================================
字符串操作
Trim(string):去除字符串两边的空格
==================================================================
LTrim(string):去除左边的空格
==================================================================
*/
function LTrim(str)
{
    var whitespace = new String(" \t\n\r");
    var s = new String(str);
    if (whitespace.indexOf(s.charAt(0)) != -1)
    {
        var j=0, i = s.length;
        while (j < i && whitespace.indexOf(s.charAt(j)) != -1)
        {
            j++;
        }
        s = s.substring(j, i);
    }
    return s;
}

/*
==================================================================
RTrim(string):去除右边的空格
==================================================================
*/
function RTrim(str)
{
    var whitespace = new String(" \t\n\r");
    var s = new String(str);
    if (whitespace.indexOf(s.charAt(s.length-1)) != -1)
    {
        var i = s.length - 1;
        while (i >= 0 && whitespace.indexOf(s.charAt(i)) != -1)
        {
            i--;
        }
        s = s.substring(0, i+1);
    }
    return s;
}
/*
==================================================================
Trim(string):去除前后空格
==================================================================
*/
function Trim(str)
{
    return RTrim(LTrim(str));
}
/*
==================================================================
Trim(string):去除前后空格
==================================================================
*/
function IsStringEmpty(str){
	
	if(str==undefined || Trim(str)==""){
		return true;
	}
	return false;
}

function getRadioCheckedValue(radio){
	if(radio==undefined)return ;
	for(var i=0;i<radio.length;i++){
		if(radio[i].checked){
			return radio[i].value;
		}
	}
}
function setRadioCheckedValue(radio,value){
	if(radio==undefined)return ;
	if(value==undefined)return;
	for(var i=0;i<radio.length;i++){
		if(radio[i].value==value){
			radio[i].checked=true;
		}
	}
}
 function deleteSubNodes(obj){
 	var subNodes=obj.childNodes;
 	if(subNodes!=undefined ){
 		var nodeLength=subNodes.length;
 		if(nodeLength>0){
		 	for(var i=nodeLength-1;i>=0;i--){
		 		obj.removeChild(subNodes[i]);
		 	}
 		}
 	}
 }
/*
IsInt(string,string,int or string):(测试字符串,+ or - or empty,empty or 0)
功能：判断是否为整数、正整数、负整数、正整数+0、负整数+0
*/
function IsInt(objStr,sign,zero)
{
    var reg;    
    var bolzero;    
    if(Trim(objStr)=="")
    {
        return false;
    }
    else
    {
       objStr=objStr.toString();
    }    
    if((sign==null)||(Trim(sign)==""))
    {
        sign="+-";
    }   
    if((zero==null)||(Trim(zero)==""))
    {
        bolzero=false;
    }
    else
    {
        zero=zero.toString();
        if(zero=="0")
        {
            bolzero=true;
        }
        else
        {
            alert("检查是否包含0参数，只可为(空、0)");
        }
    }
   switch(sign)
    {
        case "+-":
            //整数
            reg=/(^-?|^\+?)\d+$/;            
            break;
        case "+": 
            if(!bolzero)           
            {
                //正整数
               reg=/^\+?[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //正整数+0
                //reg=/^\+?\d+$/;
                reg=/^\+?[0-9]*[0-9][0-9]*$/;
            }
            break;
        case "-":
            if(!bolzero)
            {
                //负整数
                reg=/^-[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //负整数+0
               //reg=/^-\d+$/;
                reg=/^-[0-9]*[0-9][0-9]*$/;
            }            
            break;
        default:
            alert("检查符号参数，只可为(空、+、-)");
            return false;
            break;
    }
    var r=objStr.match(reg);
    if(r==null)
    {
        return false;
    }
    else
    {        
        return true;     
    }
}
/**
 * 检查一个字符串是否为合格的IP地址
 */
function isIpAddr(str)
{
	if (str == "") return false;

	// 声明变量
	var flag = true;
	var ary;

	// 组织数组
	ary = str.split(".");


	// 数组的长度不为4则表示不是正确的IP地址
	if (ary.length != 4) return false;

	// 从数组中提取出来分别检查每个IP段
	for (var i = 0;i < ary.length;i ++)
	{
		var varInt;
		str = ary[i];

		// 检查每一个IP段的长度是否符合要求
		if (str.length > 3 || str.length == 0)
		{
			flag = false;
			break;
		}

		// 检查每一个IP段的字符是否正确
		if (!IsInt(str))
		{
			flag = false;
			break;
		}

		varInt = parseInt(str);
		// 检查第一项的值必须在1-223之间
		if (i == 0)
		{

			if (varInt < 1 || varInt > 223)
			{
				flag = false;
				break
			}
		}
		//检查其他三项的值必须在0-255之间
		else
		{
			if (varInt < 0 || varInt > 255)
			{
				flag = false;
				break;
			}
		}
	}

	return flag;
}

function GetCurrentTime()
{
	var now;
	var innerHTML;

	
	now=new Date();	
		
	var MM =  now.getMonth()+1;
	var DD = now.getDate();
	var hh = now.getHours();
	var mm = now.getMinutes();
	var ss = now.getSeconds();
	if(MM<10){
		MM = "0"+MM;
	}
	if(DD<10){
		DD = "0"+DD;
	}
	if(hh<10){
		hh = "0"+hh;
	}
	if(mm<10){
		mm = "0"+mm;
	}
	if(ss<10){
		ss = "0"+ss;
	}
	innerHTML=""+now.getFullYear()+"-"+MM+"-"+DD+" "+hh+":"+mm+":"+ss;
	
	return innerHTML;
}

var	dTime = function(){
	var now;
	var innerHTML;
	this.interval = 0;	
	start = function(){	
		if(now == undefined){
			now=new Date();	
		}else{
			now.setTime(now.getTime()+1000);
		}
		var MM =  now.getMonth()+1;
		var DD = now.getDate();
		var hh = now.getHours();
		var mm = now.getMinutes();
		var ss = now.getSeconds();
		if(MM<10){
			MM = "0"+MM;
		}
		if(DD<10){
			DD = "0"+DD;
		}
		if(hh<10){
			hh = "0"+hh;
		}
		if(mm<10){
			mm = "0"+mm;
		}
		if(ss<10){
			ss = "0"+ss;
		}
		innerHTML=""+now.getFullYear()+"-"+MM+"-"+DD+" "+hh+":"+mm+":"+ss;
		
		var obj = window.document.getElementById("time");
		obj.innerText = innerHTML;
	}
	run = function(f,t){
		this.interval = setInterval(f,t);
	}
	this.onStart = function(){
		run(start,1000);
	}
	this.onStop = function(){
		clearInterval(this.interval);
	}
	this.showNow =function(){
		return innerHTML;
	}
}
function getJson(json){
	
}



function GetArgsFromHref(sHref, sArgName)
{
	var args = sHref.split("?");
	var retval = "";

	//null param
	if(args[0] == sHref)
	{
		return retval;
	} 
	var str = args[1];
	args = str.split("&");
	for(var i = 0; i < args.length; i ++)
	{
		str = args[i];
		var arg = str.split("=");
		if(arg.length <= 1) continue;
		if(arg[0] == sArgName) retval = arg[1]; 
	}
	return retval;
}

function setCookie(c_name,value,expiredays)
{
	var exdate=new Date()
	exdate.setDate(exdate.getDate()+expiredays)
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString())
}

function getCookie(c_name)
{
	if (document.cookie.length>0)
	  {
	  c_start=document.cookie.indexOf(c_name + "=")
	  if (c_start!=-1)
		{ 
		c_start=c_start + c_name.length+1 
		c_end=document.cookie.indexOf(";",c_start)
		if (c_end==-1) c_end=document.cookie.length
		return unescape(document.cookie.substring(c_start,c_end))
		} 
	  }
	return ""
}

function isIE()
{ 
   if (window.navigator.userAgent.toLowerCase().indexOf("msie")>=1)
    return true;
   else
    return false;
} 

function isFF()
{
	var sUserAgent = navigator.userAgent;
	//alert(sUserAgent);
	var isKHTML = sUserAgent.indexOf("KHTML") > -1
				  || sUserAgent.indexOf("Konqueror") > -1
				  || sUserAgent.indexOf("AppleWebKit") > -1;
	var isMoz = sUserAgent.indexOf("Gecko") > -1 && !isKHTML;
	return isMoz;
}

function GetInnerText(obj)
{
	if(true == isIE())
	{
		return document.getElementById(obj).innerText;
	}
	else
	{
		return document.getElementById(obj).textContent;
	}
}

function SetInnerText(obj,text)
{
	if(true == isIE())
	{
		return document.getElementById(obj).innerText = text;
	}
	else
	{
		return document.getElementById(obj).textContent = text;
	}
}

function GetCheckd(id)
{
	var checked = document.getElementById(id).checked;
	if(checked == false)
		return 0;				
		
	return 1;
}

function ClearSelect(select)
{		
	while(select.length > 0)
	{
		select.remove(select.length - 1);
	}
}

function appendChildOption(select,optionValue,text)
{		
	var option  = document.createElement("OPTION");
	option.value = optionValue;
	option.text  = text;
	select.add(option);
}