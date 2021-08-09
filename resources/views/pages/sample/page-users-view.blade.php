{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
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
        <div class="col s12 m6 quick-action-btns display-flex justify-content-end align-items-center pt-2">
          <a href="mailto:{{ $user->email }}" class="btn-small btn-light-indigo">
            <i class="material-icons">mail_outline</i>
          </a>
          <a href="{{ route('users.edit', $user) }}" class="btn-small indigo">Редактировать</a>
            <a href="{{ route('users.reftree', $user) }}" class="btn-small cyan">Реферальное дерево</a>
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
                @forelse($user->permissions as $role)
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
            <h6 class="indigo-text m-0">Денег на балансе:
              <span>{{ number_format($balance_usd, 2, '.', ',') }}$</span>
            </h6>
          </div>
          @if(!empty($user->deposits))
            <div class="col s12 m4 users-view-timeline">
              <h6 class="indigo-text m-0">Сумма депозитов:
                <span>{{ $deposit_sum ?? 0 }}$</span>
              </h6>
            </div>
          @endif
          @if(!empty($user->partner))
            <div class="col s12 m4 users-view-timeline">
              <h6 class="indigo-text m-0">Пригласил:
                <span>
                  <a href="{{ route('users.show', $user->partner->id) }}">{{ $user->partner->name ?? '' }}</a>
              </span>
              </h6>
            </div>
          @endif
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

  </div>
  <!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('js/scripts/page-users.js')}}"></script>
@endsection
