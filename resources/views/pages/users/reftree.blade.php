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
        <!-- users view card data start -->
        <div class="card">
            <div class="card-content">
                <form id="referralsForm" action="{{ route('users.referrals-redistribution', $user->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="referrals">
                </form>
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

    </div>
    <!-- users view ends -->
@endsection

{{-- vendor scripts --}}
@section('vendor-script')
    <script src="{{asset('vendors/jquery.nestable/jquery.nestable.js')}}"></script>
@endsection

{{-- page script --}}
@section('page-script')
    <script src="{{asset('js/scripts/page-users.js')}}"></script>
    <script src="{{asset('js/scripts/extra-components-nestable.js')}}"></script>
@endsection
