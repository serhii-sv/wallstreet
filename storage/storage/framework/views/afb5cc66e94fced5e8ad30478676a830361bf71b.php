<?php $__env->startSection('title'); ?><?php echo e(__('Users list')); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Users list')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-12">
            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Users list')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> <?php echo e(__('Fullscreen')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered hover" id="users-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Login')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Registration')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>

                            </tr>
                            </thead>
                            <tfoot>
                            <style>
                                td.tdinput input {
                                    width: 100%;
                                }
                            </style>
                            <tr>
                                <td class="tdinput"></td>
                                <td class="tdinput"></td>
                                <td class="tdinput"></td>
                                <td class="tdinput"></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /tile body -->

            </section>
            <!-- /tile -->


        </div>
        <!-- /col -->
    </div>
    <!-- /row -->


<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    

    //initialize basic datatable
    var table = $('#users-table').DataTable({
    "iDisplayLength": 25,
    "processing": true,
    "serverSide": true,
    "order": [[ 2, "desc" ]],
    "ajax": '<?php echo e(route('admin.users.dtdata')); ?>',
    "columns": [
    {"data": "login", "render": function ( data, type, row, meta ) {
        return '<a href="'+row['show']+'" target="_blank">'+data+'</a>';
    }},
    {"data": "email", "render": function ( data, type, row, meta ) {
        return '<a href="mailto:'+data+'" target="_blank">'+data+'</a>';
    }},
    {"data": "created_at"},
    {"data": 'action', "orderable": false, "searchable": false, "render": function ( data, type, row, meta ) {
        return '<a href="'+row['show']+'" target="_blank" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a> <a href="'+row['edit']+'" target="_blank" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-edit"></i> <?php echo e(__('edit')); ?></a>';
    }}
    ],
    "aoColumnDefs": [
    {
    'bSortable': false,
    'aTargets': ["no-sort"],
    'render': function (data, type, row) {
        return data +' ('+ row[1]+')';
    },
    }],
    "aoColumnDefs": [
    {'bSortable': false,'aTargets': ["no-sort"],}
    ],
    "dom": 'Rlfrtip',
    initComplete: function () {
    this.api().columns([0,1,2]).every(function () {
    var column = this;
    var input = document.createElement("input");
    $(input).appendTo($(column.footer()).empty()).attr('placeholder', 'search ...')
    .on('keyup', function () {
    column.search($(this).val(), false, false, true).draw();
    });
    });
    }
    });

    $('#users-table tbody').on('click', 'tr', function () {
    if ($(this).hasClass('row_selected')) {
    $(this).removeClass('row_selected');
    }
    else {
    table.$('tr.row_selected').removeClass('row_selected');
    $(this).addClass('row_selected');
    }
    });

    //*initialize basic datatable

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>