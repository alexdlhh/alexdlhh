@extends('layout')

@section('title')
    <title>Inicio de sesión</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="login_pad">
        <div class="row card">
            <div class="col offset-s4 s4 card-content">
                <div class="row ">
                    <div class="col s12">
                        <span class="card-title">Inicio de Sesión</span>
                    </div>
                    <div class="col s10 offset-s1 input-field">
                        <input placeholder="" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="col s10 offset-s1 input-field">
                        <input placeholder="" id="password" type="password" class="validate">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="col s12 center-align">
                        <a href="javascript:;" class="btn" id="login">Iniciar Sesión</a>
                        <a href="javascript:;" class="btn" id="forget">He olvidado la contraseña</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#login').click(function(){
                var email = $('#email').val();
                var password = $('#password').val();
                var token = '{{ csrf_token() }}';
                $.ajax({
                    url: '{{ route('do_login') }}',
                    type: 'POST',
                    data: {
                        email: email,
                        password: password,
                        _token: token
                    },
                    success: function(data){
                        if(data.success){
                            if(data.success == 'admin'){
                                M.toast({html: 'Bienvenido Administrador', classes: 'rounded green white-text'});
                                window.location.href = '{{ route('adminPanel') }}';
                            }else{
                                M.toast({html: 'Bienvenido', classes: 'rounded green white-text'});
                                window.location.href = '{{ route('home') }}';
                            }
                        }else{
                            M.toast({html: 'Email o contraseña incorrectos', classes: 'rounded red white-text'});
                        }
                    }
                });
            })
        });        
    </script>
@endsection