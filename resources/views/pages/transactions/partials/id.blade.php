<div class="display-flex align-items-center">
  <div class="" style="margin-right: 15px;">
    <a href="{{ route('transactions.show', $transaction->id) }}">{{ $transaction->int_id ?? 'Не указано' }}</a>
  </div>
  <div class="display-flex align-items-center width-100">
      <span class="avatar-contact avatar-online">
          <a href="{{ route('users.show', $transaction->user_id) }}">
            <img width="38" height="38" src="{{asset('images/avatar/user.svg')}}" alt="avatar">
          </a>
      </span>
  </div>
</div>
