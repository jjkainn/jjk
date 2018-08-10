
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
		flowplayer.conf = { live: true };
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
						<div class="tab-pane" style="text-align:center;">
							<table class="table" style="margin-top:2em;text-align: center;" align="center" id="wifelist">
							
							<a class="btn btn-lg btn-success" onclick="fresh();" style="*margin-left: 43%;">刷新WIFI列表</a>
								<thead>
									<tr>
										<td>序号</td>
										<td>SSID</td>
										<td>信号强度</td>
										<td>加密类型</td>
									</tr>
								</thead>
								<tbody>
									<input type="hidden" name="" value="{$data}">
																											<tr style="background:#8d908b;">
										<td style="color: #000000;">0</td>
										<td>TP-LINK_15DBB2</td>
										<td>													<img src="img/wifi5.png" width='20' height='20' class="wifi5">
																					</td>
										<td style="color: #000000;">WPA2-PSK</td>
									</tr>							
									
									<div id="modal-container-438989" class="modal hide" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-header" style="color: #000000;">
											<h3 id="myModalLabel">WIFI连接</h3>
										</div>
										<!--wifi连接列表-->
										<div class="modal-body" style="margin-left:0;color: #000000;">
											<span style="margin-left:0px;">SSID：</span>
											<span>LongYu</span><br>
											<span style="">加密类型：</span>
											<span>
																								<span>WPA2-PSK</span><br>
																						</tr>
											
											<form action='ctl_wifi_param.php?action=WifiConnect' method='post'>
												<input type="hidden" name="wifiSSID" value="LongYu">
												<input type="hidden" name="wifiencypt" value="WPA2-PSK">
																								<span>密码：</span>
												<span><input type="password" name="wifiPWD" class="form-control"/></span><br>
																					</div>
										
										<div class="modal-footer">
											 <button class="btn" data-dismiss="modal" aria-hidden="true">关  闭</button> <input type='submit' class="btn btn-primary" value='启用'/>
										</div>
										
										</form>
									</div>
																</tbody>
							</table>
						</div>
							
				</div>
				<input type="hidden" id="status" value="1">
</div>
  </body>
</html>
<!-- <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var status = $("#status").val();
	$.ajax({
		url:"Channel.php",
		type:'post',
		dta:{status:status},
		dataType:'json',
		success:function(resulf){
			alert(resulf);
		}
	})
});
 
</script> -->