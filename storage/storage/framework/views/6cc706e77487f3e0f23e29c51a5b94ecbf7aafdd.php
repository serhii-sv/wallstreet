<?php $__env->startSection('title'); ?><?php echo e(__('User profile')); ?>: <?php echo e($user->name); ?><?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <a href="<?php echo e(route('admin.users.index')); ?>"><?php echo e(__('Users list')); ?></a></li>
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

                    <ul class="list-group">
                        <li class="list-group-item">
                            <?php echo e(__('First name')); ?>:
                            <strong style="float:right;"><?php echo e($user->name); ?></strong>
                        </li>
                        <li class="list-group-item">
                            E-mail:
                            <strong style="float:right;">
                                <a href="mailto:<?php echo e($user->email); ?>" target="_blank"><?php echo e($user->email); ?></a>
                            </strong>
                        </li>
                        <li class="list-group-item">
                            Name:
                            <strong style="float:right;">value</strong>
                        </li>
                        <li class="list-group-item">
                            Name:
                            <strong style="float:right;">value</strong>
                        </li>
                        <li class="list-group-item">
                            Name:
                            <strong style="float:right;">value</strong>
                        </li>
                    </ul>
                    <label>Referral link:</label>
                    <input type="text" class="form-control" value="<?php echo e(route('partner',['partner_id'=>$user->my_id])); ?>" disabled>
                    <p><?php echo e(__('Roles')); ?>: <?php echo e($user->getRoleNames()); ?>

                        <?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e($role); ?>,
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </p>
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
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Wallets'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" tabindex="0" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th><?php echo app('translator')->getFromJson('Balance'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Currency'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Payment System'); ?></th>
                            <th><?php echo app('translator')->getFromJson('External ID'); ?></th>
                            <th><?php echo app('translator')->getFromJson('Accrue bonus'); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $user->wallets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $wallet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($wallet->balance); ?>

                                    <?php if($wallet->requestedAmount()): ?>
                                        <br> <span class="help-block" title="<?php echo app('translator')->getFromJson('requested'); ?>">
                                            <?php echo e($wallet->requestedAmount()); ?> </span><?php endif; ?>
                                </td>
                                <td><?php echo e($wallet->currency->code); ?></td>
                                <td><?php echo e($wallet->paymentSystem->name); ?></td>
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
                                                                 type="button"><?php echo app('translator')->getFromJson('Add'); ?></button>
                                                    </span>
                                                        <input id="amount" type="number" step="any" min="0"
                                                               class="form-control"
                                                               name="amount" placeholder="amount" required>
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
            <!-- /tile -->
        </div>

        <div class="col-md-12">
            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Withdrawal requests'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
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
                                    <th><?php echo app('translator')->getFromJson('Amount'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Currency'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Payment system'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Status'); ?></th>
                                    <th><?php echo app('translator')->getFromJson('Action'); ?></th>

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
                                        <b><?php echo app('translator')->getFromJson('Selected'); ?>:</b>
                                        <button id="singlebutton" name="approve" value="true"
                                                class="btn btn-xs btn-primary"><?php echo app('translator')->getFromJson('Approve'); ?></button>
                                        <button id="singlebutton" name="reject" value="true"
                                                class="btn btn-xs btn-warning"><?php echo app('translator')->getFromJson('Reject'); ?></button>
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

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Deposits'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
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
                                <th><?php echo app('translator')->getFromJson('Status'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Invested'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Currency'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Duration, days'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Rate'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Opened'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Action'); ?></th>
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
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Transactions'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
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
                                <th><?php echo app('translator')->getFromJson('Type'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Amount'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Currency'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Approved'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Created'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Action'); ?></th>

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
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Referrals'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->
                <!-- tile body -->
                <div class="tile-body">
                    <?php if($user->hasReferrals()): ?>

                        <div class="row">
                            <div class="col-md-6">
                                <p><?php echo app('translator')->getFromJson('Referral levels'); ?>:
                                    <?php $__currentLoopData = $user->getLevels(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $counter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('admin.users.show', ['id' => $user->id, 'level' => $counter])); ?>">
                                            <?php echo e($counter); ?> </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </p>
                                <p><?php echo app('translator')->getFromJson('Referrals on level'); ?> <?php echo e($level); ?>

                                    (<?php echo app('translator')->getFromJson('interest'); ?>
                                    : <?php echo app('translator')->getFromJson('on recharge'); ?> <?php echo e($user->getReferralOnLoadPercent($level)); ?> %,
                                    <?php echo app('translator')->getFromJson('on profit'); ?> <?php echo e($user->getReferralOnProfitPercent($level)); ?>%):</p>
                                <ol>
                                    <?php $__currentLoopData = $user->getReferralsOnLevel($level); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><a href="<?php echo e(route('admin.users.show',['id'=>$ref['id']])); ?>">
                                                <?php echo e($ref['name']); ?></a> &nbsp;&nbsp;&nbsp; <?php echo e($ref['email']); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <?php $__currentLoopData = $user->getReferrals(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $__env->make('admin.users.referrals', ['user' => $referral], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>

                            </div>
                        </div>
                    <?php else: ?>
                        <h3><?php echo app('translator')->getFromJson('You haven`t any referrals yet'); ?></h3>
                    <?php endif; ?>
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
                        <script src="//d3js.org/d3.v3.min.js"></script>
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
                                .projection(function(d) { return [d.y, d.x]; });

                            var svg = d3.select("ref").append("svg")
                                .attr("width", width + margin.right + margin.left)
                                .attr("height", height + margin.top + margin.bottom)
                                .append("g")
                                .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

                            d3.json("<?php echo e(route('admin.users.reftree',['id'=>$user->id])); ?>", function(error, flare) {
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
                                nodes.forEach(function(d) { d.y = d.depth * 100; });

                                // Update the nodes…
                                var node = svg.selectAll("g.node")
                                    .data(nodes, function(d) { return d.id || (d.id = ++i); });

                                // Enter any new nodes at the parent's previous position.
                                var nodeEnter = node.enter().append("g")
                                    .attr("class", "node")
                                    .attr("transform", function(d) { return "translate(" + source.y0 + "," + source.x0 + ")"; })
                                    .on("click", click);

                                nodeEnter.append("circle")
                                    .attr("r", 1e-6)
                                    .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

                                nodeEnter.append("text")
                                    .attr("x", function(d) { return d.children || d._children ? -10 : 10; })
                                    .attr("dy", ".35em")
                                    .attr("text-anchor", function(d) { return d.children || d._children ? "end" : "start"; })
                                    .text(function(d) { return d.name; })
                                    .style("fill-opacity", 1e-6);

                                // Transition nodes to their new position.
                                var nodeUpdate = node.transition()
                                    .duration(duration)
                                    .attr("transform", function(d) { return "translate(" + d.y + "," + d.x + ")"; });

                                nodeUpdate.select("circle")
                                    .attr("r", 4.5)
                                    .style("fill", function(d) { return d._children ? "lightsteelblue" : "#fff"; });

                                nodeUpdate.select("text")
                                    .style("fill-opacity", 1);

                                // Transition exiting nodes to the parent's new position.
                                var nodeExit = node.exit().transition()
                                    .duration(duration)
                                    .attr("transform", function(d) { return "translate(" + source.y + "," + source.x + ")"; })
                                    .remove();

                                nodeExit.select("circle")
                                    .attr("r", 1e-6);

                                nodeExit.select("text")
                                    .style("fill-opacity", 1e-6);

                                // Update the links…
                                var link = svg.selectAll("path.link")
                                    .data(links, function(d) { return d.target.id; });

                                // Enter any new links at the parent's previous position.
                                link.enter().insert("path", "g")
                                    .attr("class", "link")
                                    .attr("d", function(d) {
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
                                    .attr("d", function(d) {
                                        var o = {x: source.x, y: source.y};
                                        return diagonal({source: o, target: o});
                                    })
                                    .remove();

                                // Stash the old positions for transition.
                                nodes.forEach(function(d) {
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
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Page views'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
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
                                <th><?php echo app('translator')->getFromJson('IP'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Location'); ?></th>
                                <th><?php echo app('translator')->getFromJson('Date'); ?></th>
                                <th><?php echo app('translator')->getFromJson('URL'); ?></th>
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
            <!-- /tile -->

            <!-- tile -->
            <section class="tile">
                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font"><?php echo app('translator')->getFromJson('Log'); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> Fullscreen
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->
                <!-- tile body -->
                <div class="tile-body">
                    <textarea rows="7" style="width:100%;" disabled=""><?php echo e($user->log); ?></textarea>
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
    var table = $('#transactions-table').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [[4, "desc"]],
    "ajax": '<?php echo e(route('admin.users.dt-transactions',['user_id'=>$user->id])); ?>',
    "columns": [
    {"data": "type.name"},
    {"data": "amount"},
    {"data": "currency.code"},
    {"data": "approved"},
    {"data": "created_at"},
    {"data": 'action', "orderable": false, "searchable": false}
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
    //*initialize basic datatable

    var table = $('#deposits-table').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [[5, "desc"]],
    "ajax": '<?php echo e(route('admin.users.dt-deposits',['user_id'=>$user->id])); ?>',
    "columns": [
    {"data": "condition"},
    {"data": "invested"},
    {"data": "currency.code"},
    {"data": "duration"},
    {"data": "rate.name"},
    {"data": "created_at"},
    {"data": 'action', "orderable": false, "searchable": false}
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

    var table = $('#wrs-table').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": '<?php echo e(route('admin.users.dt-wrs',['user_id'=>$user->id])); ?>',
    "columns": [
    {"data": "amount", "name": "withdrawal_requests.amount"},
    {"data": "code", "name": "currencies.code"},
    {"data": "name", "name": "payment_systems.name"},
    {"data": "status", "name": "withdrawal_requests.status"},
    {"data": 'action', "orderable": false, "searchable": false}
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


    var table = $('#pvs-table').DataTable({
    "processing": true,
    "serverSide": true,
    "order": [[2, "desc"]],
    "ajax": '<?php echo e(route('admin.users.dt-pvs',['user_id'=>$user->id])); ?>',
    "columns": [
    {"data": "user_ip"},
    {"data": "location", "orderable": false, "searchable": false},
    {"data": "created_at"},
    {"data": "page_url"}
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

    

<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>