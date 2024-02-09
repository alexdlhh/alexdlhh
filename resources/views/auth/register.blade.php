@extends('layout')

@section('title')
    <title>Register</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="row card">
            <div class="col s12 card-content">
                <div class="row">
                    <div class="col s12">
                        <span class="card-title">Registro</span>
                    </div>
                    <div class="col s4 input-field">
                        <input placeholder="" id="name" type="text" class="validate">
                        <label for="name">Nombre</label>
                    </div>
                    <div class="col s4 input-field">
                        <input placeholder="" id="email" type="text" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="col s4 input-field">
                        <select id="role">
                            <option value="admin">Administrador</option>
                            <option value="couple">Profesor</option>
                        </select>
                    </div>
                    <div class="col s6 input-field">
                        <input placeholder="" id="password" type="password" class="validate">
                        <label for="password">Contraseña</label>
                    </div>
                    <div class="col s6 input-field">
                        <input placeholder="" id="confirm_password" type="password" class="validate">
                        <label for="confirm_password">Confirmar Contraseña</label>
                    </div>
                    <div class="col s12">
                        <a href="javascript:;" class="btn" id="singIn">Registrate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
        $('#singIn').click(function(){
            var name = $('#name').val();
            var email = $('#email').val();
            var role = $('#role').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            if(name == '' || email == '' || role == '' || password == '' || confirm_password == ''){
                alert('Todos los campos son obligatorios');
            }else{
                if(password != confirm_password){
                    alert('Las contraseñas no coinciden');
                }else{
                    $.ajax({
                        url: '{{ route('do_register') }}',
                        type: 'POST',
                        data: {
                            name: name,
                            email: email,
                            role: role,
                            password: password,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(data){
                            if(data == 'admin'){
                                alert('Usuario registrado correctamente');
                                window.location.href = '{{ route('adminPanel') }}';
                            }
                        }
                    });
                }
            }
        })
    </script>
@endsection