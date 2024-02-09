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
            <div class="col offset-s2 s8 card-content">
                <div class="row">
                    <div class="col s12">
                        <span class="card-title">Registro</span>
                    </div>
                    <div class="col s6">
                        <div class="row">
                            <div class="col s10 offset-s1 input-field">
                                <input placeholder="" id="name" type="text" class="validate">
                                <label for="name">Nombre</label>
                            </div>
                            <div class="col s10 offset-s1 input-field">
                                <input placeholder="" id="email" type="text" class="validate">
                                <label for="email">Email</label>
                            </div>
                            <div class="col s10 offset-s1 input-field">
                                <select id="role">
                                    <option value="admin">Administrador</option>
                                    <option value="couple">Profesor</option>
                                </select>
                                <label for="role">Rol</label>
                            </div>
                        </div>
                    </div>
                    <div class="col s6">
                        <div class="row">
                            <div class="col s10 offset-s1 input-field">
                                <input placeholder="" id="password" type="password" class="validate">
                                <label for="password">Contraseña</label>
                            </div>
                            <div class="col s10 offset-s1 input-field">
                                <input placeholder="" id="confirm_password" type="password" class="validate">
                                <label for="confirm_password">Confirmar Contraseña</label>
                            </div>
                            <div class="col s10 offset-s1 center-align">
                                <p>
                                    <label>
                                        <input type="checkbox" id="aceptar"/>
                                        <span>Dale al checkboc si quieres si no no pasa na, esta para decorar xD</span>
                                    </label>
                                </p>
                            </div>
                            <div class="col s12 center-align">
                                <a href="javascript:;" class="btn" id="singIn">Registrate</a>
                            </div>
                        </div>
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
            mostrarSpinner();
            var name = $('#name').val();
            var email = $('#email').val();
            var role = $('#role').val();
            var password = $('#password').val();
            var confirm_password = $('#confirm_password').val();
            if(name == '' || email == '' || role == '' || password == '' || confirm_password == ''){
                M.toast({html: 'Todos los campos son obligatorios', classes: 'rounded red white-text'});
                eliminarSpinner()
            }else{
                if(password != confirm_password){
                    M.toast({html: 'Las contraseñas no coinciden', classes: 'rounded red white-text'});
                    eliminarSpinner()
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
                            eliminarSpinner()
                            if(data == 'admin'){
                                M.toast({html: 'Usuario registrado correctamente', classes: 'rounded'});
                                window.location.href = '{{ route('adminPanel') }}';
                            }else if(data == 'user'){
                                M.toast({html: 'Usuario registrado correctamente', classes: 'rounded'});
                                window.location.href = '{{ route('home') }}';
                            }else{
                                M.toast({html: 'Ha ocurrido un error', classes: 'rounded red white-text'});
                            }
                        },
                        error: function(){
                            eliminarSpinner()
                            M.toast({html: 'Ha ocurrido un error', classes: 'rounded red white-text'});
                        }
                    });
                }
            }
        })
        function mostrarSpinner() {
            // Creamos el contenedor del spinner
            const spinnerContainer = document.createElement('div');
            spinnerContainer.classList.add('preloader-wrapper');

            // Creamos el spinner
            const spinner = document.createElement('div');
            spinner.classList.add('spinner-layer');
            spinner.classList.add('spinner-blue-only');

            // Agregamos el spinner al contenedor
            spinnerContainer.appendChild(spinner);

            // Insertamos el contenedor del spinner en el body
            document.body.appendChild(spinnerContainer);
        }
        function eliminarSpinner() {
            const spinnerContainer = document.querySelector('.preloader-wrapper');
            if (spinnerContainer) {
                spinnerContainer.parentNode.removeChild(spinnerContainer);
            }
        }
    </script>
@endsection