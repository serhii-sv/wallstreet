@php($partner = $transaction->user->firstPartner($transaction->user))
@if(null !== $partner)
    <?php
    $role = $partner->roles()->first();
    ?>
    <a href="{{ route('users.show', $partner->id) }}">
        {{ $partner->login }}
    </a>
@endif
