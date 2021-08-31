Hola {{ $user->name }}

Gracias por crear una cuenta. y por seguirme en tik Tok .. jejej.

Por favor verifica tu cuenta desde el siguiente enlace:
{{ route('verify', $user->verification_token) }}
