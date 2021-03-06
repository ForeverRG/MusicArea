$(document).ready(function(){
	var old_site_name=$(".form-newsite #inputSiteName").val();
	var old_site_remark=$(".form-newsite #inputSiteRemark").val();
	var old_dbhost=$(".form-newsite #inputDBhost").val();
	var old_dbname=$(".form-newsite #inputDBname").val();
	var old_dbuser=$(".form-newsite #inputDBuser").val();
	var old_dbpasswd=$(".form-newsite #inputDBpasswd").val();
	var site_id=0;
	modeName=['添加','修改','删除'];
	$('.form-newsite').submit(function(e){
		e.preventDefault();
		var site_name=$.trim($(".form-newsite #inputSiteName").val());
		var site_remark=$(".form-newsite #inputSiteRemark").val();
		var dbhost=$.trim($(".form-newsite #inputDBhost").val());
		var dbname=$.trim($(".form-newsite #inputDBname").val());
		var dbuser=$.trim($(".form-newsite #inputDBuser").val());
		var dbpasswd=$.trim($(".form-newsite #inputDBpasswd").val());
		var is_use_default=$('#checkToUseDefault').is(':checked')?1:0;
		var reg_site_name = /^[a-z]+$/;
		var hasError=0;
		
		$('.form-newsite span.error').html("").hide();
		var btn=$('.form-newsite button.btn');
		btn.attr("disabled","disabled");
		mode=$('.form-newsite').hasClass('form-editsite')?1:0;
		if(mode==1){
			site_id=$(".form-newsite #inputSiteID").val();
		}
		if(mode==1&&old_site_name==site_name&&old_site_remark==site_remark&&old_dbhost==dbhost&&old_dbname==dbname&&old_dbuser==dbuser&&old_dbpasswd==dbpasswd){
			$('.form-newsite .error-msg').html("未做任何修改").show();
			btn.attr('disabled',false);
			return;
		}
		if(hasError>0){
			$('.form-newsite .error-msg').html(hasError+"处错误，请修改");
			$('.form-newsite span.error').show();
			btn.attr('disabled',false);
			return;
		}

		var data={"mode":mode,"is_use_default":is_use_default,"site_id":site_id,"site_name":site_name,"site_remark":site_remark,"dbhost":dbhost,"dbname":dbname,"dbuser":dbuser,"dbpasswd":dbpasswd};
		//console.log(data);
		$.ajax({
		        type: "post",
		        url: "pages/multisites/newsiteadd-ajax.php",
		        dataType: "json",	        
		        data: data,
		        //beforeSend: LoadFunction, //加载执行方法    
		        //error: errorFunction,  //错误执行方法    
		        success: function (t) {
		        	if(t.errorsinfo==null||t.errorsinfo.count==0){
		        		$('.form-newsite .success-msg').html("站点["+site_name+"]"+modeName[mode]+"成功").show();
		        		btn.attr('disabled',false);
		        		old_site_name=site_name;
		        		old_site_remark=site_remark;
		        		old_dbhost=dbhost;
		        		old_dbname=dbname;
		        		old_dbuser=dbuser;
		        		old_dbpasswd=dbpasswd;
		        		return;
		        	}
		        	else {
		        		for(var i=0;i<t.errorsinfo.count;i++){
		        			$('.form-newsite .error-msg').append(t.errorsinfo.errors[i]+'<br />').show();
		        		}
		        	}
		        	btn.attr('disabled',false);
		        },
		        error: function () {
		        	$('.form-newsite .error-msg').html('网络错误，请稍后再试').show();
		        	btn.attr('disabled',false);
		        }
		 });
		
	});
	$('#checkToUseDefault').change(function(){
		if($(this).is(':checked'))
			$('.form-tolock input').attr('disabled','disabled');
		else
			$('.form-tolock input').attr('disabled',false);
	});
	var changeTr;
	//删除
	$('.table-multisite tbody').on('click','span.delete',function(e){
		e.preventDefault();
		changeTr=$(this).parents('tr:first');
		mode=2;
		$('.msgbox span.msg-site-name').html(changeTr.find('td:eq(1) strong').html());
		site_id=changeTr.find('td:first input').val();
		$('.pop-box.pop-delsite').fadeIn(200);
		$('.pop-box .msgbox .btn-del-commit').attr("disabled",false).focus();
		$('.msgbox .error').html('');
	});
	$('.remove-x,.pop-box .msgbox .btn-del-cancel').click(function(){
		$(this).parents('.pop-box').fadeOut(200);
		 //msgReset();
	});
	//删除确认click事件
	$('.pop-box .msgbox .btn-del-commit').click(function(e){
		$(this).attr("disabled","disabled");
		$('.msgbox .error').html("");
		var data="mode="+mode+"&site_id="+site_id;
		$.ajax({
		        type: "post",
		        url: "pages/multisites/newsiteadd-ajax.php",
		        dataType: "json",	        
		        data: data,
		        //beforeSend: LoadFunction, //加载执行方法    
		        //error: errorFunction,  //错误执行方法    
		        success: function (t) {
		        	if(t.errorsinfo==null||t.errorsinfo.count==0){
		        		$('.msgbox .success-msg').html("删除成功").show();
		        		changeTr.remove();
		        		return;
		        	}
		        	else {
		        		$('.msgbox .error-msg').html("");
		        		for(var i=0;i<t.errorsinfo.count;i++){
		        			$('.msgbox .error-msg').append(t.errorsinfo.errors[i]+'<br />');
		        		}
		        		$('.msgbox .error-msg').show();
		        		$('.pop-box .msgbox .btn-del-commit').attr("disabled",false).html("重试");
		        	}
		        },
		        error: function () {
		        	$('.msgbox .error-msg').html('网络错误，请稍后再试').show();
		        	$('.pop-box .msgbox .btn-del-commit').attr("disabled",false).html("重试");
		        }
		 });

	});
})
