/**
 * 请确保在引用本JS文件前引入util.js
 * author: py
 * content: 利用dxhtml 日期控件处理日期输入
 */
 window.dhx_globalImgPath = "img/calendar/";
 var languageType='china';
 dhtmlxCalendarLangModules = new Array();
	dhtmlxCalendarLangModules['china'] = {
		langname:	'china',
		dateformat:	'%d.%m.%Y',
		monthesFNames:	["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		monthesSNames:	["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"],
		daysFNames:	["周日","周一", "周二", "周三", "周四", "周五", "周六" ],
		daysSNames:	["周日","周一", "周二", "周三", "周四", "周五", "周六" ],
		weekend:	[0, 6],
		weekstart:	1,
		msgClose:	 "关闭",
		msgMinimize: "最小化",
		msgToday:	 "今日",
		head:'日历头'
	}
	
 
 /** 
  * 初始化日期控件
  */
 var calendar;  //日期控件
 var calendarDivId="calendarDiv";
 var calendarDiv; //日期控件Div
 var dateformat="%Y-%m-%d"; // 日期格式

 
 function initCalendar(){//calendarDiv
	if(!calendarDiv){
		// 日期控件默认ID为calendarDiv
		createCalendarDiv();
	}
	if(!calendarDiv) return;	
	calendar = new dhtmlxCalendarObject(calendarDivId, false, {
        isYearEditable: true
    });
	calendar.loadUserLanguage(languageType,dhtmlxCalendarLangModules[languageType].head);
    calendar.setYearsRange(2000, 2500);
	calendar.setHeader(true,true,"TX");
    calendar.setOnClickHandler(selectDate);
    calendar.draw();
	if(dateformat){
		calendar.setDateFormat(dateformat);
	}
 }
 /**
  * 创建日期控件所依赖的div
  */
 function createCalendarDiv(){
	calendarDiv=document.createElement("div");
	calendarDiv.setAttribute("id", calendarDivId);
	document.body.appendChild(calendarDiv);
 }
 var lastClickInput;
 /**
  * 处理日期输入框mouseover事件
  */ 
 function facadeCalendarInputMouseover(element,event){
	lastClickInput=element;
	var e=event || window.event;
	if(!calendarDiv){
		return;
	}
	isHidden=false;
	calendarDiv.style.display="block";
	calendarDiv.style.left=e.clientX+5;
	calendarDiv.style.top=e.clientY-185;
	element.onblur=function(){
		isHidden=true;
	}
 }
 function selectDate(){
	if(lastClickInput){
		var date=new Date();
		var hour=date.getHours()+"";
		var minute=date.getMinutes()+"";
		var second=date.getSeconds()+"";
		var time=(hour.length==1?("0"+hour):hour)+":"+(minute.length==1?("0"+minute):minute)+":"+(second.length==1?("0"+second):second);
		lastClickInput.value=calendar.getFormatedDate()+" "+time;
		lastClickInput.focus();
		hideCalendar();		
	}
 }
 function hideCalendar(){
	if(calendarDiv)
		calendarDiv.style.display="none";
 }
 var isHidden=false;
 document.onclick=function(){
	if(isHidden){
		isHidden=false;
		hideCalendar();
	}
 }