



<?php $__env->startSection('title','App Kanban'); ?>


<?php $__env->startSection('vendor-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/jkanban/jkanban.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/quill/quill.snow.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/chartist-js/chartist.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/chartist-js/chartist-plugin-tooltip.css')); ?>">
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
  <div class="sidebar-left sidebar-fixed">
    <div class="sidebar">
      <div class="sidebar-content">
        <div class="sidebar-header">
          <div class="sidebar-details">
            <h5 class="m-0 sidebar-title">
              <i class="material-icons app-header-icon text-top">receipt</i>
              Обмен валют
            </h5>
            <div class="mt-10 pt-2">
              <p class="m-0 subtitle font-weight-700">Общее количество обменов</p>
              <p class="m-0 text-muted"><?php echo e($exchanges_count ?? 0); ?></p>
            </div>
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
        <table class="display card card card-default scrollspy border-radius-6">
          <thead>
            <tr>
              <th class="pl-2">Пользователь</th>
              <th>Сколько внёс</th>
              <th>Сколько получил</th>
              <th>Комиссия</th>
              <th>Дата открытия</th>
            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $currency_exchange; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td class="pl-2"><?php echo e($item->user->login); ?></td>
                <td>
                  <span class="display-block"><?php echo e($item->amount_out); ?><?php echo e($item->currency_out()->first()->symbol); ?></span>
                  <span class="badge border-round gradient-45deg-purple-deep-orange gradient-shadow"><?php echo e($item->main_currency_amount_out); ?>$</span>
                </td>
                <td>
                  <span class="display-block"><?php echo e($item->amount_in); ?><?php echo e($item->currency_in()->first()->symbol); ?></span>
                  <span class="badge border-round gradient-45deg-purple-deep-orange gradient-shadow"><?php echo e($item->main_currency_amount_in); ?>$</span>
                </td>
                <td>
                  <?php echo e($item->commission); ?>$
                </td>
                <td><?php echo e($item->created_at->format("d.m.Y H:i:s")); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
        <?php echo e($currency_exchange->links()); ?>

      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('vendor-script'); ?>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-script'); ?>
  <script>
  
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/pages/currency-exchanges/index.blade.php ENDPATH**/ ?>