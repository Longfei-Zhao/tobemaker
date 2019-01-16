<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-comming</title>
    <?php include "top_css.php" ?>
</head>
<body class="wide">
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle-margin">
        <div class="slogan">
            这些创意设计即将进入我们的生活，你最想买哪一个？说不定能优先量产哦！
        </div>
        <div style="margin-left: 40px;margin-bottom:10px ;">
            <a href="?sort=recommend" class="<?=($sort_rule=="recommend"? 'red':'')?>" style="margin-right: 20px;">推荐</a>
            <a href="?sort=new" class="<?=($sort_rule=="new"? 'red':'')?>" style="margin-right: 20px;">最新</a>
            <a href="?sort=hot" class="<?=($sort_rule=="hot"? 'red':'')?>">最热</a>
        </div>
        <div id="idea-list-block" class="content list">
            <div id="idea-list-content" class="slide">
                <ul>
                    <li page="0"></li>
                    <li page="1">
                        <p>加载中，请稍后</p>
                    </li>
                    <li page="2"></li>

                </ul>
            </div>

            <div class="prev" style="display: none;">
                <div><a href="javascript:0"><</a></div>
            </div>
            <div class="next" style="display: none;">
                <div><a href="javascript:0">></a></div>
            </div>

            <br class="clear"/>

        </div>
        <div id="project-pagenum" class="pagenum" data-url="<?=BASE_URL."api/project_list.php"?>">
            <a href="#">1</a>

        </div>

    </div>

</div>

<div id="footer">
    <?php include "footer.php" ?>
</div>
    
<div class="login hide" id="weixin">
    <div class="form border dark">
        <div class="weixin">
            <div id="qrcode"></div>
            <p>用微信<span>扫一扫</span>上方的二维码，
                <br/>
                即可分享给您的微信好友或朋友圈。</p>
        </div>

    </div>
</div>

<?php include "bottom_js.php" ?>
<script type="text/javascript" src="./js/qrcode.min.js"></script>

<!--换页按钮定位相关js-->
<!--需要jQuery-->
<!--监听浏览器长宽改变-->

