<?php $__env->startSection('title'); ?>
    <?php echo e(__('Backups')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumbs'); ?>
    <li> <?php echo e(__('Backups')); ?></li>
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
                    <h1 class="custom-font"><?php echo e(__('Backups')); ?></h1>
                    <ul class="controls">
                        <li>
                            <a role="button" href="<?php echo e(route('admin.backup.backupDB')); ?>"
                               style="font-weight: bold;"><?php echo e(__('Backup DB')); ?>

                            </a>
                        </li>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.backup.backupFiles')); ?>"
                               style="font-weight: bold;"><?php echo e(__('Backup files')); ?>

                            </a>
                        </li>
                        <li>
                            <a role="button" href="<?php echo e(route('admin.backup.backupAll')); ?>"
                               style="font-weight: bold;"><?php echo e(__('Backup everything')); ?>

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
                    <ul class="list-group">
                        <table id="backups" class="table hover form-inline dt-bootstrap no-footer">
                            <thead>
                            <tr>
                                <th><?php echo e(__('File')); ?></th>
                                <th><?php echo e(__('Actions')); ?></th>
                            </tr>
                            </thead>
                            <?php $__currentLoopData = $files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tbody>
                                <td>
                                    <form action="<?php echo e(route('admin.backup.download')); ?>" method="POST" target="_blank">
                                        <?php echo e(csrf_field()); ?>

                                        <input type="hidden" name="file" value="<?php echo e($file); ?>">
                                        <input type="submit"
                                               value="<?php echo e(\Illuminate\Support\Facades\Storage::url($file)); ?>"
                                               class="btn btn-default">
                                    </form>
                                </td>
                                <td><a type="button" class="btn btn-danger btn-xs sure"
                                       href="<?php echo e(route('admin.backup.destroy', ['file' => $file])); ?>"><?php echo e(__('destroy file')); ?></a>
                                </td>
                                </tbody>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </table>
                        <?php $__env->startPush('load-scripts'); ?>
                            <script>
                                $('#backups').DataTable();
                            </script>
                        <?php $__env->stopPush(); ?>
                    </ul>
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