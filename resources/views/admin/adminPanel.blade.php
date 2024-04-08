@extends('layout')

@section('title')
    <title>Panel AlexHH</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>
    <!--jquery ui-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
        #tableName {
            width: 100%;
            table-layout: fixed;
        }
        .canvas {
            height: 450px;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col s12 center-align"><span class="card-title">Panel {{ $user->name }}</span></div>
        <div class="col s12">
            <div class="row">
                <div class="col s12">
                    <div class="row">
                        <div class="col m4 s12 card">
                            <div class="card-content">
                                <span class="card-title">Datos de usuario</span>
                                <p>Nombre: {{ $user->name }}</p>
                                <p>Email: {{ $user->email }}</p>
                                <p>Fecha de creación: {{ $user->created_at }}</p>
                            </div>
                        </div>
                        <div class="col m8 s12 card">
                            <div class="card-content">
                                <span class="card-title">OAuth 2.0 Bearer Token</span>
                                <p style="overflow:scroll">{{ $api_token->accessToken }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col s12">
            <canvas id="APIUsage"></canvas>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            printWidgetByUser();
        });
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        function printWidgetByUser(){
            var data = {!!$metrics!!};
            var labels = ['txt2img', 'img2txt', 'inpainting', 'outpainting', 'txt2video', 'img2video', 'llama2', 'codeLlama', 'Gema'];
            var datasets = [];
            var colorsByUser ='';
            var llamadasArray = {};
            var count = 0;
            for(const [apiName, apiData] of Object.entries(data.api)){
                colorsByUser = getRandomColor();
                if(typeof llamadasArray == 'undefined'){
                    llamadasArray = [];
                    llamadasArray[apiName] = 0;
                }
                llamadasArray[apiName]=apiData.total;
                datasets.push({
                    label: apiName,
                    data: llamadasArray,
                    backgroundColor: colorsByUser,
                    borderColor: colorsByUser,
                    fill: false
                });
            }
            
            console.log(datasets);
            // Obtener el contexto del canvas
            const ctx = document.getElementById('APIUsage').getContext('2d');

            // Definir los datos
            const datos = {
                labels: labels,
                datasets: datasets
            };

            // Opciones de la gráfica
            const opciones = {
                scales: {
                    yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                    }]
                },
                responsive: true,
                maintainAspectRatio: false,
            };

            // Crear la gráfica
            const miGrafica = new Chart(ctx, {
                type: 'bar',
                data: datos,
                options: opciones
            });

        }
    </script>
@endsection