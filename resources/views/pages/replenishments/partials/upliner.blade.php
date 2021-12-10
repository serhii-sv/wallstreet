@php($partner = $transaction->user->partner)
@if(null !== $partner)
    <?php
    $role = $partner->roles()->first();
    ?>
    <a href="{{ route('users.show', $partner->id) }}">
        {{ $partner->login }}
    </a>
@endif
