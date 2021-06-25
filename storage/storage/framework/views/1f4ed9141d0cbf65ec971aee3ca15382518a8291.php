<?php $__env->startSection('title'); ?>
    <?php echo e(__('Failed jobs')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Failed jobs')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Failed jobs')); ?></h1>
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
                    <table class="table table-custom" id="jobs-table">
                        <thead>
                        <tr>
                            <th><?php echo e(__('JOB type')); ?></th>
                            <th><?php echo e(__('Connection')); ?></th>
                            <th><?php echo e(__('Queue')); ?></th>
                            <th><?php echo e(__('Exception')); ?></th>
                            <th><?php echo e(__('Failed at')); ?></th>
                            <th><?php echo e(__('Deposit ID')); ?></th>
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
                            <td class="tdinput"></td>
                            <td class="tdinput"></td>
                        </tr>
                        </tfoot>
                    </table>

                    <div>
                        <a type="button" class="btn btn-danger sure"
                           href="<?php echo e(route('admin.failedjobs.retry_all')); ?>"><?php echo e(__('Restart all jobs')); ?></a>
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
    <script>
        //initialize basic datatable
        var table = $('#jobs-table').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[4, "desc"]],
            "ajax": '<?php echo e(route('admin.failedjobs.datatable')); ?>',
            "columns": [
                {"data": "type"},
                {"data": "connection"},
                {"data": "queue"},
                {
                    "data": 'exception', "render": function (data, type, row, meta) {
                        return '<textarea class="form-control" readonly>' + row['exception'] + '</textarea>';
                    }
                },
                {"data": "failed_at"},
                {
                    "data": 'deposit_id', "render": function (data, type, row, meta) {
                        if (row['deposit_id'].length > 0) {
                            var link = '<a href="/admin/deposits/' + row['deposit_id'] + '" class="btn btn-primary" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a>';
                            link += '<form style="margin-top:10px;" action="<?php echo e(route('admin.failedjobs.retry')); ?>" method="POST" target="_top"><input type="hidden" name="deposit_id" value="' + row['deposit_id'] + '"><?php echo e(csrf_field()); ?><input type="submit" class="btn btn-default" value="<?php echo e(__('Restart job')); ?>"></form>';
                            return link;
                        } else {
                            return '';
                        }
                    }
                }
            ],
            "aoColumnDefs": [
                {'bSortable': false, 'aTargets': ["no-sort"]}
            ],
            "dom": 'Rlfrtip',
            initComplete: function () {
                this.api().columns([0, 1, 2, 3, 4, 5]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        $('#jobs-table tbody').on('click', 'tr', function () {
            if ($(this).hasClass('row_selected')) {
                $(this).removeClass('row_selected');
            }
            else {
                table.$('tr.row_selected').removeClass('row_selected');
                $(this).addClass('row_selected');
            }
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>