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
            <h4 class="card-title">Тарифы</h4>
            <a href="{{ route('rates.create') }}" class="btn btn-block waves-effect waves-light width-20">Добавить
              тариф
            </a>
          </div>
          <div class="row">
            <div class="col s12">
              <div class="row">
                  @foreach($rate_groups as $key => $rate_group)
                      <div style="clear:both;"></div>
                      <hr style="margin:30px 0 30px 0;">
                      <h3>{{ $rate_group->name }}</h3>
                      @php($rates = \App\Models\Rate::where('rate_group_id', $rate_group->id)->orderBy('min')->get())
                      <div class="plans-container" style="display: flex; flex-wrap: wrap;">
                          @foreach($rates as $rate)
                              <div class="col s12 m6 l4" style=" margin-bottom: 30px;/*max-width: 365px;flex-basis: calc(33.333% - 20px);margin-left: 20px;min-height: 489px*/">
                                  <div class="card z-depth-1 animate fadeLeft" style="height: 100%">
                                      <div class="card-image teal waves-effect">
                                          <div class="card-title">{{ $rate->name }}</div>
                                          <div class="price" style="font-size: 18px">
                                              Минимальный взнос: {{ number_format($rate->min, 2, '.', ',') }} $
                                          </div>
                                          <div class="price" style="font-size: 18px">
                                              Максимальный взнос: {{ number_format($rate->max, 2, '.', ',') }} $
                                          </div>
                                      </div>
                                      <div class="card-content">
                                          <ul class="collection">
                                              <li class="collection-item">Срок действия депозита: {{ $rate->duration }}</li>
                                              <li class="collection-item">Суточный процент: {{ $rate->daily ? $rate->daily . '%' : 'отсутствует' }}</li>
                                              <li class="collection-item">{{ $rate->reinvest ? 'Можно реинвестировать' : 'Нельзя реинвестировать' }}</li>
                                              <li class="collection-item">{{ $rate->upgradable ? 'Апгрейд доступен' : 'Апгред не доступен' }}</li>

                                              @if($rate->overall)
                                                  <li class="collection-item">Возврат депозита: {{ $rate->overall }}% в конце срока</li>
                                              @else
                                                  <li class="collection-item">Депозит не возвращается</li>
                                              @endif
                                          </ul>
                                      </div>
                                      <div class="card-action center-align">
                                          <div>
                                              <a href="{{ route('rates.edit', $rate->id) }}" class="waves-effect waves-light light-blue btn">Редактировать</a>
                                          </div>
                                          <div>
                                              <a href="{{ route('rates.destroy', $rate->id) }}" class="delete-rate waves-effect waves-light light-red btn mt-4">Удалить</a>
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
