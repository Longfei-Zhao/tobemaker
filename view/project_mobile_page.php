<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?=$item[0]['name']?> - tobeMaker</title>
    <?php include "top_css.php" ?>
</head>
<body style="min-width: inherit">
<div class="webview">
    <h1><?=$item[0]['name']?></h1>
    <label>标签：<?php //echo $item[0]['tags'];
                $tag_array = split(',', $item[0]['tags']);
                foreach($tag_array as $tag_item){
                	echo $tag_item.' ';
                }
                	
                	?></label>
    <br/>
    <img src="<?php echo @$item[0]['head_pic_url'] == '' ? 'asset/12.png' : $item[0]['head_pic_url']; ?>" alt="" class="avatar">
    <br>
    <strong><?=$item[0]['user_name']?></strong>
    <div class="content">
        <?php 
        if(isset($item[0]['cover_display'])&&intval($item[0]['cover_display'])==1){
        ?>
        <img src=<?php echo "\"".$item[0]['picture_url']."\""?> alt="">
        <?php
        }
        ?>
        <?php echo $item[0]['content'];?>
        <span>更多新奇创意，请登录<a href="http://www.tobemaker.com">tobemaker.com</a>众造平台。</span>
    </div>


</div>

</body>
</html>