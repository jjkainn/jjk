/**
 * ��ȷ�������ñ�JS�ļ�ǰ����util.js
 * author: py
 * content: ����dxhtml ���ڿؼ�������������
 */
 window.dhx_globalImgPath = "img/calendar/";
 var languageType='china';
 dhtmlxCalendarLangModules = new Array();
	dhtmlxCalendarLangModules['china'] = {
		langname:	'china',
		dateformat:	'%d.%m.%Y',
		monthesFNames:	["һ��", "����", "����", "����", "����", "����", "����", "����", "����", "ʮ��", "ʮһ��", "ʮ����"],
		monthesSNames:	["һ��", "����", "����", "����", "����", "����", "����", "����", "����", "ʮ��", "ʮһ��", "ʮ����"],
		daysFNames:	["����","��һ", "�ܶ�", "����", "����", "����", "����" ],
		daysSNames:	["����","��һ", "�ܶ�", "����", "����", "����", "����" ],
		weekend:	[0, 6],
		weekstart:	1,
		msgClose:	 "�ر�",
		msgMinimize: "��С��",
		msgToday:	 "����",
		head:'����ͷ'
	}
	
 
 /** 
  * ��ʼ�����ڿؼ�
  */
 var calendar;  //���ڿؼ�
 var calendarDivId="calendarDiv";
 var calendarDiv; //���ڿؼ�Div
 var dateformat="%Y-%m-%d"; // ���ڸ�ʽ

 
 function initCalendar(){//calendarDiv
	if(!calendarDiv){
		// ���ڿؼ�Ĭ��IDΪcalendarDiv
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
  * �������ڿؼ���������div
  */
 function createCalendarDiv(){
	calendarDiv=document.createElement("div");
	calendarDiv.setAttribute("id", calendarDivId);
	document.body.appendChild(calendarDiv);
 }
 var lastClickInput;
 /**
  * �������������mouseover�¼�
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