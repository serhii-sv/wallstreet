{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Переводы')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
    <style>
        editor_block {
            min-width: 100%;
        }
        .edit-block-border-bottom {
            border-bottom: 1px solid #9e9e9e;
            margin-top: 34px;
            min-width: 40%;
            position: absolute;
        }
        .edit-block-border-bottom.focus {
            border-bottom: 1px solid #ff4081;
            box-shadow: 0 1px 0 0 #ff4081;
        }
    </style>
@endsection

{{-- page content --}}
@section('content')
    <div class="card">
        <div class="card-content">
            <h6>
                @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Переводы' contenteditable="true">{{ __('Переводы') }}</editor_block>@else {{ __('Переводы') }} @endif
                    <a href="{{ route('translations.translate-all') }}" class="btn float-right grey ml-2">
                        @if(canEditLang() && checkRequestOnEdit())
                            <editor_block data-name='Скачать переводы' contenteditable="true">{{ __('Перевести все') }}</editor_block>
                        @else
                            {{ __('Перевести все') }}
                        @endif
                    </a>
                <a href="{{ route('translations.download') }}" class="btn float-right">
                    @if(canEditLang() && checkRequestOnEdit())
                        <editor_block data-name='Скачать переводы' contenteditable="true">{{ __('Скачать переводы') }}</editor_block>
                    @else
                        {{ __('Скачать переводы') }}
                    @endif
                </a>
            </h6>

            <div class="row">
                <div class="col s12 mt-4">
                    <ul class="tabs tabs-fixed-width tab-demo z-depth-1">
                        @foreach($translationsFor as $key => $text)
                            <li class="tab"><a href="#{{ $key }}">{{ $text }}</a></li>
                        @endforeach
                    </ul>
                </div>
                @foreach($translationsFor as $key => $text)
                    <div id="{{ $key }}" class="col s12 translations">
                        <div class="row">
                            <div class="col s12 mt-4">
                                <ul class="tabs tab-demo z-depth-1">
                                    @foreach($languages as $language)
                                        <li class="tab"><a href="#{{$key}}_{{ $language->code }}">{{ $language->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            @foreach($languages as $language)
                                <div id="{{ $key }}_{{ $language->code }}" class="col s12 mt-4 translations {{ $loop->index == 0 ? 'active' : '' }}">
                                    <div style="display: flex;align-items: center;margin-bottom: 10px;">
                                        <div style="width: 50%">
                                            @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Ключ' contenteditable="true">{{ __('Ключ') }}</editor_block>@else {{ __('Ключ') }} @endif
                                        </div>
                                        <div style="width: 50%;margin-left: 40px;">
                                            @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Контент' contenteditable="true">{{ __('Контент') }}</editor_block>@else {{ __('Контент') }} @endif
                                        </div>
                                    </div>
                                    @forelse($translationKeys[$key] as $translationKey)
                                        <div style="padding: 10px 0;border-bottom: 1px solid #939393;">
                                            <form action="" method="post"
                                                  style="display: flex;align-items: center;">
                                                @csrf
                                                {{ method_field('PATCH') }}
                                                <div style="width: 50%">
                                      <span class="users-view-status ">
                                        <input
                                            class="lighten-5 chip green green-text"
                                            name="name"
                                            type="text"
                                            value="{{ $translationKey }}"
                                            readonly="readonly">
                                      </span>
                                                </div>
                                                <div style=" width: 50%;margin-left: 50px;" class="">
                                                    <div style="display: flex;align-items: center;width: 100%;">
                                                        <editor_block class="translate" data-site="{{ $key }}" data-name='{{ $translationKey }}' data-locale_name="{{ $language->code }}" contenteditable="true">{{ $translations[$key][$language->code][$translationKey] ?? '' }}</editor_block>
                                                        <div class="edit-block-border-bottom"></div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    @empty
                                    @endforelse
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')

    <script>
        $(document).ready(function () {
            $('.translations editor_block').closest('div').click(function () {
                $('.edit-block-border-bottom').removeClass('focus');
                $(this).find('.edit-block-border-bottom').toggleClass('focus');
            })
        });
    </script>
    <script>
        $(document).ready(function () {
            class Request {
                constructor() {
                    this.protocol = '';
                    this.domain = '';
                    this.params = {};

                }

                postJsonRequestAjax(url, method, data, callbackSuccess, callbackFail, callbackBefore, callbackAfter) {
                    callbackSuccess = callbackSuccess || function () {
                    };
                    callbackFail = callbackFail || function () {
                    };
                    callbackBefore = callbackBefore || function () {
                    };
                    callbackAfter = callbackAfter || function () {
                    };
                    method = method || 'POST';
                    data = data || {};
                    url = url || '';

                    callbackBefore({}, data);

                    $.ajax({
                        type: method,
                        url: url,
                        data: data,
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.error) {
                                callbackFail({}, data);
                                callbackAfter({}, data);
                                return;
                            }
                            callbackSuccess(data.data, data);
                            callbackAfter({}, data);
                        },
                        error: function (data) {
                            callbackFail({}, data);
                            callbackAfter({}, data);
                        }
                    });
                }

                queryAjax(url, data, success, fail, before, after) {
                    data = data || {};
                    this.postJsonRequestAjax(
                        url,
                        'POST',
                        this.objectMerge(data, this.params),
                        success,
                        fail,
                        before,
                        after
                    );
                }

                objectMerge(a, b) {
                    return Object.assign(a, b);
                }

                messageSuccess(mes, data) {
                    return {
                        error: false,
                        message: mes,
                        data: data || {}
                    };
                }

                messageError(mes, data) {
                    return {
                        error: true,
                        message: mes,
                        data: data || {}
                    };
                }
            }

            $('editor_block.translate')
                .prop('contentEditable', true)
                .focusin(function () {
                    let $this = $(this);
                })
                .focusout(function (e) {
                    let $this = $(this);

                    (new Request()).queryAjax('{{ route('ajax.change.lang') }}', {
                            name: $this.attr('data-name'),
                            locale_name: $this.attr('data-locale_name'),
                            send_to_client: $this.attr('data-site') === 'client',
                            text: $this.text()
                        }, function (data, dataRaw) {
                            M.toast({
                                html: 'Сохранено!',
                                classes: 'green'
                            });
                            console.log($this.text());
                        }, function () {

                        },
                        function () {
                            console.log('Сохранение');
                        }
                    );
                });

        });
    </script>
@endsection
