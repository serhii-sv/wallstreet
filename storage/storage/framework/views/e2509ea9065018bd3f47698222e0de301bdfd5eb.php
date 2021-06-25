<?php $__env->startSection('title'); ?><?php echo e(__('User profile')); ?>: <?php echo e($user->name); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li><a href="<?php echo e(route('admin.users.index')); ?>"><?php echo e(__('Users list')); ?></a></li>
    <li> <?php echo e(__('User profile')); ?>: <?php echo e($user->login); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-4">
            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('User profile')); ?></h1>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Name:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <?php echo e($user->name); ?>

                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('E-mail:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <a href="mailto:<?php echo e($user->email); ?>" target="_blank"><?php echo e($user->email); ?></a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Login:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <?php echo e($user->login); ?>

                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Phone:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <a href="tel:<?php echo e($user->phone); ?>" target="_blank"><?php echo e($user->phone); ?></a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Skype:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <a href="skype:<?php echo e($user->skype); ?>" target="_blank"><?php echo e($user->skype); ?></a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Partner ID:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <a href="<?php echo e(route('admin.users.show', ['id'=>$user->getPartnerOnLevel(1)->id??'']) ?? ''); ?>"
                                       target="_blank"><?php echo e($user->getPartnerOnLevel(1)->login ?? ''); ?></a>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <?php echo e(__('Registration:')); ?>

                                </div>
                                <div class="col-lg-7" style="font-weight:bold;">
                                    <strong data-toggle="tooltip" data-placement="top"
                                            title="<?php echo e(\Carbon\Carbon::parse($user->created_at)->diffForHumans()); ?>"><?php echo e($user->created_at); ?></strong>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <strong><?php echo e(__('Referral link:')); ?></strong>
                    <input type="text" class="form-control" value="<?php echo e(route('partner',['partner_id'=>$user->my_id])); ?>"
                           readonly>
                    <hr>
                    <a href="<?php echo e(route('admin.users.edit', ['id' => $user->id])); ?>" target="_top"
                       class="btn btn-primary btn-large" style="display: block;"><?php echo e(__('Edit user')); ?></a>
                    <a href="<?php echo e(route('admin.impersonate', ['id' => $user->id])); ?>" style="margin-top:3px; width:100%;" target="_top"
                       class="btn btn-default btn-large" style="display: block;"><?php echo e(__('Impersonate user')); ?></a>
                    <form action="<?php echo e(route('admin.users.destroy', ['id' => $user->id])); ?>" method="POST" target="_top">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger btn-large sure form-control"
                               style="display: block; margin-top:5px;" value="<?php echo e(__('Destroy user')); ?>">
                    </form>
                    <hr>
                    <?php if($user->getRoleNames()->count() > 0): ?>
                        <p><?php echo e(__('Roles')); ?>:
                            <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <strong><?php echo e($role); ?></strong><?php echo e(!$loop->last ? ', ' : ''); ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </p>
                    <?php endif; ?>
                </div>
                <!-- /tile body -->
            </section>
            <!-- /tile -->
        </div>
        <div class="col-md-8">
            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Wallets')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" tabindex="0" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> <?php echo e(__('Fullscreen')); ?>

                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <table id="wallets" class="dataTables_wrapper hover form-inline dt-bootstrap no-footer">
                        <thead>
                        <tr>
                            <th><?php echo e(__('Balance')); ?></th>
                            <th><?php echo e(__('Payment system')); ?></th>
                            <th><?php echo e(__('Currency')); ?></th>
                            <th><?php echo e(__('Wallet address')); ?></th>
                            <th><?php echo e(__('Actions')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $user->wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><strong data-toggle="tooltip" data-placement="top"
                                            title="<?php echo e(__('Current balance')); ?>"><?php echo e($wallet->balance); ?><?php echo e($wallet->currency->symbol); ?></strong>
                                    <?php if($wallet->requestedAmount()): ?>
                                        <br> <strong class="help-block" data-toggle="tooltip" data-placement="left"
                                                     title="<?php echo e(__('Requested amount')); ?>"><?php echo e($wallet->requestedAmount()); ?><?php echo e($wallet->currency->symbol); ?></strong>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('admin.payment-systems.edit', ['id' => $wallet->paymentSystem->id])); ?>"
                                       target="_blank"><?php echo e($wallet->paymentSystem->name); ?></a></td>
                                <td><a href="<?php echo e(route('admin.currencies.edit', ['id' => $wallet->currency->id])); ?>"
                                       target="_blank"><?php echo e($wallet->currency->name); ?></a></td>
                                <td><?php echo e($wallet->external); ?></td>
                                <td>
                                    <form class="form-horizontal" method="POST"
                                          action="<?php echo e(route('admin.users.bonus')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="wallet_id" value="<?php echo e($wallet->id); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="col-sm-10">
                                                    <div class="input-group mb-10">
                                                    <span class="input-group-btn">
                                                         <button class="btn btn-default"
                                                                 type="submit"><?php echo e(__('send bonus')); ?></button>
                                                    </span>
                                                        <input id="amount" type="number" step="any" min="0"
                                                               class="form-control"
                                                               name="amount" placeholder="<?php echo e(__('amount')); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                    <form class="form-horizontal" method="POST"
                                          action="<?php echo e(route('admin.users.penalty')); ?>">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="wallet_id" value="<?php echo e($wallet->id); ?>">
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
                                        <fieldset>
                                            <div class="form-group">
                                                <div class="col-sm-10">
                                                    <div class="input-group mb-10">
                                                    <span class="input-group-btn">
                                                         <button class="btn btn-default"
                                                                 type="submit"><?php echo e(__('send penalty')); ?></button>
                                                    </span>
                                                        <input id="amount" type="number" step="any" min="0"
                                                               class="form-control"
                                                               name="amount" placeholder="<?php echo e(__('amount')); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                </div>
                <!-- /tile body -->
            </section>

            <?php $__env->startPush('load-scripts'); ?>
                <script>
                    $('#wallets').DataTable();
                </script>
        <?php $__env->stopPush(); ?>
        <!-- /tile -->
        </div>

        <div class="col-md-12">
            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Withdraw requests')); ?></h1>
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
                                    <th><?php echo e(__('Payment system')); ?></th>
                                    <th><?php echo e(__('Currency')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
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
                                    <td class="tdinput">
                                        <b><?php echo e(__('selected orders')); ?>:</b>
                                        <button id="singlebutton" name="approve" value="true"
                                                class="btn btn-xs btn-primary"><?php echo e(__('approve')); ?></button>
                                        <button id="singlebutton" name="reject" value="true"
                                                class="btn btn-xs btn-warning"><?php echo e(__('reject')); ?></button>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
                <!-- /tile body -->

            </section>

            <?php $__env->startPush('load-scripts'); ?>
                <script>
                    var table = $('#wrs-table').width('100%').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": '<?php echo e(route('admin.users.dt-wrs',['user_id'=>$user->id])); ?>',
                        "columns": [
                            {"data": "name", "name": "payment_systems.name"},
                            {"data": "code", "name": "currencies.code"},
                            {"data": "amount", "name": "withdrawal_requests.amount"},
                            {"data": "status", "name": "withdrawal_requests.status"},
                            {
                                "data": 'actions',
                                "orderable": false,
                                "searchable": false,
                                "render": function (data, type, row) {
                                    return '<input type="checkbox" name="list[]" value="' + row['id'] + '"> &nbsp; <a href="/admin/requests/' + row['id'] + '" class="btn btn-xs btn-primary" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a> &nbsp; <a href="/admin/requests/approve/' + row['id'] + '" class="btn btn-xs btn-success" target="_blank"><i class="glyphicon glyphicon-check"></i> <?php echo e(__('approve')); ?></a> &nbsp;<a href="/admin/requests/reject/' + row['id'] + '" class="btn btn-xs btn-warning" target="_blank"><i class="glyphicon glyphicon-check"></i> <?php echo e(__('reject')); ?></a>';
                                }
                            },
                        ],
                        "aoColumnDefs": [
                            {'bSortable': false, 'aTargets': ["no-sort"]}
                        ],
                        "dom": 'Rlfrtip',
                        initComplete: function () {
                            this.api().columns([0, 1, 2, 3]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                    .on('change', function () {
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
                </script>
            <?php $__env->stopPush(); ?>
        <!-- /tile -->

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"> <?php echo e(__('Deposits')); ?></h1>
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
                        <table class="table table-custom" id="deposits-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Currency')); ?></th>
                                <th><?php echo e(__('Invested')); ?></th>
                                <th><?php echo e(__('Duration days')); ?></th>
                                <th><?php echo e(__('Plan')); ?></th>
                                <th><?php echo e(__('Opened')); ?></th>
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
            <?php $__env->startPush('load-scripts'); ?>
                <script>
                    var table = $('#deposits-table').width('100%').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [[5, "desc"]],
                        "ajax": '<?php echo e(route('admin.users.dt-deposits',['user_id'=>$user->id])); ?>',
                        "columns": [
                            {"data": "condition"},
                            {"data": "currency.code"},
                            {"data": "invested"},
                            {"data": "duration"},
                            {"data": "rate.name"},
                            {"data": "created_at"},
                            {
                                "data": 'actions',
                                "orderable": false,
                                "searchable": false,
                                "render": function (data, type, row) {
                                    return '<a href="/admin/deposits/' + row['id'] + '" class="btn btn-xs btn-primary"  target="_blank"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a>';
                                }
                            },
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

                    $('#deposits-table tbody').on('click', 'tr', function () {
                        if ($(this).hasClass('row_selected')) {
                            $(this).removeClass('row_selected');
                        }
                        else {
                            table.$('tr.row_selected').removeClass('row_selected');
                            $(this).addClass('row_selected');
                        }
                    });
                </script>
            <?php $__env->stopPush(); ?>
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Transactions')); ?></h1>
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
                        <table class="table table-custom" id="transactions-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Type')); ?></th>
                                <th><?php echo e(__('Currency')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Approved')); ?></th>
                                <th><?php echo e(__('Created')); ?></th>
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
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- /tile body -->
            </section>
            <?php $__env->startPush('load-scripts'); ?>
                <script>
                    //initialize basic datatable
                    var table = $('#transactions-table').width('100%').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [[4, "desc"]],
                        "ajax": '<?php echo e(route('admin.users.dt-transactions',['user_id'=>$user->id])); ?>',
                        "columns": [
                            {"data": "type_name"},
                            {"data": "currency.code"},
                            {"data": "amount"},
                            {"data": "approved"},
                            {"data": "created_at"},
                            {
                                "data": 'actions',
                                "orderable": false,
                                "searchable": false,
                                "render": function (data, type, row) {
                                    return '<a href="/admin/transactions/' + row['id'] + '" class="btn btn-xs btn-primary" target="_blank"><i class="glyphicon glyphicon-eye-open"></i> <?php echo e(__('show')); ?></a>';
                                }
                            },
                        ],
                        "aoColumnDefs": [
                            {'bSortable': false, 'aTargets': ["no-sort"]}
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

                    $('#transactions-table tbody').on('click', 'tr', function () {
                        if ($(this).hasClass('row_selected')) {
                            $(this).removeClass('row_selected');
                        }
                        else {
                            table.$('tr.row_selected').removeClass('row_selected');
                            $(this).addClass('row_selected');
                        }
                    });
                    // *initialize basic datatable
                </script>
            <?php $__env->stopPush(); ?>
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Referrals')); ?></h1>
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
                    <style>

                        .node {
                            cursor: pointer;
                        }

                        .node circle {
                            fill: #fff;
                            stroke: steelblue;
                            stroke-width: 1.5px;
                        }

                        .node text {
                            font: 10px sans-serif;
                        }

                        .link {
                            fill: none;
                            stroke: #ccc;
                            stroke-width: 1.5px;
                        }

                    </style>
                    <ref></ref>
                    <script src="/admin_assets/js/vendor/d3/d3.min.js"></script>
                    <script>

                        var margin = {top: 10, right: 10, bottom: 10, left: 10},
                            width = 900 - margin.right - margin.left,
                            height = 500 - margin.top - margin.bottom;

                        var i = 0,
                            duration = 750,
                            root;

                        var tree = d3.layout.tree()
                            .size([height, width]);

                        var diagonal = d3.svg.diagonal()
                            .projection(function (d) {
                                return [d.y, d.x];
                            });

                        var svg = d3.select("ref").append("svg")
                            .attr("width", width + margin.right + margin.left)
                            .attr("height", height + margin.top + margin.bottom)
                            .append("g")
                            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                        d3.json("<?php echo e(route('admin.users.reftree',['id'=>$user->id])); ?>", function (error, flare) {
                            if (error) throw error;

                            root = flare;
                            root.x0 = height / 2;
                            root.y0 = 0;

                            function collapse(d) {
                                if (d.children) {
                                    d._children = d.children;
                                    d._children.forEach(collapse);
                                    d.children = null;
                                }
                            }

                            /*root.children.forEach(collapse);*/
                            update(root);
                        });

                        d3.select(self.frameElement).style("height", "500px");

                        function update(source) {

                            // Compute the new tree layout.
                            var nodes = tree.nodes(root).reverse(),
                                links = tree.links(nodes);

                            // Normalize for fixed-depth.
                            nodes.forEach(function (d) {
                                d.y = d.depth * 100;
                            });

                            // Update the nodes…
                            var node = svg.selectAll("g.node")
                                .data(nodes, function (d) {
                                    return d.id || (d.id = ++i);
                                });

                            // Enter any new nodes at the parent's previous position.
                            var nodeEnter = node.enter().append("g")
                                .attr("class", "node")
                                .attr("transform", function (d) {
                                    return "translate(" + source.y0 + "," + source.x0 + ")";
                                })
                                .on("click", click);

                            nodeEnter.append("circle")
                                .attr("r", 1e-6)
                                .style("fill", function (d) {
                                    return d._children ? "lightsteelblue" : "#fff";
                                });

                            nodeEnter.append("text")
                                .attr("x", function (d) {
                                    return d.children || d._children ? -10 : 10;
                                })
                                .attr("dy", ".35em")
                                .attr("text-anchor", function (d) {
                                    return d.children || d._children ? "end" : "start";
                                })
                                .text(function (d) {
                                    return d.name;
                                })
                                .style("fill-opacity", 1e-6);

                            // Transition nodes to their new position.
                            var nodeUpdate = node.transition()
                                .duration(duration)
                                .attr("transform", function (d) {
                                    return "translate(" + d.y + "," + d.x + ")";
                                });

                            nodeUpdate.select("circle")
                                .attr("r", 4.5)
                                .style("fill", function (d) {
                                    return d._children ? "lightsteelblue" : "#fff";
                                });

                            nodeUpdate.select("text")
                                .style("fill-opacity", 1);

                            // Transition exiting nodes to the parent's new position.
                            var nodeExit = node.exit().transition()
                                .duration(duration)
                                .attr("transform", function (d) {
                                    return "translate(" + source.y + "," + source.x + ")";
                                })
                                .remove();

                            nodeExit.select("circle")
                                .attr("r", 1e-6);

                            nodeExit.select("text")
                                .style("fill-opacity", 1e-6);

                            // Update the links…
                            var link = svg.selectAll("path.link")
                                .data(links, function (d) {
                                    return d.target.id;
                                });

                            // Enter any new links at the parent's previous position.
                            link.enter().insert("path", "g")
                                .attr("class", "link")
                                .attr("d", function (d) {
                                    var o = {x: source.x0, y: source.y0};
                                    return diagonal({source: o, target: o});
                                });

                            // Transition links to their new position.
                            link.transition()
                                .duration(duration)
                                .attr("d", diagonal);

                            // Transition exiting nodes to the parent's new position.
                            link.exit().transition()
                                .duration(duration)
                                .attr("d", function (d) {
                                    var o = {x: source.x, y: source.y};
                                    return diagonal({source: o, target: o});
                                })
                                .remove();

                            // Stash the old positions for transition.
                            nodes.forEach(function (d) {
                                d.x0 = d.x;
                                d.y0 = d.y;
                            });
                        }

                        // Toggle children on click.
                        function click(d) {
                            if (d.children) {
                                d._children = d.children;
                                d.children = null;
                            } else {
                                d.children = d._children;
                                d._children = null;
                            }
                            update(d);
                        }

                    </script>
                </div>
                <!-- /tile body -->
            </section>
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('Registered page requests')); ?></h1>
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
                        <table class="table table-custom" id="pvs-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('IP address')); ?></th>
                                <th><?php echo e(__('Location')); ?></th>
                                <th><?php echo e(__('Request address')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                            </tr>
                            </thead>
                            <style>
                                #pvs-table tbody td div.page_url {
                                    width: 400px;
                                    overflow: auto;
                                }
                            </style>
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

            <?php $__env->startPush('load-scripts'); ?>
                <script>
                    var table = $('#pvs-table').width('100%').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "order": [[2, "desc"]],
                        "ajax": '<?php echo e(route('admin.users.dt-pvs',['user_id'=>$user->id])); ?>',
                        "columns": [
                            {"data": "user_ip"},
                            {"data": "location", "orderable": false, "searchable": false},
                            {
                                "data": "page_url", "render": function (data, type, row) {
                                    return '<textarea class="form-control" readonly>' + row['page_url'] + '</textarea>';
                                }
                            },
                            {"data": "created_at"},
                        ],
                        "aoColumnDefs": [
                            {'bSortable': false, 'aTargets': ["no-sort"]}
                        ],
                        "dom": 'Rlfrtip',
                        initComplete: function () {
                            this.api().columns([0, 2, 3]).every(function () {
                                var column = this;
                                var input = document.createElement("input");
                                $(input).appendTo($(column.footer()).empty())
                                    .on('keyup', function () {
                                        column.search($(this).val(), false, false, true).draw();
                                    });
                            });
                        }
                    });

                    $('#pvs-table tbody').on('click', 'tr', function () {
                        if ($(this).hasClass('row_selected')) {
                            $(this).removeClass('row_selected');
                        }
                        else {
                            table.$('tr.row_selected').removeClass('row_selected');
                            $(this).addClass('row_selected');
                        }
                    });
                </script>
        <?php $__env->stopPush(); ?>
        <!-- /tile -->

            <!-- tile -->
            <section class="tile">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo e(__('User log')); ?></h1>
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
                    <textarea rows="7" style="width:100%;" readonly><?php echo e($user->log); ?></textarea>
                </div>
                <!-- /tile body -->
            </section>
            <!-- /tile -->

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>