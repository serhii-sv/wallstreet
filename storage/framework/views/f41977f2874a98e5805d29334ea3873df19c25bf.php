<!-- BEGIN VENDOR JS-->
<script src="//code-eu1.jivosite.com/widget/WTWc6WTrkx" async></script>
<script src="<?php echo e(asset('js/vendors.min.js')); ?>"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<?php echo $__env->yieldContent('vendor-script'); ?>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="<?php echo e(asset('js/plugins.js')); ?>"></script>
<script src="<?php echo e(asset('js/search.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/intro.js')); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap-colorpicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom/custom-script.js')); ?>"></script>
<script src="<?php echo e(asset('js/scripts/ui-alerts.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/sweetalert/sweetalert.min.js')); ?>"></script>
<script src="<?php echo e(asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>s
<?php if($configData['isCustomizer']=== true): ?>
  <script src="<?php echo e(asset('js/scripts/customizer.js')); ?>"></script>
<?php endif; ?>
<?php if(session()->has('success_short')): ?>
  <script>
    var toastHTML = '<span class="font-weight-600"><?php echo e(session()->get('success_short')); ?></span>';
    M.toast({html: toastHTML, classes: 'border-radius-4 green darken-1'});
  </script>
<?php endif; ?>
<?php if(session()->has('error_short')): ?>
  <script>
    var toastHTML = '<span class="font-weight-600"><?php echo e(session()->get('error_short')); ?></span>';
    M.toast({html: toastHTML, classes: 'border-radius-4 red accent-4', });
  </script>
<?php endif; ?>

<?php if(empty($user_geoip)): ?>
  <script src="//geoip-js.com/js/apis/geoip2/v2.1/geoip2.js" type="text/javascript"></script>
  <script>
    $(document).ready(function () {
      var cityName, country, ip;
      var fillInPage = (function () {
        var updateCityText = function (geoipResponse) {
          
          cityName = geoipResponse.city.names.ru || 'Неизвестный';
          country = geoipResponse.country.names.ru || 'Неизвестная';
          ip = geoipResponse.traits.ip_address || 'ip';
          $.ajax({
            type: 'post',
            async: true,
            url: '<?php echo e(route('ajax.set.user.geoip.table')); ?>',
            data: 'country=' + country + '&city=' + cityName + '&ip=' + ip,
            headers: {
              'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
              data = $.parseJSON(data);
              console.log(data);
            }
          });
        };

        var onSuccess = function (geoipResponse) {
          console.log(geoipResponse);
          updateCityText(geoipResponse);
        };

        var onError = function (error) {
          console.log(error);
        };

        return function () {
          if (typeof geoip2 !== 'undefined') {
            geoip2.city(onSuccess, onError);
          } else {
            console.log('a browser that blocks GeoIP2 requests');
          }
        };
      }());
      fillInPage();
    });
  </script>
<?php endif; ?>

<script src="<?php echo e(asset('js/scripts/intro.js')); ?>"></script>
<script>
    $(function () {
        $('input[name="disable_client_site"]').change(function () {
            let checkboxChecked = $(this).prop('checked');
            swal({
                title: "Вы уверены?",
                // text: "You will not be able to recover this imaginary file!",
                icon: 'warning',
                buttons: {
                    cancel: {
                        text: "Отменить",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    },
                    confirm: {
                        text: "Подтвердить",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    }
                }
            }).then((result) => {
                if (result) {
                    $.ajax({
                        url: '/settings/change-client-site-status',
                        method: 'post',
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            disable_client_site: checkboxChecked
                        },
                        success: (response) => {
                            M.toast({
                                html: response.message,
                                classes: response.success ? 'green' : 'red'
                            })

                            if (!response.success) {
                                $(this).prop('checked', !checkboxChecked)
                            }
                        }
                    })
                } else {
                    $(this).prop('checked', !checkboxChecked)
                }
            })
            return false;
        })
    })
</script>

<!-- END THEME  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<?php echo $__env->yieldContent('page-script'); ?>
<?php /**PATH /var/www/resources/views/panels/scripts.blade.php ENDPATH**/ ?>