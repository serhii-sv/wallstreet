{{-- layout extend --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice List')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css"
          href="{{asset('vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/data-tables/css/dataTables.checkboxes.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/sweetalert/sweetalert.css')}}">
@endsection

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <!-- invoice list -->
    <section class="invoice-list-wrapper section">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-body">
                        <div class="row display-flex align-items-center" style="padding: 15px">
                            <div class="col s12 l6">
                                <div class="row">
                                    <div class="col s12 l6" style="padding-top: 5px">
                                        @if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Таймер'
                                                          contenteditable="true">{{ __('Таймер') }}</editor_block>@else {{ __('Таймер') }} @endif
                                        ({{ App\Models\Setting::getValue('autoaccept_documents_timer_enablde', 'off', true) == 'on' ? 'Включен' : 'Выключен' }})
                                    </div>
                                    <div class="col s12 l6">
                                        @if(App\Models\Setting::getValue('autoaccept_documents_timer_enablde', 'off', true) == 'on')
                                            <a href="#" class="btn waves-effect waves-light grey">Да</a>
                                            <a href="{{ route('verification-requests.updateTimerStatus', ['timer' => 'off']) }}"
                                               class="btn waves-effect waves-light">Нет</a>
                                        @else
                                            <a href="{{ route('verification-requests.updateTimerStatus', ['timer' => 'on']) }}"
                                               class="btn waves-effect waves-light">Да</a>
                                            <a href="#" class="btn waves-effect waves-light grey">Нет</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 l6">
                                <div class="row">
                                    <div class="col s12 l6" style="padding-top: 15px">
                                        @if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Количество часов'
                                                          contenteditable="true">{{ __('Количество часов') }}</editor_block>@else {{ __('Количество часов') }} @endif
                                    </div>
                                    <div class="col s12 l6">
                                        <input id="hours" type="number"
                                               value="{{ App\Models\Setting::getValue('autoaccept_documents_timer_hours', 5, true) }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="responsive-table">
            <table class="table verification-requests white border-radius-4 pt-1">
                <thead>
                <tr>
                    <th></th>
                    <th>
                        <span>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Email#'
                                              contenteditable="true">{{ __('Email#') }}</editor_block>
                            @else
                                {{ __('Email#') }}
                            @endif</span>
                    </th>
                    <th>
                        <span>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='Авто подтверждение'
                                              contenteditable="true">{{ __('Авто подтверждение') }}</editor_block>
                            @else
                                {{ __('Авто подтверждение') }}
                            @endif</span>
                    </th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                        @else
                            {{ __('Date') }}
                        @endif</th>
                    <th>
                        <span>@if(canEditLang() && checkRequestOnEdit())
                                <editor_block data-name='До авто подтверждения осталось'
                                              contenteditable="true">{{ __('До авто подтверждения осталось') }}</editor_block>
                            @else
                                {{ __('До авто подтверждения осталось') }}
                            @endif</span>
                    </th>
                    <th>@if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Actions' contenteditable="true">{{ __('Actions') }}</editor_block>
                        @else
                            {{ __('Actions') }}
                        @endif</th>
                </tr>
                </thead>

                <tbody>

                </tbody>
            </table>
        </div>
    </section>
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('vendors/data-tables/js/datatables.checkboxes.min.js')}}"></script>
    <script src="{{asset('vendors/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(function () {
            $('#hours').focusout(function () {
                $.ajax({
                    url: '{{ route('verification-requests.updateTimerHours') }}',
                    method: 'post',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'hours': $(this).val()
                    },
                    success: (response) => {
                        M.toast({
                            html: response.message,
                            classes: response.success ? 'green' : 'red'
                        })
                        setTimeout(function () {
                            location.reload()
                        }, 200)
                    }
                });
            });
        });
    </script>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/user-verification-requests.js')}}"></script>
@endsection
