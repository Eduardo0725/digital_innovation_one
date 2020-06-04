@extend('layout.base')

@section('titulo', 'Logar usuário')

@section('conteudo')
    <form action="" method="post">
        {{ csrf_field() }}

        <div class="email">
            <label for="email">email</label>
            <input type="email" name="email" id="email">
            @if($errors->has('email'))
                @foreach($errors->get('email') as $erro)
                    <strong class="erro">{{ $erro }}</strong>
                @endforeach
            @endif
        </div>

        <div class="senha">
            <label for="senha">senha</label>
            <input type="password" name="senha" id="senha">
            @if($errors->has('senha'))
                @foreach($errors->get('senha') as $erro)
                    <strong class="erro">{{ $erro }}</strong>
                @endforeach
            @endif
        </div>

        <div class="btn">
            <button type="submit">Logar</button>
        </div>
    </form>
@endsection