var divManaged = function () {

    var attentionProcessUrl=$('#tableattention').data('url');
   
    var length=12;
// 更改页面内容
    var initdiv = function (  data, type) {
        
        var div ;
		if(type=='my')
		{
		    div=$("#myattentionList");
			
		}
		else
		{
		     div=$("attentionmeList");
		}
		div.empty();
        var list=data["data"];
       
		for(var i in list)
		{
		    var html='<dl><dd><a href="#"><img src="'+list[i][2]+'" alt=""></dd><dd><a>'+list[i][1]+'</a></dd></dl>';
			div.append(html);
		}
		var start=+data.start;
		var total=data.recordsTotal;
		var prestartnum=(-length+start>0?start-length:1);
		var nexstartnum=(length+start>total?start:start+length);
		if(type=='my')
		{
		$("#myprevstart").val(prestartnum);
		$("#mynextstart").val(nexstartnum);
		
		}
		else
		{
		$("#meprevstart").val(prestartnum);
		$("#menextstart").val(nexstartnum);
		     
		}
        }
  //注册点击更换tab事件(换位关注我的)
 $("#attentionme-btn").click(function(){
 var $divmy=$("#mylist");
 var $divme=$("#melist");
 $divme.show();
 $divmy.hide();
 var userid=$('#userid').val();
var start=$('#menextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-attention-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'me');
                   
            },'json');
 });
 //注册点击更换tab事件（换为我的关注）
 $("#myattention-btn").click(function(){
 var $divmy=$("#mylist");
 var $divme=$("#melist");
 $divme.hide();
 $divmy.show();
 var userid=$('#userid').val();
var start=$('#mynextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'my');
                   
            },'json');
 });
//注册点击向后翻页事(我的关注)
$('.mynex').click(function()
{
var userid=$('#userid').val();
var start=$('#mynextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'my');
                   
            },'json');
});
//注册点击向前翻页事（我的关注）
$('.mypre').click(function()
{
var userid=$('#userid').val();
var start=$('#myprevstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'my');
                    
            },'json');
});
//注册点击向后翻页事(关注我的)
$('.menex').click(function()
{
var userid=$('#userid').val();
var start=$('#menextstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-attention-me', 'attention_userid':userid,'start':start,'length':length }), function(data, textStatus){
               //成功改变页面内容
                    initdiv(data,'me');
                   
            },'json');
});
//注册点击向前翻页事（关注我的）
$('.mepre').click(function()
{
var userid=$('#userid').val();
var start=$('#meprevstart').val();
 $.post(attentionProcessUrl, $.param({'action':'view-attention-me', 'attention_userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'me');
                    
            },'json');
});
    return {

        //main function to initiate the module
        init: function () {
		
     var userid=$('#userid').val();
     var start=1;
     $.post(attentionProcessUrl, $.param({'action':'view-me', 'userid':userid,'start':start,'length':length }), function(data, textStatus){
                
                    initdiv(data,'my');
                    
            },'json');
           
        }

    };

}();