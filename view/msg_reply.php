<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>tobeMaker-msg</title>
        <?php include "top_css.php" ?>
    </head>
    <body>
        <div id="top">
            <?php include "header.php" ?>
        </div>
        <div id="center">
            <div class="middle">
                <div class="mine">
                    
                    <img src="<?= ( (array_key_exists('head_pic_url', $to_user_info) && $to_user_info['head_pic_url'] != '') ? $to_user_info['head_pic_url']:"asset/12.png") ?>" alt="" id="avatar" class="small circle">
                        <br/>
                        <span class="to">
                            与 <?=$to_user_info['user_name']?> 的站内信
                        </span>
                </div>
                <div class="mine msg">
                    <div class="msgreply" data-url="<?=BASE_URL?>api/api.php/msg_v2/with_2_user">
                        站内信加载中……<br/><br/>
                    </div>
                    <div class="send reply">
                        <textarea class="msg-content"></textarea>
                        <div class="submit">
                            <a href="#">取消</a>
                            <button class="msg-send" data-url="<?=BASE_URL?>api/api.php/msg_v2/send" data-jump_url="<?=BASE_URL?>msg_reply.php?to_user=<?=$_GET['to_user']?>">发送</button>
                        </div>
                        <br class="clear"/>
                    </div>
                </div>
            </div>
        </div>

        <div id="footer">
            <?php include "footer.php" ?>
        </div>

        <?php include "bottom_js.php" ?>
        <script src="./js/msg.js"></script>
        <script>
            //当前登录用户id
            var to_user_id = "<?=array_key_exists('to_user', $_GET) ? $_GET['to_user'] : '-1' ?>";
            var now_user_id = "<?= $_SESSION['user_id'] ?>";
            var base_url = "<?=BASE_URL?>";
            
            MsgChatModule.init(".msgreply",now_user_id, to_user_id, base_url);
            MsgSentModule.init('.msg-send', '.msg-content', to_user_id);
        </script>

    </body>
</html>