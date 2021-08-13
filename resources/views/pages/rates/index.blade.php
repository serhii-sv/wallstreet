{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'eCommerce Pricing')

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
                            тариф</a>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="plans-container" style="display: flex; flex-wrap: wrap;">
                                    @foreach($rates as $key => $rate)
                                        <div class="col s12 m6 l4" style="max-width: 365px; margin-bottom: 30px;flex-basis: calc(33.333% - 20px);margin-left: 20px;min-height: 489px">
                                            <div class="card z-depth-1 animate fadeLeft" style="height: 100%">
                                                <div class="card-image teal waves-effect">
                                                    <div class="card-title">{{ $rate->name }}</div>
                                                    <div class="price" style="font-size: 20px">
                                                        Минимальный взнос: {{ number_format($rate->min, 2, '.', ',') }}
                                                    </div>
                                                    <div class="price" style="font-size: 20px">
                                                        Максимальный взнос: {{ number_format($rate->max, 2, '.', ',') }}
                                                    </div>
                                                </div>
                                                <div class="card-content" style="height: 45%">
                                                    <ul class="collection">
                                                        <li class="collection-item">Срок действия депозита: {{ $rate->duration }}</li>
                                                        @if($rate->reinvest)
                                                            <li class="collection-item">Возможность реинвестировать</li>
                                                        @endif
                                                        @if($rate->upgradable)
                                                            <li class="collection-item">Возможность апгрейда</li>
                                                        @endif
                                                        @if($rate->autoclose)
                                                            <li class="collection-item">Возврат депозита в конце срока</li>
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
