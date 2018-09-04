 <?php 
	header('Content-type:text/html;charset=utf-8');
	include 'language.php';
	include_once ("func_sys_set.php");
//	运行出错时报错
	error_reporting(1);
	session_start();
//	定义默认语言为中文
	$Language_Type = $_SESSION["LAN"] ? $_SESSION["LAN"] : 'CH';
	echo ("<script type='text/javascript'>  var lang = \"{$Language_Type}\";</script>");
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    	<!--兼容ie8以上只需考虑ie6.7就可以-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<!--自适应设备宽度-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="MaZhiyu">
    <link rel="shortcut icon" href="./img/login_logo.gif">
    
    <title><?php echo $Lan_Common["TITLE"][$Language_Type]?></title>
     
	
	<script src="js/DD_belatedPNG.js"></script>
<!--	ie6不支持png-->
	<!--[if IE 6]>
    <script type="text/javascript" src="js/DD_belatedPNG.js"></script>
    <script type="text/javascript">
    DD_belatedPNG.fix('.logo');
    </script>
<![endif]-->
    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap3.0.3.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
   <!-- ie8及更低版本不支持媒体查询-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style>
    	.container{
    		/*width: auto;*/
    		background: url(img/denglu.png) no-repeat;
    		background-size: 100%;
    		/*margin-left: ;*/
    		position: relative;
    		margin-left: 23%\9;
    		width: 1000px\9;
    	}
    	form{
    		height: auto;
    		margin: auto;
    	}
    	input{
    		background: #F36609;
    	}
    	
    	/*自适应*/
@media only screen and (min-width: 1024px) {
	.container{
		width: 1000px;
	}
	
}
@media only screen and (min-width: 976px) and (max-width: 1024px) {
	form{
		/*position: relative;*/
		margin:auto;
		
	}
	
}
@media only screen and (min-width: 768px) and (max-width: 976px) {
      .container{
      	height: auto;
      }

    form{
		/*position: relative;*/
		margin:auto;
		position: relative;
		top: -50px;
		
	}
}
@media only screen and (min-width: 480px) and (max-width: 768px) {

		.container img{
		display: none;
	}
	.container{
		background: none;
	}
	form{
		position: relative;
		margin:auto;
		
		left: -5%;
		width: 90%;
		height: auto;
		/*left: -50px;*/
		
	}
	
}
@media only screen and (max-width: 480px) {
	.container img{
		display: none;
	}
	.container{
		background: none;
	}
	form{
		position: relative;
		margin:auto;
		left: 10%;
		/*left: -50px;*/
		width: 80%;
		height: auto;
		/*font-size: 0.8em;*/
		
	}
	h2{
		font-size: 1.2em;
	}
	input{
		font-size: 1.2em;
	}
}
    </style>
  </head>

  <body style="overflow:-Scroll;overflow-x:hidden;margin: 0px auto;">

    <div class="container" style="height:100%;">
      <img src="img/logo3.png" class="logo" style="margin-left:6%;margin-top: 8%;">
      <form action="logon.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">
        	<?php 
        	$ret = GetDeviceID();
//      	 echo $ret['id'];
	        if($ret['id']=="9")
	        {
	        echo $Lan_Common["TIP"][$Language_Type]; 
			}
            else{
            echo $Lan_Common["TIPER"][$Language_Type];
	        } 
            ?>
        </h2>
        <?php if($Language_Type == 'CH'){ ?>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus required   oninvalid="setCustomValidity('请填写此字段！');" oninput="setCustomValidity('');"/>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required oninvalid="setCustomValidity('请填写此字段！');" oninput="setCustomValidity('');">
        <?php }else{ ?>
        <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus required   oninvalid="setCustomValidity('Please fill in this field!');" oninput="setCustomValidity('');"/>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required oninvalid="setCustomValidity('Please fill in this field!');" oninput="setCustomValidity('');">
        <?php } ?>
        <input type="submit" class="btn btn-lg btn-primary btn-block" value="<?php echo $Lan_Common["LOGIN"][$Language_Type];?>">
		<br>
		<select onchange="language(value)" id="LanguageType">
			<option value="CH">中文</option>
			<option value="EN">English</option>
		</select>
      </form>


    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
<script>
	function language(value){
		var LanType = value;
		
//		打开并刷新新页面
		window.location.href="changelan.php?language="+LanType;
	}
//	中英文切换按钮操作判断
	var languageType = document.getElementById("LanguageType");
	for(var i=0; i<languageType.options.length; i++){
		if(languageType.options[i].value == lang){
			languageType.options[i].selected = true;
			break;
		}
	}
</script>
