var lastDisplayDiv;  // ��һ����ʾ������Div
var lastClickDiv;    // ��һ�α�����ĵ�����   ��ʼ����ҳ��ײ�
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