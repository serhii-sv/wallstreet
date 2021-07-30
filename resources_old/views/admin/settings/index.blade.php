@extends('admin.layouts.app')
@section('title')
    {{ __('Settings') }}
@endsection
@section('breadcrumbs')
    <li> {{ __('Settings') }}</li>
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!-- col -->
        <div class="col-md-12">

            <!-- tile -->
            <section class="tile">

                <!-- tile header -->
                <div class="tile-header dvd dvd-btm">
                    <h1 class="custom-font">{{ __('Settings') }}</h1>
                    <ul class="controls">
                        <li>
                            <a role="button" class="tile-fullscreen">
                                <i class="fa fa-expand"></i> {{ __('Fullscreen') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- /tile header -->

                <!-- tile body -->
                <div class="tile-body">

                    <form class="form-horizontal" method="POST"
                          action="{{ route('admin.settings.change-many') }}">
                        {{ csrf_field() }}
                        <fieldset>

                            <!-- Form Name -->
                            <legend>{{ __('Contacts') }} </legend>

                        <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textinput">{{ __('Phone') }}</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="phone" type="tel"
                                           class="form-control input-md"
                                           value="{{ \App\Models\Setting::getValue('phone') }}">
                                    <span class="help-block"> </span>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textinput">{{ __('Email') }}</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="email" type="email"
                                           class="form-control input-md"
                                           value="{{ \App\Models\Setting::getValue('email') }}">
                                    <span class="help-block"> </span>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textinput">{{ __('Telegram') }}</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="telegram" type="tel"
                                           class="form-control input-md"
                                           value="{{ \App\Models\Setting::getValue('telegram') }}">
                                    <span class="help-block"> </span>
                                </div>
                            </div>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textinput">{{ __('WhatsApp') }}</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="whatsapp" type="tel"
                                           class="form-control input-md"
                                           value="{{ \App\Models\Setting::getValue('whatsapp') }}">
                                    <span class="help-block"> </span>
                                </div>
                            </div>
                            <!-- Form Name -->
                            <legend>{{ __('Company info') }} </legend>
                            <!-- Text input-->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textinput">{{ __('Company name') }}</label>
                                <div class="col-md-6">
                                    <input id="textinput" name="company_name" type="text"
                                           class="form-control input-md"
                                           value="{{ \App\Models\Setting::getValue('company_name') }}">
                                    <span class="help-block"> </span>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textarea">{{ __('Address') }}</label>
                                <div class="col-md-6">
                                            <textarea class="form-control" id="textarea" rows="5"
                                                      name="address"> {!! \App\Models\Setting::getValue('address') !!}</textarea>
                                </div>
                            </div>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textarea">{{ __('Working time') }}</label>
                                <div class="col-md-6">
                                            <textarea class="form-control" id="textarea" rows="5"
                                                      name="working_time"
                                                      required> {!! \App\Models\Setting::getValue('working_time') !!}</textarea>
                                </div>
                            </div>
                            <!-- Form Name -->
                            <legend>{{ __('Technical') }} </legend>
                            <!-- Textarea -->
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="textarea">{{ __('Online chat') }}</label>
                                <div class="col-md-6">
                                            <textarea class="form-control" id="textarea" rows="10"
                                                      name="online_chat"
                                                      required> {!! \App\Models\Setting::getValue('online_chat') !!}</textarea>
                                </div>
                            </div>

                        <!-- Button -->
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="singlebutton"> </label>
                                <div class="col-md-4">
                                    <button id="singlebutton" class="btn btn-primary">{{ __('Save settings') }}</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <!-- /tile body -->

            </section>
            <!-- /tile -->

        </div>
        <!-- /col -->
    </div>
    <!-- /row -->
@endsection
