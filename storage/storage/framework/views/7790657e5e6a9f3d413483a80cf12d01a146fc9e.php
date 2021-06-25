<?php $__env->startSection('title'); ?>
    <?php echo e(__('Telegram users')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Telegram users')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Telegram users')); ?></h1>
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

                    <table id="users" class="table hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('User')); ?></th>
                            <th><?php echo e(__('Bot')); ?></th>
                            <th><?php echo e(__('Created at')); ?></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
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
        var table = $('#users').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": '<?php echo e(route('admin.telegram.users.datatable')); ?>',
            "columns": [
                {
                    "data": 'user_name', "orderable": false, "searchable": false, "render": function (data, type, row, meta) {
                        return '<a href="/admin/users/' + row['user_id'] + '" target="_blank" style="font-weight:bold;"> '+ row['user_name'] +'</a>';
                    }
                },
                {
                    "data": 'bot_username', "orderable": false, "searchable": false, "render": function (data, type, row, meta) {
                        return '<a href="/admin/telegram/bots/' + row['bot_id'] + '/edit" target="_blank"> '+ row['bot_username'] +'</a>';
                    }
                },
                {"data": "created_at", "name": "telegram_users.created_at"},
            ],
            "dom": 'Rlfrtip',
            initComplete: function () {
                this.api().columns([2]).every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                        .on('keyup', function () {
                            column.search($(this).val(), false, false, true).draw();
                        });
                });
            }
        });

        $('#users tbody').on('click', 'tr', function () {
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