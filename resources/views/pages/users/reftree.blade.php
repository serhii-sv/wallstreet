{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- vendor styles --}}
@section('vendor-style')
    <link rel="stylesheet" type="text/css" href="{{asset('vendors/jquery.nestable/nestable.css')}}">
@endsection

{{-- page style --}}
@section('page-style')
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content  --}}
@section('content')
    <!-- users view start -->
    <div class="section users-view">
        <!-- users view media object ends -->
        <div class="card-panel">
            @include('panels.inform')
            <div class="row">
                <div class="col s12 m6">
                    <div class="display-flex media">
                        <a href="#" class="avatar">
                            <img src="{{asset('images/avatar/user.svg')}}" alt="users view avatar"
                                 class="z-depth-4 circle"
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
                    <a href="{{ route('users.show', $user) }}" class="btn-small cyan">Профиль</a>
                    <a href="{{ route('users.edit', $user) }}" class="btn-small indigo">Редактировать</a>
                </div>
            </div>
        </div>

        <input type="hidden" id="request_url" name="request_url" value="{{ route('users.referrals-redistribution', $user->id) }}">
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content">
                <div class="card-alert card cyan lighten-5">
                    <div class="card-content cyan-text">
                        <p>{{ empty($referrals_data['referrals']) ? 'У этого пользователя еще нет ни одного реферала' : 'Для изменения партнера реферала потяните вправо или перенесети на нужный уровень' }}</p>
                    </div>
                </div>
                <div class="dd" id="nestable">
                    @if(!empty($referrals_data['referrals']))
                        @foreach($referrals_data['referrals'] as $key => $referral)
                            @include('pages.partials.referrals-nestable', [
                                        'referrals_data' => $referral,
                                        'first' => $key == 0,
                                        'last' => last(array_keys($referrals_data['referrals'])) == $key
                            ])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <h6>Добавить реферала пользователю</h6>
                <div style="display: flex;align-items: center;margin-bottom: 10px;">
                    <div style="width: 50%">Введите логин, имейл или ID пользователя</div>
                </div>
                <div style="padding: 10px 0;border-bottom: 1px solid #939393;">
                    <form id="addNewReferral" action="{{ route('users.add-referral', $user) }}" method="post" style="display: flex;align-items: center;">
                        @csrf
                        <div style="width: 50%">
                          <span class="users-view-status">
                            <input
                                class="lighten-5 chip"
                                name="new_referral"
                                type="text"
                                style="color: black">
                          </span>
                        </div>
                        <div style="width: 15%;margin-left: 25px;">
                            <button class="width-100 btn waves-effect">
                                Добавить
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- users view ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/jquery.nestable/jquery.nestable.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/extra-components-nestable.js')}}"></script>
    <script src="{{asset('js/scripts/advance-ui-toasts.js')}}"></script>
    <script src="{{asset('js/scripts/reftree.js')}}"></script>
@endsection
