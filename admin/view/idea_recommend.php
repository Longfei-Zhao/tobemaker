<!DOCTYPE html>
<!-- 
Description: Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="cn">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>呆萌科技</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <?php include 'inc_global_css.php'; ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
    <!-- END PAGE LEVEL STYLES -->

    <?php include 'inc_theme_css.php'; ?>

    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
    
    <?php include "inc_header.php"; ?>
    <div class="clearfix"></div>
    
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <?php include 'leftnav.php'; ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">

                <?php include "inc_page_header.php"; ?>

                <!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					 <!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box grey-cascade">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>项目列表
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
						<div class="portlet-body">
							<form action="idea_recommend.php" method="POST">
                            <table class="table table-striped table-bordered table-hover" id="idea_list_recommend">
							<thead>
							<tr>
								<th>
									 想法id
								</th>
								<th>
									 想法名称
								</th>
								<th>
									 想法作者
								</th>
								<th>
									 简介
								</th>
								<th>
									 推荐状态
								</th>
                                <th>
									 修改排名
								</th>
							</tr>
							</thead>
							<?php
							$i=0;
							while ($i<$num) {
								?>
								<tr>
								<td>
								<?php echo $item_list[$i]['idea_id']?>
								</td>
								<td>
								<?php echo $item_list[$i]['name']?>
								</td>
								<td>
								<?php echo $item_list[$i]['user_name']?>
								</td>
								<td>
								<?php echo $item_list[$i]['brief']?>
								</td>
								<td>
								<?php echo $item_list[$i]['is_recommend']?>
								</td>
								<td>
								<input type="text" <?php echo "name=\"".$item_list[$i]['idea_id']."\" value=\"".$item_list[$i]['is_recommend']."\">";?>
								</td>
								
								</tr>
							

							<?php
							$i++;
						    }
						    ?>
							</table>
							<input type="hidden" name="change_recommend" value="1" />
							<button type="submit" class="btn btn-success">提交修改</button>
						</form>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
				</div>
			</div>

			<!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php include 'inc_footer_bar.php'; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <?php include 'inc_core_plugin.php'; ?>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="./assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="./assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
    <script type="text/javascript" src="./assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
    <script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="./assets/user/pages/scripts/idea_detail.js"></script>
    <script>
    jQuery(document).ready(function() {       
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Demo.init(); // init demo features
        FormWizard.init();
    });
    </script>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>