
var MsgSentModule = function() {

    var $btn_send;
    var $text_content;
    var _to_user_id;

    var actionInit = function() {

        var api_send_url = $btn_send.data('url');
        var jump_url = $btn_send.data('jump_url');
        $btn_send.click(function() {
            $.post(api_send_url, {
                'to_user': _to_user_id,
                'content': $text_content.val(),
            }, function(data, textStatus) {
                if (data.status == "success") {
                    alert('消息发送成功');
                    location.href = jump_url;
                } else {
                    alert(data.status);
                }
            }, 'json');
        });
    }

    return {
        init: function(btn_send_class, text_content_class, to_user_id) {
            $btn_send = $(btn_send_class);
            $text_content = $(text_content_class);
            _to_user_id = to_user_id;
            
            actionInit();
        },
    }
}();

var MsgListModule = function() {

    var $div_list;
    var _user_id;
    var _base_url;

    var dataInit = function() {
        get_list(0, 50);
    }

    var int2readHtml = function(status, msg_id) {
        if (status == 1) {
            return '<a href="javascript:0;" class="a1 active mark-read" data-id="'+ msg_id +'">未读</a>';
        } else {
            return '<a href="javascript:0;" class="a1 mark-unread" data-id="'+ msg_id +'">已读</a>';
        }
    }

    var get_list = function(start, end) {
        var api_url = $div_list.data('url');
        $.post(api_url, {'user_id': _user_id, 'start': start, 'end': end}, function(data, textStatus) {
            console.log(data);
            if (data.status == 'success') {
                $div_list.empty();
                $.each(data.data, function() {
                    
                    var html = '<div>\
                            <div class="avatar"><img class="circle" src="';
                    if (this.sender_head_url !== undefined && this.sender_head_url != null) {
                        html += this.sender_head_url;
                    } else {
                        html += 'asset/12.png';
                    }
                    html += '" alt=""></div>\
                            <div class="msgcontent">\
                                <label><a href="' + _base_url + 'msg_reply.php?to_user=' + this.sender_id + '">' + this.sender_name + '</a></label>\
                                <br/>\
                                <p>' + this.context + '</p>\
                                <div class="time">\
                                    <span>' + this.send_time + '</span>\
                                    <br/>' + int2readHtml(parseInt(this.message_status), this.id)
                            + '<a href="javascript:0;" data-url="' + _base_url + 'api/api.php/msg_v2/delete/' + this.id + '" class="a2 msg-remove">删除</a>\
                                </div>\
                            </div>\
                        </div>';

                    $div_list.append(html);
                });

            } else {
                alert(data.status);
            }
        }, 'json');
    }

    var actionInit = function() {
        $div_list.on('click', ".msg-remove", function() {
            var api_url = $(this).data('url');
//            var the_btn = $(this).parents('');

            $.post(api_url, '', function(data, textStatus) {
                if (data.status == 'success') {
                    alert('删除成功');
                } else {
                    alert(data.status);
                }
            }, 'json');
        });

        $div_list.on('click', ".mark-read", function() {
            var msg_id = $(this).data('id');
            var api_url = _base_url +'api/api.php/msg_v2/mark_read/' + msg_id;
            var $btn = $(this);
            
            $.post(api_url, '', function(data, textStatus){
                if (data.status == "success"){
                    $btn.text('已读');
                    $btn.attr('class', 'a1 mark-unread');
                }else{
                    alert('操作失败');
                }
            }, 'json');
        });

        $div_list.on('click', ".mark-unread", function() {
            var msg_id = $(this).data('id');
            var api_url = _base_url +'api/api.php/msg_v2/mark_unread/' + msg_id;
            var $btn = $(this);
            
            $.post(api_url, '', function(data, textStatus){
                if (data.status == "success"){
                    $btn.text('未读');
                    $btn.attr('class', 'a1 active mark-read');
                }else{
                    alert('操作失败');
                }
            }, 'json');
        });
    }

    return {
        init: function(div_list_class, user_id, base_url) {
            $div_list = $(div_list_class);
            _user_id = user_id;
            _base_url = base_url;

            dataInit();
            actionInit();
        },
    }
}();

var MsgChatModule = function() {

    var $msg_chat;
    var _now_user_id;
    var _to_user_id;
    var _base_url;

    var dataInit = function() {
        get_list(0, 50);
    };

    var get_list = function(start, end) {
        var api_url = $msg_chat.data('url');
        $.post(api_url, {'to_user_id': _to_user_id, 'now_user_id': _now_user_id, 'start': start, 'end': end}, function(data, textStatus) {
            console.log(data);
            if (data.status == 'success') {
                $msg_chat.empty();
                $.each(data.data, function() {

                    var html = '<div>\
                            <div class="avatar"><img class="circle" src="';
                    if (this.sender_head_url !== undefined && this.sender_head_url != null) {
                        html += this.sender_head_url;
                    } else {
                        html += 'asset/12.png';
                    }
                    html += '" alt=""><span>:</span></div>\
                            <div class="msgcontent">\
                                <p>' + this.context + '</p>\
                                <span>' + this.send_time + '</span>\
                                <a href="javascript:0;" data-url="' + _base_url + 'api/api.php/msg_v2/delete/' + this.id + '" class="a2 msg-remove">删除</a>\
                                <br class="clear"/>\
                            </div>\
                        </div>';

                    $msg_chat.prepend(html);
                });

            } else {
                alert(data.status);
            }
        }, 'json');
    }

    var actionInit = function() {
        $msg_chat.on('click', ".msg-remove", function() {
            var api_url = $(this).data('url');
//            var the_btn = $(this).parents('');

            $.post(api_url, '', function(data, textStatus) {
                if (data.status == 'success') {
                    alert('删除成功');
                } else {
                    alert(data.status);
                }
            }, 'json');
        });
    }

    return {
        init: function(msg_chat_class, now_user_id, to_user_id, base_url) {
            $msg_chat = $(msg_chat_class);
            _now_user_id = now_user_id;
            _to_user_id = to_user_id;
            _base_url = base_url;

            dataInit();
            actionInit();
        },
    }
}();