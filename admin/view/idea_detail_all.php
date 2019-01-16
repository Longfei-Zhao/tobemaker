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
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>css/simditor.css"/>
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
					<div class="portlet light bordered">
                       
                        <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                            <form action="idea_detail_all.php" method="post" class="form-horizontal">
                            	<div class="form-body">
                                    <!--自定义项目 开始-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">标题</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="name" name="name" value=<?php echo "\"".$idea_list[0]["name"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">标签</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" id="tags" name="tags" value=<?php echo "\"".$idea_list[0]["tags"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">图片</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <img alt="" src="<?=@$idea_list[0]["picture_url"]?>?imageMogr/v2/thumbnail/318x273!" name="image" id="image" />
															<input id="fileSelect" type="file" name="file" class="form-control input-circle" data-url="http://up.qiniu.com/">
															<!--<p id="fileurl_display" name="fileurl_display"></p>-->
															<input name="token" type="hidden" value="<?=$upToken?>" />
															<input id="fileurl" type="hidden" name="img_url" value="<?=@$idea_list[0]["picture_url"]?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">封面图片显示在正文中</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input name="cover_display" type="checkbox" value="1" <?=@$idea_list[0]['cover_display']==1?'checked="checked"':''?> >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">插入图片到正文</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                
                                                <input id="fileSelectForContent" type="file" name="file" class="form-control input-circle" data-url="http://up.qiniu.com/"><i id="upload-progress-label-for-content"></i>
                                                <input name="token" type="hidden" value="<?=$upToken?>" />
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">内容</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <textarea id="editor" name="content" placeholder="这里输入内容" autofocus><?php echo  $idea_list[0]["content"];?></textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">作者</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" disabled="disabled" class="form-control" name="user_name" value=<?php echo "\"".$idea_list[0]["user_name"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    	<label class="col-md-3 control-label">相关信息</label>
                                        <div class="col-md-4" >
                                        	<table border="1">
                                        	<tr style="color: red;width:100px">
                                        		<th>创建时间</th><th>评价数目</th><th>喜欢数目</th><th>分享数目</th>
                                        	</tr>
                                        	<tr>
                                        		<td><input type="datetime" disabled="disabled" name="create_time" value=<?php echo "\"".$idea_list[0]["create_time"]."\"/>";?></td>
                                        		<td><input type="text" disabled="disabled" name="sum_comment" value=<?php echo "\"".$idea_list[0]["sum_comment"]."\"/>";?></td>
                                        		<td>
                                        			<input type="text" disabled="disabled" name="sum_like" value="<?=@$likenum?>"/>
                                        		</td>
                                        		
                                        		<td>
                                        			<input type="text" disabled="disabled" name="sum_share" value=<?php echo "\"".$idea_list[0]["sum_share"]."\"/>";?>
                                        		</td>
                                        	</tr>
                                            </table>
                                        </div>
                                    </div>
                                   
                                    <!--
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">管理员评语</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="reason" placeholder="内容">
                                            </div>
                                        </div>
                                    </div>
                                  -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">是否首页推荐</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input id="is_recommend" type="text" class="form-control" name="is_recommend" value=<?php echo "\"".$idea_list[0]["is_recommend"]."\"/>";?>
                                            </div>

                                             说明：0表示不推荐，值越大，排名越靠前
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞开始时间</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="begin_time" name="begin_time" value=<?php echo "\"".date("Y-m-d",strtotime($idea_list[0]["begin_time"]))."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞结束时间</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="date" class="form-control" id="end_time" name="end_time" value=<?php echo "\"".date("Y-m-d",strtotime($idea_list[0]["end_time"]))."\"/>";?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞目标</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="number" class="form-control" id="target" name="target" value="<?=intval($idea_list[0]["target"])<=0 ? '100':$idea_list[0]["target"];?>" />
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <input type="hidden" id="idea_id" name="idea_id" value=<?php echo "\"".$idea_list[0]["idea_id"]."\"/>";?>
                                    <input type="hidden" name="user_id" value=<?php echo "\"".$idea_list[0]["user_id"]."\"/>";?>
                                    <!-- 自定义项目结束-->
                </div>
            </div>
			<?php
					
					?>
            <div class="form-actions">
            	<div class="row">
            		<div class="col-md-offset-3 col-md-9 waiting">
					    <input type="submit" id="edit" class="btn default" value="修改">
            			<button type="button" id="pass" class="btn green" data-url="<?=BASE_URL?>api/idea.php">批准</button>
            			<button type="button" id="refuse" class="btn red" data-url="<?=BASE_URL?>api/idea.php">拒绝</button>
            			<button type="button" id="change_product" class="btn default" data-url="<?=BASE_URL?>api/idea.php">直接待产</button>
						<button type="button" id="delete" class="btn red" data-url="<?=BASE_URL?>api/idea.php">下线</button>
            		</div>
            	</div>
				<div>
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

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="./assets/admin/pages/scripts/form-samples.js"></script>
	 <script src="./assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
     <script src="./assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
    <script type="text/javascript" src="<?=BASE_URL?>js/simditor-all.min.js"></script>
    <script>
	function showBtn(data)
	{
	    if(data==2)
		{
		    $("#pass").show();
			$("#refuse").show();
			$("#change_product").show();
			$("#delete").show();
		}
		else
		{
		if(data==3)
		{
		   $("#pass").hide();
			$("#refuse").hide();
			$("#change_product").hide();
			$("#delete").show();
		}
		else
		{
		   if(data==4)
		    {
		     $("#pass").hide();
			$("#refuse").hide();
			$("#change_product").show();
			$("#delete").show();
		    }
			else
			  {
			      if(data==5)
				  {
				       $("#pass").hide();
			           $("#refuse").hide();
			           $("#change_product").hide();
			           $("#delete").show();
				  }
				  if(data==6)
				  {
				       $("#pass").hide();
			           $("#refuse").hide();
			           $("#change_product").hide();
			           $("#delete").show();
				  }
				  if(data==7)
				  {
				       $("#pass").hide();
			           $("#refuse").hide();
			           $("#change_product").hide();
			           $("#delete").hide();
				  }
				  if(data==8)
				  {
				       $("#pass").hide();
			           $("#refuse").hide();
			           $("#change_product").hide();
			           $("#delete").show();
				  }
			  }
		}
		}
	}
    jQuery(document).ready(function() {    
       // initiate layout and plugins
       Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
       FormSamples.init();
	   $("#fileSelect").fileupload({
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.key == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        var url="<?=QINIU_DOWN?>"+ data.result.key;
                        console.log(url);
                        $('#image').attr('src', url+'?imageMogr/v2/thumbnail/318x273!');
                        $("#fileurl").val(url);
                        //$('#upload-progress-label').text('');
                    }
                },
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#upload-progress-label').text(progress+'%');
                }
            });     
            
            $('#fileSelectForContent').fileupload({
            dataType: 'json',
            done: function (e, data) {
                if (data.result.key == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    var url="<?=QINIU_DOWN?>"+ data.result.key;
                    
                    $('.simditor-body').append('<img src="'+url+'">');
                }
                $('#upload-progress-label-for-content').text('');
            },
            progress: function (e, data) {
                
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#upload-progress-label-for-content').text(progress+'%');
            },
        });
	
    });
	//注册批准事件
	$("#pass").click(function(){
	var Url=$(this).data('url');
	var idea_id=$("#idea_id").val();
	var title=$("#name").val();
	var tags=$("#tags").val();
	var content=$("#editor").val();
	var command=$("#is_recommend").val();
	var starttime=$("#begin_time").val();
	var endtime=$("#end_time").val();
	var target=$("#target").val();
	$.post(Url, $.param({'action':'idea_pass', 'ideaId':[idea_id],'title':title,'tags':tags,'content':content,'command':command,'starttime':starttime,'endtime':endtime,'target':target}), function(data, textStatus){
               if(data.status=='success'){
			     alert("操作成功！");
                window.location.href="idea_detail_all.php";
			   }else{
			   alert("操作失败"+data.status);
			   }
                   
            },'json');
	});
	//注册拒绝事件
	$("#refuse").click(function(){
	var Url=$(this).data('url');
	var idea_id=$("#idea_id").val();
	$.post(Url, $.param({'action':'idea_reject', 'ideaId':[idea_id]}), function(data, textStatus){
               if(data.status=='success'){
			     alert("操作成功！");
				 window.location.href="idea_detail_all.php";
			   }else{
			   alert("操作失败！");
			   }
                   
            },'json');
	});
	//注册待产事件
	$("#change_product").click(function(){
	var Url=$(this).data('url');
	var idea_id=$("#idea_id").val();
	$.post(Url, $.param({'action':'idea_product', 'ideaId':idea_id}), function(data, textStatus){
               if(data.status=='success'){
			     alert("操作成功！");
				 window.location.href="idea_detail_all.php";
			   }else{
			   alert("操作失败！");
			   }
                   
            },'json');
	});
	//注册下线事件事件
	$("#delete").click(function(){
	var Url=$(this).data('url');
	var idea_id=$("#idea_id").val();
	$.post(Url, $.param({'action':'idea_offline', 'ideaId':idea_id}), function(data, textStatus){
              if(data.status=='success'){
			     alert("操作成功！");
				 window.location.href="idea_detail_all.php";
			   }else{
			   alert("操作失败！");
			   }
                   
            },'json');
	});
    var editor = new Simditor({
        textarea: $('#editor'),
         toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table',  'link', 'image', 'hr', '|', 'indent', 'outdent'],
    });
    </script>
	<?php
	echo '<script>showBtn('.$idea_list[0]["idea_status"].')</script>';
	?>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>