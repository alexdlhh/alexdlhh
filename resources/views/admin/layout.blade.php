<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/admin.css" rel="stylesheet">
    @yield('style')
</head>

@php
    $section = !empty($admin['section']) ? $admin['section'] : '';
@endphp

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="/adminPanel" class="brand-logo"><img src="https://bigfootski.es/wp-content/uploads/2018/09/Logo-bigfoot-blanco.png" class="responsive-img"></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
        </div>
    </nav>
    
    <ul class="sidenav" id="mobile-demo">
        <li><a href="/adminPanel">Dashboard</a></li>
        <li><a href="/clients">Clientes</a></li>
        <li><a class="modal-trigger" href="#new_client">Añadir Cliente</a></li>
        <li><a href="/teachers">Profesores</a></li>
        <li><a href="/category">Categorias</a></li>
        <li><a href="/colaborators">Colaboradores</a></li>
        <li><a href="/products">Productos</a></li>        
        <li><a href="/rents">Alquiler</a></li>
        <li><a href="/courses">Cursos</a></li>
        <li><a href="/particulars">Clases Particulares</a></li>
        <li><a href="/repair">Reparaciones</a></li>
        <li><a href="/logout">Logout</a></li>
    </ul>

    <div class="row">
        <div class="col s12 l2 hide-on-med-and-down" id="columna">
            <ul class="collection">
                <li class="collection-item {{$section=='adminPanel'?'active':''}}"><a href="/adminPanel">Dashboard</a></li>
                <li class="collection-item {{$section=='clients'?'active':''}}"><a href="/clients">Clientes</a></li>
                <li class="collection-item"><a class="modal-trigger" href="#new_client">Añadir Cliente</a></li>
                <li class="collection-item {{$section=='teachers'?'active':''}}"><a href="/teachers">Profesores</a></li>
                <li class="collection-item {{$section=='category'?'active':''}}"><a href="/category">Categorias</a></li>
                <li class="collection-item {{$section=='colaborators'?'active':''}}"><a href="/colaborators">Colaboradores</a></li>
                <li class="collection-item {{$section=='products'?'active':''}}"><a href="/products">Productos</a></li>
                <li class="collection-item {{$section=='rents'?'active':''}}"><a href="/rents">Alquiler</a></li>
                <li class="collection-item {{$section=='courses'?'active':''}}"><a href="/courses">Cursos</a></li>
                <li class="collection-item {{$section=='particulars'?'active':''}}"><a href="/particulars">Clases Particulares</a></li>
                <li class="collection-item {{$section=='repair'?'active':''}}"><a href="/repair">Reparaciones</a></li>
                <li class="collection-item"><a href="/logout">Logout</a></li>
            </ul>
        </div>
        <div class="col s12 l10">
            @yield('content')
        </div>
    </div>
    <!-- Modal Structure -->
    <div id="new_client" class="modal">
        <div class="modal-content">
            <div class="row" id="basic">
                <div class="col s4 input-field">
                    <input type="text" id="fasTname" value="{{!empty($client['name'])?$client['name']:''}}">
                    <label for="fasTname">Nombre</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTsurname" value="{{!empty($client['surname'])?$client['surname']:''}}">
                    <label for="fasTsurname">Apellidos</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTdni" value="{{!empty($client['dni'])?$client['dni']:''}}">
                    <label for="fasTdni">DNI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTemail" value="{{!empty($client['email'])?$client['email']:''}}">
                    <label for="fasTemail">Email</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTphone" value="{{!empty($client['phone'])?$client['phone']:''}}">
                    <label for="fasTphone">Teléfono</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTaddress" value="{{!empty($client['address'])?$client['address']:''}}">
                    <label for="fasTaddress">Dirección</label>
                </div>
                <div class="col s4 input-field">
                    <input type="date" id="fasTbirthdate" value="{{!empty($client['birthdate'])?$client['birthdate']:date('Y-m-d')}}">
                    <label for="fasTbirthdate">Fecha Nacimiento</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTheight" value="{{!empty($client['height'])?$client['height']:''}}">
                    <label for="fasTheight">Altura</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTweight" value="{{!empty($client['weight'])?$client['weight']:''}}">
                    <label for="fasTweight">Peso</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTshoe_size" value="{{!empty($client['shoe_size'])?$client['shoe_size']:''}}">
                    <label for="fasTshoe_size">Talla de Calzado</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTski_level" value="{{!empty($client['ski_level'])?$client['ski_level']:''}}">
                    <label for="fasTski_level">nivel de SKI</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTsnow_level" value="{{!empty($client['snow_level'])?$client['snow_level']:''}}">
                    <label for="fasTsnow_level">nivel de SNOW</label>
                </div>
                <div class="col s4 input-field">
                    <input type="text" id="fasTsnow_front" value="{{!empty($client['snow_front'])?$client['snow_front']:''}}">
                    <label for="fasTsnow_front">Diestro/Zurdo SNOW</label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat" id="fasTsaveClient">Crear</a>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
            $('select').formSelect();
            $('.modal').modal();
            $('#fasTsaveClient').click(function(){
            var id = $('#fasTid').val();
            var name = $('#fasTname').val();
            var surname = $('#fasTsurname').val();
            var dni = $('#fasTdni').val();
            var email = $('#fasTemail').val();
            var phone = $('#fasTphone').val();
            var address = $('#fasTaddress').val();
            var birthdate = $('#fasTbirthdate').val();
            var height = $('#fasTheight').val();
            var weight = $('#fasTweight').val();
            var shoe_size = $('#fasTshoe_size').val();
            var ski_level = $('#fasTski_level').val();
            var snow_level = $('#fasTsnow_level').val();
            var snow_front = $('#fasTsnow_front').val();
            // Crear un objeto FormData para enviar los datos
            var formData = new FormData();
            formData.append('id', id);
            formData.append('name', name);
            formData.append('surname', surname);
            formData.append('dni', dni);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('address', address);
            formData.append('birthdate', birthdate);
            formData.append('height', height);
            formData.append('weight', weight);
            formData.append('shoe_size', shoe_size);
            formData.append('ski_level', ski_level);
            formData.append('snow_level', snow_level);
            formData.append('snow_front', snow_front);

            formData.append('_token', '{{ csrf_token() }}');

            // Realizar la solicitud AJAX para enviar los datos y las imágenes
            $.ajax({
                url: '/clientSave',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.success){
                        M.toast({html: response.message});
                        window.location.href = '/clientEdit/' + response.id;
                    } else {
                        M.toast({html: response.message});
                    }
                }
            });
        });
        });
    </script>
</body>
</html>