<?php $__env->startSection('title'); ?>
    <?php echo e(__('User task elements list')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('User task elements list')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('User task elements list')); ?></h1>
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

                    <table id="events" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('User')); ?></th>
                            <th><?php echo e(__('Task action ID')); ?></th>
                            <th><?php echo e(__('Last checked time')); ?></th>
                            <th><?php echo e(__('Finished')); ?></th>
                            <th><?php echo e(__('Created at')); ?></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <td class="tdinput"></td>
                            <td class="tdinput"></td>
                            <td class="tdinput"></td>
                            <td class="tdinput"></td>
                            <td class="tdinput"></td>
                        </tr>
                        </tfoot>
                    </table>

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
    <script>
        //initialize basic datatable
        var table = $('#events').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": '<?php echo e(route('admin.user-tasks.user_task_elements.datatable')); ?>',
            "columns": [
                {
                    "data": 'task', "orderable": false, "searchable": false, "render": function (data, type, row, meta) {
                        return '<a href="/admin/users/' + row['user_id'] + '" class="btn btn-xs btn-default" target="_blank"><i class="glyphicon glyphicon-eye"></i> <?php echo e(__('open user details')); ?></a>';
                    }
                },
                {"data": "task_action_id", "name": "user_task_actions.task_action_id"},
                {"data": "last_check_datetime", "name": "user_task_actions.last_check_datetime"},
                {
                    "data": 'finished', "orderable": false, "searchable": false, "render": function (data, type, row, meta) {
                        if (row['finished'] == 1) {
                            return "<?php echo e(__('yes')); ?>";
                        } else {
                            return "<?php echo e(__('no')); ?>";
                        }
                    }
                },
                {"data": "created_at", "name": "user_task_actions.created_at"},
            ],
            "dom": 'Rlfrtip',
            initComplete: function () {
                this.api().columns([0, 1, 2, 3, 4]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        $('#events tbody').on('click', 'tr', function () {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            } else {
                table.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>