var TableManaged = function () {

    var ideaProcessUrl;

    var countSelected = function(){
        var $table = $('#idea_list_table');
        var selected = $table.find('tbody tr .checkboxes:checked');
        return selected.length;
    };
    var getSelectedRows = function(){
        var $table = $('#idea_list_table');
        var rows = [];
        $table.find('tbody tr .checkboxes:checked').each(function(){
            rows.push($(this).val());
        });
        return rows;
    };
    var getSelectedRowObjects = function(){
        var $table = $('#idea_list_table');
        return $table.find('tbody tr .checkboxes:checked');
    };

    var initTable = function () {
        
        var table = $('#idea_list_table');
        
        ideaProcessUrl = table.data('url');

        table.dataTable({
            "serverSide": true,
            "ajax": {
                "url": ideaProcessUrl,
                "type": 'post',
                "timeout": 20000,
                "data": function (data) { // add request parameters before submit

                },
                    
                "dataSrc": function (res) { // Manipulate the data returned from the server
                    
                    return res.data;
                },
                "error": function () { // handle general connection errors
                    
                },
                
            },
            
            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            },{
                "orderable": false
            }
                ],
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 25,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ], // set first column as a default sort by asc
            "drawCallback": function (oSettings) { // run some code on table redraw
//                if (tableInitialized === false) { // check if table has been initialized
//                    tableInitialized = true; // set table initialized
//                    table.show(); // display table
//                }
                
                Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload                
            },
        });
        
        // 注册点击批准事件
        table.on('click', 'tbody tr .idea-pass', function(){
            var $tr = $(this).parents('tr');
            var ideaId = $tr.find('input[type="checkbox"]').val();
//            alert("批准 "+ideaId);
            $.post(ideaProcessUrl, $.param({'action':'idea_pass', 'ideaId':[ideaId]}), function(data, textStatus){
                if (data.status == "success"){
                    $status = $tr.find('.idea-status');
                    $status.removeClass();
                    $status.addClass('label label-sm label-success idea-status');
                    $status.text('已批准');
                }else{
                    alert("状态修改失败");                            
                }
            },'json');
        });
        //注册点击编辑事件
		 table.on('click','tbody tr .group-edit',function(){
		 var $tr=$(this).parents('tr');
		 var $span=$tr.find('span[name="name"]');
		 $span.hide();
		 $tr.find('.group-edit').hide();
		 $tr.find('input[name="group_name"]').show();
		  $tr.find('.edit-confirm').show();
		 $tr.find('.edit-cancel').show();
		 $tr.find('.group-delete').hide();
		 }
		 );
		 //注册确认编辑事件
		  table.on('click','tbody tr .edit-confirm',function(){
		 var $tr=$(this).parents('tr');
		 var $id=$tr.find('input[type="checkbox"]').val();
		 var $name=$tr.find('input[name="group_name"]').val();
		 $.post(ideaProcessUrl, $.param({'action':'edit', 'groupId':$id,'name':$name}), function(data, textStatus){
		            $tr.find('.edit-confirm').hide();
		            $tr.find('.edit-cancel').hide();
					 $tr.find('span[name="name"]').show();
					$tr.find('.group-edit').show();
					$tr.find('.group-delete').show();
					$tr.find('input[name="group_name"]').hide();
                if (data.status == "success"){
				   
                    $tr.find('span[name="name"]').text($name);
					//成功信息
		            
                    
                }else{
				
                    alert("状态修改失败");                            
                }
            },'json');
		 
		 }
		 );
		 //注册点击取消事件
		  table.on('click','tbody tr .edit-cancel',function(){
		   var $tr=$(this).parents('tr');
		    $tr.find('.edit-confirm').hide();
		            $tr.find('.edit-cancel').hide();
					$tr.find('.edit-confirm').hide();
					$tr.find('input[name="group_name"]').hide();
					 $tr.find('span[name="name"]').show();
					$tr.find('.group-edit').show();
					$tr.find('.group-delete').show();
		  }
		  )
		  //注册点击删除事件
		   table.on('click','tbody tr .group-delete',function(){
		    var $tr=$(this).parents('tr');
			 var $id=$tr.find('input[type="checkbox"]').val();
			  $.post(ideaProcessUrl, $.param({'action':'delete', 'groupId':$id}), function(data, textStatus){
		            
                if (data.status == "success"){
				   
                    $tr.remove();
					//成功信息
		            
                    
                }else{
				
                    alert("状态修改失败");                            
                }
            },'json');
		   }
		   )
        // 注册点击拒绝事件
        table.on('click', 'tbody tr .idea-reject', function(){
            var $tr = $(this).parents('tr');
            var ideaId = $tr.find('input[type="checkbox"]').val();
//         alert("拒绝 "+ideaId);
            $.post(ideaProcessUrl, $.param({'action':'idea_reject', 'ideaId':[ideaId]}), function(data, textStatus){
                if (data.status == "success"){
                    $status = $tr.find('.idea-status');
                    $status.removeClass();
                    $status.addClass('label label-sm label-danger idea-status');
                    $status.text('已拒绝');
                }else{
                    alert("状态修改失败");                            
                }
            },'json');
        });
        
        // 注册多选通过事件
        $("#sample_editable_1_pass").click(function(){
            var $rows = getSelectedRowObjects();
            var ideaIds = [];
            $rows.each(function(){
                ideaIds.push($(this).val());
            });
//            console.log(ideaIds);
            $.post(ideaProcessUrl, $.param({'action':'idea_pass', 'ideaId':ideaIds }), function(data, textStatus){
                if (data.status == "success"){
                    $rows.each(function(){
                        $status = $(this).parents('tr').find('.idea-status');
                        $status.removeClass();
                        $status.addClass('label label-sm label-success idea-status');
                        $status.text('已批准');
                    });
                }else{
                    alert("状态修改失败");
                }
            },'json');
        });
        
        // 注册多选拒绝事件
        $("#sample_editable_1_reject").click(function(){
            var $rows = getSelectedRowObjects();
            var ideaIds = [];
            $rows.each(function(){
                ideaIds.push($(this).val());
            });
//            console.log(ideaIds);
            $.post(ideaProcessUrl, $.param({'action':'idea_reject', 'ideaId':ideaIds }), function(data, textStatus){
                if (data.status == "success"){
                    $rows.each(function(){
                        $status = $(this).parents('tr').find('.idea-status');
                        $status.removeClass();
                        $status.addClass('label label-sm label-danger idea-status');
                        $status.text('已拒绝');
                    });
                }else{
                    alert("状态修改失败");
                }
            },'json');
        });

        // 注册全选事件
        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        // 行选择事件
        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        var tableWrapper = jQuery('#sample_1_wrapper');
        
        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
        
    }

    return {

        //main function to initiate the module
        init: function () {

            if (!jQuery().dataTable) {
                return;
            }

            initTable();
        }

    };

}();