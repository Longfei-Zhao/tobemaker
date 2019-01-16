var TableManaged = function () {

    var userProcessUrl;

    var countSelected = function(){
        var $table = $('#user_list_table');
        var selected = $table.find('tbody tr .checkboxes:checked');
        return selected.length;
    };
    var getSelectedRows = function(){
        var $table = $('#user_list_table');
        var rows = [];
        $table.find('tbody tr .checkboxes:checked').each(function(){
            rows.push($(this).val());
        });
        return rows;
    };
    var getSelectedRowObjects = function(){
        var $table = $('#user_list_table');
        return $table.find('tbody tr .checkboxes:checked');
    };

    var initTable = function () {
        
        var table = $('#user_list_table');
        
        userProcessUrl = table.data('url');

        table.dataTable({
            "serverSide": true,
            "ajax": {
                "url": userProcessUrl,
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
            }, {
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
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
        
       //注册点击
	   table.on('click', 'tbody tr .user-enable', function(){
            var $tr = $(this).parents('tr');
            var userId = $tr.find('input[type="checkbox"]').val();
//         alert("拒绝 "+ideaId);
            $.post(userProcessUrl, $.param({'action':'user_enable', 'userID':[userId]}), function(data, textStatus){
                if (data.status == "success"){
                    $status = $tr.find('.user-status');
                    $status.removeClass();
                    $status.addClass('label label-sm label-success user-status');
                    $status.text('正常');
					$action=$tr.find('a.user-enable');
					$action.removeClass();
					$action.addClass('btn btn-xs red user-shield');
					$action.html('<i class="fa fa-search"></i>屏蔽用户');
                }else{
                    alert("状态修改失败");                            
                }
            },'json');
        });
        
        // 注册点击屏蔽用户事件
        table.on('click', 'tbody tr .user-shield', function(){
            var $tr = $(this).parents('tr');
            var userId = $tr.find('input[type="checkbox"]').val();
//         alert("拒绝 "+ideaId);
            $.post(userProcessUrl, $.param({'action':'user_shield', 'userID':[userId]}), function(data, textStatus){
                if (data.status == "success"){
                    $status = $tr.find('.user-status');
                    $status.removeClass();
                    $status.addClass('label label-sm label-danger user-status');
                    $status.text('已屏蔽');
					$action=$tr.find('a.user-shield');
					$action.removeClass();
					$action.addClass('btn btn-xs green user-enable');
					$action.html('<i class="fa fa-search"></i>启用用户');
                }else{
                    alert("状态修改失败");                            
                }
            },'json');
        });
        
        // 注册多选屏蔽事件
        $("#sample_editable_1_shield").click(function(){
            var $rows = getSelectedRowObjects();
            var userIDs = [];
            $rows.each(function(){
                userIDs.push($(this).val());
            });
//            console.log(ideaIds);
            $.post(userProcessUrl, $.param({'action':'user_shield', 'userID':userIDs }), function(data, textStatus){
                if (data.status == "success"){
                    $rows.each(function(){
                        $status = $(this).parents('tr').find('.user-status');
                        $status.removeClass();
                        $status.addClass('label label-sm label-danger user-status');
                        $status.text('已屏蔽');
                    });
                }else{
                    alert("状态修改失败");
                }
            },'json');
        });
        
        // 注册多选删除事件
        $("#sample_editable_1_delete").click(function(){
            var $rows = getSelectedRowObjects();
            var userIds = [];
            $rows.each(function(){
                userIds.push($(this).val());
            });
//            console.log(ideaIds);
            $.post(userProcessUrl, $.param({'action':'user_delete', 'userID':userIds }), function(data, textStatus){
                if (data.status == "success"){
                    //删除该行
                    $rows.each(function(){
                        $(this).parents('tr').remove();
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