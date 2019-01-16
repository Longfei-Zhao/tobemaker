<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
        include ROOT_PATH."/class/class_idea.php";
        include_once ROOT_PATH."/class/class_comment.php";
        //获取数据
        $class_idea=new class_idea();
        $item=$class_idea->get_idea_by_id($idea_id);
        $class_comment=new class_comment();
        $comment_list=$class_comment->get_all_comment_by_ideaid($idea_id);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>tobeMaker-item</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.qqFace.js"></script>
    <script type="text/javascript" src="js/jquery-migrate-1.1.1.js"></script>
    <script type="text/javascript" src="js/jQuery.pin.js"></script>
    <script>
        $(function(){
            $('.emotion').qqFace({
                id : 'facebox',
                assign:'saytext',
                path:'asset/arclist/'	//表情存放的路径
            });
            $(".sub_btn").click(function(){
                var str = $("#saytext").val();
                $("#show").html(replace_em(str));
            });
            $(".pendant").pin({
                minWidth : 1220
            });

        });
        function replace_em(str){
            str = str.replace(/\</g,'&lt;');
            str = str.replace(/\>/g,'&gt;');
            str = str.replace(/\n/g,'<br/>');
            str = str.replace(/\[em_([0-9]*)\]/g,'<img src="asset/arclist/$1.gif" border="0" />');
            return str;
        }
    </script>
</head>

<body>
<div id="top">
    <iframe src="top.html" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>
</div>
<div id="center">
    <div class="middle">
        <div class="item">
            <div class="ttl">
                <div class="title"><?php echo $item[0]['name'];?></div>
                <div class="author">
                    <a href="javascript:void 0"><img src="asset/15.png" alt=""></a>
                    <br />
                    <a href="javascript:void 0"><?php echo $item[0]['user_name'];?></a>
                </div>
                <div class="subtitle"><?php echo $item[0]['brief'];?></div>
                <div class="emailme">
                    <a href="javascript:void 0"><img src="asset/10.png" alt=""></a>
                    <a href="javascript:void 0"><img src="asset/11.png" alt=""></a>
                </div>

                <br class="clear"/>

            </div>
            <div class="atc">
                <p><?php echo $item[0]['content'];?></p>
                <img src="asset/16.png" alt="">
            </div>
            <div class="commentbox">
                <form action="showidea.php" method="POST" >
                    <label>评论</label>
                    <textarea id="saytext" name="saytext"></textarea>
                    <a href="javascript:void 0" class="emotion">添加表情</a>
                    <input type="checkbox"><span>同时推荐该想法</span>
                    <input type="hidden" name="user_id" value="2"/>
                    <input type="hidden" name="idea_id" value="1"/>
                    <input type="submit" value="评论">
                    <p>个字符</p>
                    <em>2000</em>
                    <p>还可以输入</p>
                </form>


            </div>

        </div>
        <div class="comment">
            <h1>全部评论</h1>
            <ul>
                <?php
                     if($comment_list!=0) // 有评论则显示
                     {
                        $num=count($comment_list);
                        $i=0;
                        while ($i<$num) { ?>
                        <li>
                            <div class="commenter">
                                <a href="javascript:void 0"><img src="asset/15.png" alt=""></a>
                                <br />
                                <a href="javascript:void 0"><?php 
                                echo $comment_list[$i]->user_name;
                                ?></a>
                            </div>
                            <div class="text">
                        <?php
                            echo $comment_list[$i]->context;
                        ?>
                        <img src="asset/17.png" alt="">
                            </div>
                        </li>
                <?php  $i++; }
                }?>
                
            </ul>
            <div class="pagenum">
                <a href="#">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">7</a>
                <a href="#">8</a>
                <a href="#">9</a>
            </div>
            
        </div>
        <div class="pendant left">
            <ul>
                <li><a href="javascript:void 0" class="red">分&nbsp;&nbsp;&nbsp;&nbsp;享</a></li>
                <li><a href="javascript:void 0">评&nbsp;&nbsp;&nbsp;&nbsp;论</a></li>
                <li><a href="javascript:void 0">超喜欢</a></li>
            </ul>

        </div>
        <div class="pendant right">
            <a href="#top"><img src="asset/9.png" alt="" class="backtotop"></a>
        </div>

    </div>

</div>
<div id="footer">
    <iframe src="footer.html" frameborder="0" marginheight="0" marginwidth="0" scrolling="no"></iframe>
</div>

</body>
</html>