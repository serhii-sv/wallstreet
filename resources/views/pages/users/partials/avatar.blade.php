<div class="display-flex align-items-center">
  <div class="" style="margin-right: 15px;">
 
    <a href="{{ route('users.show', $user) }}">{{ $user->int_id ?? 'Не указано' }}</a>
  </div>
    <div>
        <span class="avatar-contact avatar-online">
            <img width="38" height="38" src="{{asset('images/avatar/user.svg')}}" alt="avatar">
        </span>
    </div>
</div>
