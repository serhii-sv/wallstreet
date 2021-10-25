{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Тарифные планы')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/pricing.css')}}">
@endsection

{{-- page content --}}
@section('content')
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="basic-tabs" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="display-flex justify-content-between">
            <h4 class="card-title">@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Tariffs' contenteditable="true">{{ __('Tariffs') }}</editor_block>@else {{ __('Tariffs') }} @endif
            </h4>
            <a href="{{ route('rates.create') }}" class="btn btn-block waves-effect waves-light width-20" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())
                <editor_block data-name='Add tariff' contenteditable="true">{{ __('Add tariff') }}</editor_block>@else {{ __('Add tariff') }} @endif
            </a>
          </div>
          <div class="row">
            <div class="col s12">
                @foreach($rate_groups as $key => $rate_group)
                  <div style="clear:both;"></div>
                  <hr style="margin:30px 0 30px 0;">
                  <h3>{{ $rate_group->name }}</h3>
                  @php($rates = \App\Models\Rate::where('rate_group_id', $rate_group->id)->orderBy('min')->get())
                  <div class="plans-container" style="display: flex; flex-wrap: wrap;">
                    @foreach($rates as $rate)
                      <div class="col s12 m6 l4" style="margin: 0 0 30px;/*max-width: 365px;flex-basis: calc(33.333% - 20px);margin-left: 20px;min-height: 489px*/">
                        <div class="card z-depth-1 animate fadeLeft" style="height: 100%">
                          <div class="card-image teal waves-effect">
                            <div class="card-title">{{ $rate->name }}</div>
                            <div class="price" style="font-size: 18px">
                              @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Minimum contribution' contenteditable="true">{{ __('Minimum contribution') }}</editor_block>@else {{ __('Minimum contribution') }} @endif: {{ number_format($rate->min, 2, '.', ',') }} $
                            </div>
                            <div class="price" style="font-size: 18px">
                              @if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Maximum contribution' contenteditable="true">{{ __('Maximum contribution') }}</editor_block>@else {{ __('Maximum contribution') }} @endif: {{ number_format($rate->max, 2, '.', ',') }} $
                            </div>
                          </div>
                          <div class="card-content">
                            <ul class="collection">
                              <li class="collection-item">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Term of the deposit' contenteditable="true">{{ __('Term of the deposit') }}</editor_block>@else {{ __('Term of the deposit') }} @endif: {{ $rate->duration }}
                              </li>
                              <li class="collection-item">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Daily percentage' contenteditable="true">{{ __('Daily percentage') }}</editor_block>@else {{ __('Daily percentage') }} @endif: {{ $rate->daily ? $rate->daily . '%' : __('Absent') }}
                              </li>
                              <li class="collection-item">
                                @if($rate->reinvest)
                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Can be reinvested' contenteditable="true">{{ __('Can be reinvested') }}</editor_block>@else {{ __('Can be reinvested') }} @endif
                                @else
                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name="Can't be reinvested" contenteditable="true">{{ __("Can't be reinvested") }}</editor_block>@else {{ __("Can't be reinvested") }} @endif
                                @endif
                              </li>
                              <li class="collection-item">
                                @if($rate->upgradable)
                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name='Upgrade available' contenteditable="true">{{ __('Upgrade available') }}</editor_block>@else {{ __('Upgrade available') }} @endif
                                @else
                                  @if(canEditLang() && checkRequestOnEdit()) <editor_block data-name="Upgrade not available" contenteditable="true">{{ __("Upgrade not available") }}</editor_block>@else {{ __("Upgrade not available") }} @endif
                                @endif
                              </li>
                              @if($rate->overall)
                                <li class="collection-item">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Refund of a deposit' contenteditable="true">{{ __('Refund of a deposit') }}</editor_block>@else {{ __('Refund of a deposit') }} @endif: {{ $rate->overall }}% @if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='at the end of the term' contenteditable="true">{{ __('at the end of the term') }}</editor_block>@else {{ __('at the end of the term') }} @endif
                                </li>
                              @else
                                <li class="collection-item">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='The deposit is not refundable' contenteditable="true">{{ __('The deposit is not refundable') }}</editor_block>@else {{ __('The deposit is not refundable') }} @endif
                                </li>
                              @endif
                            </ul>
                          </div>
                          <div class="card-action center-align">
                            <div>
                              <a href="{{ route('rates.edit', $rate->id) }}" class="waves-effect waves-light light-blue btn">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Edit' contenteditable="true">{{ __('Edit') }}</editor_block>@else {{ __('Edit') }} @endif
                              </a>
                            </div>
                            <div>
                              <a href="{{ route('rates.destroy', $rate->id) }}" class="delete-rate waves-effect waves-light light-red btn mt-4">@if(canEditLang() && checkRequestOnEdit())
                                  <editor_block data-name='Delete' contenteditable="true">{{ __('Delete') }}</editor_block>@else {{ __('Delete') }} @endif
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endforeach
                  </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
@endsection

@section('page-script')
  <script>
    /*
* Form Validation
*/
    $(function () {
      $(document).on('click', '.delete-rate', function () {
        swal({
          title: "Вы уверены что хотите удалить этот тариф?",
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
            location.href = $(this).attr('href')
          }
        })
        return false;
      })
    });
  </script>
@endsection
