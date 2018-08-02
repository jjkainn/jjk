

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
		alert("�޷����� XMLHttpRequest ����");
	}
	return xmlHttp;
}

function IsBool(value){
	if(value!=undefined && typeof(value)==typeof(true))
		return true;
	return false;
}

/****
 * ��ȡҳ����id=@param id��Ԫ�� (��document.getElementById(id)����)
 * @param id    :��Ҫ��ȡ��Ԫ��id
 * @param doc() :��������doc����,��ʹ�ø�document��ȡԪ��
 */
function $(id,doc){
	if(arguments.length==1){
		return document.getElementById(id);
	}else if(arguments.length==2){
		return doc.getElementById(id);
	}
}
/****
 * ��ȡҳ����name=@param name��Ԫ�� (��document.getElementsByName(name)����)
 * @param name  : ��Ҫ��ȡ��Ԫ��name
 * @param doc	: ��������document����,��ʹ�ô����document
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
�ַ�������
Trim(string):ȥ���ַ������ߵĿո�
==================================================================
LTrim(string):ȥ����ߵĿո�
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
RTrim(string):ȥ���ұߵĿո�
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
Trim(string):ȥ��ǰ��ո�
==================================================================
*/
function Trim(str)
{
    return RTrim(LTrim(str));
}
/*
==================================================================
Trim(string):ȥ��ǰ��ո�
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
IsInt(string,string,int or string):(�����ַ���,+ or - or empty,empty or 0)
���ܣ��ж��Ƿ�Ϊ����������������������������+0��������+0
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
            alert("����Ƿ����0������ֻ��Ϊ(�ա�0)");
        }
    }
   switch(sign)
    {
        case "+-":
            //����
            reg=/(^-?|^\+?)\d+$/;            
            break;
        case "+": 
            if(!bolzero)           
            {
                //������
               reg=/^\+?[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //������+0
                //reg=/^\+?\d+$/;
                reg=/^\+?[0-9]*[0-9][0-9]*$/;
            }
            break;
        case "-":
            if(!bolzero)
            {
                //������
                reg=/^-[0-9]*[1-9][0-9]*$/;
            }
            else
            {
                //������+0
               //reg=/^-\d+$/;
                reg=/^-[0-9]*[0-9][0-9]*$/;
            }            
            break;
        default:
            alert("�����Ų�����ֻ��Ϊ(�ա�+��-)");
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
 * ���һ���ַ����Ƿ�Ϊ�ϸ��IP��ַ
 */
function isIpAddr(str)
{
	if (str == "") return false;

	// ��������
	var flag = true;
	var ary;

	// ��֯����
	ary = str.split(".");


	// ����ĳ��Ȳ�Ϊ4���ʾ������ȷ��IP��ַ
	if (ary.length != 4) return false;

	// ����������ȡ�����ֱ���ÿ��IP��
	for (var i = 0;i < ary.length;i ++)
	{
		var varInt;
		str = ary[i];

		// ���ÿһ��IP�εĳ����Ƿ����Ҫ��
		if (str.length > 3 || str.length == 0)
		{
			flag = false;
			break;
		}

		// ���ÿһ��IP�ε��ַ��Ƿ���ȷ
		if (!IsInt(str))
		{
			flag = false;
			break;
		}

		varInt = parseInt(str);
		// ����һ���ֵ������1-223֮��
		if (i == 0)
		{

			if (varInt < 1 || varInt > 223)
			{
				flag = false;
				break
			}
		}
		//������������ֵ������0-255֮��
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