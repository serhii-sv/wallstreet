@component('mail::message')
  <p>Уважаемый, {{ $user->name }}.</p>
  {{ $email_text ?? '' }}
  
  С уважением, команда {{ env('APP_NAME', 'MyApp') }}.

@endcomponent