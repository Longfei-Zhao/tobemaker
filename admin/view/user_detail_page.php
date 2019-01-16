
        <!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
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
			用户详情
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
						<a href="#">用户详情</a>
					</li>
				</ul>
				<!--<div class="page-toolbar">
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
			</div>-->
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="portlet box blue" id="form_wizard_1">
						
						<div class="portlet-body form">
							<form action="#" class="form-horizontal" id="submit_form" method="POST">
								<div class="form-wizard">
									<div class="form-body">
										
										
										
										<div class="tab-content">
											<div class="alert alert-danger display-none">
												<button class="close" data-dismiss="alert"></button>
												You have some form errors. Please check below.
											</div>
											<div class="alert alert-success display-none">
												<button class="close" data-dismiss="alert"></button>
												Your form validation is successful!
											</div>
											<div class="tab-pane active" id="tab1">
												<h3 class="block">用户详情</h3>
												<div class="form-group">
													<label class="control-label col-md-3">用户名
													</label>
													<div class="col-md-4" class="form-control">
													<input type="hidden" value="<?=@$userInfo[0]["user_id"] ?>" name="user_id" id="user_id"/>
													  <input type="text" class="form-control" name="user_name" id="user_name" value="<?=@$userInfo[0]["user_name"]?>" <?php echo $strDisplay; ?> />
													
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">真实姓名 
													</label>
													<div class="col-md-4">
													
													
													<input type="text" class="form-control" name="real_name" id="real_name" value="<?=@$userInfo[0]["real_name"]?>" <?php echo $strDisplay; ?> />
													
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">性别 
													</label>
													<div class="col-md-4">
													<select class="form-control" name="sex" id="sex" <?php echo $strDisplay; ?>>
													<option value="男" <?php echo ($userInfo[0]["sex"]=="男"?'selected="selected"':''); ?>>男</option>
													<option value="女" <?php echo ($userInfo[0]["sex"]=="女"?'selected="selected"':''); ?>>女</option>
													<option value="保密" <?php echo ($userInfo[0]["sex"]=="保密"?'selected="selected"':''); ?>>保密</option>
													
													</select>	
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">生日 
													</label>
													<div class="col-md-4">
													
													<input type="text" class="form-control" name="birth" id="birth" value="<?=@$userInfo[0]["birth"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">头像
													</label>
													<div class="col-md-4">
													 <div class="pic"><div class="picture"><img alt="" src="<?=@$userInfo[0]["head_pic_url"]?>" id="image" name="image" /></div></div>
													<?php
													if($action=='edit')
													{
													echo '<img alt="" src="" name="image" id="image" />
															<input id="fileSelect" type="file" name="file" class="form-control input-circle" data-url="http://up.qiniu.com/">
															<!--<p id="fileurl_display" name="fileurl_display"></p>-->
															<input name="token" type="hidden" value="'.$upToken.'" />
															<input id="fileurl" type="hidden" name="img_url" value=""/>';
													}
													?>
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">邮箱 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="email" id="email" value="<?=@$userInfo[0]["user_email"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">手机号 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="user_mobile" id="user_mobile" value="<?=@$userInfo[0]["user_mobile"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">余额 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="money" id="money" value="<?=@$userInfo[0]["money"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">群组 
													</label>
													<div class="col-md-4">
													<select class="form-control" name="group" id="group" <?php echo $strDisplay; ?>>
													<?php
													for($i=0;$i<count($groupList);$i++)
													{
													if($userInfo[0]["user_group"]!=$groupList[$i]["group_id"])
													{
													echo '<option value='.$groupList[$i]["group_id"].'>'.$groupList[$i]["group_name"].'</option>';
													}
													else
													{
													echo '<option value='.$groupList[$i]["group_id"].' selected="selected">'.$groupList[$i]["group_name"].'</option>';
													}
													}
													?>
													</select>
													
													</div>
												</div>	
														
													
												
												<div class="form-group">
													<label class="control-label col-md-3">自我介绍 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="self_intro" id="self_intro" value="<?=@$userInfo[0]["self_intro"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">描述 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="description" id="description" value="<?=@$userInfo[0]["description"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">职务 
													</label>
													<div class="col-md-4">
													<input type="text" class="form-control" name="occupation" id="occupation" value="<?=@$userInfo[0]["occupation"]?>" <?php echo $strDisplay; ?> />
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">状态
													</label>
													<div class="col-md-4">
													
													<select name="activity" id="activity" class="form-control" <?php echo $strDisplay; ?>>
													<option value="正常" <?php echo($userInfo[0]["user_activity"]=='Y'?'selected="selected"':'') ?>>正常</option>
													<option value="屏蔽"  <?php echo($userInfo[0]["user_activity"]=='N'?'selected="selected"':'') ?>>屏蔽</option>
													<option value="删除">删除</option>
													</select>
														
														
													</div>
												</div>
											</div>
										</div>
		
									</div>
									<div class="form-actions">
										<div class="row">
											<div class="col-md-offset-3 col-md-9">
												
												<?php
												if($action!='view')
												{
												echo '<a href="javascript:;" class="btn green button-submit">
												<input type="submit" class="btn green button-submit" value="更新" /> 
												</a>';
												}
												?>
												
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
