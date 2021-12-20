@forelse($users as $user)
<li class="auto-suggestion">
    <a class="collection-item" href="{{ route('users.show', $user->id) }}">
        <div class="display-flex">
            <div class="display-flex align-item-center flex-grow-1">
                <div class="avatar">
                    <img class="circle" src="{{ asset('images/avatar/user.svg') }}" width="30" alt="sample image">
                </div>
                <div class="member-info display-flex flex-column">
                    <span class="black-text">{{ $user->name }}</span>
                    <small class="grey-text">
                        Почта:
                        <span class="copy-to-clipboard tooltip" data-text="{{ $user->email }}" style="font-weight: bold" data-type="email">
                            <span class="tooltiptext">Кликните чтоб скопировать</span>
                            {{ $user->email }}
                        </span>
                    </small>
                    <small class="grey-text">
                        Логин:
                        <span class="copy-to-clipboard tooltip" data-text="{{ $user->login }}" style="font-weight: bold" data-type="login">
                            <span class="tooltiptext">Кликните чтоб скопировать</span>
                            {{ $user->login }}
                        </span>
                    </small>
                </div>
            </div>
        </div>
    </a>
</li>
@empty
    <li class="auto-suggestion">
        <a class="collection-item display-flex align-items-center" href="#">
            <span class="material-icons">error_outline</span>
            <span class="member-info">No results found.</span>
        </a>
    </li>
@endforelse
