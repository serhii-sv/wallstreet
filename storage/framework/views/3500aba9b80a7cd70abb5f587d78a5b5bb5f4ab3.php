



<?php $__env->startSection('title','App Invoice List'); ?>


<?php $__env->startSection('vendor-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/data-tables/css/jquery.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/sweetalert/sweetalert.css')); ?>">
  <link rel="stylesheet" type="text/css"
      href="<?php echo e(asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/data-tables/css/dataTables.checkboxes.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/app-invoice.css')); ?>">
  <style>
    .preloader-wrapper-div{
        padding: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
  </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <!-- Modal Structure -->
  <div id="modal" class="modal bottom-sheet">
    <div class="preloader-wrapper-div">
      <div class="preloader-wrapper active">
        <div class="spinner-layer spinner-red-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- invoice list -->
  <section class="invoice-list-wrapper section">
    
    <!-- create invoice button-->
    <div class="invoice-filter-action mr-2">
      <a href="/withdrawals?type=0" class="btn <?php echo e(request()->type == 0 || is_null(request()->type) ? 'active' : ''); ?> waves-effect waves-light invoice-export border-round z-depth-4">
        <i class="material-icons">attach_money</i>
        <span class="hide-on-small-only">Неоплаченные</span>
      </a>
    </div>
    <!-- create invoice button-->
    <div class="invoice-create-btn mr-2">
      <a href="/withdrawals?type=1" class="btn <?php echo e(request()->type == 1 ? 'active' : ''); ?> waves-effect waves-light invoice-create border-round z-depth-4">
        <i class="material-icons">beenhere</i>
        <span class="hide-on-small-only">Оплаченные</span>
      </a>
    </div>
    
    <div class="invoice-create-btn">
      <a href="/withdrawals?type=2" class="btn <?php echo e(request()->type == 2 ? 'active' : ''); ?> waves-effect waves-light invoice-create border-round z-depth-4">
        <i class="material-icons">block</i>
        <span class="hide-on-small-only">Отмененные</span>
      </a>
    </div>
    <!-- Options and filter dropdown button-->
    <div class="filter-btn">
      <!-- Dropdown Trigger -->
      <a class='dropdown-trigger btn waves-effect waves-light purple darken-1 border-round' href='#' data-target='btn-filter'>
        <span class="hide-on-small-only">Фильтрация</span>
        <i class="material-icons">keyboard_arrow_down</i>
      </a>
      <!-- Dropdown Structure -->
      <ul id='btn-filter' class='dropdown-content'>
        <?php $__empty_1 = true; $__currentLoopData = $filter_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li>
          <a href="<?php echo e(request()->fullUrlWithQuery(['user'=> $user->id])); ?>" class="<?php echo e(request()->user == $user->id ? 'active' : ''); ?>">
            <?php echo e($user->name); ?>

          </a>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php endif; ?>
      </ul>
    </div>
    <?php echo $__env->make('panels.inform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="responsive-table">
      <form id="transactionsForm" action="/withdrawals/approve-many" method="post">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="type">
        <table class="table invoice-data-table white border-radius-4 pt-1">
          <thead>
            <tr>
              <!-- data table responsive icons -->
              <th></th>
              <!-- data table checkbox -->
              <th></th>
              <th>
                <span>Email#</span>
              </th>
              <th>
                <span>Login#</span>
              </th>
              <th>
                <span>Upliner</span>
              </th>
              <th>Сумма</th>
              <th>Дата</th>
              <th>Реквизиты</th>
              <th style="width: 120px !important;">Действия</th>
              <th></th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </form>
    </div>
  </section>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('vendor-script'); ?>
  <script src="<?php echo e(asset('vendors/data-tables/js/jquery.dataTables.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/sweetalert/sweetalert.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/data-tables/js/datatables.checkboxes.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-script'); ?>
  <script src="<?php echo e(asset('js/scripts/app-invoice.js')); ?>"></script>
  <script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
  <script>
    $(function () {
      $(document).ready(function () {
        $(document).on('mouseenter', '.tooltipped', function () {
          $(this).tooltip();
        })
      });
    })
  </script>
  <script>
    $(document).ready(function () {
      $("body").on('click', '.external-block', function (e) {
        $('#modal').empty();
        $('#modal').append('<div class="preloader-wrapper-div">' +
            '<div class="preloader-wrapper active">' +
            '<div class="spinner-layer spinner-red-only">' +
            '<div class="circle-clipper left">' +
            '<div class="circle"></div>' +
            '</div>' +
            '<div class="gap-patch">' +
            '<div class="circle"></div>' +
            '</div>' +
            '<div class="circle-clipper right">' +
            '<div class="circle"></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
        $('#modal').modal('open');
        var $external = $(this).attr('data-external');
        var $url = "<?php echo e(route('ajax.bin.check')); ?>";
        $.ajax({
          type: 'post',
          url: $url,
          data: 'card_number=' + $external,
          headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
          },
          success: function (data) {
            data = $.parseJSON(data);
            if (data.status === 'good') {
              $('#modal').empty();
              $('#modal').append(data.html);
            } else if (data.status === 'bad') {
              $('#modal').modal('close');
              M.toast({
                html: data.msg,
                classes: 'red'
              });
            }
            
          }
        });
        
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/pages/withdrawals/index.blade.php ENDPATH**/ ?>