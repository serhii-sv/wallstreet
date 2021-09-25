



<?php $__env->startSection('title','App Contact'); ?>


<?php $__env->startSection('vendor-style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/flag-icon/css/flag-icon.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/data-tables/css/jquery.dataTables.min.css')); ?>">
    <link rel="stylesheet" type="text/css"
          href="<?php echo e(asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/app-sidebar.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/app-contacts.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <!-- Sidebar Area Starts -->
    <div class="sidebar-left sidebar-fixed">
        <div class="sidebar">
            <div class="sidebar-content">
                <div class="sidebar-header">
                    <div class="sidebar-details">
                        <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">receipt</i>
                            Транзакции
                        </h5>
                        <div class="mt-10 pt-2">
                            <p class="m-0 subtitle font-weight-700">Общее количество транзакций</p>
                            <p class="m-0 text-muted"><?php echo e($transactions_count ?? 0); ?></p>
                        </div>
                    </div>
                </div>
                <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
                    <div class="sidebar-list-padding app-sidebar " id="contact-sidenav">
                        <ul class="contact-list display-grid">
                            <li class="sidebar-title">Типы</li>
                            <li <?php if(empty(request()->get('type'))): ?> class="active" <?php endif; ?>>
                                <a href="<?php echo e(route('transactions.index')); ?>" class="text-sub">
                                    <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                    Все
                                </a>
                            </li>
                            <?php $__empty_1 = true; $__currentLoopData = $transaction_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li <?php if(request()->get('type') === $type->id): ?> class="active" <?php endif; ?>>
                                    <a href="<?php echo e(route('transactions.index', array_add(request()->except('page', 'type'),'type', $type->id) )); ?>"
                                       class="text-sub">
                                        <i class=" material-icons small-icons mr-2">fiber_manual_record</i>
                                        <?php echo e(__('locale.' . $type->name)); ?>

                                    </a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
                        class="material-icons">menu</i></a>
            </div>
        </div>
    </div>
    <!-- Sidebar Area Ends -->

    <!-- Content Area Starts -->
    <div class="content-area content-right">
        <div class="app-wrapper">
            <div class="card-content p-0">
                <table id="transactions" class="display card card card-default scrollspy border-radius-6">
                    <thead>
                    <tr>
                        <th>Пользователь</th>
                        <th>Тип</th>
                        <th>Сумма</th>
                        <th>Платёжная система</th>
                        <th>Дата операции</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Content Area Ends -->

<?php $__env->stopSection(); ?>


<?php $__env->startSection('vendor-script'); ?>
    <script src="<?php echo e(asset('vendors/data-tables/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-script'); ?>
    <script src="<?php echo e(asset('js/scripts/app-contacts.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scripts/app-invoice.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<style>
    #transactions th {
        white-space: break-spaces;
    }
</style>


<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/pages/transactions/index.blade.php ENDPATH**/ ?>