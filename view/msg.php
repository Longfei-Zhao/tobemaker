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
                    <input type="hidden" id="userid" value="<?= @$userid ?>"/>
                    <img id="userHead" class="circle" src="<?= @$userInfo[0]["head_pic_url"] ?>" alt="">
                        <br/>
                        <span class="to">
                            我的站内信
                        </span>
                </div>
                <div class="mine msg">
                    <div class="msglist" data-url="<?= BASE_URL ?>api/api.php/msg_v2/to_user">
                        站内信加载中……<br/><br/>
                    </div>
                    <div class="pagenum">
<!--                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#">4</a>
                        <a href="#">5</a>
                        <a href="#">6</a>
                        <a href="#">7</a>
                        <a href="#">8</a>
                        <a href="#">9</a>-->

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
            var to_user_id = "<?= array_key_exists('user_id', $_SESSION) ? $_SESSION['user_id']:'' ?>";
            var base_url = "<?=BASE_URL?>";
            MsgListModule.init('.msglist', to_user_id, base_url);
        </script>

    </body>
</html>