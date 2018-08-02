<?php
    include_once '../func_common_param.php';
    include_once '../func_advanced_param.php';
    header("Content-type: text/html; charset=utf-8");
    //主码流路径和地址
    $chanNo = 0;
    $ret    = &GetMediaPara("RTMP",$chanNo,$streamtype=0);
    $path   = $ret['path']; //地址
    $port   = $ret['port']; //名称

    //id
    $equip = &getequipmentid();
    $eid = $equip['devName'];

    //描述符
    $ret         = &Getorchname();
    $orchDevName = $ret['devName'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>向数据库注册设备</title>
<link rel="shortcut icon" href="../img/login_logo.gif">
<script src="../js/jquery-1.7.2.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script href="../js/placeholder.js"></script><!---->
<script src="../js/bootstrap-switch-master/dist/js/bootstrap-switch.js"></script>
<link href="../css/newbutton.css" rel="stylesheet">
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">
<link href="../css/focus.css" rel="stylesheet">
<!--访问速度慢是因为focus.css中用到了google字体-->
<link href="../css/focus-responsive.css" rel="stylesheet">
<link href="../js/bootstrap-switch-master/dist/css/bootstrap3/bootstrap-switch.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../flowplayer/skin/functional.css"/>
</head>
</head>
<body style="background-color:#fff">
<form  name="form">
    <table style="margin-left:30px" >
        <tr>
            <td></td>
        </tr>
        <tr>
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
        <input type="hidden" name="equip_id" value="<?php echo $eid?>"><!--id-->
        <input type="hidden" name="equip_orchDevName" value="<?php echo $orchDevName?>"><!--描述符-->
        <input type="hidden" name="equip_stream_name" value="<?php echo $port?>"><!--流名称-->
        <input type="hidden" name="equip_stream_path" value="<?php echo $path?>"><!--流地址-->
        <tr align="center">
            <td></td>
            <td>
                <button type="button"  id="btn" class="btn btn-primary" name="submit">提交</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<script>
    $("#btn").click(function(k) {
        var j = $("form").serializeArray();//序列化name/value
        $.ajax({
            type: 'GET',  //这里用GET
            url: 'http://www.xiukeshop.com/bindingEquipment/bindEqu.php',
            dataType: 'jsonp',  //类型
            data: j,
            jsonp: 'callback', //jsonp回调参数，必需
            async: false,
            success: function(result) {//返回的json数据

                if(result.msg == 'addsuccess'){
                    alert('设备添加成功！');
                }else if(result.msg == 'adderror'){
                    alert('设备添加失败！');
                }else if(result.msg == 'upsuccess'){
                    alert('设备修改成功！');
                }else if(result.msg == 'uperror'){
                    alert('设备修改成功！');
                }else if(result.msg == 'mysqlno'){
                    alert('数据库连接失败！');
                }else{
                    alert('设备信息错误！');
                }
            },
            timeout: 3000
        });
        //...
});
</script>