<x-layouts.base title="Login">

<style>
    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}

body{
    background-color: rgb(182, 244, 244);
}

.titulos{
    display: flex;
    flex-flow: column nowrap;
    width: 100%;
    justify-content: center;
    align-items: center
}

.titulos h1{
    font-size: 2.5rem;
}

main{
    margin: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login{
    background: aqua;
    border: 1px solid black;
    border-radius: 12px;
    width: 450px;
}

.login-form{
    width: 100%;
    height: 100%;
    display: flex;
    gap: 10px;
    flex-flow: column nowrap;
    padding: 12px;

}

.label-form{
    align-self: center;
}

.input-form{
    width: 100%;
    font-size: 1.3rem;
}

.visible {
    display: block;
}

.buttons{
    width: 100%;
    display: flex;
    flex-flow: row nowrap;
    gap: 10px;
    justify-content: space-around;
    align-items: center;

}

.submit{
    grid-column: span 2;
    justify-self: end;
    font-size: 1.2rem;
    padding: 5px;
    border: 2px solid black;
    border-radius: 8px;
    background-color: blueviolet;
    font-weight: 700;
    color: rgb(182, 244, 244);
    transition: .3s all;
    margin-top: 5px;
    width: 150px;
    cursor: pointer;
    font-style: normal;
    text-align: center;
    text-decoration: none;
}

.submit:hover{
    transform: scale(1.075);
    border: 2px solid red;
}


@media (width < 350px) {
    .login-form{
        grid-template-columns: 1fr;
        row-gap: 10px;
    }

    .submit{
        grid-column: span 1;
    }
}

</style>


<header class="titulos">
    <h1>Bienvenido al elefante azul</h1>
    @if ($message = Session::get('error'))
        <h3>{{$message}}</h3>
    @endif
</header>

<main>
    <section class="login">



        <form action="{{route('user.authenticate', ['route' => Session::get('route')])}}" method="post" class="login-form">
            @csrf
            <div>
                <label class="label-form" for="username">Usuario: </label>
                <input class="input-form" type="text" id="username" name='username' value="{{old('username')}}">
                @error('username')
                    <x-MarcarError error="{{$message}}"/>
                @enderror
            </div>

            <div>
                <label class="label-form" for="pass">Contraseña:</label>
                <input class="input-form" type="password" id="pass" name='password' value="">
                @error('password')
                    <x-MarcarError error="{{$message}}"/>
                @enderror

            </div>
            <div class="buttons">
                <button type="submit" class="submit">
                    Entrar
                </button>

                <a class="submit" href="{{ route('google.redirect') }}">
                    Entrar con Google
                </a>

            </div>

        </form>
    </section>
</main>
</x-layouts.base>
