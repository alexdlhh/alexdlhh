@extends('layout')

@section('title')
    <title>Alejandro de la Haba Heredia</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection

@section('content')
    <div class="content">
        <div class="row card">
            <div class="col s12 center-align">
                <h1>FUFA DESDE ORDENADOR DE CASA</h1>
            </div>
        </div>
        <div class="row card">
            <div class="col s12 center-align">
                <h2>Stable Diffusion XL</h2>
                <iframe id="sdxl" src="http://alexdlhh.ddns.net:7860/" frameborder="0"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
        });        
    </script>
@endsection