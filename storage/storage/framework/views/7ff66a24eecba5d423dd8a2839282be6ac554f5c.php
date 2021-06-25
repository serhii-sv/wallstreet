<?php $__env->startSection('title'); ?>
    <?php echo e(__('Withdrawal requests')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Withdrawal requests')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Withdrawal requests')); ?></h1>
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
                        <form method="POST"
                              action="<?php echo e(route('admin.requests.approve-many')); ?>">
                            <?php echo e(csrf_field()); ?>

                            <table class="table table-custom" id="wrs-table">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('Currency')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment system')); ?></th>
                                    <th><?php echo e(__('Wallet')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('User')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>

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
                                    <td class="tdinput">
                                        <b><?php echo e(__('Selected requests')); ?>:</b>
                                        <button id="singlebutton" name="approve" value="true"
                                                class="btn btn-xs btn-primary sure"><?php echo e(__('Approve')); ?></button>
                                        <button id="singlebutton" name="approveManually" value="true"
                                                class="btn btn-xs btn-default sure"><?php echo e(__('Approve manually')); ?></button>
                                        <button id="singlebutton" name="reject" value="true"
                                                class="btn btn-xs btn-warning sure"><?php echo e(__('reject')); ?></button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
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
    var table = $('#wrs-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": '<?php echo e(route('admin.requests.dtdata')); ?>',
        "columns": [
            {"data": "code", "name": "currencies.code"},
            {
                "data": "amount", "name": "withdrawal_requests.amount", "render": function (data, type, row, meta) {
                    return '<strong>'+ row['amount'] +'</strong>';
                }
            },
            {"data": "name", "name": "payment_systems.name"},
            {"data": "external", "name": "wallets.external"},
            {"data": "status", "name": "withdrawal_requests.status"},
            {"data": "username", "name": "users.name"},
            {
                "data": 'action', "orderable": false, "searchable": false, "render": function (data, type, row, meta) {
                    return '<input type="checkbox" name="list[]" value="' + row['id'] + '"> &nbsp; <a href="/admin/requests/' + row['id'] + '" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a> &nbsp; <a href="/admin/requests/approve/' + row['id'] + '" class="btn btn-xs btn-success sure"><i class="glyphicon glyphicon-check"></i> <?php echo e(__('Approve')); ?></a> &nbsp; <a href="/admin/requests/approveManually/'+ row['id'] +'" class="btn btn-xs btn-default sure"><i class="glyphicon glyphicon-check"></i> <?php echo e(__('Approve manually')); ?></a> &nbsp; <a href="/admin/requests/reject/' + row['id'] + '" class="btn btn-xs btn-warning sure"><i class="glyphicon glyphicon-check"></i> <?php echo e(__('reject')); ?></a>';
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

    $('#wrs-table tbody').on('click', 'tr', function () {
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