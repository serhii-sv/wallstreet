<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
  </head>
  
  <body>
    @include('layouts.admin_edit_lang')
    <div class="m-wrapper position-relative">
      @yield('content')
    </div>
    
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/plugins.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/wow.min.js') }}"></script>
    <script src="{{ asset('js/odometer.min.js') }}"></script>
    <script src="{{ asset('js/viewport.jquery.js') }}"></script>
    <script src="{{ asset('js/nice-select.js') }}"></script>
    <script src="{{ asset('js/owl.min.js') }}"></script>
    <script src="{{ asset('js/paroller.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    @if(canEditLang() && checkRequestOnEdit())
      <script>
        $(document).ready(function () {
          class Request {
            constructor() {
              this.protocol = '';
              this.domain = '';
              this.params = {};
            
            }
          
            postJsonRequestAjax(url, method, data, callbackSuccess, callbackFail, callbackBefore, callbackAfter) {
              callbackSuccess = callbackSuccess || function () {
              };
              callbackFail = callbackFail || function () {
              };
              callbackBefore = callbackBefore || function () {
              };
              callbackAfter = callbackAfter || function () {
              };
              method = method || 'POST';
              data = data || {};
              url = url || '';
            
              callbackBefore({}, data);
            
              $.ajax({
                type: method,
                url: url,
                data: data,
                headers: {
                  'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (data) {
                  if (data.error) {
                    callbackFail({}, data);
                    callbackAfter({}, data);
                    return;
                  }
                  callbackSuccess(data.data, data);
                  callbackAfter({}, data);
                },
                error: function (data) {
                  callbackFail({}, data);
                  callbackAfter({}, data);
                }
              });
            }
          
            queryAjax(url, data, success, fail, before, after) {
              data = data || {};
              this.postJsonRequestAjax(
                  url,
                  'POST',
                  this.objectMerge(data, this.params),
                  success,
                  fail,
                  before,
                  after
              );
            }
          
            objectMerge(a, b) {
              return Object.assign(a, b);
            }
          
            messageSuccess(mes, data) {
              return {
                error: false,
                message: mes,
                data: data || {}
              };
            }
          
            messageError(mes, data) {
              return {
                error: true,
                message: mes,
                data: data || {}
              };
            }
          }
        
          $('editor_block')
          .prop('contentEditable', true)
          .focusin(function () {
            let $this = $(this);
          })
          .focusout(function (e) {
            let $this = $(this);
          
            (new Request()).queryAjax('{{ route('ajax.change.lang') }}', {
                  name: $this.attr('data-name'),
                  text: $this.text()
                }, function (data, dataRaw) {
                  console.log('Сохранено!');
                  console.log($this.text());
                }, function () {
                
                },
                function () {
                  console.log('Сохранение');
                }
            );
          });
        
        });
      </script>
    @endif
    @stack('js')
  </body>

</html>