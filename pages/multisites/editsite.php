<?php 
	global $mydb;
	$site=$mydb->get_site($_GET['sid']);
	$is_use_default=true;
	$dbhost='';
	$dbname='';
	$dbuser='';
	$dbpasswd='';
	if($site)
		read_site_conf_file($site['site_name'],$dbhost,$dbname,$dbuser,$dbpasswd);
	if($dbhost==DB_HOST&&$dbname==DB_NAME&&$dbuser==DB_USER&&$dbpasswd==DB_PASSWORD){
		$dbhost='';
		$dbname='';
		$dbuser='';
		$dbpasswd='';
	}
	else
		$is_use_default=false;
?>
<div class="widget">
	<h3>编辑站点</h3>

	<form class="form-horizontal form-newsite form-editsite">
		<div class="form-group">
			<label for="inputSiteName" class="col-sm-3 control-label input-required">站点名</label>
			<div class="col-sm-6">
				<div class="input-group">
					<input type="text" class="form-control" id="inputSiteName" placeholder="站点名" required="required" value="<?php echo $site['site_name'] ?>">
					<div class="input-group-addon">.kedinggis.com</div>
				</div>
				<label>站点名长度在16个字符以内,只能输入小写英文字母&nbsp;&nbsp;&nbsp;&nbsp;<span class="error error-sitename"></span>
				<br /><strong>添加新站点前务必先在域名注册商处添加二级域名</strong>
				</label>
			</div>
		</div>
		<div class="form-group">
			<label for="inputSiteRemark" class="col-sm-3 control-label">备注</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="inputSiteRemark" placeholder="备注" value="<?php echo $site['site_remark'] ?>">
				
				<label>备注长度在30个字符以内&nbsp;&nbsp;&nbsp;&nbsp;<span class="error error-siteremark"></span></label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<div class="checkbox">
					<label>
						<input id="checkToUseDefault" type="checkbox"<?php echo ($is_use_default==1)?' checked="checked"':'';?>> 使用默认数据库
					</label>
				</div>
			</div>
		</div>
		<br />

		<div class="form-group form-tolock">
			<label for="inputDBhost" class="col-sm-3 control-label">数据库地址</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="inputDBhost" placeholder="数据库地址"<?php echo ($is_use_default==1)?' disabled="disabled"':'',' value="'.$dbhost.'"';?>>
				
				<label>数据库的域名地址或ip&nbsp;&nbsp;&nbsp;&nbsp;<span class="error error-dbhost"></span></label>
			</div>
		</div>
		<div class="form-group form-tolock">
			<label for="inputDBname" class="col-sm-3 control-label">数据表名</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="inputDBname" placeholder="数据表名"<?php echo ($is_use_default==1)?' disabled="disabled"':'',' value="'.$dbname.'"';?>>
				
				<label>所连接的数据表名称&nbsp;&nbsp;&nbsp;&nbsp;<span class="error error-dbname"></span></label>
			</div>
		</div>
		<div class="form-group form-tolock">
			<label for="inputDBuser" class="col-sm-3 control-label">数据库用户名</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="inputDBuser" placeholder="数据库用户名" <?php echo ($is_use_default==1)?' disabled="disabled"':'',' value="'.$dbuser.'"';?>>
				
				<label><span class="error error-dbuser"></span></label>
			</div>
		</div>
		<div class="form-group form-tolock">
			<label for="inputDBpasswd" class="col-sm-3 control-label">数据库密码</label>
			<div class="col-sm-6">
				<input type="password" class="form-control" id="inputDBpasswd" placeholder="数据库密码"<?php echo ($is_use_default==1)?' disabled="disabled"':'',' value="'.$dbpasswd.'"';?>>

				<label><span class="error error-dbpasswd"></span></label>
			</div>
		</div>
		<div class="form-group">
			<label for="selectLine" class="col-sm-3 control-label"></label>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-success">确定修改</button>
				<a href="index.php?page=multisites&action=siteslist" class="btn btn-warning">返回站点列表</a>
				<label><span class="error error-msg"></span><span class="error success-msg"></span></label>
			</div>
		</div>
		<input type="hidden" id="inputSiteID" value="<?php echo $site['site_id'];?>">

	</form>
</div>

<script type="text/javascript" src="js/newsite.js"></script>