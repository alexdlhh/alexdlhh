@extends('layout')

@section('title')
    <title>Alejandro de la Haba Heredia</title>
@endsection

@section('style')
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
                <!--iframe id="sdxl" src="http://alexdlhh.ddns.net:7860/" frameborder="0"></iframe-->
            </div>
            <div class="col s6">
                <div class="row">
                    <div class="col s12">
                        <input type="text" id="prompt" placeholder="prompt">
                    </div>
                    <div class="col s12">
                        <input type="text" id="negative_propmt" placeholder="negative prompt">
                    </div>
                    <div class="col s12">
                        <a href="javascript:;" id="txt2img" class="btn">TXT2IMG</a>
                    </div>
                </div>
            </div>
            <div class="col s6 center-align" id="result"></div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#txt2img').click(function(){
                $.ajax({
                    url: 'http://alexdlhh.ddns.net:1314/txt2img',
                    type: 'POST',
                    data: {
                        prompt: $('#prompt').val(),
                        negative_prompt: $('#negative_propmt').val(),
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        console.log(data);
                        data = JSON.parse(data);
                        image = data.images[0];
                        var result = '<img src="data:image/png;base64,' + image + '">';
                        $('#result').html(result);
                    }
                });
            });
        });        
    </script>
@endsection