<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
	    <link rel="shortcut icon" href="../img/login_logo.gif">
		<!-- <title><?php echo $Lan_Common["TITLE"][$Language_Type]?></title> -->
		<script src="../js/jquery-1.7.2.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
		<script href="../js/placeholder.js"></script><!---->
		<script src="../js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
		<link href="../css/newbutton.css" rel="stylesheet">
	    <link href="../css/bootstrap.css" rel="stylesheet">
		<!--<link href="../css/bootstrap3.0.3.css" rel="stylesheet">-->
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">
	    <link href="../css/focus.css" rel="stylesheet">
	    <!--访问速度慢是因为focus.css中用到了google字体-->
	    <link href="../css/focus-responsive.css" rel="stylesheet">
		<link href="../js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" 
		rel="stylesheet">
	</head>
	<body>
		<form action="fun_server.php?action=setserveradd" method="post">
			<table style="margin-left:30px" >
				<tr>
				<td></td>
				</tr>
				<tr align="right">
					<td >输入IP地址：</td>
					<td >
						<div style="margin-top:8px">
							<input valign="hidden" style="width:36px" class="form-control" type="text" name="dev_ip_1" id="dev_ip_1" required="required"  value="115"/>.
							<input valign="hidden" style="width:36px" class="form-control" type="text" name="dev_ip_2" id="dev_ip_2" required="required"  value="29"/>.
							<input valign="hidden" style="width:36px" class="form-control" type="text" name="dev_ip_3" id="dev_ip_3" required="required"  value="148"/>.
							<input valign="hidden" style="width:36px" class="form-control" type="text" name="dev_ip_4" id="dev_ip_4" required="required"  value="122"/>
						</div>
					</td>
				</tr>
				<tr align="right">
					<td>数据库用户名:</td>
					<td><input type="text" name="db_user" value="root" required="root"></td>
				</tr>
				<tr align="right">
					<td>数据库密码:</td>
					<td>
						<input type="password" name="db_pwd" value="">
					</td>
				</tr>
				<tr align="right">
					<td>端口号:</td>
					<td>
						<input type="text" name="db_port" value="3306" required="required">
					</td>
				</tr>
				<tr align="center">
					<td></td>
					<td>
						<button type="submit"  class="btn btn-primary" name="submit">提交</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>