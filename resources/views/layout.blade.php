<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <link href="https://fonts.cdnfonts.com/css/indie-flower" rel="stylesheet">                
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16"  href="/favicon-16x16.png">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    @yield('style')
</head>
<body>
    <nav>
        <div class="nav-wrapper">
            <a href="/" class="brand-logo center">
                <div class="circle white center">
                    <img src="/logo.png" alt="">
                </div>
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="/proyectos">Proyectos</a></li>
                <li><a href="/cositas">Cositas</a></li>
                <li><a href="/contacto">Contacto</a></li>
            </ul>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                @if(Auth::check())
                    <li><a href="/admin">Dashboard</a></li>
                    <li><a href="/logout">Cerrar Sesion</a></li>
                @else
                    <li><a href="/login">Iniciar Sesion</a></li>
                    <li><a href="/register">Registro</a></li>
                @endif
            </ul>
        </div>
    </nav>
    
    @yield('content')
    <footer class="page-footer">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text">Mapa del sitio</h5>
              <p class="grey-text text-lighten-4">Realmente solo hay enlaces a proyectos y alguna que otra foto.</p>
            </div>
            <div class="col l4 offset-l2 s12">
              <h5 class="white-text">Links</h5>
              <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright">
          <div class="container">
          © 2024 Copyright
          <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
          </div>
        </div>
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.materialboxed').materialbox();
        });
    </script>
</body>
</html>