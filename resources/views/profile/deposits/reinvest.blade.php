@extends('profile.layouts.customer')
@section('title', __('Create deposit'))
@section('content')
  <section class="lk-section">
    <div class="form-lk">
      <div class="form-lk__col">
        <form action="{{ route('profile.deposits.reinvest', $id) }}" method="POST" target="_top">
          <p style="font-weight: bold;">@include('partials.inform')</p>
          {{ csrf_field() }}
          
          <div style="font-size: 24px;font-weight: bold;margin-bottom: 35px;margin-top: 10px;">Баланс {{ $deposit->wallet->balance }} {{ $deposit->currency->symbol }}</div>
  
          <div class="input-row white-shadow-select">
            <label for="rate" class="input-row__name">{{ __('Reinvest sum') }}
            </label>
            <input type="text" name="amount" autofocus> <span style="margin-left: 10px;">{{ $deposit->currency->symbol }}</span>
          </div>
          
          <div class="form-lk__bottom"><button type="submit" class="btn btn--accent2">{{ __('Reinvest') }}</button>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection

@push('load-scripts')

@endpush
