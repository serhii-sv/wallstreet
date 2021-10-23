<div class="display-flex align-items-center">
  <div class="" style="margin-right: 15px;">
    
    <a href="{{ route('users.show', $deposit->user->id) }}">{{ $deposit->user->int_id ?? __('Not indicated') }}</a>
  </div>
  <div class="display-flex align-items-center width-100">
      <span class="avatar-contact avatar-online">
          <img width="38" height="38" src="{{asset('images/avatar/user.svg')}}" alt="avatar">
      </span>
  
  </div>
</div>