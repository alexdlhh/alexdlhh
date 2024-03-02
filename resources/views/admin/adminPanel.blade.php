@extends('layout')

@section('title')
    <title>Panel AlexHH</title>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
    <div class="row card">
        <div class="col s12 card-content">
            <span class="card-title">Panel AlexHH</span>
            <div class="row">
                <div class="col s8 offset-s2">
                    <div class="row">
                        <div class="col s12">
                            @dump($user)
                            @dump($api_token)
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
        });        
    </script>
@endsection