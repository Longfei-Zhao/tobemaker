<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
							</li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
							</li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
							</li>
							<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Mode</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-small">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Style </span>
						<select class="sidebar-style-option form-control input-small">
							<option value="default" selected="selected">Default</option>
							<option value="light">Light</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			用户列表
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.php">首页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">用户</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">用户添加</a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="#">Action</a>
							</li>
							<li>
								<a href="#">Another action</a>
							</li>
							<li>
								<a href="#">Something else here</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#">Separated link</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
                        <div class="tab-content">
							<div class="tab-pane active" id="tab_0">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>用户添加
										</div>
										<div class="tools">
											<a href="javascript:;" class="collapse">
											</a>
											<a href="#portlet-config" data-toggle="modal" class="config">
											</a>
											<a href="javascript:;" class="reload">
											</a>
											<a href="javascript:;" class="remove">
											</a>
										</div>
									</div>
									<div class="portlet-body form">
										<!-- BEGIN FORM-->
										<form  class="form-horizontal"  id="form1" method="POST"> 
											<div class="form-body">
											<div class="form-group">
													<label class="col-md-3 control-label">用户名</label>
													<div class="col-md-4">
													<input id="user_name" name="user_name" type="text" class="form-control input-circle" placeholder="输入用户名">
														
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-md-3 control-label">头像</label>
													<div class="col-md-4">
														<!--<div class="input-group">
															<span class="input-group-addon input-circle-left">
															<i class="fa fa-envelope"></i>
															</span>-->
															<img alt="" src="" name="image" id="image" />
															<input id="fileSelect" type="file" name="file" class="form-control input-circle" data-url="http://up.qiniu.com/">
															<!--<p id="fileurl_display" name="fileurl_display"></p>-->
															<input name="token" type="hidden" value="<?=$upToken?>" />
															<input id="fileurl" type="hidden" name="img_url" value=""/>
														<!--</div>-->
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">密码</label>
													<div class="col-md-4">
														
															<input id="paaword" name="password" type="password" class="form-control input-circle" placeholder="输入密码">
															
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">确认密码</label>
													<div class="col-md-4">
														
															<input id="confirmpaaword" name="confirmpassword" type="password" class="form-control input-circle" placeholder="输入确认密码">
															
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">真实姓名</label>
													<div class="col-md-4">
														<input id="real_name" name="real_name" type="text" class="form-control input-circle" placeholder="输入姓名">
														
														<span class="help-block">
														 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">性别</label>
													<div class="col-md-4">
														<select class="form-control input-circle" name="sex" id="sex">
														<option value="男">男</option>
														<option value="女">女</option>
														<option value="保密">保密</option>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">出生日期</label>
													<div class="col-md-4">
														<input id="birth" name="birth" type="text" class="form-control input-circle" placeholder="">
														
														<span class="help-block">
														 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">邮箱</label>
													<div class="col-md-4">
														
															<input id="email" name="email" type="text" class="form-control input-circle" placeholder="输入邮箱">
														
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">手机号</label>
													<div class="col-md-4">
														
															<input id="mobile" name="mobile" type="number" class="form-control input-circle" placeholder="输入手机号">
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">群组 
													</label>
													<div class="col-md-4">
													<select class="form-control input-circle" name="group" id="group" >
													<?php
													for($i=0;$i<count($groupList);$i++)
													{
													
													echo '<option value='.$groupList[$i]["group_id"].'>'.$groupList[$i]["group_name"].'</option>';
													}
													?>
													</select>
													
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">职务</label>
													<div class="col-md-4">
														<input id="occupation" name="occupation" type="text" class="form-control  input-circle" placeholder="用户组">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">金额</label>
													<div class="col-md-4">
														<input id="money" name="money" type="number" class="form-control  input-circle" placeholder="金额">
													</div>
												</div>
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn btn-circle blue">添加</button>
														
													</div>
												</div>
											</div>
										</form>
										<!-- END FORM-->
									</div>
								</div>
							</div>
						</div>

<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->