@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Form Validation')
{{-- vendor style --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/flag-icon/css/flag-icon.min.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12">
                <div id="validations" class="card card-tabs">
                    <div class="card-content">
                        <div class="card-title">
                            <div class="row">
                                <div class="col s12 m6 l10">
                                    <h4 class="card-title">Проверка платежной карты</h4>
                                </div>
                            </div>
                        </div>
                        <div id="view-validations">
                            @include('panels.inform')
                            <form class="formValidate" action="{{ route('bin-check.index') }}" id="formValidate" method="get">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="card_number">Номер карты*</label>
                                        <input id="card_number" name="card_number" type="text" data-error=".errorTxt1" value="{{ old('card_number') ?? $card_number ?? '' }}">
                                    </div>
                                    @if(isset($cardData) && !session()->has('error_short'))
                                        <table>
                                            <thead>
                                            <tr>
                                                <th>Бренд</th>
                                                <th>Тип карты</th>
                                                <th>Страна</th>
                                                <th>Валюта</th>
                                                <th>Имя банка</th>
                                                <th>Веб сайт банка</th>
                                                <th>Номер телефона банка</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{ $cardData['brand'] }}</td>
                                                <td>{{ $cardData['type'] }}</td>
                                                <td>{{ $cardData['flag'] }} {{ $cardData['country'] }} ({{ $cardData['symbol'] }})</td>
                                                <td>{{ $cardData['currency'] }}</td>
                                                <td>{{ $cardData['bank_name'] }}</td>
                                                <td>{{ $cardData['bank_url'] ? '<a target="_blank" href="' . $cardData['bank_url'] .'">' . $cardData['bank_url'] . '</a>' : '' }}</td>
                                                <td>{{ $cardData['bank_phone'] }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right submit" type="submit">
                                            Проверить
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/bin-check.js')}}"></script>
@endsection

