{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
  
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/daterangepicker.css')}}">
@endsection

{{-- page content  --}}
@section('content')
  
  <!-- users view start -->
  <div class="section users-view">
    <!-- users view media object start -->
    <div class="card-panel">
      @include('panels.inform')
      <div class="row">
        <div class="col s12 m6">
          <div class="display-flex media">
            <a href="#" class="avatar">
              <img src="{{asset('images/avatar/user.svg')}}" alt="users view avatar" class="z-depth-4 circle"
                  height="64" width="64">
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
        <div class="col s12 m6 quick-action-btns display-flex justify-content-end align-items-center display-flex flex-wrap">
          <div class="mb-2 width-100 display-flex justify-content-end">
            <a href="mailto:{{ $user->email }}" class="btn-small btn-light-indigo ">
              <i class="material-icons">mail_outline</i>
            </a>
            @if(auth()->user()->id !== $user->id)
              <a href="{{ env('CLIENT_SITE_URL') . 'impersonate/' . $user->id }}" class="btn-small purple darken-4 ">Залогиниться</a>
            @endif
            <a href="{{ route('users.edit', $user) }}" class="btn-small indigo ">Редактировать</a>
            <a href="{{ route('users.reftree', $user) }}" class="btn-small cyan ">Рефералы</a>
          </div>
          <div>
            <a href="{{ route('user.reftree', $user) }}" class="btn-small cyan">Реферальное дерево</a>
            <a href="{{ route('user-transactions.index', $user) }}" class="btn-small grey">Транзакции</a>
          </div>
        </div>
      </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 m4">
            <table class="striped">
              <tbody>
                <tr>
                  <td>Upliner:</td>
                  <td>
                    @if($user->partner)
                      <a href="{{ $user->partner ? route('users.show', $user->partner->id) : '' }}" target="_blank">{{ $user->partner->email  ?? '' }}</a>
                      @else
                      No
                    @endif
                  </td>
                </tr>
                <tr>
                  <td>First upliner:</td>
                  <td>
                    <a href="{{ route('users.show', $user_first_upliner->id) }}" target="_blank">{{ $user_first_upliner->email  ?? '' }}</a>
                  </td>
                </tr>
                <tr>
                  <td>Пароль:</td>
                  <td>{{ $user->unhashed_password  ?? '' }}</td>
                </tr>
                <tr>
                  <td>Зарегестрирован:</td>
                  <td>{{ $user->created_at->format('Y-m-d H:i:s') ?? '' }}</td>
                </tr>
                <tr>
                  <td>Последняя активнось:</td>
                  <td class="users-view-latest-activity">{{ $user->last_activity_at ?? 'Не авторизовывался' }}</td>
                </tr>
                <tr>
                  <td>Подтверждение почты:</td>
                  <td class="users-view-verified">@if($user->email_verified_at) Email подтверждён @else Email не подтверждён @endif</td>
                </tr>
                <tr>
                  <td>Роли:</td>
                  <td class="users-view-role">
                    @forelse($user->roles as $role)
                      <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
                    @empty
                      <span class="users-view-status chip red lighten-5 red-text">Никаких ролей нет</span>
                    @endforelse
                  </td>
                </tr>
              
              </tbody>
            </table>
          </div>
          <div class="col s12 m8">
            <table class="responsive-table">
              <thead>
                <tr>
                  <th>Все права</th>
                  <th style="text-align: right">Дата выдачи</th>
                </tr>
              </thead>
              <tbody>
                @forelse($user_permissions as $role)
                  <tr>
                    <td>
                      <span class="users-view-status chip green lighten-5 green-text">{{ $role->name ?? ''}}</span>
                    </td>
                    <td style="text-align: right">{{ $role->pivot->created_at ?? ''}}</td>
                  </tr>
                @empty
                  <td colspan="2">
                    <span class="users-view-status chip red lighten-5 red-text">Никаких прав нет</span>
                  </td>
                @endforelse
              </tbody>
            </table>
            {{ $user_permissions->appends(request()->except('permissions'))->links() }}
          </div>
        </div>
      </div>
    </div>
    <!-- users view card data ends -->
    
    <!-- users view card details start -->
    <div class="card">
      <div class="card-content">
        <div class="row indigo lighten-5 border-radius-4 mb-2">
          <div class="col s12 m4 users-view-timeline">
            <h6 class="indigo-text mb-3">Денег на балансе:
              <span>{{ number_format($balance_usd, 2, '.', ',') }}$</span>
            </h6>
            <h6 class="indigo-text m-0">Количество рефералов:
              <span>{{ $referral_count ?? 0 }}</span>
            </h6>
          </div>
          <div class="col s12 m4 users-view-timeline">
            @if(!empty($user->deposits))
              <h6 class="indigo-text mb-3">Сумма депозитов:
                <span>{{ $deposit_sum ?? 0 }}$</span>
              </h6>
            @endif
            @if(!empty($user->partner))
              <h6 class="indigo-text m-0">Переходы по реферальной ссылке:
                <span>{{ $referral_clicks ?? 0 }}</span>
              </h6>
            @endif
          </div>
        
        </div>
        <div class="row">
          <div class="col s12">
            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Информация и пользователе</h6>
            <table class="striped">
              <tbody>
                <tr>
                  <td>E-mail:</td>
                  <td class="users-view-email">{{ $user->email ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>Телефон:</td>
                  <td class="users-view-email">{{ $user->phone ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>Skype:</td>
                  <td class="users-view-email">{{ $user->skype ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>Пол:</td>
                  <td class="users-view-email">{{ $user->sex ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>Страна:</td>
                  <td>{{ $user->country ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>Город:</td>
                  <td>{{ $user->city ?? 'Не указано' }}</td>
                </tr>
                <tr>
                  <td>IP:</td>
                  <td>{{ $user->ip ?? 'Не указано' }}</td>
                </tr>
              
              </tbody>
            </table>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
    <!-- users view card details ends -->
    
    <div class="card">
      <div class="card-content">
        <div class="row">
          <div class="col s12 l8">
            <ul id="issues-collection" class="collection z-depth-1  fadeRight">
              <div style="display: flex; justify-content: space-between;" class="issues-collection-header">
                <div>
                  <li class="collection-item avatar">
                    <i class="material-icons red accent-2 circle">access_time</i>
                    <h6 class="collection-header m-0">Время активности</h6>
                    <p>Пользователя @ {{ $user->login }}</p>
                  </li>
                </div>
                <div style="margin-top: 15px;margin-right: 15px">
                  <i class="material-icons right grey-text lighten-3" id="datepicker">date_range</i>
                </div>
              </div>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">Активность за сегодня</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityDay['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityDay['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">Активность за последние 7 дней</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityWeek['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityWeek['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
              <li class="collection-item">
                <div class="row">
                  <div class="col s7">
                    <p class="collections-title">Активность за последние 30 дней</p>
                  </div>
                  <div class="col s2">
                    <span class="task-cat deep-orange accent-2">{{ $userActivityMonth['time'] }}</span>
                  </div>
                  <div class="col s3">
                    <div class="progress">
                      <div class="determinate" style="width: {{ $userActivityMonth['percentage'] }}%"></div>
                    </div>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="col s12 l4">
            <ul id="issues-collection" class="collection z-depth-1  fadeRight">
              
              <li class="collection-item avatar" style="min-height: auto">
                <i class="material-icons blue accent-2 circle">computer</i>
                <h6 class="collection-header m-0">Последние ip адреса</h6>
                <p>Пользователя @ {{ $user->login }}</p>
              </li>
              @foreach($user_auth_logs as $item)
                <li class="collection-item pt-1 pb-1">
                  <div class="row">
                    <div class="col s12 display-flex justify-content-between">
                      <span class="task-cat indigo-text darken-4 darken-4">Заходил: {{ $item->created_at->format('d.m.Y H:i:s') }}</span>
                      <span class="task-cat red accent-2">Ip: {{ $item->ip ?? '' }}</span>
                    </div>
                  </div>
                </li>
              @endforeach
            </ul>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
  
  </div>
  <!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('js/scripts/page-account-settings.js')}}"></script>
  
  <script src="{{asset('js/moment.js')}}"></script>
  <script src="{{asset('js/daterangepicker.js')}}"></script>
  <script>
    $('#datepicker').dateRangePicker({
      format: 'DD-MM-YYYY HH:mm',
      separator: '/',
      language: 'auto',
      startOfWeek: 'monday',
      time: {
        enabled: true
      }
    }).bind('datepicker-apply', function (event, obj) {
      $.ajax({
        url: '/users/activity-by-date',
        data: {
          date: obj.value,
          user_id: '{{ $user->id }}'
        },
        success: (response) => {
          if (response.success) {
            $('#issues-collection li:not(.issues-collection-header li)').remove()
            $('#issues-collection').append(response.html)
          } else {
            M.toast({
              html: response.message,
              classes: 'red'
            })
          }
        }
      })
      return false;
    });
  </script>
@endsection
