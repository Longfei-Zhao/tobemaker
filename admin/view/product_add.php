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
<link rel="stylesheet" type="text/css" href="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>

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
                        <div class="tab-content">
							<div class="tab-pane active" id="tab_0">
								<div class="portlet box green">
									<div class="portlet-title">
										<div class="caption">
											<i class="fa fa-gift"></i>商品添加
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
													<label class="col-md-3 control-label">商品目录</label>
													<div class="col-md-4">
													
														<select class="form-control " id="category" name="category">
														<?php
														for($i=0;$i<count($categoryList);$i++)
														{
														echo '<option value="'.$categoryList[$i]["pc_id"].'">'.$categoryList[$i]["pc_name"].'</option>';
														}
														?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">商品名称</label>
													<div class="col-md-4">
														<input id="name" name="name" type="text" class="form-control" placeholder="输入商品名称">
														
														<span class="help-block">
														 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">上传图片</label>
													<div class="col-md-4">
														<!--<div class="input-group">
															<span class="input-group-addon input-circle-left">
															<i class="fa fa-envelope"></i>
															</span>-->
															<img alt="" src="" name="image" id="image" />
															<input id="fileSelect" type="file" name="file" class="form-control" data-url="http://up.qiniu.com/">
															<!--<p id="fileurl_display" name="fileurl_display"></p>-->
															<input name="token" type="hidden" value="<?=$upToken?>" />
															<input id="fileurl" type="hidden" name="img_url" value=""/>
														<!--</div>-->
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">商品链接</label>
													<div class="col-md-4">
														
															<input id="link" name="link" type="text" class="form-control" placeholder="链接地址">
															
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">商品标签</label>
													<div class="col-md-4">
														
															<input id="label" name="label" type="text" class="form-control" placeholder="不填则不显示">
														
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">原价</label>
													<div class="col-md-4">
														
															<input id="price" name="price" type="text" class="form-control" placeholder="不填则不显示">
														
													</div>
												</div>
												<div class="form-group last">
													<label class="col-md-3 control-label">现价</label>
													<div class="col-md-4">
														<input id="discount" name="discount" type="text" class="form-control" placeholder="现价">
													</div>
												</div>
												
											</div>
											<div class="form-actions">
												<div class="row">
													<div class="col-md-offset-3 col-md-9">
														<button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> 添加</button>
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
    <script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="./assets/user/pages/scripts/product_list.js"></script>

    <script src="./assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
<script src="./assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
<script>

jQuery(document).ready(function() {       
    Metronic.init(); // init metronic core components
    Layout.init(); // init current layout
    QuickSidebar.init(); // init quick sidebar
    Demo.init(); // init demo features
    TableManaged.init();
	$("#fileSelect").fileupload({
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.key == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        var url="<?=QINIU_DOWN?>"+ data.result.key;
                        console.log(url);
                        $('#image').attr('src', url);
                        $("#fileurl").val(url);
                        $('#upload-progress-label').text('');
                    }
                },
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#upload-progress-label').text(progress+'%');
                }
            });     
		
    
});
</script>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>