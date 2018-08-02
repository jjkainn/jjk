function showTime(outInput,event){
	if(!outInput) return;
	defaultOptions['outInput']=outInput;
	if(!isInited) resetTimeDiv();
	var e=event||window.event;
	timeDiv.style.display="block";
	timeDiv.style.left=e.clientX+20;
	timeDiv.style.top=e.clientY+5;
}
function hiddenTime(){
	var timeString="00:00:00";
	$('myTime_Hour').value="00";
	$('myTime_Hour').focused=true;
	boundInnerInput($('myTime_Hour'),0,23);
	$('myTime_Minute').value="00";
	$('myTime_Second').value="00";
	timeDiv.style.display='none';
}
var defaultOptions = {
	'row_cell':'12',
	'cell_count':'60',
	'head_text':" 请选择时间",
	'submitText':'确定',
	'innerInput':$('ttt'),
	'outInput':$('ttt'),
	'inputCallBack':defaultInputCallBack
};
function resetTimeDiv(){	
	var innerHTML="<table class='timeTable' border=0>";
	var headText=defaultOptions['head_text'];
	var rowCell=defaultOptions['row_cell'];
	
	if(headText && rowCell){
		innerHTML+="<tr><td class='table_head' colspan="+(rowCell-1)+">"+headText+"</td><td style='cursor:pointer' onclick='hiddenTime()'>x</td></tr>";
	}
	var cellCount=defaultOptions['cell_count'];
	var lastRowCellCount=cellCount % rowCell;
	var rowCount=cellCount/rowCell+(lastRowCellCount>0?1:0);
	for(var i=0;i<rowCount;i++){
		innerHTML+="<tr>";
		for(var j=0;j<rowCell;j++){
			var text=i*rowCell+j;
			if(text>=cellCount)break;
			if(text<10){text="0"+text.toString();}
			innerHTML+="<td><input class='td_unable' name='myTimeTextButton' id='"+text+"' onclick=\"input('"+text+"')\" onmouseover=\"this.className=\'td_mouseover\'\" onmouseout=\"this.className=\'td_normal\'\" type='button' disabled=disabled value='"+text+"'/></td>";
		}
		innerHTML+="</tr>";
	}
	innerHTML+="</table>";
	innerHTML+="<div class='timeInputDiv'>";
	innerHTML+="<input type='text' class='time_input' readonly=true onclick='boundInnerInput(this,0,23)' value='00' id='myTime_Hour'/>:";
	innerHTML+="<input class='time_input' type='text' readonly=true onclick='boundInnerInput(this,0,59)' value='00' id='myTime_Minute'/>:";
	innerHTML+="<input class='time_input' type='text' readonly=true onclick='boundInnerInput(this,0,59)' value='00' id='myTime_Second'/>";
	innerHTML+="<span class='displayTimeSpan' id='displayTime'>00:00:00</span>";
	innerHTML+="<input class='submitSpan' type='button' class='submitSpan' onclick='defaultInputCallBack()' value='"+defaultOptions['submitText']+"'/>";
	innerHTML+="</div>";
	timeDiv.innerHTML=innerHTML;
	boundInnerInput($('myTime_Hour'),0,23);
	isInited=true;
}
function defaultInputCallBack(value){
	var outInput=defaultOptions['outInput'];
	if(outInput){
		var timeString=$('myTime_Hour').value+":"+$('myTime_Minute').value+":"+$('myTime_Second').value;
		outInput.value=timeString;
	}
	hiddenTime();
}
function input(value){
	var boundInnerInput=defaultOptions['innerInput'];
	if(boundInnerInput) boundInnerInput.value=value;
	$("displayTime").innerHTML=$("myTime_Hour").value+":"+$("myTime_Minute").value+":"+$("myTime_Second").value;
}
function boundInnerInput(input,from,to){
	defaultOptions['innerInput']=input;
	if(from!=undefined && to!=undefined && from<to){
		var textButtons=$n("myTimeTextButton");
		if(textButtons){
			for(var i=0;i<textButtons.length;i++){
				var id=textButtons[i].id;
				if(id>=from && id<=to){
					textButtons[i].disabled=false;
					textButtons[i].className="td_normal";
				}else{
					textButtons[i].disabled=true;
					textButtons[i].className="td_unable";
				}
			}
		}
	}
}
function boundOutput(outInput){
	if(outInput) defaultOptions['outInput']=outInput; 
}
var timeDiv;
var isInited=false;
function initTimeDiv(outInput,headText,submitText){
	if(!outInput) return;
	defaultOptions['outInput']=outInput;
	if(headText) defaultOptions['head_text']=headText;
	if(submitText) defaultOptions['submitText']=submitText;
	timeDiv=document.createElement("div");
	timeDiv.setAttribute("id", "myTimeDiv");	
	document.body.appendChild(timeDiv);
	//resetTimeDiv();
}