<script type="text/javascript" charset="utf-8">
    function a(){
            $(".prev").height( $(window).height() );
            $(".prev").css("line-height" , $(window).height()+"px");
            $(".prev").css("left" , ($(window).width() - 1020)/2 - 70 +"px");
            $(".next").height( $(window).height() );
            $(".next").css("line-height" , $(window).height()+"px");
            $(".next").css("left" , ($(window).width() - 1020)/2 + 1040 +"px");
    }
    
    var qrcode = new QRCode(document.getElementById("qrcode"), {
            width : 150,
            height : 150
    });
    
    function makeCode (idea_id) {		
            
            var url = '<?=BASE_URL?>project_mobile.php?idea_id='+idea_id;

            qrcode.makeCode(url);
    }
    
    var pageSize = 6;
    var pageNow = 1;
    var maxPageNo = 1;
    
    function loadIdeaPage(current_page, move_type){
        
        var start = (current_page - 1) * pageSize;
        var length = pageSize;
        var url = $('#project-pagenum').data("url");
        $.post(url, {
		    'buy':1,
            "start":start, 
            "length":length, 
            "type":"produce", 
            "user_id":<?=(array_key_exists('user_id', $current_user) ? $current_user['user_id']: '')?>,
            "sort_rule":'<?=$sort_rule?>',
            "q":'<?=$search_word?>',}, function(data, textStatus){
            // set up content
            var $container = $("[page='"+move_type+"']");
            $container.html('');
            
            for (var i=0; data.data != undefined && i<data.data.length; i++){
                var item = data.data[i];
                
                // process date
                var startTime = new Date(item.begin_time);
                var endTime = new Date(item.end_time);
                var nowTime = new Date();
                var timePercent = parseInt(((nowTime - startTime)/(endTime - startTime))*100);
                var leftDays = Math.ceil( (endTime - nowTime)/(24*3600*1000));
                if (leftDays < 0)
                    leftDays = 0;
                if (timePercent > 100)
                    timePercent = 100;
                if (timePercent < 0)
                    timePercent = 0;
                
                $container.append('\
            <dl>\
                <dd><a href="project.php?idea_id='+ item.idea_id +'"><img src="'+(item['picture_url']==undefined?'asset/13.png':item['picture_url'])+'?imageMogr/v2/thumbnail/318x273!" class="h273" alt=""></a></dd>\
                <dt><a href="project.php?idea_id='+ item.idea_id +'">'+ item.name +'</a><span class="deadline"><i class="fa fa-clock-o"></i>剩余' + leftDays + '天</span></dt>\
                <dd><div class="bar"><div class="done" style="width: '+timePercent+'%"></div></div></dd>\
                <dd>\
                    <a href="<?=BASE_URL?>person.php?user_id='+item.user_id+'" class="avatar"><img class="circle" src="'+(item['head_pic_url']==undefined?'asset/15.png':item['head_pic_url'])+'?imageMogr/v2/thumbnail/40x40!" alt=""></a>\
                    <a href="<?=BASE_URL?>person.php?user_id='+item.user_id+'" class="author">'+ item.user_name +'</a>\
                    <span>发布</span>\
                </dd>\
                <dd>\
                    <div class="button"><a class="weixinbtn" href="javascript:0;" data-idea_id="'+item.idea_id+'">分享</a></div>\
                    <div class="button"><a href="project.php?idea_id='+ item.idea_id +'#commentForm">评论</a><span>'+ (item.sum_comment == null ? 0 : item.sum_comment) +'</span></div>\
                    <div class="button"><a class="like_btn '+ (item.likeit == 0 ? '':'red') +'" href="javascript:void 0" data-idea_id="'+ item.idea_id +'" data-url="<?=BASE_URL."api/like.php"?>" >'+(item.idea_status>=5?'超想买':'超喜欢')+'</a><span>'+ (item.sum_like == null ? 0 : item.sum_like) +'</span></div>\
                </dd>\
            </dl>');
                
            }
            
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
            
            $('#idea-list-content').on('click', '.weixinbtn', function(){
                $("#weixin").removeClass("hide");
                $("#weixin").siblings("div").addClass("blur");
                makeCode($(this).data('idea_id'));
            });
            
            // set up page nav
            var $pageNav = $('#project-pagenum');
            $pageNav.html('');
            maxPageNo = Math.ceil( parseInt(data.num_of_all) / pageSize );
            for (var i=1; i<=maxPageNo && i<=9; i++){
                var pageNavClass = "";
                if (i == current_page){
                    pageNavClass = ' class="active" ';
                }
                $pageNav.append('<a href="#" '+ pageNavClass +' >'+ i +'</a>');
            }
            if (maxPageNo > 9){
                $pageNav.append('<a>...</a>');
            }
        },"json");
    }
    
    $("#project-pagenum").on("click","a",function(){
        var current_page = parseInt( $(this).text() );
        pageNow = current_page;
        loadIdeaPage(pageNow, 1);
    });
    
    $(document).ready(function(){
        window.onresize= a;
        a();
        pageNow = 1;
        loadIdeaPage(pageNow, 1);
        
        $('#idea-list-block .next').show();
        $('#idea-list-block .prev').show();
        
        $('#idea-list-block .next').click(function(){
            if (pageNow < maxPageNo){
                pageNow++;
                loadIdeaPage(pageNow, 2);
            }
        });
        
        $('#idea-list-block .prev').click(function(){
            if (pageNow > 1){
                pageNow--;
                loadIdeaPage(pageNow, 0);
            }
        });
        
        $("#idea-list-content").on('click', ".like_btn", function(){
            var the_like_btn = $(this);
            var url = $(this).data("url");
            var idea_id = $(this).data("idea_id");
            
            var user_id = <?=$current_user['user_id']?>;
            $.post(url, {'idea_id':idea_id, 'user_id':user_id,'buy':1}, function(data,textStatus){
                var status = data['status'];
                if (status == "success"){
                    // 标记“喜欢”按钮为红色表示已经标记为喜欢
                    the_like_btn.addClass("red");
                    // 修改喜欢数量+1
                    var $likeCntNode = the_like_btn.next('span');
                    var likeCnt = $likeCntNode.text();
                    likeCnt = parseInt(likeCnt) + 1;
                    $likeCntNode.text(likeCnt);
                    
                }else if (status == "error"){
                    alert("系统错误，请联系管理员");
                }else if (status == "buy_delete"){
                   // 标记“喜欢”按钮为红色还原
                    the_like_btn.removeClass();
					the_like_btn.addClass("like_btn");
                    // 修改喜欢数量-1
                    var $likeCntNode = the_like_btn.next('span');
                    var likeCnt = $likeCntNode.text();
                    likeCnt = parseInt(likeCnt) - 1;
                    $likeCntNode.text(likeCnt);
                }
            },'json');
        });
        
        function hideAll(){
            $(".login").addClass("hide");
            $("#weixin").siblings("div").removeClass("blur");
            $("#weibo").siblings("div").removeClass("blur");
        }
        
        $(document).keydown(function(event){ 

            if (event.keyCode == 27){
                hideAll();
            }
        });
        
        $('#weixin').click(function(){
            hideAll();
        });
    });
</script>

</body>
</html>