{{-- layout --}}
@extends('layouts.contentLayoutMaster')

{{-- page title --}}
@section('title','Users View')

{{-- page style --}}
@section('page-style')
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-account-settings.css')}}">
  <link rel="stylesheet" href="{{ asset('vendors/sweetalert/sweetalert.css') }}">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pages/page-users.css')}}">
@endsection

{{-- page content  --}}
@section('content')
  
  <!-- users view start -->
  <div class="section users-view">
    <!-- users view media object ends -->
    <!-- users view card details start -->
    <div class="card">
      <div class="card-content">
        <h5 style="font-weight: bold">
          @if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User referrals' contenteditable="true">{{ __('User referrals') }}</editor_block>@else {{ __('User referrals') }} @endif: {{ $user->name }}</h5>
        <span href="">
@if(canEditLang() && checkRequestOnEdit())<editor_block data-name='User login' contenteditable="true">{{ __('User login') }}</editor_block>@else {{ __('User login') }} @endif: <a href="{{ route('users.show', $user->id) }}">{{ $user->login }}</a></span>
        <table class="table table-bordernone" style="margin-top: 20px;">
          <thead>
            <tr>
              <th class="f-22">
                @if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='User' contenteditable="true">{{ __('User') }}</editor_block> @else {{ __('User') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Email' contenteditable="true">{{ __('Email') }}</editor_block> @else {{ __('Email') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Date/Time of registration ' contenteditable="true">{{ __('Date/Time of registration ') }}</editor_block> @else {{ __('Date/Time of registration ') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Upliner login' contenteditable="true">{{ __('Upliner login') }}</editor_block> @else {{ __('Upliner login') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Invested' contenteditable="true">{{ __('Invested') }}</editor_block> @else {{ __('Invested') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Accruals' contenteditable="true">{{ __('Accruals') }}</editor_block> @else {{ __('Accruals') }} @endif
              </th>
              <th>@if(canEditLang() && checkRequestOnEdit())
                  <editor_block data-name='Reward' contenteditable="true">{{ __('Reward') }}</editor_block> @else {{ __('Reward') }} @endif
              </th>
            </tr>
          </thead>
          <tbody>
            @forelse($referrals as $referral)
              <tr>
                <td>
                  <div class="display-flex align-items-center">
                    <a href="{{ route('users.referral.list', $referral->id) }}">
                    <img class="img-40 m-r-15 rounded-circle align-top" src="{{ $referral->image ? route('accountPanel.profile.get.avatar', $referral->id) : asset('images/user.png') }}" alt="">
                    </a>
                    <div class="status-circle bg-primary"></div>
                    <div class="d-inline-block ml-4">
                      <a href="{{ route('users.referral.list', $referral->id) }}" class="" target="_blank" style="color:black;font-size: 16px;display: block;">{{ $referral->name }}</a>
                      <a href="{{ route('users.referral.list', $referral->id) }}" class="" target="_blank" style="color:black;font-size: 14px;">{{ $referral->login }}</a>
                    </div>
                  </div>
                </td>
                <td>
                  <a href="{{ route('users.referral.list', $referral->id) }}" class="" target="_blank" style="color:black;font-size: 16px;display: block;">{{ $referral->email }}</a>
                </td>
                <td>{{ $referral->created_at->format('d.m.Y H:i:s') }}</td>
                <td>
                  <span class="badge blue darken-2" style="color: white;font-size: 16px;">{{ $user->login }}</span>
                </td>
                <td>
                            <span class="label">
                              {{ number_format($referral->invested(), 2, '.', ' ') ?? 0 }}$
                            </span>
                </td>
                <td class="">
                  {{ number_format($referral->deposits_accruals(), 2, '.', ' ') ?? 0 }}$
                </td>
                <td>
                  {{ number_format($referral->deposit_reward(), 2, '.', ' ') }}$
                </td>
              </tr>
            @empty
            @endforelse
          </tbody>
        </table>
        {{ $referrals->links() }}
      </div>
    </div>
  
  </div>
  <!-- users view ends -->
@endsection

{{-- page script --}}
@section('page-script')
  <script src="{{asset('js/scripts/page-account-settings.js')}}"></script>

@endsection
