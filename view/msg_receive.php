<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>share</title>
        <?php include "top_css.php" ?>
        <script type="text/javascript" src="js/md5.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/redactor.css">
        <link rel="stylesheet" type="text/css" href="css/simditor.css"/>
        <link rel="stylesheet" type="text/css" href="./admin/assets/global/plugins/select2/select2.css"/>
        <link rel="stylesheet" type="text/css" href="./admin/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
    </head>
    <body>
        <div id="top">
            <?php include "header.php" ?>
        </div>
        <div id="center">
            <div class="middle">
                <div class="share">
                    <form id="idea-form" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                                <div class="portlet box grey-cascade">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-globe"></i>收件箱
                                        </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse">
                                            </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config">
                                            </a>
                                            <a href="javascript:;" class="reload">
                                            </a>
                                            <a href="javascript:;" class="remove">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-toolbar">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="btn-group">
                                                        <a href="user_add.php"><button id="sample_editable_1_new" class="btn green">
                                                                添加用户 <i class="fa fa-plus"></i>
                                                            </button></a>

                                                    </div>
                                                    <div class="btn-group">
                                                        <button id="sample_editable_1_shield" class="btn red">
                                                            屏蔽用户 <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                    <div class="btn-group">
                                                        <button id="sample_editable_1_delete" class="btn red" onclick="return confirm('确定删除？')">
                                                            批量删除 <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="btn-group pull-right">
                                                        <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu pull-right">
                                                            <li>
                                                                <a href="#">
                                                                    Print </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    Save as PDF </a>
                                                            </li>
                                                            <li>
                                                                <a href="#">
                                                                    Export to Excel </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="user_id" value="<?= @$userinfo["user_id"] ?>"/>
                                        <table class="table table-striped table-bordered table-hover" id="message_list_table" data-url="<?= BASE_URL ?>api/message.php">
                                            <thead>
                                                <tr>
                                                    <th class="table-checkbox">
                                                        <input type="checkbox" class="group-checkable" data-set="#message_list_table .checkboxes"/>
                                                    </th>
                                                    <th>
                                                        <img alt="" src=""/>
                                                    </th>
                                                    <th>
                                                        发信人
                                                    </th>
                                                    <th>
                                                        内容
                                                    </th>
                                                    <th>
                                                        时间
                                                    </th>

                                                    <th>
                                                        操作
                                                    </th>
                                                </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>

                        <!-- END PAGE CONTENT-->

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
    <script type="text/javascript" src="./admin/assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="./admin/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="./admin/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <script src="./admin/assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="./admin/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="./admin/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="./admin/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

    <script type="text/javascript" charset="utf-8">
                                                            jQuery(document).ready(function() {
                                                                TableManaged.init();
                                                            });


                                                            var TableManaged = function() {

                                                                var userProcessUrl;

                                                                var countSelected = function() {
                                                                    var $table = $('#message_list_table');
                                                                    var selected = $table.find('tbody tr .checkboxes:checked');
                                                                    return selected.length;
                                                                };
                                                                var getSelectedRows = function() {
                                                                    var $table = $('#message_list_table');
                                                                    var rows = [];
                                                                    $table.find('tbody tr .checkboxes:checked').each(function() {
                                                                        rows.push($(this).val());
                                                                    });
                                                                    return rows;
                                                                };
                                                                var getSelectedRowObjects = function() {
                                                                    var $table = $('#message_list_table');
                                                                    return $table.find('tbody tr .checkboxes:checked');
                                                                };

                                                                var initTable = function() {

                                                                    var table = $('#message_list_table');

                                                                    userProcessUrl = table.data('url');

                                                                    table.dataTable({
                                                                        "serverSide": true,
                                                                        "ajax": {
                                                                            "url": userProcessUrl,
                                                                            "type": 'post',
                                                                            "timeout": 20000,
                                                                            "data": function(data) { // add request parameters before submit
                                                                                data.userid = $("#user_id").val();
                                                                            },
                                                                            "dataSrc": function(res) { // Manipulate the data returned from the server

                                                                                return res.data;
                                                                            },
                                                                            "error": function() { // handle general connection errors

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
                                                                                "previous": "Prev",
                                                                                "next": "Next",
                                                                                "last": "Last",
                                                                                "first": "First"
                                                                            }
                                                                        },
                                                                        "columnDefs": [{// set default column settings
                                                                                'orderable': false,
                                                                                'targets': [0]
                                                                            }, {
                                                                                "searchable": false,
                                                                                "targets": [0]
                                                                            }],
                                                                        "order": [
                                                                            [1, "asc"]
                                                                        ], // set first column as a default sort by asc
                                                                        "drawCallback": function(oSettings) { // run some code on table redraw
//                if (tableInitialized === false) { // check if table has been initialized
//                    tableInitialized = true; // set table initialized
//                    table.show(); // display table
//                }

                                                                            Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload                
                                                                        },
                                                                    });

                                                                    //注册点击
                                                                    table.on('click', 'tbody tr .user-enable', function() {
                                                                        var $tr = $(this).parents('tr');
                                                                        var userId = $tr.find('input[type="checkbox"]').val();
//         alert("拒绝 "+ideaId);
                                                                        $.post(userProcessUrl, $.param({'action': 'user_enable', 'userID': [userId]}), function(data, textStatus) {
                                                                            if (data.status == "success") {
                                                                                $status = $tr.find('.user-status');
                                                                                $status.removeClass();
                                                                                $status.addClass('label label-sm label-success user-status');
                                                                                $status.text('正常');
                                                                                $action = $tr.find('a.user-enable');
                                                                                $action.removeClass();
                                                                                $action.addClass('btn btn-xs red user-shield');
                                                                                $action.html('<i class="fa fa-search"></i>屏蔽用户');
                                                                            } else {
                                                                                alert("状态修改失败");
                                                                            }
                                                                        }, 'json');
                                                                    });







                                                                    // 注册全选事件
                                                                    table.find('.group-checkable').change(function() {
                                                                        var set = jQuery(this).attr("data-set");
                                                                        var checked = jQuery(this).is(":checked");
                                                                        jQuery(set).each(function() {
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
                                                                    table.on('change', 'tbody tr .checkboxes', function() {
                                                                        $(this).parents('tr').toggleClass("active");
                                                                    });

                                                                    var tableWrapper = jQuery('#sample_1_wrapper');

                                                                    tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown

                                                                }

                                                                return {
                                                                    //main function to initiate the module
                                                                    init: function() {

                                                                        if (!jQuery().dataTable) {
                                                                            return;
                                                                        }

                                                                        initTable();
                                                                    }

                                                                };

                                                            }();
    </script>
</body>
</html>