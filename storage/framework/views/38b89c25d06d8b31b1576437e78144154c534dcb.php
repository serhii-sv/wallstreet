<!-- Theme Customizer -->

<a href="#" data-target="theme-cutomizer-out" class="btn btn-customizer pink accent-2 white-text sidenav-trigger theme-cutomizer-trigger">
   <i class="material-icons">settings</i>
</a>

<div id="theme-cutomizer-out" class="theme-cutomizer sidenav row">
   <div class="col s12">
      <a class="sidenav-close" href="#!"><i class="material-icons">close</i></a>
      <h5 class="theme-cutomizer-title">Настройщик темы</h5>

      <div class="menu-options">
         <h6 class="mt-6">Опции меню</h6>
         <hr class="customize-devider" />
         <div class="menu-options-form row">
            <div class="input-field col s12 menu-color mb-0">
               <p class="mt-0">Цвет меню</p>
               <div class="gradient-color center-align">
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-indigo-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-purple-deep-orange' ? 'selected' : ''); ?> gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-light-blue-cyan' ? 'selected' : ''); ?> gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-purple-amber' ? 'selected' : ''); ?> gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-purple-deep-purple' ? 'selected' : ''); ?> gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-deep-orange-orange' ? 'selected' : ''); ?> gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-green-teal' ? 'selected' : ''); ?> gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-indigo-light-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'gradient-45deg-red-pink' ? 'selected' : ''); ?> gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
               </div>
               <div class="solid-color center-align">
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'red' ? 'selected' : ''); ?> red" data-color="red"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'purple' ? 'selected' : ''); ?> purple" data-color="purple"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'pink' ? 'selected' : ''); ?> pink" data-color="pink"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'deep-purple' ? 'selected' : ''); ?> deep-purple" data-color="deep-purple"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'dark' ? 'selected' : ''); ?> dark" data-color="dark"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'teal' ? 'selected' : ''); ?> teal" data-color="teal"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'light-blue' ? 'selected' : ''); ?> light-blue" data-color="light-blue"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'amber darken-3' ? 'selected' : ''); ?> amber darken-3" data-color="amber darken-3"></span>
                  <span class="menu-color-option <?php echo e(($themeSettings['menu-color'] ?? null) == 'brown darken-2' ? 'selected' : ''); ?> brown darken-2" data-color="brown darken-2"></span>
               </div>
            </div>
            <div class="input-field col s12 menu-bg-color mb-0">
               <p class="mt-0">Цвет фона меню</p>
               <div class="gradient-color center-align">
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-indigo-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-purple-deep-orange' ? 'selected' : ''); ?> gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-light-blue-cyan' ? 'selected' : ''); ?> gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-purple-amber' ? 'selected' : ''); ?> gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-purple-deep-purple' ? 'selected' : ''); ?> gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-deep-orange-orange' ? 'selected' : ''); ?> gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-green-teal' ? 'selected' : ''); ?> gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-indigo-light-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'gradient-45deg-red-pink' ? 'selected' : ''); ?> gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
               </div>
               <div class="solid-color center-align">
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'red' ? 'selected' : ''); ?> red" data-color="red"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'purple' ? 'selected' : ''); ?> purple" data-color="purple"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'pink' ? 'selected' : ''); ?> pink" data-color="pink"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'deep-purple' ? 'selected' : ''); ?> deep-purple" data-color="deep-purple"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'dark' ? 'selected' : ''); ?> dark" data-color="dark"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'teal' ? 'selected' : ''); ?> teal" data-color="teal"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'light-blue' ? 'selected' : ''); ?> light-blue" data-color="light-blue"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'amber darken-3' ? 'selected' : ''); ?> amber darken-3" data-color="amber darken-3"></span>
                  <span class="menu-bg-color-option <?php echo e(($themeSettings['menu-bg-color'] ?? null) == 'brown darken-2' ? 'selected' : ''); ?> brown darken-2" data-color="brown darken-2"></span>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  Темное меню
                  <label class="float-right">
                      <input class="menu-dark-checkbox" type="checkbox" <?php echo e(($themeSettings['menu-dark'] ?? null) == 'true' ? 'checked' : 'checked'); ?> />
                      <span class="lever ml-0"></span>
                  </label>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  Свернутое меню
                  <label class="float-right">
                      <input class="menu-collapsed-checkbox" type="checkbox" <?php echo e(($themeSettings['menu-collapsed'] ?? null) == 'true' ? 'checked' : ''); ?> />
                      <span class="lever ml-0"></span>
                  </label>
               </div>
            </div>
            <div class="input-field col s12">
               <div class="switch">
                  <p class="mt-0">Активный пункт меню</p>
                  <label>
                     <input class="menu-selection-radio with-gap" value="sidenav-active-square" name="menu-selection" type="radio" <?php echo e(($themeSettings['menu-selection'] ?? null) == 'sidenav-active-square' ? 'checked' : ''); ?> />
                     <span>Квадратный</span>
                  </label>
                  <label>
                     <input class="menu-selection-radio with-gap" value="sidenav-active-rounded" name="menu-selection" type="radio" <?php echo e(($themeSettings['menu-selection'] ?? null) == 'sidenav-active-rounded' ? 'checked' : ''); ?> />
                     <span>Скругленный</span>
                  </label>
                  <label>
                     <input class="menu-selection-radio with-gap" value="normal" name="menu-selection" type="radio" <?php echo e(($themeSettings['menu-selection'] ?? null) == 'normal' ? 'checked' : ''); ?> />
                     <span>Нормальный</span>
                  </label>
               </div>
            </div>
         </div>
      </div>
      <h6 class="mt-6">Параметры навигационной панели</h6>
      <hr class="customize-devider" />
      <div class="navbar-options row">
         <div class="input-field col s12 navbar-color mb-0">
            <p class="mt-0">Цвет панели навигации</p>
            <div class="gradient-color center-align">
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-indigo-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-blue" data-color="gradient-45deg-indigo-blue"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-purple-deep-orange' ? 'selected' : ''); ?> gradient-45deg-purple-deep-orange" data-color="gradient-45deg-purple-deep-orange"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-light-blue-cyan' ? 'selected' : ''); ?> gradient-45deg-light-blue-cyan" data-color="gradient-45deg-light-blue-cyan"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-purple-amber' ? 'selected' : ''); ?> gradient-45deg-purple-amber" data-color="gradient-45deg-purple-amber"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-purple-deep-purple' ? 'selected' : ''); ?> gradient-45deg-purple-deep-purple" data-color="gradient-45deg-purple-deep-purple"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-deep-orange-orange' ? 'selected' : ''); ?> gradient-45deg-deep-orange-orange" data-color="gradient-45deg-deep-orange-orange"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-green-teal' ? 'selected' : ''); ?> gradient-45deg-green-teal" data-color="gradient-45deg-green-teal"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-indigo-light-blue' ? 'selected' : ''); ?> gradient-45deg-indigo-light-blue" data-color="gradient-45deg-indigo-light-blue"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'gradient-45deg-red-pink' ? 'selected' : ''); ?> gradient-45deg-red-pink" data-color="gradient-45deg-red-pink"></span>
            </div>
            <div class="solid-color center-align">
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'red' ? 'selected' : ''); ?> red" data-color="red"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'purple' ? 'selected' : ''); ?> purple" data-color="purple"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'pink' ? 'selected' : ''); ?> pink" data-color="pink"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'deep-purple' ? 'selected' : ''); ?> deep-purple" data-color="deep-purple"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'dark' ? 'selected' : ''); ?> dark" data-color="dark"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'teal' ? 'selected' : ''); ?> teal" data-color="teal"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'light-blue' ? 'selected' : ''); ?> light-blue" data-color="light-blue"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'amber darken-3' ? 'selected' : ''); ?> amber darken-3" data-color="amber darken-3"></span>
               <span class="navbar-color-option <?php echo e(($themeSettings['navbar-color'] ?? null) == 'brown darken-2' ? 'selected' : ''); ?> brown darken-2" data-color="brown darken-2"></span>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Темная панель навигации
               <label class="float-right">
                   <input class="navbar-dark-checkbox" type="checkbox" <?php echo e(($themeSettings['navbar-dark'] ?? null) == 'true' ? 'checked' : ''); ?>/>
                   <span class="lever ml-0"></span>
               </label>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Фиксированная панель навигации
               <label class="float-right">
                   <input class="navbar-fixed-checkbox" type="checkbox" <?php echo e(($themeSettings['navbar-fixed'] ?? 'true') == 'true' ? 'checked' : ''); ?> />
                   <span class="lever ml-0"></span>
               </label>
            </div>
         </div>
      </div>
      <h6 class="mt-6">Параметры нижней панели</h6>
      <hr class="customize-devider" />
      <div class="navbar-options row">
         <div class="input-field col s12">
            <div class="switch">
               Темная нижняя панель
               <label class="float-right">
                   <input class="footer-dark-checkbox" type="checkbox" <?php echo e(($themeSettings['footer-dark'] ?? null) == 'true' ? 'checked' : ''); ?>/>
                   <span class="lever ml-0"></span>
               </label>
            </div>
         </div>
         <div class="input-field col s12">
            <div class="switch">
               Фиксированная нижняя панель
               <label class="float-right">
                   <input class="footer-fixed-checkbox" type="checkbox" <?php echo e(($themeSettings['footer-fixed'] ?? null) == 'true' ? 'checked' : ''); ?>/>
                   <span class="lever ml-0"></span>
               </label>
            </div>
         </div>
      </div>
   </div>
</div>
<!--/ Theme Customizer -->
<?php /**PATH /var/www/resources/views/pages/partials/customizer.blade.php ENDPATH**/ ?>