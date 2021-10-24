{{-- extend layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','App Invoice View' )

{{-- page styles --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/app-invoice.css')}}">
@endsection

{{-- page content --}}
@section('content')
    <!-- app invoice View Page -->
    <section class="invoice-view-wrapper section">
        <div class="row">
        @include('pages.partials.notifications')
            <!-- invoice view page -->
            <div class="col xl9 m8 s12">
                <div class="card">
                    <div class="card-content invoice-print-area">
                        <!-- header section -->
                        <div class="row invoice-date-number">
                            <div class="col xl4 s12">
                                <span class="invoice-number mr-1">@if(canEditLang() && checkRequestOnEdit())
                                    <editor_block data-name='Deposit' contenteditable="true">{{ __('Deposit') }}</editor_block>
                                  @else
                                    {{ __('Deposit') }}
                                  @endif</span>
{{--                                <span>{{ $transaction->id }}</span>--}}
                            </div>
                            <div class="col xl8 s12">
                                <div class="invoice-date display-flex align-items-center flex-wrap">
                                    <div class="mr-3">
                                        <small>@if(canEditLang() && checkRequestOnEdit())
                                            <editor_block data-name='Date' contenteditable="true">{{ __('Date') }}</editor_block>
                                          @else
                                            {{ __('Date') }}
                                          @endif:</small>
                                        <span>{{ $deposit->created_at->format('d-m-Y H:i') }}</span>
                                    </div>
{{--                                    <div>--}}
{{--                                        <small>Date Due:</small>--}}
{{--                                        <span>08/10/2019</span>--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                        </div>
                        <!-- logo and title -->
{{--                        <div class="row mt-3 invoice-logo-title">--}}
{{--                            <div class="col m6 s12 display-flex invoice-logo mt-1 push-m6">--}}
{{--                                <img src="{{asset('images/gallery/pixinvent-logo.png')}}" alt="logo" height="46" width="164">--}}
{{--                            </div>--}}
{{--                            <div class="col m6 s12 pull-m6">--}}
{{--                                <h4 class="indigo-text">Invoice</h4>--}}
{{--                                <span>Software Development</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="divider mb-3 mt-3"></div>
                        <!-- invoice address and contact -->
                        <div class="row invoice-info">
                            <div class="col m6 s12">
{{--                                <h6 class="invoice-from">Bill From</h6>--}}
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='# Deposit' contenteditable="true">{{ __('# Deposit') }}</editor_block>
                                      @else
                                        {{ __('# Deposit') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
{{--                                    <span>Тип транзации</span>--}}
                                </div>
                                <div class="invoice-address">
{{--                                    <span>Email пользователя</span>--}}
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Payment system' contenteditable="true">{{ __('Payment system') }}</editor_block>
                                      @else
                                        {{ __('Payment system') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Rate' contenteditable="true">{{ __('Rate') }}</editor_block>
                                      @else
                                        {{ __('Rate') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Currency' contenteditable="true">{{ __('Currency') }}</editor_block>
                                      @else
                                        {{ __('Currency') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='% in a day' contenteditable="true">{{ __('% in a day') }}</editor_block>
                                      @else
                                        {{ __('% in a day') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Wallet' contenteditable="true">{{ __('Wallet') }}</editor_block>
                                      @else
                                        {{ __('Wallet') }}
                                      @endif</span>
                                </div>
{{--                                <div class="invoice-address">--}}
{{--                                    <span>Сумма в $</span>--}}
{{--                                </div>--}}
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Date of next accrual' contenteditable="true">{{ __('Date of next accrual') }}</editor_block>
                                      @else
                                        {{ __('Date of next accrual') }}
                                      @endif</span>
                                </div>
                                <div class="invoice-address">
                                    <span>@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Total left to accrue' contenteditable="true">{{ __('Total left to accrue') }}</editor_block>
                                      @else
                                        {{ __('Total left to accrue') }}
                                      @endif</span>
                                </div>
                            </div>
                            <div class="col m6 s12">
                                <div class="divider show-on-small hide-on-med-and-up mb-3"></div>
{{--                                <h6 class="invoice-to">Bill To</h6>--}}
                                <div class="invoice-address">
                                    <span>{{ $deposit->id }}</span>
                                </div>
                                <div class="invoice-address">
{{--                                    <span>{{ $deposit->name ?? 'Не указано' }}</span>--}}
                                </div>
                                <div class="invoice-address">
{{--                                    <span><a href="{{ route('users.show', $deposit->user->id) }}">{{ $deposit->user->email }}</a></span>--}}
                                </div>
                                <div class="invoice-address">
                                    <span>{{ $deposit->paymentSystem->name ?? __('Not indicated') }}</span>
                                </div>
                                <div class="invoice-address">
                                    <span>{{ $deposit->rate->name }}</span>
                                </div>
                                <div class="invoice-address">
                                    <span>{{ $deposit->currency->symbol }} ({{ $deposit->currency->name }})</span>
                                </div>
                                <div class="invoice-address">
                                    <span>{{ $deposit->daily }}</span>
                                </div>
                                <div class="invoice-address">
                                    <span>{{ $deposit->wallet_id }}</span>
                                </div>
                                <div class="invoice-address">
                                    <span>{{ !is_null($deposit->nextPayment()) ? $deposit->nextPayment()->created_at->format('d-m-Y H:i') : '-' }}</span>
                                </div>
                                <div class="invoice-address">
                                    <span>≈ {{ $deposit->needToCharge() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="divider mt-3 mb-3"></div>
                    </div>
                </div>
            </div>
            <!-- invoice action  -->
            <div class="col xl3 m4 s12">
                <div class="card invoice-action-wrapper">
                    <div class="card-content">
                        <div class="invoice-action-btn">
                            <form id="deleteTransaction" action="{{ route('deposits.destroy', $deposit->id) }}" class="display-flex align-items-center justify-content-center" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="btn waves-effect waves-light display-flex align-items-center justify-content-center">
                                    <i class="material-icons mr-3">clear</i>
                                    <span class="text-nowrap">@if(canEditLang() && checkRequestOnEdit())
                                        <editor_block data-name='Delete' contenteditable="true">{{ __('Delete') }}</editor_block>
                                      @else
                                        {{ __('Delete') }}
                                      @endif</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

{{-- page scripts --}}
@section('page-script')
    <script src="{{asset('js/scripts/app-invoice.js')}}"></script>
@endsection
