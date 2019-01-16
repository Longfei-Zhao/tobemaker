<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:wb="http://open.weibo.com/wb" >
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
        <title>tobeMaker-item</title>
        <?php include "top_css.php" ?>
        <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
    </head>
    <body>
        <div id="top">
            <?php include "header.php" ?>
        </div>
        <div id="center">
            <div class="middle">
                <div class="item">
                    <div class="ttl">
                        <div class="title"><?php echo $item[0]['name']; ?></div>
                        <div class="author">
                            <a href="<?= BASE_URL . 'person.php' ?>?user_id=<?= @$item[0]["user_id"] ?>"><img class="circle" src="<?php echo @$item[0]['head_pic_url'] == '' ? 'asset/12.png' : $item[0]['head_pic_url']; ?>?imageMogr/v2/thumbnail/60x60!" alt=""></a>
                            <br />
                            <input type="hidden" id="author_id" value="<?= @$item[0]["user_id"] ?>">
                                <input type="hidden" id="user_id" value="<?= @$user_id ?>">
                                    <a href="<?= BASE_URL . 'person.php' ?>?user_id=<?= @$item[0]["user_id"] ?>"><?php echo $item[0]['user_name']; ?></a>
                                    </div>
                                    <div class="subtitle"><?php
                                        //echo $item[0]['tags'];
                                        $tag_array = split(' ', $item[0]['tags']);
                                        foreach ($tag_array as $tag_item) {
                                            echo '<span class="tag">' . $tag_item . '</span>';
                                        }
                                        ?></div>
                                    <div class="emailme">
                                        <a href="javascript:void 0" id="addAttention" data-url="<?= BASE_URL ?>api/attention.php"><i class="fa fa-plus ired"></i></a>
                                        <a href="javascript:void 0" id="deleteAttention" data-url="<?= BASE_URL ?>api/attention.php" style="display:none">取消关注</a>
                                        <a href="<?= BASE_URL ?>msg_send_2.php?to_user=<?= @$item[0]["user_id"] ?>"><i class="fa fa-envelope-o ired"></i></a>
                                    </div>
                                    <br class="clear"/>
                                    </div>
                                    <div class="simditor" style="border: none;">
                                        <div class="atc simditor-body">

                                            <?php
                                            if (isset($item[0]['cover_display']) && intval($item[0]['cover_display']) == 1) {
                                                ?>
                                                <img src=<?php echo "\"" . $item[0]['picture_url'] . "\"" ?> alt="图挂了">
                                                    <?php
                                                }
                                                ?>

                                                <p><?php echo $item[0]['content']; ?></p>

                                        </div>
                                    </div>

                                    <?php if ($preview_status == false) { ?>

                                        <div class="commentbox">
                                            <form id="commentForm" action="<?= BASE_URL ?>project.php?idea_id=<?= $idea_id ?>" method="POST" >
                                                <label>评论</label>
                                                <textarea id="saytext" name="saytext"></textarea>
                                                <a href="javascript:void 0" class="emotion">添加表情</a>
                                                <input type="checkbox"><span>同时推荐该想法</span>
                                                    <input type="hidden" name="idea_id" value="<?= $idea_id ?>"/>
                                                    <input class="sub_btn" type="submit" value="评论">
                                                        <p>个字符</p>
                                                        <em id="commentWordLeft">2000</em>
                                                        <p>还可以输入</p>
                                                        </form>
                                                        </div>

                                                    <?php } ?>

                                                    </div>

                                                    <?php if ($preview_status == false) { ?>

                                                        <div class="comment">
                                                            <h1>全部评论</h1>
                                                            <ul id="comment-list-content">
                                                                <p>加载中，请稍等</p>
                                                            </ul>
                                                            <div id="comment-pagenum" class="pagenum" data-url="<?= BASE_URL ?>api/get_comment.php">

                                                            </div>



                                                        </div>
                                                        <div class="pendant left" style="height: 600px;">
                                                            <ul class="js-pin" style="margin-top: 200px;">
                                                                <li><a href="javascript:void 0" class="red" id="share">分&nbsp;&nbsp;&nbsp;&nbsp;享</a>
                                                                    <div id="sharein"><i id="weixinbtn">微信</i><!--<wb:share-button id="weibo" appkey="4SkNjA" addition="number" type="button" ralateUid="5285964905" default_text=""></wb:share-button>--></div>
                                                                </li>
                                                                <li><a href="#commentForm">评&nbsp;&nbsp;&nbsp;&nbsp;论</a></li>
                                                                <li><a id="like_btn" class="<?= ($is_like_item == 1 ? 'red' : '') ?>" href="javascript:void 0" data-status="<?= @$item[0]['idea_status'] ?>" data-idea_id="<?= $idea_id ?>" data-url="<?= BASE_URL . "api/like.php" ?>"><?php echo($item[0]['idea_status'] >= 5 ? '超想买' : '超喜欢'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="pendant right">
                                                            <a href="#top" style="position: fixed;top: 190px;"><img src="asset/9.png" alt="" class="backtotop js-headno" style="display: none;"></a>
                                                        </div>

                                                    <?php } ?>

                                                    </div>

                                                    </div>
                                                    <div id="footer">
                                                        <?php include "footer.php" ?>
                                                    </div>

                                                    <div class="login hide" id="weibo">
                                                        <div class="form border dark" style="z-index:1;">
                                                            <div class="weibo" >
                                                                <h2>分享到微博</h2>
                                                                <form action="#">
                                                                    <textarea></textarea>
                                                                    <div class="info">
                                                                        <img src="asset/16.png" alt="">
                                                                            <div>
                                                                                <h5>【可以唱歌的杯子】</h5>
                                                                                <p>这是一款可以唱歌的杯子啊，这是一款可以唱歌的杯子啊......</p>
                                                                            </div>
                                                                    </div>
                                                                    <div class="link">
                                                                        <span>来自</span><a href="#">tobeMaker.com</a><span>的分享链接</span>
                                                                        <button>分 享</button>
                                                                    </div>

                                                                </form>
                                                            </div>
                                                        </div>
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
                                                    <script type="text/javascript" src="./js/jquery.qqFace.js"></script>
                                                    <script type="text/javascript" src="./js/jquery-migrate-1.1.1.js"></script>
                                                    <script type="text/javascript" src="./js/jQuery.pin.js"></script>
                                                    <script type="text/javascript" src="./js/qrcode.min.js"></script>

                                                    <script>

                                                        var pageSize = 50;
                                                        var pageNow = 1;
                                                        var maxPageNo = 1;

                                                        function loadIdeaPage(current_page) {

                                                            var start = (current_page - 1) * pageSize;
                                                            var length = pageSize;
                                                            var url = $('#comment-pagenum').data("url");
                                                            var idea_id = <?= $idea_id ?>;
                                                            $.post(url, {"action": 'get_comment', "start": start, "length": length, "idea_id": idea_id}, function(data, textStatus) {
                                                                console.log(data);

                                                                // set up content
                                                                var $container = $('#comment-list-content');
                                                                $container.html('');

                                                                for (var i = 0; data.data != undefined && i < data.data.length; i++) {
                                                                    var item = data.data[i];

                                                                    $container.append('\
                                                                <li>\
                                                                    <div class="commenter">\
                                                                        <a href="javascript:void 0"><img src="' + (item['head_pic_url'] == undefined ? 'asset/15.png' : item['head_pic_url']) + '" alt=""></a>\
                                                                        <br />\
                                                                        <a href="<?= BASE_URL . 'person.php?user_id=' ?>' + item['sender_id'] + '">' + item['user_name'] + '</a>\
                                                                    </div>\
                                                                    <div class="text">' + item['context'] + '\
                                                                    </div>\
                                                                </li>');
                                                                }

                                                                // set up page nav
                                                                var $pageNav = $('#comment-pagenum');
                                                                $pageNav.html('');
                                                                maxPageNo = Math.ceil(parseInt(data.num_of_all) / pageSize);
                                                                for (var i = 1; i <= maxPageNo && i <= 9; i++) {
                                                                    var pageNavClass = "";
                                                                    if (i == current_page) {
                                                                        pageNavClass = ' class="active" ';
                                                                    }
                                                                    $pageNav.append('<a href="#" ' + pageNavClass + ' >' + i + '</a>');
                                                                }
                                                                if (maxPageNo > 9) {
                                                                    $pageNav.append('<a>...</a>');
                                                                }
                                                            }, "json");
                                                        }

                                                        $("#comment-pagenum").on("click", "a", function() {
                                                            var current_page = parseInt($(this).text());
                                                            pageNow = current_page;
                                                            loadIdeaPage(pageNow);
                                                        });

<?php
$attention = new class_attention();
if($attention->checkunique($_SESSION["user_id"], @$item[0]["user_id"])){
    echo "var is_attention_on = true;";
}else{
    echo "var is_attention_on = false;";
} 
?>
                                                        if (is_attention_on){
                                                            $("#addAttention").hide();
                                                            $("#deleteAttention").show();
                                                        }else{
                                                            $("#addAttention").show();
                                                            $("#deleteAttention").hide();
                                                        }
                                                        //注册关注事件
                                                        $("#addAttention").click(function() {
                                                            var attention_userid = $('#author_id').val();
                                                            var userid = $("#user_id").val();
                                                            var url = $(this).data('url');
                                                            $.post(url, {
                                                                'action': 'add',
                                                                'userid': userid,
                                                                'attention_userid': attention_userid

                                                            }, function(data, textStatus) {
                                                                if (data.status == "success") {
                                                                    var $control = $("#addAttention");
                                                                    $control.hide();
                                                                    $("#deleteAttention").show();
                                                                    alert('关注成功！');
                                                                } else {
                                                                    //rollBack();
                                                                    alert("关注失败");

                                                                }
                                                            }, 'json');
                                                        });
                                                        //填充分享内容
                                                        //function addWeiboDefault()
                                                        //{
                                                        // var title="<?= $item[0]['name'] ?>";
                                                        //var content="<?= $item[0]['content'] ?>"
                                                        //content =content.substr(0,100);
                                                        //content+="<a href='<?= BASE_URL ?>project.php?idea_id=<?= @$item[0]['idea_id'] ?>'>详情</a>"
                                                        //$("#weibo").attr("default_text",title+content);
                                                        //}
                                                        //注册取消关注事件
                                                        $("#deleteAttention").click(function() {
                                                            var attention_userid = $('#author_id').val();
                                                            var userid = $("#user_id").val();
                                                            var url = $(this).data('url');
                                                            $.post(url, {
                                                                'action': 'delete',
                                                                'userid': userid,
                                                                'attention_userid': attention_userid

                                                            }, function(data, textStatus) {
                                                                if (data.status == "success") {
                                                                    var $control = $("#deleteAttention");
                                                                    $control.hide();
                                                                    $("#addAttention").show();
                                                                    alert("取消成功")
                                                                } else {
                                                                    //rollBack();
                                                                    alert("取消关注失败");

                                                                }
                                                            }, 'json');
                                                        });
                                                        function replace_em(str) {
                                                            str = str.replace(/\</g, '&lt;');
                                                            str = str.replace(/\>/g, '&gt;');
                                                            str = str.replace(/\n/g, '<br/>');
                                                            str = str.replace(/\[em_([0-9]*)\]/g, '<img src="asset/arclist/$1.gif" border="0" />');
                                                            return str;
                                                        }

                                                        var qrcode = new QRCode(document.getElementById("qrcode"), {
                                                            width: 150,
                                                            height: 150
                                                        });

                                                        function makeCode() {

                                                            var url = '<?= BASE_URL ?>project_mobile.php?idea_id=<?= $idea_id ?>';

                                                                    qrcode.makeCode(url);
                                                                }
                                                                $(window).scroll(
                                                                        function() {

                                                                            var top = document.body.scrollTop || document.documentElement.scrollTop;

                                                                            if (top < 100)
                                                                                $(".js-headno").css("display", "none");
                                                                            else
                                                                                $(".js-headno").css("display", "inline");


                                                                            //  		if($(".js-headno").scrollTop() == 0)
                                                                            //  			$(".js-headno").css("display","none");
                                                                            //  		else
                                                                            //  			$(".js-headno").css("display","block");
                                                                        }


                                                                );


                                                                $(function() {
                                                                    $('.emotion').qqFace({
                                                                        id: 'facebox',
                                                                        assign: 'saytext',
                                                                        path: 'asset/arclist/'	//表情存放的路径
                                                                    });
                                                                    $(".sub_btn").click(function() {
                                                                        var str = $("#saytext").val();
                                                                        $("#saytext").val(replace_em(str));
                                                                        //        alert(replace_em(str));
                                                                        //           $("#show").html(replace_em(str));
                                                                    });
                                                                    //      $(".pendant").pin({
                                                                    //          minWidth : 1220
                                                                    //      });
                                                                    $(".js-pin").pin({
                                                                        //          minWidth : 1220,
                                                                        containerSelector: ".pendant"
                                                                    });

                                                                    $('#saytext').keyup(function(event) {
                                                                        var left = 2000 - $('#saytext').val().length;
                                                                        $('#commentWordLeft').text(left);
                                                                        if (left < 0) {
                                                                            $(this).siblings('input[type=submit]').hide();
                                                                        } else {
                                                                            $(this).siblings('input[type=submit]').show();
                                                                        }
                                                                    });

                                                                    $("#like_btn").click(function() {
                                                                        var url = $(this).data("url");
                                                                        var idea_id = $(this).data("idea_id");
                                                                        var status = $(this).data('status');
                                                                        //TODO:从当前登录用户信息中获取用户id
                                                                        var user_id = $('#user_id').val();
                                                                        if (status >= 5)
                                                                        {
                                                                            $.post(url, {'idea_id': idea_id, 'user_id': user_id, 'buy': 1}, function(data, textStatus) {
                                                                                var status = data['status'];
                                                                                if (status == "success") {
                                                                                    $("#like_btn").addClass("red");
                                                                                } else if (status == "error") {
                                                                                    alert("系统错误，请联系管理员");
                                                                                } else if (status == "buy_delete") {
                                                                                    // 标记“喜欢”按钮为红色还原
                                                                                    $("#like_btn").removeClass();


                                                                                }
                                                                            }, 'json');
                                                                        }
                                                                        else
                                                                        {
                                                                            $.post(url, {'idea_id': idea_id, 'user_id': user_id}, function(data, textStatus) {
                                                                                var status = data['status'];
                                                                                if (status == "success") {
                                                                                    $("#like_btn").addClass("red");
                                                                                } else if (status == "error") {
                                                                                    alert("系统错误，请联系管理员");
                                                                                } else if (status == "like_delete") {
                                                                                    // 标记“喜欢”按钮为红色还原
                                                                                    $("#like_btn").removeClass();


                                                                                }
                                                                            }, 'json');
                                                                        }
                                                                    });

                                                                    $("#share").hover(
                                                                            function() {
                                                                                $("#sharein").show();
                                                                            },
                                                                            function() {
                                                                                $("#sharein").hide();
                                                                            }
                                                                    );
                                                                    $("#sharein").hover(
                                                                            function() {
                                                                                $("#sharein").show();
                                                                            },
                                                                            function() {
                                                                                $("#sharein").hide();
                                                                            }
                                                                    );
                                                                    $("#weibobtn").click(function() {
                                                                        $("#weibo").removeClass("hide");
                                                                        $("#weibo").siblings("div").addClass("blur");
                                                                    });
                                                                    $("#weixinbtn").click(function() {
                                                                        $("#weixin").removeClass("hide");
                                                                        $("#weixin").siblings("div").addClass("blur");
                                                                        makeCode();
                                                                    });

                                                                    function hideAll() {
                                                                        $(".login").addClass("hide");
                                                                        $("#weixin").siblings("div").removeClass("blur");
                                                                        $("#weibo").siblings("div").removeClass("blur");
                                                                    }
                                                                    $(document).keydown(function(event) {

                                                                        if (event.keyCode == 27) {
                                                                            hideAll();
                                                                        }
                                                                    });

                                                                    $('#weixin').click(function() {
                                                                        hideAll();
                                                                    });

                                                                    $('#weibo').click(function() {
                                                                        hideAll();
                                                                    });

                                                                    //$('.weibo').click(function(event){
                                                                    // event.stopPropagation();
                                                                    //});

                                                                    pageNow = 1;
                                                                    loadIdeaPage(pageNow);
                                                                    //addWeiboDefault();


                                                                });

                                                    </script>

                                                    </body>
                                                    </html>
