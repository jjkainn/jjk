<?php
	include 'language.php';
	include_once ("func_common_param.php");
	include_once ("func_advanced_param.php");
	include_once ("func_sys_set.php"); 
	error_reporting(1);
	session_start();
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
?>
<!DOCTYPE html>
<html>
  <head>
  	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('#img1,#img2,#img3,#img4,.tabsright1,#img1-1,#img2-1,#img3-1,#img4-1,.logo,.nav2,.nav3,.li1,.li2,.li3,.li4,.wifi0,.wifi2,.wifi3,.wifi4,.wifi5');
    </script>
    <![endif]-->
    
    <!-- ie8及更低版本不支持媒体查询-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">    
	<meta name="description" content="">
    <meta name="author" content="MaZhiyu">
    <link rel="shortcut icon" href="./img/login_logo.gif">
	<title>4G直播后台管理系统</title>
	<!--引入外部js-->
	<script src="./js/jquery-1.7.2.min.js"></script>
	<script src="./js/bootstrap.min.js"></script>
	<script src="./js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
    <!--引入外部css-->
    <link href="./css/bootstrap.css" rel="stylesheet">
    <link href="./css/focus.css" rel="stylesheet">		<!--访问速度慢是因为focus.css中用到了google字体-->
   	<!--选项卡-->
	<link href="./js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
	<script type="text/javascript">
		// flowplayer.conf = { live: true };
	</script>
	<script>
		function fresh(){
			window.location.reload();
		}
	</script>
		<style>
		.header{
			width: 1000px;
			height: 60px;
			background: #231916;
			margin: auto;
			line-height: 60px;
			line-height: 0px\9;
		}
		.headerleft{
			float: left;
			position: relative;
		}
			.headerleft img{
			margin-left: 10px\9;
			margin-top: 10px\9;
		}
		.headerright{
			position: relative;
			float：right;
			right: -40%;
			right: -55%\9;
		}
		.headerleft span{
			display: none\9;

		}

		.headerright img:hover{
			background: #24252E;
		}
		.headerright img{
			margin-left:12px;
		}
		.tabsleft{
			float: left; 
			background: #292B3A;
			width: 50px;
			background: #a8a8a8;
			height:890px;             
		}
		.tabsright{
			float: right;
			background: #171b1d;
			height:890px;
			width:950px;
			overflow: scroll;
		}
		.tabsright1{
			margin-top: 40%;
		}
		.tabsright1 img{
			display: block;
			margin-left: 10%;
			cursor: crosshair;
			-webkit-animation: show 40s infinite linear;
		}
		#showImg1{
			position: absolute;
			top:160px;
			right: 500px;
		}
			#showImg2{
				position: absolute;
			top:660px;
			right: 500px;
		}
			#showImg3{
			height: 200px;
			width: 200px;
			background: #018159;
			position: absolute;
			top:160px;
			right: 500px;
			opacity: 0.15;
		}
		@-webkit-keyframes show{
			0%{transform: rotateZ(0deg);}
			100%{transform: rotateZ(360deg);}
		}
		.tabsright2{
		 margin: 20px;
		 cursor: pointer;
		}
		.showbutton img{
			height: 100px;
			width: 100px;
			margin-left: 40px;
			margin-top: 120px;
		}
		#table {
			text-align: center;
		}
		tr{
			text-align: center;
		}
		table td{
			width: 200px;
			text-align: center;
		}
		td select{
			width: 300px;
		}
		td input{
			width: 300px;
		}
		.loupe{ 
  position:absolute; 
  pointer-events:none;
  visibility:hidden;
  z-index:999;
  width:100px;
  height:100px;
  border:1px solid #636363;
  border-radius:50%;
}
.tabs1{
	height: 34px;
	background: #a8a8a8;
}
table img{
	width: 20px\9;
	height: 20px\9;
}
#showName{
	display: none\9;
}



