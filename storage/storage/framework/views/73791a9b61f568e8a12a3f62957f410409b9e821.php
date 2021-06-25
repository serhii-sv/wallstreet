<?php $__env->startSection('title'); ?>
    <?php echo e(__('Template translations')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Template translations')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Template translations')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button"
                               href="<?php echo e(route('admin.tpl_texts.index',['category'=>'customer'])); ?>"><?php echo e(__('customer texts')); ?>

                            </a>
                        </li>
                        <li>
                            <a role="button"
                               href="<?php echo e(route('admin.tpl_texts.index',['category'=>'admin'])); ?>"><?php echo e(__('admin texts')); ?>

                            </a>
                        </li>
                        <li>
                            <a role="button"
                               href="<?php echo e(route('admin.tpl_texts.index',['category'=>'demo'])); ?>"><?php echo e(__('demo texts')); ?>

                            </a>
                        </li>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.tpl_texts.create')); ?>"
                               style="font-weight: bold;">[<?php echo e(__('add new text')); ?>]
                            </a>
                        </li>
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
                        <table class="table table-custom" id="translations-table">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Text')); ?></th>
                                <th><?php echo e(__('Language')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $texts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($text->text); ?></td>
                                    <td style="font-weight: bold;"><?php echo e($text->lang->name); ?></td>
                                    <td>
                                        <a type="button" class="btn btn-primary btn-xs" style="display:block;"
                                           href="<?php echo e(route('admin.tpl_texts.edit', ['id' => $text->id])); ?>"><?php echo e(__('edit')); ?></a>
                                        <a type="button" class="btn btn-warning btn-xs"
                                           style="display: block; margin-top:5px;" href="#" onclick="
                                                var result = confirm('<?php echo e(__('Please confirm deletion')); ?>');
                                                if(result) {
                                                event.preventDefault();
                                                document.getElementById('delete-<?php echo e($text->id); ?>').submit()
                                                }"><?php echo e(__('delete')); ?></a>
                                        <form action="<?php echo e(route('admin.tpl_texts.destroy', ['id' => $text->id])); ?>"
                                              method="POST"
                                              id="delete-<?php echo e($text->id); ?>" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
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
    <script>
        //initialize basic datatable
        var table = $('#translations-table').DataTable({
            "order": [[0, "desc"]],
        });

        $('#translations-table tbody').on('click', 'tr', function () {
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
<?php echo $__env->make('admin/layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>