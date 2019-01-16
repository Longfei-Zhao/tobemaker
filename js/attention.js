var AttentionListModule = function() {

    var $list_content;

    var _base_url;
    var _length;
    var _user_id;

    var tomeInit = function() {
        var api_url = _base_url + 'api/api.php/attention_v2/to_me/' + _user_id;
        $list_content.text("无关注数据");
        $.post(api_url, '', function(data, textStatus) {
            console.log(data);

            $list_content.empty();
            $.each(data.data, function() {
                html = '<div class="user"><img class="circle" src="';
                if (this.user_head_url != undefined && this.user_head_url != null) {
                    html += this.user_head_url;
                } else {
                    html += 'asset/12.png';
                    
                }

                html += '" alt=""><a href="'+_base_url+'person.php?user_id='+this.userid+'">' + this.user_name + '</a></div>';
                $list_content.append(html);
            });

        }, 'json');
    }

    var frommeInit = function() {
        var api_url = _base_url + 'api/api.php/attention_v2/from_me/' + _user_id;
        $list_content.text("无关注数据");
        $.post(api_url, '', function(data, textStatus) {
            console.log(data);

            $list_content.empty();
            $.each(data.data, function() {
                html = '<div class="user"><img class="circle" src="';
                if (this.attention_head_url != undefined && this.attention_head_url != null) {
                    html += this.attention_head_url;
                } else {
                    html += 'asset/12.png';
                }

                html += '" alt=""><a href="'+_base_url+'person.php?user_id='+this.attention_userid+'">' + this.attention_name + '</a></div>';
                $list_content.append(html);
            });

        }, 'json');
    }

    return {
        init: function(user_id, type, base_url, list_content_class) {

            _base_url = base_url;
            _length = 24;
            _user_id = user_id
            $list_content = $(list_content_class);


            if (type == 'to_me') {
                tomeInit();
            } else if (type == 'from_me') {
                frommeInit();
            }
        },
    }
}();