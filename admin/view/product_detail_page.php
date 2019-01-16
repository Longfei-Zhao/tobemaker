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
												<h3 class="block">商品详情</h3>
												<div class="form-group">
													<label class="control-label col-md-3">商品目录 
													</label>
													<div class="col-md-4" class="form-control">
													<input type="hidden" value="<?=@$productInfo[0]["pc_id"] ?>" name="pc_id" id="pc_id"/>
													    <input type="hidden" value="<?=@$productInfo[0]["pf_id"] ?>" name="pf_id" id="pf_id"/>
														<select class="form-control" name="category" disabled="disabled" id="category">
														
														<?php
														
														for($i=0;$i<count($categoryList);$i++)
														{
														if(@$categoryList[$i]["pc_id"]!=@$productInfo[0]["pc_id"])
														{
														$cateforyid=@$categoryList[$i]["pc_id"];
														echo '<option value="'.$cateforyid.'">'.@$categoryList[$i]["pc_name"].'</option>';
														}
														
														else
														{
														    echo '<option selected="selected" value="'.@$categoryList[$i]["pc_id"].'">'.@$categoryList[$i]["pc_name"].'</option>';
														}
														}
														?>
														</select>
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">商品名称 
													</label>
													<div class="col-md-4">
													<?php
													
													echo '<input type="text" class="form-control" name="name" id="name" value="'.@$productInfo[0]["pf_name"].'" '.$strDisplay.' />';
													?>
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">图片 
													</label>
													<div class="col-md-4">
													<?php
													 echo ' <div class="pic"><div class="picture"><img alt="" src="'.@$productInfo[0]["pf_image"].'" id="image" name="image" /></div></div>';
													 if($action=='edit')
													 {
													  /*echo '<input id="fileSelect" type="file" name="file" class="form-control input-circle" data-url="<?= BASE_URL ?>api/tmpfileupload.php"><input id="fileurl" type="hidden" name="img_url" value=""/>';
													 */}
													?>
													<input id="fileSelect" type="file" name="file" class="form-control input-circle" data-url="http://up.qiniu.com/" <?php echo ($action=='edit'?'':'style="display:none"')?>>
															<!--<p id="fileurl_display" name="fileurl_display"></p>-->
															<input name="token" type="hidden" value="<?=$upToken?>" />
															<input id="fileurl" type="hidden" name="img_url" value=""/>
														
															
															
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">商品链接 
													</label>
													<div class="col-md-4">
													<?php
													echo '<input type="text" class="form-control" name="link" value="'.@$productInfo[0]["pf_link"].'" '.$strDisplay.'/>';
													?>
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">商品标签 
													</label>
													<div class="col-md-4">
													<?php
													echo '<input type="text" class="form-control" name="label"  value="'.@$productInfo[0]["pf_label"].'" '.$strDisplay.'/>';
													?>
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">原价 
													</label>
													<div class="col-md-4">
													<?php
													
													echo '<input type="text" class="form-control" name="price" value="'.(@$productInfo[0]["pf_price"]=='0.00'?'':$productInfo[0]["pf_price"]).'" '.$strDisplay.'/>';
													
												
													?>
													</div>
												</div>	
														
													
												<div class="form-group">
													<label class="control-label col-md-3">现价</label>
													<div class="col-md-4">
													<?php
													echo '<input type="text" class="form-control" name="discount" value="'.@$productInfo[0]["pf_discount"].'" '.$strDisplay.'/>';
													?>
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">推荐权重</label>
													<div class="col-md-4">
													<?php
													echo '<input type="number" class="form-control" name="sort" value="'.@$productInfo[0]["pf_sort"].'" '.$strDisplay.'/>';
													?>
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">添加日期 
													</label>
													<div class="col-md-4">
													<?php
													echo '<input type="text" class="form-control" name="addDate" value="'.@$productInfo[0]["pf_addDate"].'" disabled="disabled"/>';
													?>
														
														
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-3">状态 
													</label>
													<div class="col-md-4">
													<select class="form-control" name="status" <?php echo $strDisplay ?>>
													<?php
													$selected=($productInfo[0]["pf_status"]=='正常'?' selected="selected" ':'');
													
													echo '<option  value="正常" '.$selected.'>正常</option>';
													echo '<option value="下线" '.(empty($selected)?' selected="selected" ':'').'>下线</option>';
													?>
													<option  value="删除" >删除</option>
													
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