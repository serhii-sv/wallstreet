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
  <link rel="stylesheet" href="{{ asset('vendors/sweetalert/sweetalert.css') }}">
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

      .delete-data-btn, .add-data-btn, .save-data-btn {
          padding: 0 1rem !important;
      }
  </style>
@endsection

{{-- page content --}}
@section('content')
  <div class="section mt-2 invoice-list-wrapper" id="blog-list">
    <div class="row">
      <div class="col s12 responsive-table mt-3">
        <table class="table white border-radius-4 pt-1">
          <thead>
            <tr class="border-none">
              <th rowspan="2" colspan="2">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Career status' contenteditable="true">{{ __('Career status') }}</editor_block>@else {{ __('Career status') }} @endif
              </th>
              <th colspan="2">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Deposit turnover' contenteditable="true">{{ __('Deposit turnover') }}</editor_block>@else {{ __('Deposit turnover') }} @endif
              </th>
              <th rowspan="2">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Reward' contenteditable="true">{{ __('Reward') }}</editor_block>@else {{ __('Reward') }} @endif
              </th>
              <th rowspan="2">@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Leadership bonus' contenteditable="true">{{ __('Leadership bonus') }}</editor_block>@else {{ __('Leadership bonus') }} @endif
              </th>
              <th rowspan="2"></th>
              <th></th>
            </tr>
            <tr class="border-none">
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Personal turnover' contenteditable="true">{{ __('Personal turnover') }}</editor_block>@else {{ __('Personal turnover') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Structural turnover' contenteditable="true">{{ __('Structural turnover') }}</editor_block>@else {{ __('Structural turnover') }} @endif
              </th>
            </tr>
          </thead>
          <tbody>
            @if($deposit_turnovers)
              @foreach($deposit_turnovers as $item)
                <tr class="bonus-list" data-id="{{ $item->id }}" data-personal-turnover="{{ $item->personal_turnover ?? 0 }}">
                  <td>
                    <input type="text" name="status_name" value="{{ $item->status_name ?? '' }}">
                  </td>
                  <td>
                    <input type="text" name="status_stage" value="{{ $item->status_stage ?? '' }}">
                  </td>
                  <td>
                    <input type="text" name="personal_turnover" value="{{ $item->personal_turnover ?? 0 }}">
                  </td>
                  <td>
                    <input type="text" name="total_turnover" value="{{ $item->total_turnover ?? 0 }}">
                  </td>
                  <td>
                    <input type="text" name="reward" value="{{ $item->reward ?? 0 }}">
                  </td>
                  <td>
                    <input type="text" name="leadership_bonus" value="{{ $item->leadership_bonus ?? '' }}">
                  </td>
                  <td>
                    <button class="btn blue darken-3 save-data-btn" data-id="{{ $item->id }}">
                      <i class="material-icons dp48">save</i>
                    </button>
                    <button class="btn delete-data-btn" data-id="{{ $item->id }}">
                      <i class="material-icons dp48">delete_forever</i>
                    </button>
                  </td>
                </tr>
              @endforeach
            @endif
            <tr class="new-bonus">
              <td>
                <input type="text" name="status_name" value="">
              </td>
              <td>
                <input type="text" name="status_stage" value="">
              </td>
              <td>
                <input type="text" name="personal_turnover" value="">
              </td>
              <td>
                <input type="text" name="total_turnover" value="">
              </td>
              <td>
                <input type="text" name="reward" value="">
              </td>
              <td>
                <input type="text" name="leadership_bonus" value="">
              </td>
              <td>
                <button class="btn add-data-btn" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                    <editor_block data-name='Add' contenteditable="true">{{ __('Add') }}</editor_block>@else {{ __('Add') }} @endif
                </button>
              </td>
            </tr>
          </tbody>
        </table>
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
      $("body").on('click', '.delete-data-btn', function () {
        var $button = $(this);

        swal({
          title: "Ты уверен?",
          text: "Запись будет удалена!",
          icon: 'warning',
          buttons: {
            cancel: true,
            delete: 'Yes, Delete It'
          }
        }).then((willDelete) => {
          if (willDelete) {
            $button.addClass('disabled');
            $id = $(this).attr('data-id');
            $("button[data-id='" + $id + "']").addClass('disabled');
            var $url = "{{ route('deposit.bonus.delete') }}";
            $.ajax({
              type: 'post',
              url: $url,
              data: 'id=' + $id,
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                $button.removeClass('disabled');
                data = $.parseJSON(data);
                $("tr[data-id='" + $id + "']").remove();
                M.toast({
                  html: data.msg,
                  classes: data.status === 'good' ? 'green' : 'red'
                })
              }
            });

          }
        });
      });

      $("body").on('click', '.add-data-btn', function () {
        var $button = $(this);
        if (!$button.hasClass('disabled')) {
          $button.addClass('disabled');
          $status_name = $(".new-bonus").find("input[name='status_name']").val();
          $status_stage = $(".new-bonus").find("input[name='status_stage']").val();
          $personal_turnover = $(".new-bonus").find("input[name='personal_turnover']").val();
          $total_turnover = $(".new-bonus").find("input[name='total_turnover']").val();
          $reward = $(".new-bonus").find("input[name='reward']").val();
          $leadership_bonus = $(".new-bonus").find("input[name='leadership_bonus']").val();
          if ($status_name.length > 0 && $status_stage.length > 0) {
            var $url = "{{ route('deposit.bonus.add') }}";
            $.ajax({
              type: 'post',
              url: $url,
              data: 'status_name=' + $status_name + '&status_stage=' + $status_stage + '&personal_turnover=' + $personal_turnover + '&total_turnover=' + $total_turnover + '&reward=' + $reward + '&leadership_bonus=' + $leadership_bonus,
              headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
              },
              success: function (data) {
                $button.removeClass('disabled');
                data = $.parseJSON(data);
                $(".new-bonus").find("input[name='status_name']").val('');
                $(".new-bonus").find("input[name='status_stage']").val('');
                $(".new-bonus").find("input[name='personal_turnover']").val('');
                $(".new-bonus").find("input[name='total_turnover']").val('');
                $(".new-bonus").find("input[name='reward']").val('');
                $(".new-bonus").find("input[name='leadership_bonus']").val('');

                $(".bonus-list").each(function (i, el) {
                  if (parseInt($(el).attr('data-personal-turnover')) > $personal_turnover) {
                    $(el).before('<tr class="new-bonus" data-id="' + data.id + '" data-personal-turnover="' + $personal_turnover + '">' +
                        '<td>' +
                        '<input type="text" name="status_name" value="' + $status_name + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="status_stage" value="' + $status_stage + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="personal_turnover" value="' + $personal_turnover + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="total_turnover" value="' + $total_turnover + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="reward" value="' + $reward + '">' +
                        '</td>' +
                        '<td>' +
                        '<input type="text" name="leadership_bonus" value="' + $leadership_bonus + '">' +
                        '</td>' +
                        '<td>' +
                        ' <button class="btn blue darken-3 save-data-btn" data-id="' + data.id + '">' +
                        '<i class="material-icons dp48">save</i>' +
                        '</button>' +
                        '<button class="btn delete-data-btn" data-id="' + data.id + '">' +
                        '<i class="material-icons dp48">delete_forever</i>' +
                        ' </button>' +
                        '</td>' +
                        '</tr>');
                    return false;
                  }
                })

                M.toast({
                  html: data.msg,
                  classes: data.status === 'good' ? 'green' : 'red'
                })
              }
            });
          } else if (!($status_name.length > 0) || !($status_stage.length > 0)) {
            $button.removeClass('disabled');
            M.toast({
              html: 'Требуется название статуса и стадия статуса',
              classes: 'red'
            })
          }
        }
      });


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
          } else if (!($status_name.length > 0) || !($status_stage.length > 0)) {
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
