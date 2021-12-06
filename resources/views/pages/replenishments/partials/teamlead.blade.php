@php($partner = $transaction->user->firstPartner($transaction->user))
@if(null !== $partner)
    <?php
    $role = $partner->roles()->first();
    $color = null !== $role && !empty($role->color)
        ? $role->color
        : null;
    ?>
    <span class="chip {{ null !== $color ? '' : 'orange' }} lighten-5" title="{{ null !== $role ? $role->name : 'без роли' }}" {{ null !== $color ? 'style=background-color:'.$color.';' : '' }}>
            <a href="{{ route('users.show', $partner->id) }}">
                <span class="{{ null !== $color ? '' : 'orange-text' }}" {{ null !== $color ? 'style=color:white; font-weight:bold;' : '' }}>{{ $partner->login }}</span>
            </a>
    </span>
@endif
