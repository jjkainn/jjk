<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">    
	<meta name="description" content="">
    <meta name="author" content="MaZhiyu">
	<title>文件下载</title>
</head>
<body>
	<div class="container-fluid" style="margin:0 auto;">
		<div class="download-file" style="text-align:center; line-height:5em;">
		<h1>文件下载</h1>
			<form action="download.php?action=download" method="post">
				<input type="text" id="file" name="file" placeholder="请输入文件在网站根目录中的路径 如：DM385/image/1.png" style="width:30em; line-height:2em;"/>
				<input type="submit" name="down" value="下载" style="line-height:2em; width:5em;"/>
			</form>
		</div>
	</div>
</body>
</html>
