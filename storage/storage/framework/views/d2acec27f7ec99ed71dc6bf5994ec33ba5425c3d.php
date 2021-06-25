<?php $__env->startSection('title', __('Affiliate program')); ?>
<?php $__env->startSection('content'); ?>
    <div class="card card-outline-secondary">
        <div class="card-header">
            <strong><?php echo e(__('Hi')); ?>, <?php echo e(getUserName()); ?></strong>
            <strong style="float:right;"><?php echo e(__('Your balance')); ?>:
                <?php $__currentLoopData = getUserBalancesByCurrency(true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $symbol => $balance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($symbol); ?> <?php echo e(number_format($balance, 2)); ?><?php echo e(!$loop->last ? ',' : ''); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </strong>
        </div>
        <div class="card-body">
            <?php echo $__env->make('partials.inform', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php if(!empty(getPartnerArray())): ?>
                <p class="help-block">
                    <?php echo e(__('You invited by')); ?>: <?php echo e(getPartnerArray()['login']); ?>

                    <br>Email: <a href="mailto:<?php echo e(getPartnerArray()['email']); ?>"
                                  target="_blank"><?php echo e(getPartnerArray()['email']); ?></a>
                    <?php if(getPartnerArray()['skype']): ?>
                        Skype: <a href="skype:<?php echo e(getPartnerArray()['skype']); ?>"><?php echo e(getPartnerArray()['skype']); ?></a>
                    <?php endif; ?>
                    <?php if(getPartnerArray()['phone']): ?>
                        <?php echo e(__('Phone')); ?>: <a
                                href="skype:<?php echo e(getPartnerArray()['phone']); ?>"><?php echo e(getPartnerArray()['phone']); ?></a>
                    <?php endif; ?>
                </p>
            <?php endif; ?>
            <hr>
            <?php if(getUserReferrals(1)): ?>
                <h3><?php echo e(__('Referrals tree')); ?></h3>
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
                <script src="https://d3js.org/d3.v3.min.js"></script>
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

                    d3.json("<?php echo e(route('users.reftree')); ?>", function (error, flare) {
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
            <?php else: ?>
                <div class="alert alert-danger"
                     role="alert"><?php echo e(__('Referrals tree visualization can not be created. You don\'t have any referrals.')); ?></div>
            <?php endif; ?>
            <hr>
            <h3><?php echo e(__('Affiliate earnings operations list')); ?></h3>
            <table class="table table-striped" id="operations-table" style="width:100%;">
                <thead>
                <tr>
                    <th><?php echo e(__('Amount')); ?></th>
                    <th><?php echo e(__('Currency')); ?></th>
                    <th><?php echo e(__('From')); ?></th>
                    <th><?php echo e(__('Approved')); ?></th>
                    <th><?php echo e(__('Date')); ?></th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
    <!-- /.card -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('load-scripts'); ?>
    <script>
        //initialize basic datatable
        jQuery('#operations-table').width('100%').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[4, "desc"]],
            "ajax": '<?php echo e(route('profile.operations.dataTable', ['type' => 'partner'])); ?>',
            "columns": [
                {
                    "data": 'amount',
                    "orderable": true,
                    "searchable": true,
                    "render": function (data, type, row, meta) {
                        return row['amount'] + row['currency']['symbol'];
                    }
                },
                {"data": "currency.name"},
                {"data": "partner_from"},
                {
                    "data": "approved", "render": function (data, type, row, meta) {
                        if (row['approved'] == 1) {
                            return '<?php echo e(__('yes')); ?>';
                        }
                        return '<?php echo e(__('no')); ?>';
                    }
                },
                {"data": "created_at"},
            ],
        });
        //*initialize basic datatable
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.profile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>