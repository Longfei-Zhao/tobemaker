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
        <div id="my_info_view" class="mine">
            <img class="head circle" src="<?=($user_info['head_pic_url']==""?'asset/12.png':$user_info['head_pic_url'])?>" alt=""/>
            <br/>
            <h2 class="user_name"><?=$user_info['user_name']?></h2>
            <br/>
            <span class="occupation"><?=$user_info['occupation']==''?'还没有输入您的职位':$user_info['occupation']?></span>
            <br/>
            <p class="self_intro"><?=$user_info['self_intro']==''?'还没有输入您的个人介绍，点击下方的“笔”来添加':$user_info['self_intro']?></p>
            <br/>
            <a id="btn-cancel" class="delete" data-url="<?=BASE_URL?>api/attention.php" style="display:none">取消关注</a>
            <a id="btn-follow" class="add" data-url="<?=BASE_URL?>api/attention.php"><i class="fa fa-plus" ></i></a>
            <a id="btn-msg" href="<?=BASE_URL?>msg_send_2.php?to_user=<?=@$user_info['user_id']?>"><i class="fa fa-envelope-o ired"></i></a>
            
            <a href="javascript:0;" id="btn-modify"><i class="fa fa-pencil ired"></i></a>
            <a href="javascript:0;" id="btn-modify-password"><i class="fa fa-unlock-alt ired"></i></a>
        </div>
        
        <div id="my_info_edit" class="mine edit hide">
            <div class="avatarupload">
                <img src="<?=($user_info['head_pic_url']==""?'asset/12.png':$user_info['head_pic_url'])?>" alt="" class="head circle blur">
                <div></div>
                <form>
                    <input id="fileSelect" type="file" name="file" data-url="http://up.qiniu.com/" />
                    <input id="head_pic_url" type="hidden" name="img_url" value="<?=$user_info['head_pic_url']?>"/>
                    <input name="token" type="hidden" value="<?=$upToken?>" />
                </form>
            </div>
            <label id="upload-progress-label"></label>
            <br/>
            <input class="user_name" type="text" value="<?=$user_info['user_name']?>" placeholder="输入用户名"/>
            <input class="occupation" type="text" value="<?=$user_info['occupation']?>" id="job" placeholder="输入职位" />
            <input class="self_intro" type="text" value="<?=$user_info['self_intro']?>" placeholder="输入个人介绍" />
                <a href="javascript:void 0;" id="btn_user_cancle" ><i class="fa fa-times ired"></i></a>
            <a href="javascript:void 0;" id="btn_user_submit" data-url="<?=BASE_URL?>api/userinfo_change.php"><i class="fa fa-check ired"></i></a>

        </div>
        
        <input type="hidden" id="user_id" name="user_id" value=<?php 
            echo $user_info['user_id']." />";
            ?>
        <input type="hidden" id="session_userid" name="session_userid" value="<?=@$_SESSION["user_id"]?>" />
    </div>
    <div class="middle-margin">
        <div id="myProjectBlock" class="minepro list" data-url="<?=BASE_URL.'api/user_project.php'?>">
            <div id="myProjectList" class="slide slide--h220">
                <ul>
                    <li page="0"></li>
                    <li page="1">
                        <p>加载中，请稍后</p>
                    </li>
                    <li page="2"></li>
                </ul>
            </div>

            <div class="prev" id="minelistprev">
                <div><a href="javascript:0"><</a></div>
            </div>
            <div class="next" id="minelistnext">
                <div><a href="javascript:0">></a></div>
            </div>

            <br class="clear"/>
        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>
    

<div class="login hide" id="pwdchange">
    <div class="form border dark">
        <h1 style="text-align:center;">密码更改</h1>
        <form id="changepwdForm" action="" >
            <input type="password" name="password_ori" placeholder="当前密码">
            <input type="password" name="new_pass" placeholder="新密码">
            <input type="password" name="new_pass_again" placeholder="确认新密码">
            <input type="button" data-url="<?=BASE_URL?>api/find_password.php" value="确认">
        </form>
    </div>
