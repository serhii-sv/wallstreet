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
            <div class="media-body">
              <h6 class="media-heading">
                <span class="users-view-name">{{ $user->name ?? 'Не указано' }}</span>
                <span class="grey-text">@</span>
                <span class="users-view-username grey-text">{{ $user->login ?? 'Не указан' }}</span>
              </h6>
              <span>ID:</span>
              <span class="users-view-id">{{ $user->id ?? 'Не указан' }}</span>
            </div>
          </div>
        </div>
        <div class="col s12 m6 quick-action-btns display-flex justify-content-end align-items-center pt-2">
          <a href="mailto:{{ $user->email }}" class="btn-small btn-light-indigo">
            <i class="material-icons">mail_outline</i>
          </a>
          <a href="{{ route('users.show', $user) }}" class="btn-small indigo">Профиль</a>
          <a href="{{ route('users.reftree', $user) }}" class="btn-small cyan">Рефералы</a>
          <a href="{{ route('user.reftree', $user) }}" class="btn-small cyan">Реферальное дерево</a>
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
                <a href="#general">
                  <i class="material-icons">brightness_low</i>
                  <span>Основные</span>
                </a>
              </li>
              <li class="tab">
                <a href="#requisites">
                  <i class="material-icons">brightness_low</i>
                  <span>Реквизиты</span>
                </a>
              </li>
              <li class="tab">
                <a href="#change-password">
                  <i class="material-icons">lock_open</i>
                  <span>Изменить пароль</span>
                </a>
              </li>
              <li class="tab">
                <a href="#roles">
                  <i class="material-icons">error_outline</i>
                  <span>Роли</span>
                </a>
              </li>
              <li class="tab">
                <a href="#permissions">
                  <i class="material-icons">chat_bubble_outline</i>
                  <span>Права</span>
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
                    <label for="username">Логин</label>
                    <small class="errorTxt1"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="name" name="name" type="text" class="validate" value="{{ $user->name ?? '' }}"
                        data-error=".errorTxt2">
                    <label for="name">Имя</label>
                    <small class="errorTxt2"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="email" name="email" type="email" class="validate" value="{{ $user->email ?? '' }}"
                        data-error=".errorTxt3">
                    <label for="email">E-mail</label>
                    <small class="errorTxt3"></small>
                  </div>
                  <div class="col s12 input-field">
                    <input id="phonenumber" type="text" class="validate" name="phone" value="{{ $user->phone ?? '' }}">
                    <label for="phonenumber">Номер телефона</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="address" name="skype" type="text" value="{{ $user->skype ?? '' }}" class="validate">
                    <label for="address">Skype</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="sex" name="sex" type="text" value="{{ $user->sex ?? '' }}" class="validate">
                    <label for="sex">Пол</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="city" type="text" value="{{ $user->city ?? '' }}" class="validate" readonly>
                    <label for="city">Город</label>
                  </div>
                  <div class="col s12 input-field">
                    <input id="country" type="text" class="validate" value="{{ $user->country }}" readonly>
                    <label for="country">Страна</label>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3">
                      Сохранить изменения
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>
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
                      <label for="swd">Current Password</label>
                      <small class="errorTxt5"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <div class="input-field">
                      <input id="newpswd" name="password" type="password" data-error=".errorTxt5">
                      <label for="newpswd">New Password</label>
                      <small class="errorTxt5"></small>
                    </div>
                  </div>
                  <div class="col s12">
                    <div class="input-field">
                      <input id="repswd" type="password" name="password_confirm" data-error=".errorTxt6">
                      <label for="repswd">Retype new Password</label>
                      <small class="errorTxt6"></small>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3">
                      Сохранить изменения
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="roles">
              <div class="card-panel">
                <table class="mt-1">
                  <thead>
                    <tr>
                      <th>Роль</th>
                      <th>Выбрать</th>
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
                      </tr>
                    @empty
                      <tr>Нет ролей</tr>
                    @endforelse
                  </tbody>
                </table>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3">
                      Сохранить изменения
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>
                  </div>
                </div>
              </div>
            </div>
            <div id="permissions">
              <div class="card-panel">
                
                <table class="mt-1">
                  <thead>
                    <tr>
                      <th>Права</th>
                      <th>Выбрать</th>
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
                            <input type="checkbox" name="permissions[]" value="{{ $permission->name ?? '' }}" @if($user->hasPermissionTo($permission->name)) checked="checked" @endif />
                            <span></span>
                          </label>
                        </td>
                      </tr>
                    @empty
                      <tr>Нет прав</tr>
                    @endforelse
                  </tbody>
                </table>
                <div class="row">
                  <div class="col s12 display-flex justify-content-end mt-1">
                    <button type="submit" class="form-submit btn indigo mr-3">
                      Сохранить изменения
                    </button>
                    <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>
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
                          <button type="submit" class="form-submit btn indigo">
                            Сохранить
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
    
    {{--    <div class="card">--}}
    {{--      <div class="card-content">--}}
    {{--        <!-- <div class="card-body"> -->--}}
    {{--        <ul class="tabs mb-2 row">--}}
    {{--          <li class="tab">--}}
    {{--            <a class="display-flex align-items-center active" id="account-tab" href="#account">--}}
    {{--              <i class="material-icons mr-1">person_outline</i>--}}
    {{--              <span>Аккаунт</span>--}}
    {{--            </a>--}}
    {{--          </li>--}}
    {{--          <li class="tab">--}}
    {{--            <a class="display-flex align-items-center" id="information-tab" href="#information">--}}
    {{--              <i class="material-icons mr-2">error_outline</i>--}}
    {{--              <span>Информация</span>--}}
    {{--            </a>--}}
    {{--          </li>--}}
    {{--        </ul>--}}
    {{--        <div class="divider mb-3"></div>--}}
    {{--        <form id="accountForm" method="post" action="{{ route('users.update', $user) }}">--}}
    {{--          @csrf--}}
    {{--          {{ method_field('PATCH') }}--}}
    {{--          <div class="row">--}}
    {{--            <div class="col s12" id="account">--}}
    {{--              <!-- users edit media object start -->--}}
    {{--              <div class="media display-flex align-items-center mb-2">--}}
    {{--                <a class="mr-2" href="#">--}}
    {{--                  <img src="{{asset('images/avatar/user.svg')}}" alt="users avatar" class="z-depth-4 circle"--}}
    {{--                      height="64" width="64">--}}
    {{--                </a>--}}
    {{--                <div class="media-body">--}}
    {{--                  <h5 class="media-heading mt-0">{{ $user->name ?? '' }}</h5>--}}
    {{--                  --}}{{--              <div class="user-edit-btns display-flex">--}}
    {{--                  --}}{{--                <a href="#" class="btn-small indigo">Change</a>--}}
    {{--                  --}}{{--                <a href="#" class="btn-small btn-light-pink">Reset</a>--}}
    {{--                  --}}{{--              </div>--}}
    {{--                </div>--}}
    {{--              </div>--}}
    {{--              <!-- users edit media object ends -->--}}
    {{--              <!-- users edit account form start -->--}}
    {{--              --}}
    {{--              <div class="row">--}}
    {{--                <div class="col s12 m6">--}}
    {{--                  <div class="row">--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="username" name="login" type="text" class="validate" value="{{ $user->login ?? '' }}"--}}
    {{--                          data-error=".errorTxt1">--}}
    {{--                      <label for="username">Логин</label>--}}
    {{--                      <small class="errorTxt1"></small>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="name" name="name" type="text" class="validate" value="{{ $user->name ?? '' }}"--}}
    {{--                          data-error=".errorTxt2">--}}
    {{--                      <label for="name">Имя</label>--}}
    {{--                      <small class="errorTxt2"></small>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="email" name="email" type="email" class="validate" value="{{ $user->email ?? '' }}"--}}
    {{--                          data-error=".errorTxt3">--}}
    {{--                      <label for="email">E-mail</label>--}}
    {{--                      <small class="errorTxt3"></small>--}}
    {{--                    </div>--}}
    {{--                  </div>--}}
    {{--                </div>--}}
    {{--                <div class="col s12">--}}
    {{--                  <table class="mt-1">--}}
    {{--                    <thead>--}}
    {{--                      <tr>--}}
    {{--                        <th>Роль</th>--}}
    {{--                        <th>Выбрать</th>--}}
    {{--                      </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                      @forelse($roles as $role)--}}
    {{--                        <tr>--}}
    {{--                          <td>--}}
    {{--                            <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>--}}
    {{--                          </td>--}}
    {{--                          <td>--}}
    {{--                            <label>--}}
    {{--                              <input type="radio" name="roles[]" value="{{ $role->name ?? '' }}" @if($user->hasRole($role->name)) checked="checked" @endif />--}}
    {{--                              <span></span>--}}
    {{--                            </label>--}}
    {{--                          </td>--}}
    {{--                        </tr>--}}
    {{--                      @empty--}}
    {{--                        <tr>Нет ролей</tr>--}}
    {{--                      @endforelse--}}
    {{--                    </tbody>--}}
    {{--                  </table>--}}
    {{--                </div>--}}
    {{--                <div class="col s12">--}}
    {{--                  <table class="mt-1">--}}
    {{--                    <thead>--}}
    {{--                      <tr>--}}
    {{--                        <th>Права</th>--}}
    {{--                        <th>Выбрать</th>--}}
    {{--                      </tr>--}}
    {{--                    </thead>--}}
    {{--                    <tbody>--}}
    {{--                      @forelse($permissions as $permission)--}}
    {{--                        <tr>--}}
    {{--                          <td>--}}
    {{--                            <span class="users-view-status chip green lighten-5 green-text">{{ $permission->name ?? ''}}</span>--}}
    {{--                          </td>--}}
    {{--                          <td>--}}
    {{--                            <label>--}}
    {{--                              <input type="checkbox" name="permissions[]" value="{{ $permission->name ?? '' }}" @if($user->hasPermissionTo($permission->name)) checked="checked" @endif />--}}
    {{--                              <span></span>--}}
    {{--                            </label>--}}
    {{--                          </td>--}}
    {{--                        </tr>--}}
    {{--                      @empty--}}
    {{--                        <tr>Нет прав</tr>--}}
    {{--                      @endforelse--}}
    {{--                    </tbody>--}}
    {{--                  </table>--}}
    {{--                </div>--}}
    {{--                <div class="col s12 display-flex justify-content-end mt-1">--}}
    {{--                  <button type="submit" class="btn indigo">--}}
    {{--                    Сохранить изменения--}}
    {{--                  </button>--}}
    {{--                  <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>--}}
    {{--                </div>--}}
    {{--              </div>--}}
    {{--              <!-- users edit account form ends -->--}}
    {{--            </div>--}}
    {{--            <div class="col s12" id="information">--}}
    {{--              <!-- users edit Info form start -->--}}
    {{--              --}}
    {{--              <div class="row">--}}
    {{--                --}}
    {{--                <div class="col s12 m6">--}}
    {{--                  <div class="row">--}}
    {{--                    <div class="col s12">--}}
    {{--                      <h6 class="mb-4"><i class="material-icons mr-1">person_outline</i>Личная информация</h6>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="phonenumber" type="text" class="validate" name="phone" value="{{ $user->phone ?? '' }}">--}}
    {{--                      <label for="phonenumber">Номер телефона</label>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="address" name="skype" type="text" value="{{ $user->skype ?? '' }}" class="validate">--}}
    {{--                      <label for="address">Skype</label>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="sex" name="sex" type="text" value="{{ $user->sex ?? '' }}" class="validate">--}}
    {{--                      <label for="sex">Пол</label>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="city" type="text" value="{{ $user->city ?? '' }}" class="validate" readonly>--}}
    {{--                      <label for="city">Город</label>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input id="country" type="text" class="validate" value="{{ $user->country }}" readonly>--}}
    {{--                      <label for="country">Страна</label>--}}
    {{--                    </div>--}}
    {{--                  </div>--}}
    {{--                </div>--}}
    {{--                <div class="col s12 m6">--}}
    {{--                  <div class="row">--}}
    {{--                    <div class="col s12">--}}
    {{--                      <h6 class="mb-2"><i class="material-icons mr-1">link</i>Дополнительные поля</h6>--}}
    {{--                    </div>--}}
    {{--                    <div class="col s12 input-field">--}}
    {{--                      <input class="validate" type="text">--}}
    {{--                      <label>Для примера</label>--}}
    {{--                    </div>--}}
    {{--                  </div>--}}
    {{--                </div>--}}
    {{--                <div class="col s12 display-flex justify-content-end mt-1">--}}
    {{--                  <button type="submit" class="btn indigo">--}}
    {{--                    Сохранить изменения--}}
    {{--                  </button>--}}
    {{--                  <a href="{{ route('users.show', $user) }}" type="button" class="btn btn-light">Назад</a>--}}
    {{--                </div>--}}
    {{--              </div>--}}
    {{--              --}}
    {{--              <!-- users edit Info form ends -->--}}
    {{--            </div>--}}
    {{--          </div>--}}
    {{--        </form>--}}
    {{--        <!-- </div> -->--}}
    {{--      </div>--}}
    {{--    </div>--}}
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
  </script>
@endsection
