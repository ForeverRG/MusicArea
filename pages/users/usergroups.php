<div class="btn-group">
	<button class="btn btn-primary btn-topopaddug">新增小组</button>
</div>
<div class="btn-group pull-right">
	<!--<button class="btn btn-success btn-topopnew">新建成员</button>-->
	<button class="btn btn-danger btn-topopeli" style="float:left;margin-left:10px;">删除成员</button>
	<a href="index.php?page=users&action=newuser" class="btn btn-success">新建成员</a>
</div>
<?php 
global $mydb;
$usergroups=$mydb->get_all_usergroups();
$users=$mydb->get_reindex_string('users','user_gid','user_name');
$groups=$mydb->get_reindex_string('groups','user_gid',array('group_loc','group_name'));
if(!empty($usergroups)){
?>
	<table class="table striped table-usergroup">
		<thead><tr>
			<th class="select"><input id="cb-select-all" type="hidden"></th><th>小组名</th><th>小组成员</th><th>管理杆塔</th>
		</tr></thead>
		<tbody>
		<?php
			foreach ($usergroups as $usergroup) {
				$html= '<tr><td><input id="cb-select-'.$usergroup['user_gid'].'" type="hidden" value="'.$usergroup['user_gid'].'"><br />&nbsp;</td>';
				$html.='<td><strong>'.$usergroup['user_gname'].'</strong><div class="row-actions"><span class="edit"><a href="javascript:void(0)" title="更改小组名称">改名</a></span><span class="delete"><a href="javascript:void(0)" title="删除此小组">删除</a></span>
				<span class="join"><a href="javascript:void(0)"title="加入成员">加入</a></span></div></td>';
				if(empty($users[$usergroup['user_gid']]))
					$users[$usergroup['user_gid']]='';
				$html.='<td>'.$users[$usergroup['user_gid']].'</td>';  //显示用户（小组成员）
				if(empty($groups[$usergroup['user_gid']]))
					$groups[$usergroup['user_gid']]='';
				$html.='<td>'.$groups[$usergroup['user_gid']].'</td></tr>';  //显示管理杆塔
				echo $html;
			}
		?>
		</tbody>
		<tfoot><tr>
			<th><input id="cb-select-all" type="hidden"></th><th>小组名</th><th>小组成员</th><th>管理杆塔</th>
		</tr></tfoot>
	</table>

<?php 
	$pgn_html=$mydb->__get("pgn_html");
	if(!empty($pgn_html))
		echo $pgn_html;
}
else{
?>
	<table class="table striped table-usergroup tohide">
		<thead><tr>
			<th class="select"><input id="cb-select-all" type="hidden"></th><th>小组名</th><th>小组成员</th><th>管理杆塔</th>
		</tr></thead>
		<tbody>
		</tbody>
		<tfoot><tr>
			<th><input id="cb-select-all" type="hidden"></th><th>小组名</th><th>小组成员</th><th>管理杆塔</th>
		</tr></tfoot>
	</table>
	<div class="widget widget-null">
		<h3>NOT FOUND</h3>
		<p><h2>&nbsp;&nbsp;小组列表为空</h2></p>
	</div>
<?php 
}
?>
<div class="pop-box pop-addug">
	<form class="form-horizontal form-addug">
		<div class="remove-x"><i class="fa fa-remove"></i></div>
		<h3 class="center-block">添加小组</h3>
		<div class="form-group">
			<label for="inputUserGName" class="col-sm-3 control-label input-required">小组名</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" id="inputUserGName"
					placeholder="小组名" required="required">
				<label>小组名长度在16个字符以内&nbsp;&nbsp;&nbsp;&nbsp;<span class="error error-usergname"></span></label>
			</div>
		</div>
		<div class="form-group">
			<label for="selectLine" class="col-sm-3 control-label"></label>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-success">确定添加</button>
				<label><span class="error error-msg"></span><span class="error success-msg"></span></label>
			</div>
		</div>

	</form>
</div>

<div class="pop-box pop-join">
	<form class="form-horizontal form-join">
		<div class="remove-x"><i class="fa fa-remove"></i></div>
		<h3 class="center-block">加入成员</h3>
		<div class="form-group">
			<label for="selectMember" class="col-sm-3 control-label input-required">成员名</label>
			<div class="col-sm-6">
				<select class="form-control" id="selectMember">
					
					<?php
						require_db();
						global $mydb;
						$users = $mydb -> get_all_users();
						$html = "";
						if($users && count($users)>0) {
							$html .= '<option selected="selected" value="0">空（点击选择小组成员）</option>';
							foreach ($users as $user) {
								$html.= '<option class="user-'.$user['user_id'].'" value="'.$user['user_name'].'">'.$user['user_name'].'</option>';
							}
						}
						else{ 
							$html='<option selected="selected">空（暂无用户成员信息，请创建用户）</option>';
						}
						echo $html;
					?>

				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="selectLine" class="col-sm-3 control-label"></label>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-success">确定添加</button>
				<input onclick="window.location.href='http://localhost/index.php?page=users&action=usergroups'" type="button" value="返回" name="B8" class="btn btn-warning">
				<label><span class="error error-msg"></span><span class="error success-msg"></span></label>
			</div>
		</div>
	</form>
</div>

<div class="pop-box pop-eli">
	<form class="form-horizontal form-eli">
		<div class="remove-x"><i class="fa fa-remove"></i></div>
		<h3 class="center-block">删除成员</h3>
		<div class="form-group">
			<label for="selectMember" class="col-sm-3 control-label input-required">成员名</label>
			<div class="col-sm-6">
				<select class="form-control" id="selectMember">
					
					<?php
						require_db();
						global $mydb;
						$users = $mydb -> get_all_users();
						$html = "";
						if($users && count($users)>0) {
							$html .= '<option selected="selected" value="0">空（点击选择小组成员）</option>';
							foreach ($users as $user) {
								$html.= '<option class="user-'.$user['user_id'].'" value="'.$user['user_name'].'">'.$user['user_name'].'</option>';
							}
						}
						else{ 
							$html='<option selected="selected">空（暂无用户成员信息，请创建用户）</option>';
						}
						echo $html;
					?>

				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="selectLine" class="col-sm-3 control-label"></label>
			<div class="col-sm-6">
				<button type="submit" class="btn btn-success">确定删除</button>
				<input onclick="window.location.href='http://localhost/index.php?page=users&action=usergroups'" type="button" value="返回" name="B8" class="btn btn-warning">
				<label><span class="error error-msg"></span><span class="error success-msg"></span></label>
			</div>
		</div>
	</form>
</div>

<div class="pop-box pop-delug">
	<div class="msgbox">
		<div class="remove-x"><i class="fa fa-remove"></i></div>
		<h3 class="center-block">确定删除吗？<br />此操作不可恢复</h3>
		<input type="hidden" class="form-control" id="inputUserGName" />
		<p class="msg">小组<b><span class="msg-usergroup-name"></span></b>将被删除</p>
		<div class="center-block">	
			<button type="submit" class="btn btn-danger btn-del-commit">确定</button>
			<button type="submit" class="btn btn-warning btn-del-cancel">取消</button>
			<p class="msg"><span class="error error-msg"></span><span class="error success-msg"></span></p>
		</div>
	</div>
</div>

<script type="text/javascript" src="js/newusergroup.js"></script>