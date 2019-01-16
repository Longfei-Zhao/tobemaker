<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta property="wb:webmaster" content="7eb59a96dc1771ba" />
    <title>tobeMaker</title>
    <link rel="stylesheet" type="text/css" href="css/style-index.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.fullPage.css">
    <link rel="stylesheet" href="./fonts/Font-Awesome/css/font-awesome.min.css">
</head>
<body class="index">
<div id="index">
    <div class="main">
    	<img src="asset/index-logo.png" alt="" class="index-logo">
        <img src="asset/index.png" alt="" class="index-img">
        <div id="fullpage" class="front">
            <div class="section" id="section1">
                <div class="loginbtn">
                    <a href="#" id="login">登陆</a>
                    <a href="#" id="register">注册</a>
                    <a href="#" id="godown"><i class="fa fa-angle-down fa-3x first" style="color: rgb(251,251,251);"></i></a>
                </div>
            </div>
            <div id="flowSection" class="section" style="display: none;">
                <div class="flow">
                    <label >众造模式</label>
                    <ul id="stage_list">
                        <li data-stage="share">
                            <img src="asset/index_1.png" alt="">
                            <span>· · ·</span>
                            <p>分享创意</p>
                        </li>
                        <li data-stage="like">
                            <img src="asset/index_2.png" alt="">
                            <span>· · ·</span>
                            <p>点赞</p>
                        </li>
                        <li data-stage="exame">
                            <img src="asset/index_3.png" alt="">
                            <span>· · ·</span>
                            <p>审核</p>
                        </li>
                        <li data-stage="deep">
                            <img src="asset/index_4.png" alt="">
                            <span>· · ·</span>
                            <p>深化</p>
                        </li>
                        <li data-stage="produce">
                            <img src="asset/index_5.png" alt="">
                            <span>· · ·</span>
                            <p>生产销售</p>
                        </li>
                        <li data-stage="money">
                            <img src="asset/index_6.png" alt="">
                            <p>分红</p>
                        </li>
                        <br class="clear"/>
                    </ul>
                    <div id="tobe_stage_msg">
                        <p id="tobe_stage_basic">在这里，自由分享你创意与设计，说不定她会让大家的生活更便利。</p>
                        <p id="tobe_stage_share">生活里总有东西让你看着不爽？用着不爽？别抱怨了，跟我们说说你的创意与设计，一起改变吧！</p>
                        <p id="tobe_stage_like">你真的灰常喜欢这个创意 or 设计吗？那就负责的点击“超喜欢”告诉我们吧！说不定她将被量产进入你我的生活。</p>
                        <p id="tobe_stage_exame">从设计、生产、市场等角度，对大家支持的创意与设计进行最后的筛选、评审，保证其产品化的顺利进行。</p>
                        <p id="tobe_stage_deep">在产品量产前，我们将和普通用户、创意 or 设计提出者进行深度的沟通和交流，完善产品细节，力保用户体验。</p>
                        <p id="tobe_stage_produce">我们帮助成熟的创意和设计产品化，量产，销售。在tobeMaker的电商平台你可以买到所有你支持、喜爱的产品。</p>
                        <p id="tobe_stage_money">作为作品的创意 or 设计提出者，你将获得该产品销售后所得净利润30%的分红，鼓励更多分享。</p>
                    <div>
                    <a href="#" id="goup"><i class="fa fa-angle-up fa-2x" style="color: rgb(251,251,251);"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="login_form" class="login hide">
    <div class="form">
        <img src="asset/29.png" alt="">
        <form id="loginForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?>">
            <input type="text" name="username" placeholder="tobeMaker邮箱" />
            <input type="password" name="password" placeholder="密码"></input>
            
            <input type="button" value="登录">
            <div>
                <a href="#" id="forget">忘记密码>></a>
                <span>还没有账号？</span>
                <a href="#" id='reg_btn'>立即注册></a>
            </div>
        </form>
    </div>
</div>
<div id="register_form" class="login hide">
    <div class="form">
        <img src="asset/29.png" alt="">
        <form id="regForm" action="" method="post" data-url="<?=BASE_URL."api/user_login.php"?> ">
            <input type="text" name="username" placeholder="tobeMaker邮箱"/>
            <input id="regPassword" type="password" name="password" placeholder="密码"/>
            <i id="watchRegPassword" class="fa fa-eye fa-2x" style="position: absolute;top: 248px;left: 387px;"></i>
            <!--<input type="password" name="passwordAgain" placeholder="确认密码">-->
            <input type="text" name="inviteCode" placeholder="邀请码" />
            <input type="checkbox" name="readMsg" /><span>我已经认真阅读并同意<a href="login_agreement.html">《使用协议》</a></span>
            <input type="button" value="注册">
        </form>
    </div>
    <p>关注微信公众号：sidarsm，回复邮箱，获取邀请码</p>
</div>

