	<header id="header">
        <div class="container clearfix">
            <h1 class="center-block">线路型避雷器在线监测系统</h1>
       
	        <nav class="pull-left"><ul class="site-nav site-navbar clearfix">
					<li class="navto-home<?php echo ($_GET['page']=='home')?" active":""; ?>"><a href="index.php">首页</a></li>
					<li class="navto-devs<?php echo ($_GET['page']=='devs')?" active":""; ?>"><a href="index.php?page=devs">设备管理</a></li>
					<li class="navto-groups<?php echo ($_GET['page']=='groups')?" active":""; ?>"><a href="index.php?page=groups">杆塔管理 </a></li>
					<li class="navto-lines<?php echo ($_GET['page']=='lines')?" active":""; ?>"><a href="index.php?page=lines">线路管理 </a></li>
					<?php 
					if(is_current_user_can_see(2)){ 
					?>
						<li class="navto-users<?php echo ($_GET['page']=='users')?" active":""; ?>"><a href="index.php?page=users">用户管理 </a></li>
					<?php 
					}
					?>
					<li class="navto-monitor<?php echo ($_GET['page']=='monitor')?" active":""; ?>"><a href="index.php?page=monitor">在线监测 </a></li>
					<li class="navto-help<?php echo ($_GET['page']=='help')?" active":""; ?>"><a href="index.php?page=help">帮助 </a></li>
			</ul></nav>
			<div class="login-info-bar pull-left">
				<div class="pull-right">
					<i class="fa fa-user" aria-hidden="true"></i>
					<span>
						<?php 
							global $__USER;
							echo $__USER['user_name'];    //可以在次编辑登录用户身份信息
						?>
					</span>
					<i class="fa fa-caret-down" aria-hidden="true"></i> <!-- 显示斜体文本效果 -->
					<ul class="tohie submenu">
						<li><a href="index.php?page=users&action=editself">修改资料</a></li>
						<li><a href="login.php?action=logout">注销</a></li>
					</ul>
				</div>
			</div>
        </div>
    </header>
