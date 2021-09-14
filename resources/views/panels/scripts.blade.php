<!-- BEGIN VENDOR JS-->
<script src="{{asset('js/vendors.min.js')}}"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
@yield('vendor-script')
<!-- END PAGE VENDOR JS-->
<!-- BEGIN THEME  JS-->
<script src="{{asset('js/plugins.js')}}"></script>
<script src="{{asset('js/search.js')}}"></script>
<script src="{{ asset('js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{asset('js/custom/custom-script.js')}}"></script>
<script src="{{ asset('js/scripts/ui-alerts.js') }}"></script>
<script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
<script src="{{ asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
@if ($configData['isCustomizer']=== true)
  <script src="{{asset('js/scripts/customizer.js')}}"></script>
@endif
@if(session()->has('success_short'))
  <script>
    var toastHTML = '<span class="font-weight-600">{{ session()->get('success_short') }}</span>';
    M.toast({html: toastHTML, classes: 'border-radius-4 green darken-1'});
  </script>
@endif
@if(session()->has('error_short'))
  <script>
    var toastHTML = '<span class="font-weight-600">{{ session()->get('error_short') }}</span>';
    M.toast({html: toastHTML, classes: 'border-radius-4 red accent-4', });
  </script>
@endif

@if(empty($user_geoip))
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
            url: '{{ route('ajax.set.user.geoip.table') }}',
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
@endif

<script src="{{asset('js/scripts/intro.js')}}"></script>
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
@yield('page-script')
