{{ route('verify', $user->verification_token) }}
@component('mail::message')
    # Hola {{ $user->name }}

    Gracias por crear una cuenta. y por seguirme en tik Tok .. jejej..<br>

    Por favor verifica tu cuenta desde el siguiente botón:

    @component('mail::button', ['url' => route('verify', $user->verification_token) ])
        Confirmar mi cuenta
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