<div id="forget_form" class="login hide">
    <div class="form">
        <img src="asset/29.png" alt="">
        <form id="forgetPassForm" action="" method="post" data-url="<?=BASE_URL."api/find_password.php"?>" >
            <input type="text" name="username" placeholder="tobeMaker邮箱" id="forget_email">
            <input type="button" value="发送">
            <div>
                <a href="#" id="login2">又想起来了>></a>
            </div>
        </form>
    </div>
</div>
    
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/jquery.fullPage.min.js"></script>
<script src="js/placeholder.js"></script>
<script>
    $(function(){
        $('#fullpage').fullpage();
        if(navigator.userAgent.indexOf("MSIE 8.0")>0||navigator.userAgent.indexOf("MSIE 9.0")>0){
            placeholderGray();
        }
    });
    $("#godown").click(function(){
        $("#fullpage").fullpage.moveSectionDown();
    });
    $("#goup").click(function(){
        $("#fullpage").fullpage.moveSectionUp();
    });
    $("#login").click(function(){
        $('#flowSection').hide();
        $(".login").addClass("hide");
        $("#login_form").removeClass("hide");
        blur();
    });
    $("#login2").click(function(){
        $('#flowSection').hide();
        $(".login").addClass("hide");
        $("#login_form").removeClass("hide");
        blur();
    });
    $("#register,#reg_btn").click(function(){
        $('#flowSection').hide();
        $(".login").addClass("hide");
        $("#register_form").removeClass("hide");
        blur();
    });
    $("#forget").click(function(){
        $('#flowSection').hide();
        $(".login").addClass("hide");
        $("#forget_form").removeClass("hide");
        blur();
    });
	
    function blur(){
        if(navigator.userAgent.indexOf("Firefox") != -1){
            $("#index").addClass("blur");
        }
        else{
            $(".background").addClass("blur");
            $(".section").addClass("blur");
        }
    }
    
    function hideAll(){
        $('#flowSection').show();
        $(".login").addClass("hide");
        $("#index").removeClass("blur");
        $(".background").removeClass("blur");
        $(".section").removeClass("blur");
    }
    $(document).keydown(function(event){ 
        
        if (event.keyCode == 27){
            hideAll();
        }
    });
    $("input[type=text], input[type=password]").keydown(function(event){
        if (event.keyCode == 13){
            $(this).siblings('input[type=button]').trigger("click");
        }
    });
        
    $(document).ready(function(){
        
        $('#watchRegPassword').hover(function(){
            $('#regPassword').attr('type','text');
        },function(){
            $('#regPassword').attr('type','password');
        });
        
        $('#loginForm input[type=button]').click(function(){
            var url = $('#loginForm').data('url');
            var user_email = $('#loginForm input[name=username]').val();
            var password = $('#loginForm input[name=password]').val();
            $.post(url, {
                'action':'login', 
                'user_email':user_email, 
                'password':password
                }, function(data, textStatus){
                if (data['status'] != 'success'){
                    alert(data['status']);
                }else{
                    location.href = 'project_list.php';
                }
            }, 'json');
        });
        $('#regForm input[type=button]').click(function(){
            var url = $('#regForm').data('url');
            var user_email = $('#regForm input[name=username]').val();
            var password = $('#regForm input[name=password]').val();
//            var passwordAgain = $('#regForm input[name=passwordAgain]').val();
            var inviteCode = $('#regForm input[name=inviteCode]').val();
//            if (password != passwordAgain){
//                alert('两次输入的密码不一致');
//                return;
//            }

            var isRead = $('#regForm input[type=checkbox]').is(":checked");//attr("checked");
            if (isRead != true){
                alert("阅读并同意《使用手册》后方可注册");
                return;
            }
            $.post(url, {
                'action':'register', 
                'user_email':user_email, 
                'password':password,
                'invite_code':inviteCode,
                }, function(data, textStatus){
                if (data['status'] != 'success'){
                    alert(data['status']);
                }else{
                    location.href = 'person.php?edit';
                }
            }, 'json');
        });
        $('#forgetPassForm input[type=button]').click(function(){
            var url = $('#forgetPassForm').data('url');
            var user_email = $('#forgetPassForm input[name=username]').val();
            
            $.post(url, {
                'action':'findpass', 
                'user_email':user_email, 
                }, function(data, textStatus){
                if (data['status'] == 'success'){
                    hideAll();
                    alert("密码已发送到指定邮箱，请查收");
                }else{
                    alert(data['status']);
                }
            }, 'json');
        });
        
        $(".close").click(function(){
           hideAll();
        });
        $("#tobe_stage_msg p").hide();
        $("#tobe_stage_basic").show();
        
        $("#stage_list").on("mouseover", "li", function(){
            var stage_name = $(this).data('stage');
            $("#tobe_stage_msg p").hide();
        
            $("#tobe_stage_"+stage_name).show();
            
        });
        
        $('#login_form, #register_form, #forget_form').click(function(){
            hideAll();
        });
        
        $(".form").click(function(event){
            event.stopPropagation();
        });
        
        $('#flowSection').show();
    });

</script>

</body>
</html>