/*自适应*/
@media only screen and (min-width: 976px) and (max-width: 1024px) {

	.header{
		width: 100%;
	}
	.nav-tabs{
		width: 100%;
	}
	.tab-content{
		width: 100%;
	}
	.tabsleft{
		width: 10%;

	}
	 table{
		position: relative;
		/*left: -10%;*/

	}
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
	.tabsright1 img{
		width: 80%;
		height: 80%;
	}
	.tabsright{
		width: 90%;
	}

	.tabsright2 img{
		/*width: 80%;*/
		margin:40px 35px;
		height: 30%;
		width: 30%;
	}
}
@media only screen and (min-width: 768px) and (max-width: 976px) {

	.header{
		width: 100%;
	}
	.nav-tabs{
		width: 100%;
	}
	.tab-content{
		width: 100%;
	}
	.tabsleft{
		width: 10%;
		font-size: 0.8em;

	}
	.daohang li{

	height: 120px;
	

}
	 table{
		position: relative;
		/*left: -1%;*/
		width: 70%;
		font-size: 0.8em;

	}
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}

	.tabsright{
		width: 90%;
	}

}
@media only screen and (min-width: 480px) and (max-width: 768px) {

	.header{
		position: relative;
		width: 100%;
		margin: auto;
		/*left: -25%;*/
	}
	.nav-tabs{
		position: relative;
		width: 100%;
		top:-3px;
		height: auto;
	}
	.nav-tabs li{
		/*width: 60%;*/
		font-size: 0.7em;
	    text-align: left;

	margin-left: -10px;
		/*width: 60%;*/
	}
	.nav-tabs span{
		display: none;
	}
		.headerleft img{
		width: 80%;
		height: 80%;
	}
	.headerleft span{
		/*font-size: 0.7em;*/
		display: none;
	}
	.tab-content{
		width: auto;
		margin: auto;
	    position: relative;
		/*background: #292B3A;*/
		top: -3px;
		/*display: table;*/
		width: 100%;
		height: auto;
	/*left: -25%;*/
		
	}
	.tabsleft{
		width: 12%;
		 margin: auto;
		 font-size: 0.7em;
	}

	table{
        margin: auto;
        width: auto;
        font-size: 0.7em;
        width: 90%;
        height: auto;
        line-height: 1.5em;
	}
	table span{
		width: auto;
		display: inline-block;
	}
	 td{
		width:auto;
		line-height: 5em;
	}

	.tabsright{
		width: 88%;
		height: auto;
		background: #24252E;
	}
	
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}
	
}
@media only screen and (max-width: 480px) {
.header{
		position: relative;
		width: auto;
		margin: auto;
	}
	.nav-tabs{
		position: relative;
		width: 100%;
		top:-3px;
		height: auto;
	}
	.nav-tabs li{
		/*width: 60%;*/
		font-size: 0.7em;
	    text-align: left;

	margin-left: -10px;
		/*width: 60%;*/
	}
	.nav-tabs span{
		display: none;
	}

		.headerleft img{
		width: 80%;
		height: 80%;
	}
	.headerleft span{
		/*font-size: 0.7em;*/
		display: none;
	}
	.tab-content{
		width: auto;
		margin: auto;
	    position: relative;
		top: -3px;
		clear: both;
		height: auto;
		
	}
	.tabsleft{
		width: auto;
		 margin: auto;
		 clear: both;
		 height: 70px;

	}
	table{
        margin: left;
        width: auto;
        font-size: 0.7em;
        width:auto;
        line-height: 1em;
	}
	table span{
		width: auto;
		display: inline-block;
	}
	 td{
		width:auto;
		line-height: 20px;
		width: auto;
	}
	table input{
		width: 150px;
	}

	.tabsright{
		width: auto;
        height: auto;
		 clear: both;
		 background: #24252E;
		 margin-left: 10%;
	}
	
	.headerright{
		display: none;
	}
	#showName{
		display: none;
	}

	.tabsleft ul li{
		float: left;
		margin-left:28px;
		height: auto;
	}
	.tabsleft a{
		display: none;
	}
	.tabsleft img{
		height: 80%;
		width: 80%;
	}
	.tabsleft ul{
		float: left;
		margin-left: 0%;
	}
	.daohang li:hover{
	
	background: #24252E;
	
}
.showLi{
	background: #24252E;
}
}
	</style>
  </head>
  <script type='text/javascript'>  var lang = "CH";</script>  <body>
  	<div style="margin: auto;">
