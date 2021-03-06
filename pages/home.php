<!DOCTYPE HTML>
<html lang="zh_CN">
	<?php get_head(); ?>
	<body>

		<?php 
			get_header();
			global $__USER,$mydb;
							
			$rolearr=['','系统管理员','超级管理员','设备管理员','','普通用户'];
		?>	
	
	    <div id="bodier" class="">
	        <div class="container">
				<div class="row">
				  	<div class="col-md-3">
				  		<div class="home-box widget">
				  			<div class="user-info-cover" id="skin_cover_s">
				  				<div class="headpic"></div>
				  			</div>
				  			<div class="user-info-box">
				  				<div class="name"><?php echo $__USER['user_name'];?></div>
				  				<div class="role"><?php echo $rolearr[$__USER['user_role']];?></div>
				  				<div class="last-login-time">上次登陆：<?php echo $__USER['last_login_time']; ?></div>
				  			</div>
				  		</div>
				  		<div class="home-box">
				  			<div class="bignav-box">
				  				<a class="bignav-title" href="index.php?page=monitor"><i class="fa fa-industry" aria-hidden="true"></i>
在线监测</a>
				  			</div>
				  			<?php
				  			if(is_current_user_can_see(2)){
				  			?>
					  			<div class="bignav-box">
					  				<a class="bignav-title" href="index.php?page=users"><i class="fa fa-users" aria-hidden="true"></i>
用户管理</a>
					  			</div>
					  		<?php
					  		}
					  		?>
				  			<div class="bignav-box">
				  				<a class="bignav-title" href="index.php?page=devs"><i class="fa fa-server" aria-hidden="true"></i>
设备管理</a>
				  			</div>
				  			<div class="bignav-box">
				  				<a class="bignav-title" href="index.php?page=groups"><i class="fa fa-neuter" aria-hidden="true"></i>
杆塔管理</a>
				  			</div>
				  			<div class="bignav-box">
				  				<a class="bignav-title"  href="index.php?page=lines"><i class="fa fa-chain-broken" aria-hidden="true"></i>
线路管理</a>
				  			</div>
				  			<?php
				  			if(is_current_user_can_see(1)){
				  				if(is_multisite_on()){
				  			?>
				  			<div class="bignav-box">
				  				<a class="bignav-title"  href="index.php?page=multisites"><i class="fa fa-globe" aria-hidden="true"></i>
站点管理</a>
				  			</div>
				  			<?php
				  				}
				  			?>
					  			<div class="bignav-box">
					  				<a class="bignav-title" href="index.php?page=dologs"><i class="fa fa-file-o" aria-hidden="true"></i>
操作日志</a>
					  			</div>
					  		<?php
					  		}
					  		?>
				  		</div>
				  	</div>
				  	<div class="col-md-9">
				  		<div class="home-box widget">
				  			<h3>最近报警信息(<a href="index.php?page=excel&action=alarmslog">更多</a>&nbsp;|&nbsp;<a href="index.php?page=excel&action=historieslog">历史</a>)</h3>
				  		</div>
				  			<?php 
				  			$alarms=$mydb->get_last_alarms();
				  			if($alarms){
				  			?>
				  						<table class="table striped table-alarmslist">
					<thead><tr>
						<th>报警设备</th><th>报警时间</th><th>动作次数</th><th>泄漏电流</th><th>温度</th><th>湿度</th><th>所在杆塔与线路</th>
					</tr></thead>
					<tbody>
						<?php

						foreach ($alarms as $alarm) {
							$html='';
							$html.='<tr><td><a href="index.php?page=charts&devnum='.$alarm['dev_number'].'" target="_blank">'.$alarm['dev_number'].'</a></td><td>'.$alarm['action_time'].'</td><td>'.$alarm['action_num'].'</td><td>'.$alarm['i_num'].'</td><td>'.$alarm['tem'].'</td><td>'.$alarm['hum'].'</td><td>'.$alarm['group_loc_name'].'<br />'.$alarm['line_name'].'-'.$alarm['dev_phase'].'</td></tr>';
							echo $html;
						}
						?>
					</tbody>
					<tfoot><tr>
						<th>报警设备</th><th>报警时间</th><th>动作次数</th><th>泄漏电流</th><th>温度</th><th>湿度</th><th>所在杆塔与线路</th>
					</tr></tfoot>
				</table>
							<?php
							}
							else{
							?>
							<h2>&nbsp;&nbsp;暂无报警信息</h2>
							<?php 
							}
							?>
				  		
				  	</div>

				</div>
					
				</div>
		</div>
	
		<?php get_footer();?>
    
	</body>
</html>