var lastDisplayDiv;  // 上一次显示的内容Div
var lastClickDiv;    // 上一次被点击的导航条   初始化在页面底部
function switchTable(clickDiv,displayDiv){
	if(clickDiv!=lastClickDiv){
		lastDisplayDiv.style.display="none";
		displayDiv.style.display="block";
		lastClickDiv.className="nt_normal";
		clickDiv.className="nt_down";
		lastClickDiv=clickDiv;		
		lastDisplayDiv=displayDiv;
	}
}

function switchNavigatorBG(div,className)
{
	try
	{
		if(div.id!=lastClickDiv.id)
		{
			div.className=className;
		}
	}
	catch(e)
	{
	}
}