<!--导航1-->
<div class="header">
	<div class="headerleft">
	　<a href="http://www.avsolutiontech.com/">
		<img src="img/logo1.png" class="logo">
	  </a>
	  <span style="color: #FFFFFF;">　｜　产品型号：AURORA-IV 8000W	    </span>
		
	</div>
	<div class="headerright">
		<img src="img/nav1.png" />
		<a href="#" onclick="javascript:history.go(-1)"><img src="img/nav2.png" class="nav2"/></a>
		<a href="#" onclick="logout();"><img src="img/nav3.png" class="nav3"/></a>
	</div>
	<script>
		function logout(){
			window.location.href="index.php";
			return false;
		}
	</script>
</div>
<!--导航2-->
                <div>
					<ul class="nav nav-tabs" style="clear: both;overflow: hidden;">
						<li style="float: left;_margin-top:20px">
							<!--<ul><li><a href="common.php"><b>常用功能</b></a>　<span style="color:#f0f0f0">｜</span>　</li></ul>-->
							　<a href="common.php"><b>常用功能</b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left;_margin-top:20px">
							<a href="advanced.php"><b>高级参数</b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left;_margin-top:20px">
							<a href="orchestrator.php"><b>配置</b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="float: left;_margin-top:20px">
							<a href="wifi.php"><b>wifi参数</b></a>　<span style="color:#f0f0f0">｜</span>　
						</li>
						<li style="margin-left: 120px;" id="showName">
							<span style="color: #f36609;">admin</span>
								　登录日期：<span id="jnkc"></span>
								 
                        <script>setInterval("jnkc.innerHTML=new Date().toLocaleString();",1000);
 
                        </script>
						</li>
					
					</ul>
					
					</div>
		
					<div class="tab-content" style="margin: auto;background: #231916;">

						<!--wifi参数-->
						<br />
						<div class="tab-pane" style="text-align:center;"  id="show">
							<table class="table" style="margin-top:2em;text-align: center;" align="center" id="wifelist">
							<input type="text" name="" id="ChannelID" style="margin-top:1.5em;">
							<button class="btn btn-lg btn-success" style="*margin-left: 30%;" id="buttonID">频道ID查询</button>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<input type="text" name="" id="Livestate" style="margin-top:1.5em;">
							<button class="btn btn-lg btn-success" style="*margin-left: 30%;" id="buttonStatus">直播状态查询</button> 
								<thead>
									<tr>
										<td>频道ID</td>
										<td>频道名称</td>
										<td>直播状态</td>
									</tr>
								</thead>
								<tbody id="getlist">
									<tr style="background:#8d908b;" id="list">
										<td>0</td>
										<td>TP-LINK_15DBB2</td>
										<td>正在直播</td>
										<td><button id="Btrtmp" value="">直播</button></td>
									</tr>		
								</tbody>
							</table>
							<span id="page"><button id="Bpage"><a href="javascript:void(0)">上一页</a>&nbsp&nbsp&nbsp&nbsp<span>总页数&nbsp(5)</span>&nbsp&nbsp&nbsp&nbsp<span>当前页&nbsp(1)</span>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)" id="nextpage" class="">下一页</a>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)" id="endpage" class="">尾页</a></button></span>
						</div>
						 		<div style="margin-left: 10em; margin-top: 5em; margin-bottom: 5em; background-color: 1px; display: none;" id="none">
						 			<div style="float: left; margin-left: 100px;  padding-bottom: 5em">
						 				<img src="img/mudu.png" style="width: 200px;">
						 			</div>
						 			<div style="margin-left: 300px;">
						 				<table bgcolor="1" >
										<tr>
											<td><input type="text" name="email" placeholder="目睹账号" id="mdemail" value="" style="width: 150px"></td>
										</tr>
											<tr>
											<td><input type="password" name="password" placeholder="目睹密码" id="mdpassword" value="" style="width: 150px"></td>
										</tr>
											<tr>
											<td><button id="mddl">登录</button></td>
										</tr>
									</table>
						 			</div>
								</div>
				</div>
