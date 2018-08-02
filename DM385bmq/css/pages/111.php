<!DOCTYPE html>
<head>
	<mata charset="utf-8">
	<script src="../../js/bootstrap-switch-master/docs/js/jquery.min.js"></script>
	<script src="../../js/bootstrap-switch-master/test/bootstrap-switch.js"></script>

</head>
<body>
	<input name="status"  type="checkbox"/>
		<input name="status"  type="checkbox"/>
			<input name="status"  type="checkbox"/>
					<script type="text/javascript">
		
		$('[name="status"]').bootstrapSwitch({  
        onText:"启动",  
        offText:"停止",  
        onColor:"success",  
        offColor:"info",  
        size:"small",  
        onSwitchChange:function(event,state){  
            if(state==true){  
                $(this).val("1");  
            }else{  
                $(this).val("2");  
            }  
        }  
    })
	</script>
</body>
</html>