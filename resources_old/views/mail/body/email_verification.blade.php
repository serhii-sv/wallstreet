<p>Please, confirm your email:</p>
Code: {{ $email_verification_hash }}<br>
Confirmation link: {{ route('email.confirm', ['hash' => $email_verification_hash]) }}