</div>
  </body>
</html>
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#show").hide();
	$("#none").show();
});
		//登录接口传值调用
	$("#mddl").click(function(){
		var email = $("#mdemail").val();
		var password = $("#mdpassword").val();
		$.ajax({
				type:'post',
				url:"witness_lg.php",
				data:{email:email,password:password},
				dataType:'json',
				success:function(data){
					if (data == 102) {
						alert("不存在该用户,请重新输入");
					} else if (data == 103) {
						alert("密码错误,请重新输入");
					} else if (data == 101) {
						alert("参数错误,请重新输入");
					} else {
						$("#list").remove();
						var str = "";
						$.each(data.activities,function(k,v){
								if(v.live_status == 1){
								var text = '<td>正在直播</td>';
								}else{
								var text = '<td>没有直播</td>';
								}
								str += '<tr style="background:#231916;">';
								str += '<td>'+v.id+'</td><td>'+v.name+'</td>'+text+'';
								str += '</tr>';
								// console.log(v.live_status);
						})
						$("#getlist").html(str);
						$("#Bpage").remove();
						var sta = "";
						sta +='<button id="Bpage">'
						sta +='<a href="">上一页</a>&nbsp&nbsp&nbsp&nbsp<span>总页数&nbsp('+data.meta.page+')</span>&nbsp&nbsp&nbsp&nbsp<span>当前页&nbsp('+data.meta.current+')</span>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)"  id="nextpage" class="'+data.links.next_url+'">下一页</a>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)" id="endpage" class="'+data.links.end_url+'">尾页</a>';
						sta +='</button>';
						$("#page").html(sta);
						// console.log(sta);
					}
						$("#show").show();
						$("#none").hide();
				}
		})
	})
	//根据频道id和tokne通过ajax调用接口
	$("#buttonID").click(function(){
		var ChannelID = $("#ChannelID").val();
		$.ajax({
				type:'post',
				url:"Channel.php",
				data:{ChannelID:ChannelID},
				dataType:'json',
				success:function(data){
					$("#list").remove();
						if(data.live_status == 1){
								var text = '<td>正在直播</td>';
								}else{
								var text = '<td>没有直播</td>';
								}
						var port = ":1935";

						var Length = data.rtmp_publish_addr.indexOf('v');
						var serverIP = (insert_item(data.rtmp_publish_addr,port,Length));
						var streamName = getCaption(serverIP);
						var ste = "";
							ste += '<tr style="background:#231916;">';
							ste += '<td>'+data.id+'</td><td>'+data.name+'</td>'+text+'<td><input type="text" id="setMainServerIP" class="form-control" value="'+serverIP+'" onblur="setMainServerIP(value)"></td><td><input type="text" name="mainStreamName" id="mainStreamName" class="form-control" placeholder="livestream1" value="'+streamName+'" onblur="setmainStreamName(value)"></td><td><button id="IPNAME">直播</button></td>';

							ste += '</tr>';
						// console.log(ste);
						$("#Bpage").remove();
						$("#getlist").html(ste);
				}
		})
	})

	//根据直播状态和tokne通过ajax调用接口
	$("#buttonStatus").click(function(){
		var Livestate = $("#Livestate").val();
		$.ajax({
				type:'get',
				url:"Channel.php",
				data:{Livestate:Livestate},
				dataType:'json',
				success:function(data){
					console.log(data);
					$("#list").remove();
						var std = "";
						$.each(data.activities,function(k,v){
								if(v.live_status == 1){
								var text = '<td>正在直播</td>';
								}else{
								var text = '<td>没有直播</td>';
								}
								std += '<tr style="background:#231916;">';
								std += '<td>'+v.id+'</td><td>'+v.name+'</td>'+text+'';
								std += '</tr>';
								// console.log(v.live_status);
						})
						$("#getlist").html(std);
				}
		})
	})

	//根据下一页的值调用频道分页接口
	$(document).on('click','#nextpage',function(){
		var nextpage = $(this).attr('class');
		next_page = nextpage.substr(nextpage.length-1,1);
		$.ajax({
				type:'post',
				url:"Page.php",
				data:{next_page:next_page},
				dataType:'json',
				success:function(data){
					$("#list").remove();
						var str = "";
						$.each(data.activities,function(k,v){
								if(v.live_status == 1){
								var text = '<td>正在直播</td>';
								}else{
								var text = '<td>没有直播</td>';
								}
								str += '<tr style="background:#231916;">';
								str += '<td>'+v.id+'</td><td>'+v.name+'</td>'+text+'';
								str += '</tr>';
								// console.log(v.live_status);
						})
						$("#getlist").html(str);
						$("#Bpage").remove();
						var sta_next = "";
						sta_next +='<button id="Bpage">'
						sta_next +='<a href="">上一页</a>&nbsp&nbsp&nbsp&nbsp<span>总页数&nbsp('+data.meta.page+')</span>&nbsp&nbsp&nbsp&nbsp<span>当前页&nbsp('+data.meta.current+')</span>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)"  id="nextpage" class="'+data.links.next_url+'">下一页</a><a href="javascript:void(0)" id="endpage" class="'+data.links.end_url+'">尾页</a>';
						sta_next +='</button>';
						$("#page").html(sta_next);
				}
		})
	})

	//根据尾页的值调用频道分页接口
		$(document).on('click','#endpage',function(){
		var endpage = $(this).attr('class');
		endpage = endpage.substr(endpage.length-1,1);
		$.ajax({
				type:'get',
				url:"Page.php",
				data:{endpage:endpage},
				dataType:'json',
				success:function(data){
					$("#list").remove();
						var str = "";
						$.each(data.activities,function(k,v){
								if(v.live_status == 1){
								var text = '<td>正在直播</td>';
								}else{
								var text = '<td>没有直播</td>';
								}
								str += '<tr style="background:#231916;">';
								str += '<td>'+v.id+'</td><td>'+v.name+'</td>'+text+'';
								str += '</tr>';
								// console.log(v.live_status);
						})
						$("#getlist").html(str);
						$("#Bpage").remove();
						var sta_next = "";
						sta_next +='<button id="Bpage">'
						sta_next +='<a href="">上一页</a>&nbsp&nbsp&nbsp&nbsp<span>总页数&nbsp('+data.meta.page+')</span>&nbsp&nbsp&nbsp&nbsp<span>当前页&nbsp('+data.meta.current+')</span>&nbsp&nbsp&nbsp&nbsp<a href="javascript:void(0)"  id="nextpage" class="'+data.links.next_url+'">下一页</a><a href="javascript:void(0)" id="endpage" class="'+data.links.end_url+'">尾页</a>';
						sta_next +='</button>';
						$("#page").html(sta_next);
				}
		})
	})
	//点击直播开启推流
	$(document).on('click','#IPNAME',function(){
		var serverIP = $("#setMainServerIP").val();
		var streamName = $("#mainStreamName").val();
		$.post("ctl_advanced_param.php?action=mainIPNAME",{"serverIP":serverIP,"streamName":streamName,"streamtype":0},function(msg){
												if(lang == 'CH'){
													var info = "主码流地址与名称名修改成功";
													var errorInfo = "修改未成功，请检查参数";
													var error1Info = "未能修改成功";
												}else{
													var info = "Success";
													var errorInfo = "Modification is not successful, please check the parameter";
													var error1Info = "Modification is not successful";
												}
												if(msg == 1){
													alert(info);
												}else if(msg == 'error'){
													alert(errorInfo);
												}else{
													alert(error1Info);
												}
											});
	})

	function getCaption(obj){
    var index=obj.lastIndexOf("/");
    obj=obj.substring(index+1,obj.length);
	//  console.log(obj);
	    return obj;
	}

	function insert_item(str,item,index){//js字符串插入方法

		var serverIP="";             //初始化一个空字符串

		var tmp=str.substring(0,index+1);

		var estr=str.substring(index+1,str.length);
		serverIP+=tmp+item+estr;

		return serverIP;
	}
</script>
