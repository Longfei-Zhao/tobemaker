<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>share</title>
    <?php include "top_css.php" ?>
    <script type="text/javascript" src="js/md5.js"></script> 
    <link rel="stylesheet" type="text/css" href="css/redactor.css">
    <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
</head>
<body>
<div id="top">
    <?php include "header.php" ?>
</div>
<div id="center">
    <div class="middle">
        <div class="share">
            <form id="idea-form" method="POST">
            <div class="form">
                
                   <input type="hidden" id="user_id" name="user_id" value="<?=@$user_id?>" />
				    <input type="hidden" id="to_user_id" name="to_user_id" value="<?=@$to_user_id?>" />
                    <label class="last">正文</label>
                    <div class="textdiv">
                  		<textarea id="content" name="content" placeholder="这里输入内容" autofocus></textarea>					
                    </div>
                    <input type="hidden" name="act" value="create_share" />
                    

                
            </div>
            <div class="submit">
                <div class="out">
                    <div>
					
                        <input type="submit" class="btn" value="发送" />
                        
                    </div>
                </div>
            </div>
			</form>
            <br class="clear"/>
        </div>

    </div>

</div>
<div id="footer">
    <?php include "footer.php" ?>
</div>
    
    <?php include "bottom_js.php" ?>
    <script src="js/redactor.js"></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js" ></script>
    <script src="admin/assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js" ></script>
	<script src="js/simditor-all.min.js" type="text/javascript" charset="utf-8"></script>

    
    <script type="text/javascript" charset="utf-8">
		var editor = new Simditor({
			textarea: $('#content'),
			 toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table',  'link', 'image', 'hr', '|', 'indent', 'outdent'],
		});
    </script>
</body>
</html>