</div>

<?php include "bottom_js.php" ?>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
	
    <script>
        var pageSize = 4;
        var pageNow = 1;
        var maxPageNo = 1;
        
        function loadPersonalProject(current_page, move_type){
            
            var start = (current_page - 1) * pageSize;
            var length = pageSize;
            var url = $('#myProjectBlock').data("url");
            $.post(url, {
                "start":start, 
                "length":length, 
                "type":"all", 
                "user_id":<?=(array_key_exists('user_id', $current_user) ? $current_user['user_id']: '')?>,
                }, function(data, textStatus){
                // set up content
                var $container = $("[page='"+move_type+"']");
                $container.html('');
                
                maxPageNo = Math.ceil( parseInt(data.num_of_all) / pageSize );
                for (var i=0; data.data != undefined && i<data.data.length; i++){
                    var item = data.data[i];
                    var str='';
					if(item['idea_status']<5)
					{
					  str='\
                    <dl>\
                        <dd>\
                            <img src="'+(item['picture_url']==undefined?'asset/13.png':item['picture_url'])+'?imageMogr/v2/thumbnail/233x200!"  class="h200" >\
                            <div class="person-img-shield">\
                                <p class="state">'+ item.status_name +'</p>\
                                <a href="project.php?idea_id='+ item.idea_id +'"><p class="title">'+item.name+'</p></a>\
                                <p class="justify">\
                                    <a href="project.php?idea_id='+ item.idea_id +'">\
                                        <i class="fa fa-info"></i>\
                                    </a>\
                                    <a href="changeshare.php?idea_id='+ item.idea_id +'">\
                                        <i class="fa fa-pencil-square-o"></i>\
                                    </a>\
                                    <a href="javascript:0;" class="idea_delete" data-url="<?=BASE_URL?>api/share.php" data-id="'+item.idea_id+'" data-status="'+item['idea_status']+'">\
                                        <i class="fa fa-trash-o"></i>\
                                    </a>\
                                </p>\
                            </div>\
                        </dd>\
                    </dl>\
                    ';
					}
					else
					{
					    str='\
                    <dl>\
                        <dd>\
                            <img src="'+(item['picture_url']==undefined?'asset/13.png':item['picture_url'])+'?imageMogr/v2/thumbnail/233x200!"  class="h200" >\
                            <div class="person-img-shield">\
                                <p class="state">'+ item.status_name +'</p>\
                                <a href="project.php?idea_id='+ item.idea_id +'"><p class="title">'+item.name+'</p></a>\
                                <p class="justify">\
                                    <a href="project.php?idea_id='+ item.idea_id +'">\
                                        <i class="fa fa-info"></i>\
                                    </a>\
                                </p>\
                            </div>\
                        </dd>\
                    </dl>\
                    ';
					}
                    $container.append(str);
                }
                $('.person-img-shield').hide();

                if (move_type == 0){
                    // move right
                    $(".slide ul").animate({left:0},1000,
                    function(){
                        $("[page='1']").remove();
                        $("[page='0']").attr("page",1);
                        $(".slide ul li:first-child").before("<li page='0'></li>");
                        $(".slide ul").attr("style","left:-1020px");
                    });
                }else if(move_type == 2){
                    // move left
                    $(".slide ul").animate({left:"-2040px"},1000,
                    function(){
                        $("[page='1']").remove();//在这拉取数据填充进li里
                        $("[page='2']").attr("page",1);
                        $(".slide ul").append("<li page='2'></li>");
                        $(".slide ul").attr("style","left:-1020px");
                        flag = 0;
                    });
                }
            },"json");
        }
        
        function rollBack(){
            
            $('#my_info_edit .head').attr('src', $('#my_info_view .head').attr('src'));
            $('#my_info_edit .user_name').val( $('#my_info_view .user_name').text());
            $('#my_info_edit .occupation').val( $('#my_info_view .occupation').text());
            $('#my_info_edit .self_intro').val( $('#my_info_view .self_intro').text());
            $('#head_pic_url').val($('#my_info_view .head').attr('src'));
            
        }
        
        $(document).ready(function(){
            
            var editMode = <?=(array_key_exists('edit', $_GET)?'true':'false')?>;
            
            if (editMode == true){
                $('#my_info_view').addClass('hide');
                $('#my_info_edit').removeClass('hide');
            }
            
            $("#btn-modify").click(function(){
                // 进入编辑模式
                $('#my_info_view').addClass('hide');
                $('#my_info_edit').removeClass('hide');
            });
            
            $("#btn-modify-password").click(function(){
                // 修改密码
                $('#pwdchange').removeClass('hide');
                $("#pwdchange").siblings("div").addClass("blur");
                
                $('#changepwdForm input[name=password_ori]').val('');
                $('#changepwdForm input[name=new_pass]').val('');
                $('#changepwdForm input[name=new_pass_again]').val('');
            });
            
            function hideAll(){
                $("#pwdchange").addClass("hide");
                $("#pwdchange").siblings("div").removeClass("blur");
            }
            $(document).keydown(function(event){ 

                if (event.keyCode == 27){
                    hideAll();
                }
            });
            //项目删除事件
			
            $("#myProjectList").on('click', '.idea_delete',function(){
                        var $delete_btn = $(this);
                        var url=$(this).data('url');
                        var idea_id=$(this).data('id');
                            var status=$(this).data('status');
                            if(status>=5)
                            {
                               alert('此状态项目无法删除！');
                            }
                            else
                            {
                               $.post(url, {
                'action':'delete',
                'id':idea_id,
            }, function(data, textStatus){
                if (data['status'] == 'success'){
                    alert("删除成功");
                    var $dl = $delete_btn.parents('dl');
                                            $dl.remove();
                }else{
                    alert(data['status']);
                }
            },'json');
                            }
                    });
            $('#pwdchange').click(function(){
                hideAll();
            });
            
            $('#pwdchange .form').click(function(event){
                event.stopPropagation();
            });
            
            $('#changepwdForm input[type=button]').click(function(){
                var url = $(this).data('url');
                
                var oldPass = $('#changepwdForm input[name=password_ori]').val();
                var newPass = $('#changepwdForm input[name=new_pass]').val();
                var newPass_again = $('#changepwdForm input[name=new_pass_again]').val();
                
                if (newPass != newPass_again){
                    alert('两次密码密码不一致');
                    return;
                }
                
                var user_email = '<?=$user_info['user_email']?>';
                
                $.post(url, {
                    'action':'resetpass',
                    'user_email':user_email,
                    'old_password':oldPass,
                    'new_password':newPass,
                }, function(data, textStatus){
                    if (data['status'] == 'success'){
                        alert("修改密码成功");
                        hideAll();
                    }else{
                        alert(data['status']);
                    }
                },'json');
            });
        
            //注册关注事件
            $("#btn-follow").click(function(){
			var attention_userid = $('#user_id').val();
			var userid=$("#session_userid").val();
			var url=$(this).data('url');
			$.post(url, {
			        'action':'add',
                    'userid':userid,
                    'attention_userid':attention_userid
                    
                    }, function(data, textStatus){
                    if (data.status == "success"){
					var $control=$("#btn-follow");
                        $control.hide();
                      $("#btn-cancel").show();
                        alert('关注成功！');
                    }else{
                        //rollBack();
                        alert("关注失败");
                        
                    }
                },'json');
            });
            //注册取消关注事件
             $("#btn-cancel").click(function(){
                    var attention_userid = $('#user_id').val();
                    var userid=$("#session_userid").val();
                    var url=$(this).data('url');
                    $.post(url, {
                            'action':'delete',
                'userid':userid,
                'attention_userid':attention_userid

                }, function(data, textStatus){
                    if (data.status == "success"){
                                        var $control=$("#btn-cancel");
                        $control.hide();
                        $("#btn-follow").show();
                        alert("取消成功")
                    }else{
                        //rollBack();
                        alert("取消关注失败");

                    }
                },'json');
            });
            
            // 个人信息修改提交
            $("#btn_user_submit").click(function(){
                
                var url = $(this).data('url');
                
                var head_url = $('#head_pic_url').val();
                var user_name = $('#my_info_edit .user_name').val();
                var user_occupation = $('#my_info_edit .occupation').val();
                var user_introduction = $('#my_info_edit .self_intro').val();
                
                var user_id = <?=$user_info['user_id']?>;
                
                $('#my_info_view').removeClass('hide');
                $('#my_info_edit').addClass('hide');
                
                $.post(url, {
                    'user_id':user_id,
                    'head_url':head_url,
                    'user_name':user_name,
                    'user_occupation':user_occupation,
                    'user_introduction':user_introduction
                    }, function(data, textStatus){
                    if (data.status == "success"){
                        
                        $('#my_info_view .head').attr('src', head_url );
                        $('#my_info_view .user_name').text( user_name );
                        $('#my_info_view .occupation').text( user_occupation );
                        $('#my_info_view .self_intro').text( user_introduction );

                    }else{
                        
                        rollBack();
                        alert("个人信息修改失败！"+data.status);
                        
                    }
                },'json');
                
            });
            
            $("#btn_user_cancle").click(function(){
                
                $('#my_info_view').removeClass('hide');
                $('#my_info_edit').addClass('hide');
                
                rollBack();
            });
            
            $('#fileSelect').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    if (data.result.key == null){
                        alert("错误：" + data.result.err_msg);
                    }else{
                        var url="<?=QINIU_DOWN?>"+ data.result.key;
//                        console.log(url);
                        $('#my_info_edit .head').attr('src', url);
                        $("#head_pic_url").val(url);
                        $('#upload-progress-label').text('');
                    }
                },
                progress: function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $('#upload-progress-label').text(progress+'%');
                },
            });
            
            $('.person-img-shield').hide();
            
            $('#myProjectList').on('mouseenter' ,'img', function(){
                $(this).next().show();
                $(this).addClass('person-img__blur');
            });
            $('#myProjectList').on('mouseout' ,'.person-img-shield', function(){
                $(this).hide();
                $(this).prev().removeClass('person-img__blur');
            });
            
            $('#myProjectBlock .next').click(function(){
                if (pageNow < maxPageNo){
                    pageNow++;
                    loadPersonalProject(pageNow, 2);
                }
            });

            $('#myProjectBlock .prev').click(function(){
                if (pageNow > 1){
                    pageNow--;
                    loadPersonalProject(pageNow, 0);
                }
            });
            loadPersonalProject(1,1);
            
        });
    </script>
<?php
	//控制页面显示信息
	if(!array_key_exists('user_id',$_SESSION))
	{
	     echo '<script>$("#btn-follow").remove();$("#btn-msg").remove();</script>';
	}
if(!array_key_exists('user_id', $_GET)){

echo '<script>$("#btn-follow").remove();</script>';

}
elseif($_GET["user_id"]!=$_SESSION["user_id"])
{
   echo '<script>$("#btn-modify").remove();$("#btn-modify-password").remove();</script>';
   //获取用户是否被关注
$attention=new class_attention();
if($attention->checkunique($_SESSION["user_id"],$_GET["user_id"]))
{
//echo '<script>$("#btn-follow").empty();$("#btn-folloy").removeClass();$("#btn-follow").addClass("delete");$("#btn-follow").append("取消关注")</script>';
echo '<script>$("#btn-follow").hide(); $("#btn-cancel").show();</script>';
    //将关注符号改为取消关注
}
}


	?>
</body>
</html>
