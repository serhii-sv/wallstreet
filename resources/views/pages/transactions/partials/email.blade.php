<div class="display-flex align-items-center">
  <div class="" style="margin-right: 15px;">
    
    <a href="{{ route('users.show', $transaction->user->id) }}">{{ $transaction->user->int_id ?? 'Не указано' }}</a>
  </div>
  <div class="display-flex align-items-center width-100">
      <span class="avatar-contact avatar-online">
          <img width="38" height="38" src="{{asset('images/avatar/user.svg')}}" alt="avatar">
      </span>
    <a class="ml-3" href="{{ route('transactions.show', $transaction->id) }}">{{ $transaction->user->login ?? 'Не указано' }}</a>
  </div>
</div>
