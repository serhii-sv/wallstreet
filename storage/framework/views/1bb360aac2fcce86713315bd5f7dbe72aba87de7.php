<!-- START RIGHT SIDEBAR NAV -->
<aside id="right-sidebar-nav">
  <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
    <div class="row">
      <div class="slide-out-right-title">
        <div class="col s12 border-bottom-1 pb-0 pt-1">
          <div class="row">
            <div class="col s2 pr-0 center">
              <i class="material-icons vertical-text-middle">
                <a href="#" class="sidenav-close">clear</a>
              </i>
            </div>
            <div class="col s10 pl-0">
              <ul class="tabs">
                <li class="tab col s4 p-0">
                  <a href="#messages" class="active">
                    <span>Админы</span>
                  </a>
                </li>
                <li class="tab col s4 p-0">
                  <a href="#activity">
                    <span>Пользователи</span>
                  </a>
                </li>
           
              
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="row slide-out-right-body pl-3">
        <div id="messages" class="col s12 pb-0">
          <div class="collection border-none mb-0">
            <input class="header-search-input mt-4 mb-2" type="text" name="Search" placeholder="Search Messages" />
            <ul class="collection right-sidebar-chat p-0 mb-0">
              <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                    data-target="slide-out-chat">
                <span class="avatar-status <?php echo e($admin->lastActivity['is_online'] ? "avatar-online" : "avatar-off"); ?> avatar-50">
                  <img src="<?php echo e(asset('images/avatar/user.svg')); ?>" alt="avatar" />
                  <i></i>
                </span>
                  <div class="user-content">
                    <h6 class="line-height-0"><?php echo e($admin->shortName); ?></h6>
                    <p class="medium-small blue-grey-text text-lighten-3 pt-3"><?php echo e($admin->email); ?></p>
                  </div>
                  <span class="secondary-content medium-small"><?php echo e($admin->lastActivity['last_seen']); ?></span>
                </li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
            </ul>
          </div>
        </div>
        <div id="activity" class="col s12">
          <div id="messages" class="col s12 pb-0">
            <div class="collection border-none mb-0">
              <p class="mt-5 mb-0 ml-5 font-weight-900">Недавно заходили</p>
              <ul class="collection right-sidebar-chat p-0 mb-0">
                <?php $__currentLoopData = $online_users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li class="collection-item right-sidebar-chat-item sidenav-trigger display-flex avatar pl-5 pb-0"
                      data-target="slide-out-chat">
                    
                <span class="avatar-status <?php echo e($user->lastActivity['is_online'] ? "avatar-online" : "avatar-off"); ?> avatar-50">
                  <img src="<?php echo e(asset('images/avatar/user.svg')); ?>" alt="avatar" />
                  <i></i>
                </span>
                    <div class="user-content">
                      <h6 class="line-height-0"><?php echo e($user->shortName); ?></h6>
                      <p class="medium-small blue-grey-text text-lighten-3 pt-3"><?php echo e($user->email); ?></p>
                    </div>
                    <span class="secondary-content medium-small"><?php echo e($user->lastActivity['last_seen']); ?></span>
                  </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
              </ul>
            </div>
            
          </div>
        </div>
        
       
      </div>
    </div>
  </div>
  
  <!-- Slide Out Chat -->
  <ul id="slide-out-chat" class="sidenav slide-out-right-sidenav-chat">
    <li class="center-align pt-2 pb-2 sidenav-close chat-head">
      <a href="#!"><i class="material-icons mr-0">chevron_left</i>Elizabeth Elliott</a>
    </li>
    <li class="chat-body">
      <ul class="collection">
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">hello!</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">How can we help? We're here for you!</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">I am looking for the best admin template.?</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Materialize admin is the responsive materializecss admin template.</p>
          </div>
        </li>
        
        <li class="collection-item display-grid width-100 center-align">
          <p>8:20 a.m.</p>
        </li>
        
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">Ohh! very nice</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Thank you.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">How can I purchase it?</p>
          </div>
        </li>
        
        <li class="collection-item display-grid width-100 center-align">
          <p>9:00 a.m.</p>
        </li>
        
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">From ThemeForest.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Only $24</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">Ohh! Thank you.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar pl-5 pb-0" data-target="slide-out-chat">
          <span class="avatar-status avatar-online avatar-50"><img src="<?php echo e(asset('images/avatar/avatar-7.png')); ?>"
                alt="avatar" />
          </span>
          <div class="user-content speech-bubble">
            <p class="medium-small">I will purchase it for sure.</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">Great, Feel free to get in touch on</p>
          </div>
        </li>
        <li class="collection-item display-flex avatar justify-content-end pl-5 pb-0" data-target="slide-out-chat">
          <div class="user-content speech-bubble-right">
            <p class="medium-small">https://pixinvent.ticksy.com/</p>
          </div>
        </li>
      </ul>
    </li>
    <li class="center-align chat-footer">
      <form class="col s12" onsubmit="slideOutChat()" action="javascript:void(0);">
        <div class="input-field">
          <input id="icon_prefix" type="text" class="search" />
          <label for="icon_prefix">Type here..</label>
          <a onclick="slideOutChat()"><i class="material-icons prefix">send</i></a>
        </div>
      </form>
    </li>
  </ul>
</aside>
<!-- END RIGHT SIDEBAR NAV --><?php /**PATH /Users/fladko/Work/Clients/Serhei/wallstreet/resources/views/pages/sidebar/right-sidebar.blade.php ENDPATH**/ ?>