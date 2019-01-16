<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-mine</title>
    <?php include "top_css.php" ?>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="mine">
		<input type="hidden" id="userid" value="<?=@$userid?>"/>
            <img id="userHead" src="<?=@$userInfo[0]["head_pic_url"]?>" alt="">
                <a href="#" id="btn-upload" style="display: none;" data-url="<?=BASE_URL?>api/user.php" title="上传图片">
                    <input id="fileSelect" type="file" name="file" data-url="<?= BASE_URL ?>api/tmpfileupload.php" /><i class="fa fa-chevron-circle-up"></i>
                </a>
            <br>
			<div>
			<a id="myattention-btn">我的关注</a>
			<a id="attentionme-btn"> 关注我的</a>
			</div>
            <!--<h2 id="userName">水泡长在驴身上</h2>
            <br/>
            <span id="userTitle">工业设计师</span>
            <br/>
            <p id="userIntroduction">从来不在意朋友不帅 因为都没我帅</p>
            <br/>
            <a id="btn-follow"><i class="fa fa-plus"></i></a>
            <a id="btn-msg"><i class="fa fa-envelope-o"></i></a>
            <a href="javascript:0" id="btn-modify"><i class="fa fa-pencil"></i></a>
            <a href="javascript:0" id="btn-comfirm" style="display: none;" data-url="<?=BASE_URL?>api/user.php" ><i class="fa fa-check blue"></i></a>
            <a href="javascript:0" id="btn-cancle" style="display: none;" ><i class="fa fa-times red"></i></a>-->

        </div>

    </div>
    <div id="tableattention" class="middle-margin" data-url="<?=BASE_URL?>api/attention.php" id="data_userinfo">
        <div class="minepro list" id="mylist">
            <div class="minepro list" id="myattentionList">
			</div>
            <div class="prev mypre" id="minelistprev">
                <div><a href="#"><</a></div>
				<input type="hidden" id="myprevstart" value="1"/>
            </div>
            <div class="next mynex" id="minelistnext">
                <div><a href="#">></a></div>
				<input type="hidden" id="mynextstart" value="1"/>
            </div>

            <br class="clear"/>
        </div>
        <div class="minepro list" style="display:none" id="melist" >
		<div class="minepro list" id="attentionmeList">
		</div>
		 <div class="prev mepre" id="minelistprev">
                <div><a href="#"><</a></div>
				<input type="hidden" id="meprevstart" value="1"/>
            </div>
            <div class="next menex" id="minelistnext">
                <div><a href="#">></a></div>
				<input type="hidden" id="menextstart" value="1"/>
            </div>
		</div>
    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>

<?php include "bottom_js.php" ?>
<?=@$page_level_plugins?>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<?=@$page_level_script?>
<!-- END JAVASCRIPTS -->
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
    <script>
        function bottomBtnToggle(){
            
            $("#btn-follow").toggle();
            $("#btn-msg").toggle();
            $("#btn-modify").toggle();
            
            $("#btn-comfirm").toggle();
            $("#btn-cancle").toggle();
            
            $("#btn-upload").toggle();
        };
        
        function rollBack(){
            var head_url = $('#userHead').data('ori');
            var user_name = $('#userName input[name=user_name]').data('ori');
            var user_occupation = $('#userTitle input[name=user_occupation]').data('ori');
            var user_introduction = $('#userIntroduction input[name=user_introduction]').data('ori');

            $('#userHead').attr('src', head_url);
            $('#userName').html(user_name);
            $('#userTitle').html(user_occupation);
            $('#userIntroduction').html(user_introduction);
        }
        
        $(document).ready(function(){
            
            $("#btn-comfirm").hide();
            $("#btn-modify").show();
            
            $("#btn-modify").click(function(){
                var headUrl = $('#userHead').attr('src');
                $('#userHead').data('ori', headUrl);
                
                var data = $('#userName').text();
                $('#userName').html('<input type="text" name="user_name" value="'+data+'" data-ori="'+data+'" />');
                
                data = $('#userTitle').text();
                $('#userTitle').html('<input type="text" name="user_occupation" value="'+data+'" data-ori="'+data+'" />');
                
                data = $('#userIntroduction').text();
                $('#userIntroduction').html('<input type="text" name="user_introduction" value="'+data+'" data-ori="'+data+'" />');
                
                bottomBtnToggle();
                
            });
            
            $("#btn-comfirm").click(function(){
                var url = $(this).data('url');
                
                var head_url = $('#userHead').data('ori');
                var user_name = $('#userName input[name=user_name]').val();
                var user_occupation = $('#userTitle input[name=user_occupation]').val();
                var user_introduction = $('#userIntroduction input[name=user_introduction]').val();
                
                $.post(url, {
                    'user_id':1,
                    'head_url':head_url,
                    'user_name':user_name,
                    'user_occupation':user_occupation,
                    'user_introduction':user_introduction
                    }, function(data, textStatus){
                    if (data.status == "success"){
                        $('#userName').html(user_name);
                        $('#userTitle').html(user_occupation);
                        $('#userIntroduction').html(user_introduction);

                    }else{
                        rollBack();
                        alert("个人信息修改失败");
                        
                    }
                },'json');
                
                bottomBtnToggle();
                
            });
            
            $("#btn-cancle").click(function(){
                
                rollBack();
                
                bottomBtnToggle();
                
            });
            
            $('#fileSelect').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.url == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        $("#userHead").attr('src', data.result.url);
//                        $("#fileurl").val(data.result.url);
                    }
                },
                progress: function (e, data) {

                },
            });
            
        });
    </script>

</body>
</html>
