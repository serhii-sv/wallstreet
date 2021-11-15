{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title', 'Платежные системы')

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
            <div class="card card-default scrollspy">
                <div class="card-content">
                    <div class="row">
                        <div class="col s12">
                            <div class="display-flex align-items-center" style="padding: 5px;margin-bottom: 10px;">
                                <div style="width: 20%;font-weight: 900;">Название</div>
                                <div style="width: 20%;font-weight: 900;">Код</div>
                                <div style="width: 20%;font-weight: 900;">Валюты</div>
                                <div style="width: 20%;font-weight: 900;">Статус</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            @forelse($paymentSystems as $paymentSystem)
                                <div class="display-flex align-items-center" style="padding: 5px;border: 1px solid #f8f8f8;">
                                    <div style="width: 20%;">
                                        {{ $paymentSystem->name }}
                                    </div>
                                    <div style="width: 20%;">{{ $paymentSystem->code }}</div>
                                    <div style="width: 20%;">
                                        @foreach($paymentSystem->currencies as $currency)
{{ $loop->index > 0 ? ', ' : '' }} {{ $currency->code }}
                                        @endforeach
                                    </div>
                                    <div style="width: 20%;">{{ $paymentSystem->connected == 1 ? 'актив' : '' }}</div>
                                </div>
                            @empty
                                <div>
                                    Ничего нет
                                </div>
                            @endforelse
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
    </script>
@endsection
