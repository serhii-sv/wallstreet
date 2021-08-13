{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'eCommerce Pricing')

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
                        <a href="{{ route('rates.create') }}" class="btn btn-block waves-effect waves-light width-20">Добавить тариф</a>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div class="row">
                                <div class="plans-container">
                                    @foreach($rates as $key => $rate)
                                    <div class="col s12 m6 l4">
                                        <div class="card z-depth-1 animate fadeLeft">
                                            <div class="card-image teal waves-effect">
                                                <div class="card-title">{{ $rate->name }}</div>
                                                <div class="price" style="font-size: 20px">
                                                    Минимальный взнос: {{ number_format($rate->min, 2, '.', ',') }}
                                                </div>
                                                <div class="price" style="font-size: 20px">
                                                    Максимальный взнос: {{ number_format($rate->max, 2, '.', ',') }}
                                                </div>
                                            </div>
                                            <div class="card-content">
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
                                                <a href="{{ route('rates.edit', $rate->id) }}" class="waves-effect waves-light light-blue btn">Редактировать</a>
                                                <a href="{{ route('rates.destroy', $rate->id) }}" class="waves-effect waves-light light-red btn mt-4">Удалить</a>
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
