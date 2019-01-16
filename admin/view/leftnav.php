
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
		<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu " data-auto-scroll="true" data-slide-speed="200">
				<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler">
					</div>
					<!-- END SIDEBAR TOGGLER BUTTON -->
				</li>
				<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
					<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
					<form class="sidebar-search " action="extra_search.html" method="POST">
						<a href="javascript:;" class="remove">
						<i class="icon-close"></i>
						</a>
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
							<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
							</span>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
				<li class="start <?= @$page_level[0] == 'dashboard' ? 'active' : '' ?>">
					<a href="index.php">
					<i class="icon-home"></i>
					<span class="title">控制台</span>
					</a>
				</li>
                                <li class="<?= @$page_level[0] == 'idea' ? 'active open' : '' ?>">
					<a href="javascript:;">
					<i class="icon-layers"></i>
					<span class="title">项目</span>
					<span class="arrow <?= @$page_level[0] == 'idea' ? 'open' : '' ?>"></span>
					</a>
                                        <ul class="sub-menu">
                                                <li class="<?= @$page_level[1] == 'idea_list' ? 'active' : '' ?>">
                                                        <a href="idea_list.php">
							<i class="icon-list"></i>
							项目列表</a>
						</li>
                                                
                                                <li class="<?= @$page_level[1] == 'like_detail' ? 'active' : '' ?>">
                                                    <a href="like_detail.php">
							<i class="icon-list"></i>
							评价详细</a>
						</li>
<!--                                                <li class="<?= @$page_level[1] == 'idea_detail' ? 'active' : '' ?>">
                                                        <a href="idea_detail.php">
							<i class="icon-home"></i>
							项目向导</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'idea_detail_all' ? 'active' : '' ?>">
                                                        <a href="idea_detail_all.php">
							<i class="icon-home"></i>
							项目详情</a>
						</li>-->

						<li class="<?= @$page_level[1] == 'idea_recommend' ? 'active' : '' ?>">
                                                        <a href="idea_recommend.php">
							<i class="icon-like"></i>
							推荐排序</a>
						</li>
					</ul>
				</li>
                                <li class="<?= @$page_level[0] == 'product' ? 'active open' : '' ?>">
					<a href="javascript:;">
					<i class="icon-basket"></i>
					<span class="title">商品</span>
					<span class="arrow <?= @$page_level[0] == 'product' ? 'open' : '' ?>"></span>
					</a>
                                        <ul class="sub-menu">
                                                <li class="<?= @$page_level[1] == 'product_add' ? 'active' : '' ?>">
                                                        <a href="product_add.php">
							<i class="icon-note"></i>
							新商品</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'product_list' ? 'active' : '' ?>">
                                                        <a href="product_list.php">
							<i class="icon-handbag"></i>
							商品列表</a>
						</li>
						<li class="<?= @$page_level[1] == 'product_category_list' ? 'active' : '' ?>">
                                                        <a href="product_category_list.php">
							<i class="icon-grid"></i>
							商品目录</a>
						</li>
					</ul>
				</li>
                                <li class="<?= @$page_level[0] == 'user' ? 'active open' : '' ?>">
					<a href="javascript:;">
					<i class="icon-user"></i>
					<span class="title">用户</span>
					<span class="arrow <?= @$page_level[0] == 'user' ? 'open' : '' ?>"></span>
					</a>
                                        <ul class="sub-menu">
                                                <li class="<?= @$page_level[1] == 'user_add' ? 'active' : '' ?>">
                                                        <a href="user_add.php">
							<i class="icon-user-follow"></i>
							新用户</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'user_list' ? 'active' : '' ?>">
                                                        <a href="user_list.php">
							<i class="icon-users"></i>
							用户列表</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'invitation_code' ? 'active' : '' ?>">
                                                        <a href="invitation_code.php">
							<i class="icon-users"></i>
							新邀请码</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'invitation_list' ? 'active' : '' ?>">
                                                        <a href="invitation_list.php">
							<i class="icon-users"></i>
							邀请码列表</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'invitation_user' ? 'active' : '' ?>">
                                                        <a href="invitation_user.php">
							<i class="icon-users"></i>
							邀请码使用</a>
						</li>
					</ul>
				</li>
                                <li class="last <?= @$page_level[0] == 'auth' ? 'active open' : '' ?>">
					<a href="javascript:;">
					<i class="icon-badge"></i>
					<span class="title">权限</span>
					<span class="arrow <?= @$page_level[0] == 'auth' ? 'open' : '' ?>"></span>
					</a>
                                        <ul class="sub-menu">
                                                <li class="<?= @$page_level[1] == 'group_add' ? 'active' : '' ?>">
                                                        <a href="group_add.php">
							<i class="icon-flag"></i>
							新群组</a>
						</li>
                                                <li class="<?= @$page_level[1] == 'group_list' ? 'active' : '' ?>">
                                                        <a href="group_list.php">
							<i class="icon-calculator"></i>
							群组列表</a>
						</li>
						</li>
						   <li class="<?= @$page_level[1] == 'auth_assign' ? 'active' : '' ?>">
                                                        <a href="auth_assign.php">
							<i class="icon-directions"></i>
							权限分配</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->
        