{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Blog List Page')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" type="text/css"
      href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
  <style>
      thead {
          background: #f8f8f8;
      }

      th {
          border: 1px solid #e7e7e7;
          text-align: center;
      }

      td {
          border: 1px solid #e7e7e7;
          text-align: center;
          padding: 0;
      }

      tbody input {
          margin-bottom: 0 !important;
          text-align: center;
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <div class="section mt-2 invoice-list-wrapper" id="blog-list">
    <div class="row">
      <div class="col s12 mt-2">
        
        <div class="col s12 responsive-table mt-3">
          <table class="table white border-radius-4 pt-1">
            <thead>
              <tr class="border-none">
                <th rowspan="2" colspan="2">Карьерный статус</th>
                <th colspan="2">Оборот депозитов</th>
                <th rowspan="2">Вознаграждение</th>
                <th rowspan="2">Лидерский бонус</th>
                <th rowspan="2"></th>
                <th></th>
              </tr>
              <tr class="border-none">
                <th>Личный оборот</th>
                <th>Структурный оборот</th>
              </tr>
            </thead>
            <tbody>
              @if($deposit_turnovers)
                @foreach($deposit_turnovers as $item)
                  <tr data-id="{{ $item->id }}">
                    <td>
                      <input type="text" name="status_name" value="{{ $item->status_name ?? '' }}">
                    </td>
                    <td>
                      <input type="text" name="status_stage" value="{{ $item->status_stage ?? '' }}">
                    </td>
                    <td>
                      <input type="text" name="personal_turnover" value="{{ $item->personal_turnover ?? '' }}">
                    </td>
                    <td>
                      <input type="text" name="total_turnover" value="{{ $item->total_turnover ?? '' }}">
                    </td>
                    <td>
                      <input type="text" name="reward" value="{{ $item->reward ?? '' }}">
                    </td>
                    <td>
                      <input type="text" name="leadership_bonus" value="{{ $item->leadership_bonus ?? '' }}">
                    </td>
                    <td>
                      <button class="btn save-data-btn" data-id="{{ $item->id }}">Сохранить</button>
                    </td>
                  </tr>
                @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
  <script>
    $(document).ready(function () {
      var $id, $status_name, $status_stage, $personal_turnover, $total_turnover, $reward, $leadership_bonus;
      
      $("body").on('click', '.save-data-btn', function () {
        var $button = $(this);
        if (!$button.hasClass('disabled')) {
          $button.addClass('disabled');
          $id = $button.attr('data-id');
          $status_name = $("tr[data-id='" + $id + "']").find("input[name='status_name']").val();
          $status_stage = $("tr[data-id='" + $id + "']").find("input[name='status_stage']").val();
          $personal_turnover = $("tr[data-id='" + $id + "']").find("input[name='personal_turnover']").val();
          $total_turnover = $("tr[data-id='" + $id + "']").find("input[name='total_turnover']").val();
          $reward = $("tr[data-id='" + $id + "']").find("input[name='reward']").val();
          $leadership_bonus = $("tr[data-id='" + $id + "']").find("input[name='leadership_bonus']").val();
          
          if ($status_name.length > 0 && $status_stage.length > 0) {
            var $url = "{{ route('deposit.bonus.set') }}";
            $.ajax({
              type: 'post',
              url: $url,
              data: 'id=' + $id + '&status_name=' + $status_name + '&status_stage=' + $status_stage + '&personal_turnover=' + $personal_turnover + '&total_turnover=' + $total_turnover + '&reward=' + $reward + '&leadership_bonus=' + $leadership_bonus,
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                $button.removeClass('disabled');
                data = $.parseJSON(data);
             
                M.toast({
                  html: data.msg,
                  classes: data.status === 'good' ? 'green' : 'red'
                })
              }
            });
          }
          else if(!($status_name.length > 0) || !($status_stage.length > 0)){
            $button.removeClass('disabled');
            M.toast({
              html: 'Status name and Status stage is required',
              classes: 'red'
            })
          }
        }
      });
    });
  </script>
@endsection