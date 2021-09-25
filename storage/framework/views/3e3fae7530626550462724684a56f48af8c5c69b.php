<div class="navbar <?php if(($configData['isNavbarFixed'])=== true): ?><?php echo e('navbar-fixed'); ?> <?php endif; ?>">
  <nav
    class="<?php echo e($configData['navbarMainClass']); ?> <?php if($configData['isNavbarDark']=== true): ?> <?php echo e('navbar-dark'); ?> <?php elseif($configData['isNavbarDark']=== false): ?> <?php echo e('navbar-light'); ?> <?php elseif(!empty($configData['navbarBgColor'])): ?> <?php echo e($configData['navbarBgColor']); ?> <?php else: ?> <?php echo e($configData['navbarMainColor']); ?> <?php endif; ?>">
    <div class="nav-wrapper">
      <div class="header-search-wrapper hide-on-med-and-down" style="<?php echo e($configData['isMenuCollapsed'] ? 'width:calc(100% - 400px)' : ''); ?>">
        <i class="material-icons">search</i>
        <input class="header-search-input z-depth-2" type="text" name="Search" placeholder="Login/Email/Name"
          data-search="template-list">
        <ul class="search-list collection display-none"></ul>
      </div>
      <ul class="navbar-list right">
        <li>
          <span class="badge time"><?php echo e(now()->format('d-m-Y H:i')); ?></span>
        </li>






        <li class="hide-on-med-and-down">
          <a class="waves-effect waves-block waves-light toggle-fullscreen" href="">
            <i class="material-icons">settings_overscan</i>
          </a>
        </li>
        <li class="hide-on-large-only search-input-wrapper">
          <a class="waves-effect waves-block waves-light search-button" href="javascript:void(0);">
            <i class="material-icons">search</i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);"
            data-target="notifications-dropdown">
            <i class="material-icons">notifications_none <?php if($counts['notifications'] > 0): ?><small class="notification-badge"><?php echo e($counts['notifications'] ?? 0); ?></small><?php endif; ?></i>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
            data-target="profile-dropdown">
            <span class="avatar-status avatar-online">
              <img src="<?php echo e(asset('images/avatar/IMG_3735.JPG')); ?>" alt="avatar"><i></i>
            </span>
          </a>
        </li>
        <li>
          <a class="waves-effect waves-block waves-light sidenav-trigger" href="#" data-target="slide-out-right">
            <i class="material-icons">format_indent_increase</i>
          </a>
        </li>
      </ul>
      <!-- translation-button-->
      <ul class="dropdown-content" id="translation-dropdown">
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="<?php echo e(url('lang/en')); ?>" data-language="en">
            <i class="flag-icon flag-icon-gb"></i>
            English
          </a>
        </li>
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="<?php echo e(url('lang/fr')); ?>" data-language="fr">
            <i class="flag-icon flag-icon-fr"></i>
            French
          </a>
        </li>
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="<?php echo e(url('lang/pt')); ?>" data-language="pt">
            <i class="flag-icon flag-icon-pt"></i>
            Portuguese
          </a>
        </li>
        <li class="dropdown-item">
          <a class="grey-text text-darken-1" href="<?php echo e(url('lang/de')); ?>" data-language="de">
            <i class="flag-icon flag-icon-de"></i>
            German
          </a>
        </li>
      </ul>
      <!-- notifications-dropdown-->
      <ul class="dropdown-content" id="notifications-dropdown">
        <li>
          <h6>NOTIFICATIONS <?php if($counts['notifications'] > 0): ?> <span class="new badge"><?php echo e($counts['notifications'] ?? 0); ?></span> <?php endif; ?></h6>
        </li>
        <li class="divider"></li>
        <?php $__empty_1 = true; $__currentLoopData = $navbar_notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <li class="notification" data-id="<?php echo e($item->id); ?>" data-count="<?php echo e($counts['notifications'] ?? 0); ?>">
          <a class="black-text" href="" style="display: flex; align-items: flex-start">
            <span class="material-icons icon-bg-circle red small " style="display: block;">notifications</span>
            <small style="font-size: 14px; display: block;">
            <?php echo e($item->notification->text); ?>

            </small>
          </a>
          <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00" style="margin-left: 30px;top: 0;">
            <?php if($item->notification->created_at): ?><?php echo e($item->notification->created_at->diffForHumans()); ?><?php endif; ?>
          </time>
        </li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
          <li>
            <a class="black-text" href="">
              <span class="material-icons icon-bg-circle red small">notifications_none</span>
              Уведомлений нет!
            </a>
          </li>
        <?php endif; ?>
      </ul>
      <!-- profile-dropdown-->
      <style>
        .dropdown-content{
            width: 290px !important;
        }
        .navbar-list li:first-child {
            margin-right: 0;
        }
      </style>
      <ul class="dropdown-content" id="profile-dropdown">
        <li class="divider"></li>
        <li>
          <a class="grey-text text-darken-1" href="<?php echo e(route('user.lock', Auth::user())); ?>">
            <i class="material-icons">lock_outline</i>
            Заблокировать
          </a>
        </li>
        <li>
          <a class="grey-text text-darken-1" href="<?php echo e(route('logout')); ?>">
            <i class="material-icons">keyboard_tab</i>
            Выйти
          </a>
        </li>
      </ul>
    </div>
    <nav class="display-none search-sm">
      <div class="nav-wrapper">
        <form id="navbarForm">
          <div class="input-field search-input-sm">
            <input class="search-box-sm mb-0" type="search" required="" placeholder='Login/Email/Name' id="search"
              data-search="template-list">
            <label class="label-icon" for="search">
              <i class="material-icons search-sm-icon">search</i>
            </label>
            <i class="material-icons search-sm-close">close</i>
            <ul class="search-list collection search-list-sm display-none"></ul>
          </div>
        </form>
      </div>
    </nav>
  </nav>
</div>

<ul class="display-none" id="default-search-main">
  <li class="auto-suggestion-title">
    <a class="collection-item" href="#">
      <h6 class="search-title">Пользователи</h6></a>
  </li>
</ul>






<ul class="display-none" id="search-not-found">
  <li class="auto-suggestion">
    <a class="collection-item display-flex align-items-center" href="#">
      <span class="material-icons">error_outline</span>
      <span class="member-info">No results found.</span>
    </a>
  </li>
</ul>
<?php /**PATH /Users/fladko/Work/Clients/Serhei/wallstreet/resources/views/panels/navbar.blade.php ENDPATH**/ ?>