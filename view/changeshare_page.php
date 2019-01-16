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
            <div class="pic">
                <div class="picture">
                    <img id="coverPreview" src="<?=$idea_info['picture_url']?>" alt="">
                    <label id="title_preview"><?=$idea_info['name']?></label>
                </div>
                <p>请保证：</p>
                <p>* 分享内容均为你的原创创意或原创设计；</p>
                <p>* 分享的创意和设计均属于生活家居用品范畴，非智能硬件；</p>
                <p>* 分享的创意和设计均是现实技术可实现的。</p>

            </div>
            <div class="form">
                <div class="form--rhombus">
                    
                </div>
                <form id="idea-form" method="POST">
                    <label>标题</label>
                    <input id="title_input_text" name="title" type="text" value="<?=$idea_info['name']?>" >

                    <label>作者<span></span></label>
                    <input name="author" type="text" disabled="true" value="<?=$idea_info['user_name']?>" />                    
                    <input name="token" type="hidden" value="<?=$upToken?>" />
                    <label>封面<span>（大图片建议尺寸 900像素*500像素）</span></label>
                    <div class="fileupload">
                        <div>上传<i id='upload-progress-label'></i></div>
                        <input id="fileSelect" type="file" name="file" data-url="http://up.qiniu.com/">
                        <input id="fileurl" type="hidden" name="img_url" value="<?=$idea_info['picture_url']?>" />
                    </div>
                    <input name="cover_display" type="checkbox" value="1" <?=$idea_info['cover_display']==1?'checked="checked"':''?> ><span>封面图片显示在正文中</span>
                    <label>标签<span>（标签之前用英文逗号分隔，最多5个标签）</span></label>
                    <input id="tmpTagText" type="text" value="<?=$idea_info['tags']?>" />
                    <input id="trueTagText" name="tags" type="hidden" value="<?=$idea_info['tags']?>" />
                    <div id="tagView"><i>修改后标签效果在此预览</i></div>
                    <label class="last">正文</label>
                    <div class="fileupload" style="width: 160px;">
                        <div>插入图片到正文<i id='upload-progress-label-for-content'></i></div>
                        <input id="fileSelectForContent" type="file" name="file" data-url="http://up.qiniu.com/">
                    </div>
                    <div class="textdiv">
                    <textarea id="editor" name="content" placeholder="这里输入内容" autofocus>
                    <?php
                    echo $idea_info['content'];
                    ?>
                    </textarea>                 
                    </div>
                    <input type="hidden" name="act" value="change_share" />
                    <input type="hidden" name="idea_id" value=
                    <?php
                    echo $idea_info['idea_id'];
                    ?>
                    >
                </form>
            </div>
            <div class="submit">
                <div class="out">
                    <div>
                        <button class="save">保存</button>
                        <button class="view">预览</button>
                    </div>
                </div>
            </div>
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

    <script>
    $(document).ready(function(){
        $('#content').redactor();
        $('#fileSelect').fileupload({
            dataType: 'json',
            done: function (e, data) {
                if (data.result.key == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    var url="<?=QINIU_DOWN?>"+ data.result.key;
                    $("#coverPreview").attr('src', url);
                    $("#fileurl").val(url);
                }
                $('#upload-progress-label').text('');
            },
            progress: function (e, data) {
                console.log(data);
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#upload-progress-label').text(progress+'%');
            },
        });

        $('#fileSelectForContent').fileupload({
            dataType: 'json',
            done: function (e, data) {
                if (data.result.key == null){
                    alert("错误：" + data.result.err_msg);
                }else{
                    var url="<?=QINIU_DOWN?>"+ data.result.key;
                    
                    $('.simditor-body').append('<img src="'+url+'">');
                }
                $('#upload-progress-label-for-content').text('');
            },
            progress: function (e, data) {
                
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#upload-progress-label-for-content').text(progress+'%');
            },
        });
        
        $('button.save').click(function(){
            $('#idea-form').action="../changeshare.php";
            $('#idea-form').submit();
        });

        $('button.view').click(function(){
            // alert('结果预览');
            var formData = $('#idea-form').serialize();
            $.post('project.php', formData, function(data, textStatus){
                var win=window.open("about blank");
                win.document.write(data);
            });
        });
        
        $('#tmpTagText').keyup(function(){
            var labelArr = $(this).val().split(',');
            var trueLabelArr = new Array();
            console.log(labelArr);
            $('#tagView').html('');
            for (var i=0; i<5 && i<labelArr.length; i++){
                trueLabelArr.push(labelArr[i]);
                $('#tagView').append('<span class="tag">' + labelArr[i] + '</span>');
            }
//          $('#tagView').html(trueLabelArr.join(','));
            $('#trueTagText').val(trueLabelArr.join(','));
        });
        
        $('#title_input_text').keyup(function(){
            var title_val = $(title_input_text).val();
            if (title_val == ''){
                title_val = "标题";
            }
            $('#title_preview').text(title_val);
        });
    });

    </script>
    <script type="text/javascript" charset="utf-8">
        var editor = new Simditor({
            textarea: $('#editor'),
             toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table',  'link', 'image', 'hr', '|', 'indent', 'outdent'],
        });
    </script>
</body>
</html>












