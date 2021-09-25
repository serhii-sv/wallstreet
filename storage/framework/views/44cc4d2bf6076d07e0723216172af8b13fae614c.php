<?php $__env->startSection('title','Dashboard Modern'); ?>


<?php $__env->startSection('vendor-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/animate-css/animate.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/chartist-js/chartist.min.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/chartist-js/chartist-plugin-tooltip.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-style'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/dashboard-modern.css')); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo e(asset('css/pages/intro.css')); ?>">
  <style>
      .dashboard-operations-switch {
          margin-top: 30px;
          padding-right: 15px;
          position: relative;
          z-index: 5;
      }

      .dashboard-operations-wrapper {
          position: relative;
      }

      .subscription-table thead th {
          font-weight: 600;
      }

      button.badge {
          border: none;
      }
  </style>
  <style>

      :root {
          --white: #ffffff;
          --light: #f0eff3;
          --black: #000000;
          --dark-blue: #1f2029;
          --dark-light: #353746;
          --red: #da2c4d;
          --yellow: #f8ab37;
          --grey: #ecedf3;
      }

      .checkbox-tools:checked + label,
      .checkbox-tools:not(:checked) + label{
          position: relative;
          display: inline-block;
          padding: 10px 20px;
          /*width: 110px;*/
          font-size: 14px;
          line-height: 20px;
          letter-spacing: 1px;
          margin: 0 auto;
          text-align: center;
          border-radius: 4px;
          overflow: hidden;
          cursor: pointer;
          text-transform: uppercase;
          color: var(--white);
          -webkit-transition: all 300ms linear;
          transition: all 300ms linear;
      }
      .checkbox-tools:not(:checked) + label{
          background-color: var(--dark-light);
          box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
      }
      .checkbox-tools:checked + label{
          background-color: transparent;
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }
      .checkbox-tools:not(:checked) + label:hover{
          box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
      }
      .checkbox-tools:checked + label::before,
      .checkbox-tools:not(:checked) + label::before{
          position: absolute;
          content: '';
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          border-radius: 4px;
          background-image: linear-gradient(45deg, #303f9f, #1976D2);
          z-index: -1;
      }
      .checkbox-tools:checked + label .uil,
      .checkbox-tools:not(:checked) + label .uil{
          font-size: 24px;
          line-height: 24px;
          display: block;
          padding-bottom: 10px;
      }

      .checkbox:checked ~ .section .container .row .col-12 .checkbox-tools:not(:checked) + label{
          background-color: var(--light);
          color: var(--dark-blue);
          box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.05);
      }

      [type="checkbox"]:checked,
      [type="checkbox"]:not(:checked),
      [type="radio"]:checked,
      [type="radio"]:not(:checked){
          position: absolute;
          left: -9999px;
          width: 0;
          height: 0;
          visibility: hidden;
      }
      .checkbox:checked + label,
      .checkbox:not(:checked) + label{
          position: relative;
          /*width: 70px;*/
          display: inline-block;
          padding: 0;
          margin: 0 auto;
          text-align: center;
          height: 6px;
          border-radius: 4px;
         /* background-image: linear-gradient(298deg, var(--red), var(--yellow));*/
          z-index: 100 !important;
      }
      .checkbox:checked + label:before,
      .checkbox:not(:checked) + label:before {
          position: absolute;
          font-family: 'unicons';
          cursor: pointer;
          top: -17px;
          z-index: 2;
          font-size: 20px;
          line-height: 40px;
          text-align: center;
          width: 40px;
          height: 40px;
          border-radius: 50%;
          -webkit-transition: all 300ms linear;
          transition: all 300ms linear;
      }
      .checkbox:not(:checked) + label:before {
          content: '\eac1';
          left: 0;
          color: var(--grey);
          background-color: var(--dark-light);
          box-shadow: 0 4px 4px rgba(0,0,0,0.15), 0 0 0 1px rgba(26,53,71,0.07);
      }
      .checkbox:checked + label:before {
          content: '\eb8f';
          left: 30px;
          color: var(--yellow);
          background-color: var(--dark-blue);
          box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
      }

      .checkbox:checked ~ .section .container .row .col-12 p{
          color: var(--dark-blue);
      }
      .dashboard-send-bonus-btn{
         /* background-image: linear-gradient(45deg, #303f9f, #1976D2);*/
      }
  </style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
  <div class="section">
    
    <div id="chart-dashboard">
      
      <div id="card-stats" class="pt-0">
        <div class="row">
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeLeft">
              <div class="card-content orange lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">person_outline</i> Новые аккаунты</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">За 24 часа:</p> <?php echo e($users['today']); ?></h4>
                <p>Итого: <?php echo e(number_format($users['total'], 0, '.', ',')); ?></p>
              </div>
              <div class="card-action orange">
                <div id="clients-bar" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeLeft">
              <div class="card-content green lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">attach_money</i>Пополнения</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">За 24 часа:</p> $<?php echo e(number_format($enter_transactions_for_24h_sum, 0, '.', ',')); ?>

                </h4>
                <p>Итого: $<?php echo e(number_format($deposit_total_sum, 0, '.', ',')); ?></p>
              </div>
              <div class="card-action green ">
                <div id="sales-compositebar" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeRight">
              <div class="card-content red accent-2 white-text">
                <p class="card-stats-title"><i class="material-icons">attach_money</i> Выводы</p>
                <h4 class="card-stats-number white-text">
                  <p class="no-margin" style="font-size: 14px">За 24 часа:</p> <?php echo e(number_format($withdraw_transactions_for_24h_sum, 0, '.', ',')); ?>

                </h4>
                <p>Итого: <?php echo e(number_format($deposit_total_withdraw, 0, '.', ',')); ?></p>
              </div>
              <div class="card-action red">
                <div id="profit-tristate" class="center-align"></div>
              </div>
            </div>
          
          </div>
          <div class="col s12 m6 l6 xl3">
            <div class="card animate fadeRight">
              <div class="card-content cyan  white-text">
                <p class="card-stats-title"><i class="material-icons">timeline</i> Прибыль</p>
                <h4 class="card-stats-number white-text"><p class="no-margin" style="font-size: 14px">За 24 часа:</p>
                  <?php echo e($profit_transactions_for_24h_sum < 0 ? '-' : ''); ?>

                  $<?php echo e(number_format(abs($profit_transactions_for_24h_sum), 0, '.', ',')); ?></h4>
                <p>Сегодня: <?php echo e($profit_transactions_for_today_sum < 0 ? '-' : ''); ?>

                  $<?php echo e(number_format(abs($profit_transactions_for_today_sum), 0, '.', ',')); ?></p>
              </div>
              <div class="card-action cyan darken-1">
                <div id="invoice-line" class="center-align"></div>
              </div>
            </div>
          
          </div>
        </div>
      </div>
      
      <div class="row mt-1">
        <div class="col s12 m8 l8">
          <div class="card animate fadeUp">
            <div class="card-move-up waves-effect waves-block waves-light">
              <div class="move-up cyan darken-1">
                <div>
                  <span class="chart-title white-text">Статистика</span>
                  <div class="chart-revenue cyan darken-2 white-text">
                    <p class="chart-revenue-total week">
                      $<?php echo e($weeks_deposit_revenue); ?></p>
                    <p class="chart-revenue-total month display-none">
                      $<?php echo e($month_deposit_revenue); ?></p>
                    <p class="chart-revenue-per week">
                      <i class="material-icons"><?php if($week_revenue_percent>=0): ?> arrow_drop_up <?php else: ?>
                          arrow_drop_down <?php endif; ?></i> <?php echo e($week_revenue_percent ?? 0); ?> %
                    </p>
                    <p class="chart-revenue-per month display-none">
                      <i class="material-icons"><?php if($month_revenue_percent>=0): ?> arrow_drop_up <?php else: ?>
                          arrow_drop_down <?php endif; ?></i> <?php echo e($month_revenue_percent ?? 0); ?> %
                    </p>
                  </div>
                  <div class="switch chart-revenue-switch right">
                    <label class="cyan-text text-lighten-5">
                      Неделя <input type="checkbox" class="chart-revenue-switch-input" />
                      <span class="lever"></span>
                      Месяц
                    </label>
                  </div>
                </div>
                <div class="trending-line-chart-wrapper mt-3">
                  <canvas id="revenue-line-chart" height="61"></canvas>
                </div>
              </div>
            </div>
            <div class="card-content">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">filter_list</i>
              </a>
              <div class="col s12 m3 l3">
                <div id="doughnut-chart-wrapper">
                  <canvas id="doughnut-chart" height="200"></canvas>
                  <div class="doughnut-chart-status week">
                    <p class="center-align font-weight-600 mt-4">
                      $<?php echo e($weeks_deposit_revenue ?? 0); ?></p>
                    <p class="ultra-small center-align">Прибыль</p>
                  </div>
                  <div class="doughnut-chart-status month display-none">
                    <p class="center-align font-weight-600 mt-4">
                      $<?php echo e($month_deposit_revenue ?? 0); ?></p>
                    <p class="ultra-small center-align">Прибыль</p>
                  </div>
                </div>
              </div>
              <div class="col s12 m2 l2">
                <ul class="doughnut-chart-legend">
                  <li class="kitchen ultra-small">
                    <span class="legend-color"></span>
                    Пополнено
                  </li>
                  <li class="mobile ultra-small">
                    <span class="legend-color"></span>
                    Выведено
                  </li>
                </ul>
              </div>
              <div class="col s12 m5 l6">
                <div class="trending-bar-chart-wrapper">
                  <canvas id="trending-bar-chart" height="90"></canvas>
                </div>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Доход по месяцам <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table">
                <thead>
                  <tr>
                    <th data-field="">id</th>
                    <th data-field="">Дата</th>
                    <th data-field="">Пополнено</th>
                    <th data-field="">Выведено</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $month_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($loop->index); ?></td>
                      <td><?php echo e($item['start']->format('d M') . '-' . $item['end']->format('d M')); ?></td>
                      <td>
                        $ <?php echo e(number_format($month_period_enter_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0); ?></td>
                      <td>
                        $ <?php echo e(number_format($month_period_withdraw_transactions[$item['start']->format('d M') . '-' . $item['end']->format('d M')], 2, ',', '.') ?? 0); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col s12 m4 l4">
          <div class="card animate fadeUp">
            <div class="card-move-up teal accent-4 waves-effect waves-block waves-light">
              <div class="move-up">
                <p class="margin white-text">Популярность по странам</p>
                <canvas id="trending-radar-chart" height="114"></canvas>
              </div>
            </div>
            <div class="card-content  teal">
              <a class="btn-floating btn-move-up waves-effect waves-light red accent-2 z-depth-4 right">
                <i class="material-icons activator">done</i>
              </a>
              <div class="line-chart-wrapper">
                <p class="margin white-text">Популярность по городам</p>
                <canvas id="line-chart" height="113"></canvas>
              </div>
            </div>
            <div class="card-reveal">
                  <span class="card-title grey-text text-darken-4">Популярность по странам <i
                        class="material-icons right">close</i>
                  </span>
              <table class="responsive-table ">
                <thead>
                  <tr>
                    <th data-field="country-name">Страна</th>
                    <th data-field="item-sold">Количество юзеров</th>
                    <th data-field="total-profit">Инвестировано, $</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $countries_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($item->name ?? ''); ?></td>
                      <td><?php echo e($item->count ?? ''); ?></td>
                      <td>$<?php echo e($item->invested ?? ''); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                      <td colspan="3" style="text-align: center">Пусто</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
                  <span class="card-title grey-text text-darken-4 mt-3">Популярность по браузерам</span>
              <table class="responsive-table ">
                <thead>
                  <tr>
                    <th data-field="country-name">Браузер</th>
                    <th data-field="item-sold">Количество юзеров</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $__empty_1 = true; $__currentLoopData = $device_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td width="50%"><?php echo e($item->browser ?? ''); ?></td>
                      <td width="50%"><?php echo e($item->count ?? ''); ?></td>
                    </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                      <td colspan="2" style="text-align: center">Пусто</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  
   
    <div class="row">
      <div class="col s12 m12 l12">
        <div class="row">
          <div class="col-12">
            <div class="card-content">
              <h4 class="card-title mt-2 mb-1" style="text-align: center">Начислить бонус</h4>
              <form method="post" class="dashboard-send-bonus-form" action="<?php echo e(route('dashboard.add_bonus')); ?>">
                <?php echo e(csrf_field()); ?>

                
                
                
                
                <div class="row" style="text-align: center; margin-top:20px;">
                  <div class="col-12">
                    <input class="checkbox-tools" name="type" value="enter" type="radio" <?php echo e(old('type', 'enter') == 'enter' ? 'checked' : ''); ?> id="enter">
                    <label class="for-checkbox-tools" for="enter">Ввод средств в систему</label>
                    <input class="checkbox-tools" name="type" value="withdraw" type="radio"  id="withdraw" <?php echo e(old('type') == 'withdraw' ? 'checked' : ''); ?>>
                    <label class="for-checkbox-tools" for="withdraw">Вывод средств</label>
                  </div>
                </div>
                
                <div class="row" style="text-align: center; margin-top:20px;">
                  <div class="col-12 ">
                    <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($loop->index % 7 == 0 && $loop->index > 1): ?>
                        <br>
                      <?php endif; ?>
                        <input class="checkbox-tools" value="<?php echo e($currency->id); ?>" type="radio" <?php echo e(old('currency', $currencies[0]->id ?? '') == $currency->id ? 'checked' : ''); ?>  name="currency" id="currency-<?php echo e($currency->id); ?>">
                        <label class="for-checkbox-tools" for="currency-<?php echo e($currency->id); ?>">
                          <?php echo e($currency->code); ?>

                        </label>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   
                  </div>
                </div>
 
                
                <div class="row" style="margin-top:20px; text-align: center;">
                  <?php $__currentLoopData = $payment_system; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <input class="checkbox-tools" name="payment_system" value="<?php echo e($ps->id); ?>" type="radio" id="payment_system-<?php echo e($ps->id); ?>" <?php echo e(old('payment_system', $payment_system[0]->id ?? '') == $ps->id ? 'checked' : ''); ?>>
                    <label class="for-checkbox-tools" for="payment_system-<?php echo e($ps->id); ?>">
                      <?php echo e($ps->name); ?>

                    </label>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                
                <div class="row" style="margin-top:20px; text-align: center;">
                  <input class="checkbox-tools" name="is_real" value="1" type="radio" id="is_real1" <?php echo e(old('is_real', '1') == '1' ? 'checked' : ''); ?>>
                  <label class="for-checkbox-tools" for="is_real1">Реал</label>
                  <input class="checkbox-tools" name="is_real" value="0" type="radio" id="is_real0" <?php echo e(old('is_real') == '0' ? 'checked' : ''); ?> >
                  <label class="for-checkbox-tools" for="is_real0">Фейк</label>
                </div>
  
                <div class="row" style=" text-align: center;">
                  <div class="input-field col s12 text-center">
                    <div >
                      <input id="login" type="text" name="login"
                          placeholder="Логин, айди, или почта" value="<?php echo e(old('login')); ?>"
                          style="font-weight: bold; text-align: center;width: 320px;">
                    </div>
                  </div>
                </div>
                <div class="row" style=" text-align: center;">
                  <div class="input-field col s12">
                    <div class="text-center">
                      <input id="amount" type="text" name="amount" placeholder="Сумма" value="<?php echo e(old('amount')); ?>"
                          style="font-weight: 500; text-align: center; width: 320px;">
                    </div>
                  </div>
                </div>
                
                
                <div class="row" style="text-align: center;">
                  <div class="input-field col s12" style="text-align:center;">
                    <button class="btn red accent-2 shadow waves-effect waves-light dashboard-send-bonus-btn" type="submit" name="action">ОТПРАВИТЬ БОНУС<i class="material-icons right">attach_money</i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col s12 m12 l12 dashboard-operations-wrapper">
            <div class="switch dashboard-operations-switch right">
              <label class="grey-text darken-4">
                Статистика <input type="checkbox" class="dashboard-operations-switch-input">
                <span class="lever"></span>
                Последние операции
              </label>
            </div>
            
            <div id="stats-block" class="card card card-default animate fadeUp scrollspy ">
              <div class="card-content">
                <h4 class="card-title">Статистика</h4>
                <p class="mb-2"></p>
                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12">
                    <table class="striped">
                      <thead>
                        <tr>
                          <th data-field="name">Система</th>
                          <th data-field="plus">Пополнений</th>
                          <th data-field="minus">Выплат</th>
                          <th data-field="sum">Сумма</th>
                          <th data-field="percent">В процентах</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $payment_system; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr>
                            <td><?php echo e($item->name); ?></td>
                            <td class="green-text">
                                                    <span
                                                        style="font-weight: 900;">$</span><?php echo e(number_format(round($item->transaction_sum, 2), 2, '.',' ') ?? 0); ?>

                            </td>
                            <td class="red-text">
                                                    <span
                                                        style="font-weight: 900;">$</span><?php echo e(number_format(round($item->transaction_minus, 2), 2, '.',' ') ?? 0); ?>

                            </td>
                            <td class="blue-grey-text">
                                                    <span
                                                        style="font-weight: 900;">$</span><?php echo e(number_format(round($item->transaction_sum - $item->transaction_minus, 2), 2, '.',' ') ?? 0); ?>

                            </td>
                            <td><?php if($item->transaction_sum): ?>
                                <?php echo e(number_format(round( (($item->transaction_sum - $item->transaction_minus) / $item->transaction_sum) * 100, 2), 2, '.',' ')  ?? 0); ?>

                              <?php else: ?>
                                0
                              <?php endif; ?>
                              %
                            </td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                            <td colspan="3" style="text-align: center">Пусто</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
            <div id="last-operations-block" class="card subscriber-list-card animate fadeUp display-none">
              <div class="card-content pb-1">
                <h4 class="card-title mb-0">Последние операции</h4>
              </div>
              <table class="subscription-table responsive-table highlight">
                <thead>
                  <tr>
                    <th>Пользователь</th>
                    <th>Тип</th>
                    <th>Сумма</th>
                    <th>Платёжная система</th>
                    <th>Дата операции</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(isset($last_operations) && !empty($last_operations)): ?>
                    <?php $__currentLoopData = $last_operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <tr>
                        <td><?php echo e(Str::limit( $operation->user->name, 13) ?? 'Не указано'); ?></td>
                        <td><?php echo e(__('locale.' . $operation->type->name) ?? 'Не указано'); ?></td>
                        <td>
                                        <span
                                            class="badge  green-text  lighten-5 text-accent-4">$ <?php echo e(number_format($operation->main_currency_amount, 2, '.', ',') ?? 0); ?></span>
                        </td>
                        <td><?php echo e($operation->paymentSystem->name ?? 'Не указано'); ?></td>
                        <td><?php echo e($operation->created_at->format('d-m-Y H:i')); ?></td>
                        <td class="center-align">
                          <a href="<?php echo e(route('transactions.show', $operation->id)); ?>">Open</a>
                        </td>
                      </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="col s12 m12 l12">
            <div id="striped-table" class="card card card-default scrollspy">
              <div class="card-content">
                <h4 class="card-title">История входов админов</h4>
                <p class="mb-2"></p>
                <div class="row">
                  <div class="col s12">
                  </div>
                  <div class="col s12">
                    <table class="striped">
                      <thead>
                        <tr>
                          <th data-field="id">Пользователь</th>
                          <th data-field="name">Ip</th>
                          <th data-field="price">Дата</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $user_auth_logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                          <tr>
                            <td><b>Имя: </b><?php echo e($item->user->name ?? ''); ?>

                              <br><b>Логин: </b><?php echo e($item->user->login ?? ''); ?></td>
                            <td><?php echo e($item->ip ?? ''); ?></td>
                            <td><?php echo e($item->created_at->format('d.m.Y H:i:s') ?? ''); ?></td>
                          </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                          <tr>
                            <td colspan="3" style="text-align: center">Пусто</td>
                          </tr>
                        <?php endif; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    
    
    <div class="row">
      <div class="col s12 m12 l8">
      
      </div>
      <div class="col s12 m12 l12">
        <div class="row">
          <div class="col s12 m12">
            <div class="card">
              <?php if(session()->has('success')): ?>
                <div class="card-alert card green mb-0">
                  <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> <?php echo app('translator')->get(session()->get('success')); ?></span>
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php endif; ?>
              <?php if(session()->has('error')): ?>
                <div class="card-alert card red mb-0">
                  <div class="card-content white-text">
                                  <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> <?php echo app('translator')->get(session()->get('error')); ?></span>
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php endif; ?>
              <?php if($errors->any()): ?>
                <div class="card-alert card red lighten-2 mb-0">
                  <div class="card-content text-white">
                                     <span class="card-title white-text darken-1 mb-0">
                                    <i class="material-icons">notifications</i> <?php echo e(__("Error")); ?></span>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <p class="white-text darken-5"><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>
                  <button type="button" class="close white-text" data-dismiss="alert"
                      aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
              <?php endif; ?>
            
            </div>
          </div>
        </div>
      </div>
    </div>
  
  </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('vendor-script'); ?>
  <script src="<?php echo e(asset('vendors/sparkline/jquery.sparkline.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/chartjs/chart.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/chartist-js/chartist.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/sweetalert/sweetalert.min.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/chartist-js/chartist-plugin-tooltip.js')); ?>"></script>
  <script src="<?php echo e(asset('vendors/chartist-js/chartist-plugin-fill-donut.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-script'); ?>
  <script>
  
  </script>
  
  
  <script src="<?php echo e(asset('js/scripts/ui-alerts.js')); ?>"></script>
  
  <script>
    (function (window, document, $) {
      
      $("#task-card input:checkbox").change(function () {
        $.ajax({
          url: '/tasks/update/' + $(this).attr('id'),
          method: 'post',
          data: {
            _token: $('meta[name="csrf-token"]').attr('content')
          },
          success: (response) => {
            M.toast({
              html: response.message,
              classes: response.success ? 'green' : 'red'
            })
            if (response.success) {
              checkbox_check(this);
            }
          }
        })
      });
      
      // Check Uncheck function
      function checkbox_check(el) {
        if (!$(el).is(":checked")) {
          $(el)
          .next()
          .css("text-decoration", "none"); // or addClass
        } else {
          $(el)
          .next()
          .css("text-decoration", "line-through"); //or addClass
        }
      }
      
      $("#task-card input:checkbox").each(function () {
        checkbox_check(this);
      });
      
      var revenueLineChartCTX = $("#revenue-line-chart");
      var revenueLineChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              },
              ticks: {
                fontColor: "#fff"
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: true,
                color: "rgba(255,255,255,0.3)"
              },
              ticks: {
                beginAtZero: false,
                fontColor: "#fff",
                callback: function (value) {
                  if (value % 1 === 0 && value >= 0) {
                    return value;
                  }
                }
              }
            }
          ]
        }
      };
      
      var revenueLineChartDataWeek = {
        labels: [<?php $__currentLoopData = $weeks_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($item['start']->format('d M')); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
        datasets: [
          {
            label: "Deposit",
            data: [<?php $__currentLoopData = $weeks_period_enter_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            //data: [150, 50, 20, 40, 80, 50, 80],
            backgroundColor: "rgba(128, 222, 234, 0.6)",
            borderColor: "#d1faff",
            pointBorderColor: "#d1faff",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#d1faff",
            pointHoverBackgroundColor: "#d1faff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          },
          {
            label: "Withdraw",
            data: [<?php $__currentLoopData = $weeks_period_withdraw_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.2)",
            borderColor: "#80deea",
            pointBorderColor: "#80deea",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#80deea",
            pointHoverBackgroundColor: "#80deea",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      var revenueLineChartDataMonth = {
        labels: [<?php $__currentLoopData = $month_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($item['start']->format('d M') .'-'.$item['end']->format('d M')); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
        datasets: [
          {
            label: "Deposit",
            data: [<?php $__currentLoopData = $month_period_enter_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            //data: [150, 50, 20, 40, 80, 50, 80],
            backgroundColor: "rgba(128, 222, 234, 0.6)",
            borderColor: "#d1faff",
            pointBorderColor: "#d1faff",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#d1faff",
            pointHoverBackgroundColor: "#d1faff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          },
          {
            label: "Withdraw",
            data: [<?php $__currentLoopData = $month_period_withdraw_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            borderDash: [15, 5],
            backgroundColor: "rgba(128, 222, 234, 0.2)",
            borderColor: "#80deea",
            pointBorderColor: "#80deea",
            pointBackgroundColor: "#00bcd4",
            pointHighlightFill: "#80deea",
            pointHoverBackgroundColor: "#80deea",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      
      var revenueLineChartConfigWeek = {
        type: "line",
        options: revenueLineChartOptions,
        data: revenueLineChartDataWeek
      };
      var revenueLineChartConfigMonth = {
        type: "line",
        options: revenueLineChartOptions,
        data: revenueLineChartDataMonth
      };
      
      /*
   Doughnut Chart Widget
   */
      
      var totalRevenueChartCTX = $("#doughnut-chart");
      var totalRevenueChartOptions = {
        cutoutPercentage: 70,
        legend: {
          display: false
        },
      };
      var totalRevenueChartDataWeek = {
        labels: ["Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [<?php echo e($weeks_total_enter ?? 0); ?>, <?php echo e($weeks_total_withdraw ?? 0); ?>],
            backgroundColor: ["#46BFBD", "#f7464a"]
          }
        ]
      };
      var totalRevenueChartDataMonth = {
        labels: ["Пополнено", "Выведено"],
        datasets: [
          {
            label: "Sales",
            data: [<?php echo e($month_total_enter ?? 0); ?>, <?php echo e($month_total_withdraw ?? 0); ?>],
            backgroundColor: ["#46BFBD", "#f7464a"]
          }
        ]
      };
      
      var totalRevenueChartConfigWeek = {
        type: "doughnut",
        options: totalRevenueChartOptions,
        data: totalRevenueChartDataWeek
      };
      var totalRevenueChartConfigMonth = {
        type: "doughnut",
        options: totalRevenueChartOptions,
        data: totalRevenueChartDataMonth
      };
      
      
      var monthlyRevenueChartCTX = $("#trending-bar-chart");
      var monthlyRevenueChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: false
              },
              ticks: {
                beginAtZero: true,
                callback: function (value) {
                  if (value % 1 === 0 && value >= 0) {
                    return value;
                  }
                }
              }
            }
          ]
        },
        tooltips: {
          titleFontSize: 0,
          callbacks: {
            label: function (tooltipItem, data) {
              return tooltipItem.yLabel;
            }
          }
        }
      };
      var monthlyRevenueChartDataWeek = {
        labels: [<?php $__currentLoopData = $weeks_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($item['start']->format('d M')); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
        datasets: [
          {
            label: "Внесено",
            //data: [6, 9, 8, 4, 6, 7, 9, 4, 8],
            data: [<?php $__currentLoopData = $weeks_period_enter_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            backgroundColor: "#46BFBD",
            hoverBackgroundColor: "#009688"
          }
        ]
      };
      var monthlyRevenueChartDataMonth = {
        labels: [<?php $__currentLoopData = $month_period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>"<?php echo e($item['start']->format('d M') .'-'.$item['end']->format('d M')); ?>",<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
        //labels: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sept"],
        datasets: [
          {
            label: "Внесено",
            data: [<?php $__currentLoopData = $month_period_enter_transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php echo e($item); ?>,<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
            backgroundColor: "#46BFBD",
            hoverBackgroundColor: "#009688"
          }
        ]
      };
      
      var monthlyRevenueChartConfigWeek = {
        type: "bar",
        options: monthlyRevenueChartOptions,
        data: monthlyRevenueChartDataWeek
      };
      var monthlyRevenueChartConfigMonth = {
        type: "bar",
        options: monthlyRevenueChartOptions,
        data: monthlyRevenueChartDataMonth
      };
      
      
      var countryStatsChartCTX = $("#trending-radar-chart");
      var countryStatsChartOptions = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scale: {
          angleLines: {color: "rgba(255,255,255,0.4)"},
          gridLines: {color: "rgba(255,255,255,0.2)"},
          ticks: {
            display: false
          },
          pointLabels: {
            fontColor: "#fff"
          }
        }
      };
      var countryStatsChartData = {
        labels: [<?php $__empty_1 = true; $__currentLoopData = $countries_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>"<?php echo e($country->name); ?>"<?php if(!$loop->last): ?>, <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> "Пусто" <?php endif; ?>],
        datasets: [
          {
            label: "Count",
            data: [<?php $__empty_1 = true; $__currentLoopData = $countries_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>"<?php echo e(intval($country->count)); ?>"<?php if(!$loop->last): ?>, <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> "Пусто" <?php endif; ?>],
            fill: true,
            fillColor: "rgba(255,255,255,0.2)",
            borderColor: "#fff",
            pointBorderColor: "#fff",
            pointBackgroundColor: "#00bfa5",
            pointHighlightFill: "#fff",
            pointHoverBackgroundColor: "#fff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            
          }
        ]
      };
      var countryStatsChartConfig = {
        type: "radar",
        options: countryStatsChartOptions,
        data: countryStatsChartData
      };
      
      var cityStatsChartCTX = $("#line-chart");
      var cityStatsChartOption = {
        responsive: true,
        // maintainAspectRatio: false,
        legend: {
          display: false
        },
        hover: {
          mode: "label"
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: false
              },
              ticks: {
                fontColor: "#fff"
              }
            }
          ],
          yAxes: [
            {
              display: true,
              fontColor: "#fff",
              gridLines: {
                display: false
              },
              ticks: {
                beginAtZero: false,
                fontColor: "#fff",
                callback: function (value) {
                  if (Number.isInteger(value)) {
                    return value;
                  }
                },
              }
            }
          ]
        }
      };
      var cityStatsChartData = {
        labels: [<?php $__empty_1 = true; $__currentLoopData = $cities_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>"<?php echo e($country->name); ?>"<?php if(!$loop->last): ?>, <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> "Пусто" <?php endif; ?>],
        datasets: [
          {
            label: "Users",
            data: [<?php $__empty_1 = true; $__currentLoopData = $cities_stat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>"<?php echo e($country->count); ?>"<?php if(!$loop->last): ?>, <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?> "Пусто" <?php endif; ?>],
            fill: false,
            lineTension: 0,
            borderColor: "#fff",
            pointBorderColor: "#fff",
            pointBackgroundColor: "#009688",
            pointHighlightFill: "#fff",
            pointHoverBackgroundColor: "#fff",
            borderWidth: 2,
            pointBorderWidth: 2,
            pointHoverBorderWidth: 4,
            pointRadius: 4
          }
        ]
      };
      var cityStatsChartConfig = {
        type: "line",
        options: cityStatsChartOption,
        data: cityStatsChartData
      };
      
      window.onload = function () {
        
        var revenueLineChart = new Chart(revenueLineChartCTX, revenueLineChartConfigWeek);
        var monthlyRevenueChart = new Chart(monthlyRevenueChartCTX, monthlyRevenueChartConfigWeek);
        var totalRevenueChart = new Chart(totalRevenueChartCTX, totalRevenueChartConfigWeek);
        var countryStatsChart = new Chart(countryStatsChartCTX, countryStatsChartConfig);
        var cityStatsChart = new Chart(cityStatsChartCTX, cityStatsChartConfig);
        
        
        document.querySelector('.chart-revenue-switch-input').addEventListener('change', function (e) {
          
          if (typeof revenueLineChart != "undefined") {
            if (this.checked == true) {
              revenueLineChart.config = revenueLineChartConfigMonth;
              revenueLineChart.update();
            } else {
              revenueLineChart.config = revenueLineChartConfigWeek;
              revenueLineChart.update();
            }
          }
          if (typeof monthlyRevenueChart != "undefined") {
            if (this.checked == true) {
              monthlyRevenueChart.config = monthlyRevenueChartConfigMonth;
              monthlyRevenueChart.update();
            } else {
              monthlyRevenueChart.config = monthlyRevenueChartConfigWeek;
              monthlyRevenueChart.update();
            }
          }
          if (typeof totalRevenueChart != "undefined") {
            if (this.checked == true) {
              totalRevenueChart.config = totalRevenueChartConfigMonth;
              totalRevenueChart.update();
              document.querySelector('.doughnut-chart-status.month').classList.remove('display-none');
              document.querySelector('.doughnut-chart-status.week').classList.add('display-none');
              
              document.querySelector('.chart-revenue-total.month').classList.remove('display-none');
              document.querySelector('.chart-revenue-total.week').classList.add('display-none');
              document.querySelector('.chart-revenue-per.month').classList.remove('display-none');
              document.querySelector('.chart-revenue-per.week').classList.add('display-none');
            } else {
              totalRevenueChart.config = totalRevenueChartConfigWeek;
              totalRevenueChart.update();
              document.querySelector('.doughnut-chart-status.month').classList.add('display-none');
              document.querySelector('.doughnut-chart-status.week').classList.remove('display-none');
              
              document.querySelector('.chart-revenue-total.month').classList.add('display-none');
              document.querySelector('.chart-revenue-total.week').classList.remove('display-none');
              document.querySelector('.chart-revenue-per.month').classList.add('display-none');
              document.querySelector('.chart-revenue-per.week').classList.remove('display-none');
            }
          }
        });
      };
      
    })(window, document, jQuery);
  
  </script>
  <script>
    $(document).ready(function () {
      $(".dashboard-send-bonus-btn").on('click', function (e) {
        e.preventDefault();
        swal({
          title: "Вы уверены?",
          text: "Пользователю будет начислен бонус!",
          icon: 'warning',
          buttons: {
            cancel: true,
            delete: 'Выполнить операцию?'
          }
        }).then(function (willDelete) {
          if (willDelete) {
            $(".dashboard-send-bonus-form").submit();
          }
        });
      });
      
      $("#clients-bar").sparkline(<?php echo json_encode($usersCountPeriod, 15, 512) ?>, {
        type: "bar",
        height: "25",
        barWidth: 7,
        barSpacing: 4,
        barColor: "#b2ebf2",
        negBarColor: "#81d4fa",
        zeroColor: "#81d4fa"
      });
      
      $("#sales-compositebar").sparkline(<?php echo json_encode($enterTransactionsPeriod, 15, 512) ?>, {
        type: "bar",
        barColor: "#F6CAFD",
        height: "25",
        width: "100%",
        barWidth: "7",
        barSpacing: 4
      });
      //Total Sales - Line
      $("#sales-compositebar").sparkline(<?php echo json_encode($enterTransactionsPeriod, 15, 512) ?>, {
        type: "line",
        width: "100%",
        lineWidth: 2,
        lineColor: "#fff3e0",
        fillColor: "rgba(255, 82, 82, 0.25)",
        highlightSpotColor: "#fff3e0",
        highlightLineColor: "#fff3e0",
        minSpotColor: "#00bcd4",
        maxSpotColor: "#00e676",
        spotColor: "#fff3e0",
        spotRadius: 4
      });
      
      $("#profit-tristate").sparkline(<?php echo json_encode($withdrawalsPeriod, 15, 512) ?>, {
        type: "bar",
        height: "25",
        barWidth: 7,
        barSpacing: 4,
        barColor: "#f2e3b2",
        negBarColor: "#fae681",
        zeroColor: "#fade81"
      });
      
      $("#invoice-line").sparkline(<?php echo json_encode($profitPeriod, 15, 512) ?>, {
        type: "line",
        width: "100%",
        height: "25",
        lineWidth: 2,
        lineColor: "#E1D0FF",
        fillColor: "rgba(255, 255, 255, 0.2)",
        highlightSpotColor: "#E1D0FF",
        highlightLineColor: "#E1D0FF",
        minSpotColor: "#00bcd4",
        maxSpotColor: "#fade81",
        spotColor: "#E1D0FF",
        spotRadius: 4
      });
    });
  </script>
  <script>
    //stats-block
    //last-operations-block
    $(".dashboard-operations-switch-input").on('change', function (e) {
      e.preventDefault();
      if ($(this).prop('checked')) {
        $("#stats-block").addClass('display-none');
        $("#last-operations-block").removeClass('display-none');
      } else {
        $("#stats-block").removeClass('display-none');
        $("#last-operations-block").addClass('display-none');
      }
    });
  </script>
  <script>
    $(document).ready(function (){
      $(".for-checkbox-tools").on('click', function () {
      
      });
    });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contentLayoutMaster', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/fladko/Work/Clients/Serhei/wallstreet/resources/views/pages/dashboard.blade.php ENDPATH**/ ?>