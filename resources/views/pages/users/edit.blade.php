{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users edit')

{{-- vendor styles --}}
@section('vendor-style')
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('vendors/select2/select2-materialize.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">

  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content --}}
@section('content')


  <!-- users edit start -->
  <div class="section users-edit users-view">
    <div class="card-panel">
      @include('panels.inform')
      <div class="row">
        <div class="col s12 m6">
          <div class="display-flex media">
            <a href="#" class="avatar">
              <img src="{{asset('images/avatar/user.svg')}}" alt="users view avatar" class="z-depth-4 circle" height="64" width="64">
            </a>
              <div class="media-body width-50">
                  <h6 class="media-heading">
                      <span class="users-view-name">{{ $user->name ?? 'Не указано' }}</span>
                      <span class="grey-text">@</span>
                      <span class="users-view-username grey-text">{{ $user->login ?? 'Не указан' }}</span>
                  </h6>
                  <div class="row">
                      {{--                    <div class="col s12 m2">--}}
                      {{--                        <span>ID:</span>--}}
                      {{--                        <span class="users-view-id">{{ $user->int_id ?? 'Не указан' }}</span>--}}
                      {{--                    </div>--}}
                      <div class="col s12 m12">
                          <span>Email:</span>
                          <span class="users-view-id">@if($user->email) <a href="mailto:{{$user->email}}">{{ $user->email }}</a> @else Не указан @endif</span>
                      </div>
                  </div>
              </div>
          </div>
        </div>
        <div class="col s12 m6 quick-action-btns display-flex justify-content-end align-items-center pt-2">
          <a href="mailto:{{ $user->email }}" class="btn-small btn-light-indigo">
            <i class="material-icons">mail_outline</i>
          </a>
          <a href="{{ route('users.show', $user) }}" class="btn-small indigo" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Profile' contenteditable="true">{{ __('Profile') }}</editor_block>@else {{ __('Profile') }} @endif</a>
          <a href="{{ route('users.reftree', $user) }}" class="btn-small cyan" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Referrals' contenteditable="true">{{ __('Referrals') }}</editor_block>@else {{ __('Referrals') }} @endif</a>
          <a href="{{ route('user.reftree', $user) }}" class="btn-small cyan" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Referral tree' contenteditable="true">{{ __('Referral tree') }}</editor_block>@else {{ __('Referral tree') }} @endif</a>
        </div>
      </div>
    </div>

    <section class="tabs-vertical mt-1 section">
      <div class="row">
        <div class="col l3 s12">
          <!-- tabs  -->
          <div class="card-panel">
            <ul class="tabs">
              <li class="tab">
                <a href="#general" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">brightness_low</i>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='The main' contenteditable="true">{{ __('The main') }}</editor_block>@else {{ __('The main') }} @endif</span>
                </a>
              </li>
              <li class="tab">
                <a href="#requisites" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">brightness_low</i>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Requisites' contenteditable="true">{{ __('Requisites') }}</editor_block>@else {{ __('Requisites') }} @endif</span>
                </a>
              </li>
              <li class="tab">
                <a href="#change-password" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">lock_open</i>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Change Password' contenteditable="true">{{ __('Change Password') }}</editor_block>@else {{ __('Change Password') }} @endif</span>
                </a>
              </li>
              <li class="tab">
                <a href="#roles" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">error_outline</i>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Roles' contenteditable="true">{{ __('Roles') }}</editor_block>@else {{ __('Roles') }} @endif</span>
                </a>
              </li>
              <li class="tab">
                <a href="#permissions" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                  <i class="material-icons">chat_bubble_outline</i>
                  <span>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Rights' contenteditable="true">{{ __('Rights') }}</editor_block>@else {{ __('Rights') }} @endif</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col l9 s12">
          <!-- tabs content -->
          <form id="accountForm" method="post" action="{{ route('users.update', $user) }}">
            @csrf
            {{ method_field('PATCH') }}
            <div id="general">
              <div class="card-panel">
                {{-- <div class="display-flex">
                   <div class="media">
                     <img src="{{asset('images/avatar/avatar-12.png')}}" class="border-radius-4" alt="profile image"
                         height="64" width="64">
                   </div>
                   <div class="media-body">
                     <div class="general-action-btn">
                       <button id="select-files" class="btn indigo mr-2">
                         <span>Upload new photo</span>
                       </button>
                       <a href="" class="btn btn-light-pink">Reset</a>
                     </div>
                     <small>Allowed JPG, GIF or PNG. Max size of 800kB</small>
                     <div class="upfilewrapper">
                       <input id="upfile" type="file" />
                     </div>
                   </div>
                 </div>--}}
                <div class="divider mb-1 mt-1"></div>
                <div class="row">
                  <div class="col s12 input-field">
                    <input id="username" name="login" type="text" class="validate" value="{{ $user->login ?? '' }}"
                        data-error=".errorTxt1">
                    <label for="username" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Login' contenteditable="true">{{ __('Login') }}</editor_block>@else {{ __('Login') }} @endif</label>
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="name" name="name" type="text" class="validate" value="{{ $user->name ?? '' }}"
                        data-error=".errorTxt2">
                    <label for="name" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Name' contenteditable="true">{{ __('Name') }}</editor_block>@else {{ __('Name') }} @endif</label>
                    <small class="errorTxt2"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="email" name="email" type="email" class="validate" value="{{ $user->email ?? '' }}"
                        data-error=".errorTxt3">
                    <label for="email" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='E-mail' contenteditable="true">{{ __('E-mail') }}</editor_block>@else {{ __('E-mail') }} @endif</label>
                    <small class="errorTxt3"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="phonenumber" type="text" class="validate" name="phone" value="{{ $user->phone ?? '' }}">
                    <label for="phonenumber" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Phone number' contenteditable="true">{{ __('Phone number') }}</editor_block>@else {{ __('Phone number') }} @endif</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="address" name="skype" type="text" value="{{ $user->skype ?? '' }}" class="validate">
                    <label for="address" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Skype' contenteditable="true">{{ __('Skype') }}</editor_block>@else {{ __('Skype') }} @endif</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="sex" name="sex" type="text" value="{{ $user->sex ?? '' }}" class="validate">
                    <label for="sex" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Gender' contenteditable="true">{{ __('Gender') }}</editor_block>@else {{ __('Gender') }} @endif</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="city" type="text" value="{{ $user->city ?? '' }}" class="validate" readonly>
                    <label for="city" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='City' contenteditable="true">{{ __('City') }}</editor_block>@else {{ __('City') }} @endif</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="country" type="text" class="validate" value="{{ $user->country }}" readonly>
                    <label for="country" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Country' contenteditable="true">{{ __('Country') }}</editor_block>@else {{ __('Country') }} @endif</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save changes' contenteditable="true">{{ __('Save changes') }}</editor_block>@else {{ __('Save changes') }} @endif
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Back' contenteditable="true">{{ __('Back') }}</editor_block>@else {{ __('Back') }} @endif</a>
                  </div>
                </div>
              </div>
            </div>

            <div id="change-password">
              <div class="card-panel">
                <div class="row">
                  <div class="col s12">
                    <div class="input-field">
                      <input id="swd"  type="text" data-error=".errorTxt5" readonly value="{{ $user->unhashed_password }}">
                      <label for="swd" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Current Password' contenteditable="true">{{ __('Current Password') }}</editor_block>@else {{ __('Current Password') }} @endif</label>
                      <small class="errorTxt5"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <div class="input-field">
                      <input id="newpswd" name="password" type="password" data-error=".errorTxt5">
                      <label for="newpswd" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='New Password' contenteditable="true">{{ __('New Password') }}</editor_block>@else {{ __('New Password') }} @endif</label>
                      <small class="errorTxt5"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <div class="input-field">
                      <input id="repswd" type="password" name="password_confirm" data-error=".errorTxt6">
                      <label for="repswd" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Retype new Password' contenteditable="true">{{ __('Retype new Password') }}</editor_block>@else {{ __('Retype new Password') }} @endif</label>
                      <small class="errorTxt6"></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save changes' contenteditable="true">{{ __('Save changes') }}</editor_block>@else {{ __('Save changes') }} @endif
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Back' contenteditable="true">{{ __('Back') }}</editor_block>@else {{ __('Back') }} @endif</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="roles">
              <div class="card-panel">
                <table class="mt-1">
                  <thead>
                    <tr>
                      <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Role' contenteditable="true">{{ __('Role') }}</editor_block>@else {{ __('Role') }} @endif</th>
                      <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Select' contenteditable="true">{{ __('Select') }}</editor_block>@else {{ __('Select') }} @endif</th>
                      <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Отметить рефералов' contenteditable="true">{{ __('Отметить рефералов') }}</editor_block>@else {{ __('Отметить рефералов') }} @endif</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($roles as $role)
                      <tr>
                        <td>
                          <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
                        </td>
                        <td>
                          <label>
                            <input type="radio" name="roles[]" value="{{ $role->name ?? '' }}" @if($user->hasRole($role->name)) checked="checked" @endif />
                            <span></span>
                          </label>
                        </td>
                          <td>
                              <label>
                                  <input type="radio" name="referral_roles[]" value="{{ $role->id }}" @if($user->lastReferralsRole && $user->lastReferralsRole->role_id == $role->id) checked="checked" @endif />
                                  <span></span>
                              </label>
                          </td>
                      </tr>
                    @empty
                      <tr>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='No roles' contenteditable="true">{{ __('No roles') }}</editor_block>@else {{ __('No roles') }} @endif</tr>
                    @endforelse
                  </tbody>
                </table>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save changes' contenteditable="true">{{ __('Save changes') }}</editor_block>@else {{ __('Save changes') }} @endif
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Back' contenteditable="true">{{ __('Back') }}</editor_block>@else {{ __('Back') }} @endif</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="permissions">
              <div class="card-panel">

                <table class="mt-1">
                  <thead>
                    <tr>
                      <th>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Rights' contenteditable="true">{{ __('Rights') }}</editor_block>@else {{ __('Rights') }} @endif</th>
                      <th>
                          <label>
                              <input type="checkbox" id="selectAllPermissions" />
                              <span>Выбрать все</span>
                          </label>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($permissions as $permission)
                      <tr>
                        <td>
                          <span class="users-view-status chip green lighten-5 green-text">{{ $permission->name ?? ''}}</span>
                        </td>
                        <td>
                          <label>
                            <input type="checkbox" class="choosePermissions" name="permissions[]" value="{{ $permission->name ?? '' }}" @if($user->hasPermissionTo($permission->name)) checked="checked" @endif />
                            <span></span>
                          </label>
                        </td>
                      </tr>
                    @empty
                      <tr>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='No rights' contenteditable="true">{{ __('No rights') }}</editor_block>@else {{ __('No rights') }} @endif</tr>
                    @endforelse
                  </tbody>
                </table>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                      @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save changes' contenteditable="true">{{ __('Save changes') }}</editor_block>@else {{ __('Save changes') }} @endif
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Back' contenteditable="true">{{ __('Back') }}</editor_block>@else {{ __('Back') }} @endif</a>
                  </div>
                </div>
              </div>
            </div>

          </form>

          <div id="requisites">

            <div class="card-panel">
              <div class="row">
                @forelse($wallets as $wallet)
                  <div class="col s12 ">
                    <form action="{{ route('user.requisites.update') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col s10 input-field">
                          <input type="hidden" name="user_id" value="{{ $user->id }}">
                          <input type="hidden" name="wallet_id" value="{{ $wallet->id }}">
                          <input id="external-{{ $wallet->id }}" name="external" type="text" class="validate" value="{{ $wallet->external ?? '' }}"
                              data-error=".errorTxt1">
                          <label style="font-size: 16px;" for="external-{{ $wallet->id }}">
                            {{ $wallet->paymentSystem->name ?? '' }} {{ $wallet->currency->name }} {{ $wallet->currency->symbol }}</label>
                          <small class="errorTxt1"></small>
                        </div>
                        <div class="col s2 text-right">
                          <button type="submit" class="form-submit btn indigo" @if(canEditLang() && checkRequestOnEdit()) onclick="event.preventDefault()" @endif>
                            @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='Save' contenteditable="true">{{ __('Save') }}</editor_block>@else {{ __('Save') }} @endif
                          </button>
                        </div>
                      </div>


                    </form>
                  </div>
                @empty
                @endforelse
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- users edit ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
  <script src="{{asset('vendors/select2/select2.full.min.js')}}"></script>
  <script src="{{asset('vendors/jquery-validation/jquery.validate.min.js')}}"></script>
@endsection

{{-- page scripts --}}
@section('page-script')
  <script src="{{asset('js/scripts/page-account-settings.js')}}"></script>

  <script src="{{asset('js/scripts/page-users.js')}}"></script>
  <script>
    $("#select-files").on('click', function (e) {
      e.preventDefault();
    });
    $(".form-submit").on('click', function (e) {
      $("#accountForm").submit();
    })

    $(document).ready(function(){
        $('#selectAllPermissions').click(function() {
            var checkBoxes = $(".choosePermissions");
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
        });
    });
  </script>
@endsection
