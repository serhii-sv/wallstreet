@component('mail::message')
  <p>Уважаемый, {{ $user->name }}.</p>
  {!! $text ?? '' !!}
  
  С уважением, команда {{ env('APP_NAME', 'MyApp') }}.

@endcomponent