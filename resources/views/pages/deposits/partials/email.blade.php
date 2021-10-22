
<a class="ml-3" href="{{ route('deposits.show', $deposit->id) }}">{{ $deposit->user->login ?? __('Not indicated') }}</a>