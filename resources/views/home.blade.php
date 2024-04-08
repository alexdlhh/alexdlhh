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
            <div class="col s3">
                <div class="row">
                    <div class="col s12">
                        <input type="text" id="prompt" placeholder="prompt">
                    </div>
                    <div class="col s12">
                        <input type="text" id="negative_propmt" placeholder="negative prompt">
                    </div>
                    <div class="col s12" id="inpaintzone">
                        <div class="phppot-container">
                            <div id="drop-area">
                                <h3 class="drop-text">Drop images here to upload</h3>
                            </div>
                            <input type="file" name="image" id="image" hidden>
                        </div>
                    </div>
                    <div class="col s12" id="mask">
                        <img src="" id="imgmask" width="100%" alt="">
                    </div>
                    <div class="col s12">
                        <a href="javascript:;" id="txt2img" class="btn">TXT2IMG</a>
                        <a href="javascript:;" id="img2img" class="btn">IMG2IMG</a>
                        <a href="javascript:;" id="print" class="btn">print mask</a>
                    </div>
                </div>
            </div>
            <div class="col s9 center-align" id="result"></div>
        </div>
    </div>
    Mi IP es: <strong id="ipId"></strong>
@endsection

@section('script')


<script type="text/javascript">
    function get_ip(obj){
        document.getElementById('ipId').innerHTML = obj.ip;
        var ip = obj.ip;
        $.ajax({
            url: 'http://alexdlhh.ddns.net:1314/ip',
            type: 'POST',
            data: {
                ipG: ip,
                _token: '{{csrf_token()}}'
            },
            success: function(data){
                console.log(data);
            }
        });
    }
</script>
<script type="text/javascript" src="https://api.ipify.org/?format=jsonp&callback=get_ip"></script>
    <script>
        $(document).ready(function(){
            var imgs=0;
            
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

            $('#img2img').click(function(){
                var formData = new FormData();
                formData.append('image', $('#image')[0].files[0]);
                formData.append('prompt', $('#prompt').val());
                formData.append('negative_prompt', $('#negative_propmt').val());
                formData.append('_token', '{{csrf_token()}}');
                $.ajax({
                    url: 'http://alexdlhh.ddns.net:1314/img2img',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data){
                        console.log(data);
                        data = JSON.parse(data);
                        image = data.images[0];
                        var result = '<img src="data:image/png;base64,' + image + '">';
                        $('#result').html(result);
                    }
                });
            });

            $("#drop-area").on('dragenter', function (e){
                e.preventDefault();
            });

            $("#drop-area").on('dragover', function (e){
                e.preventDefault();
            });

            $("#drop-area").on('drop', function (e){
                e.preventDefault();
                var image = e.originalEvent.dataTransfer.files;
                $('#image').prop('files', image);
                $('#drop-area').html('<img id="img'+imgs+'" src="' + URL.createObjectURL(image[0]) + '" width="100%">');
                
                //detectamos altura y ancho del la imagen #img0
                setTimeout(() => {
                    var img = document.getElementById('img0');
                    var w = img.width;
                    var h = img.height;
                    console.log(w, h);
                    $('#inpaintzone').append(`
                        <canvas id="can" width="${img.width}" height="${img.height}" style="border: 2px solid;
                        position: absolute;
                        top: 222px;border:2px solid;"></canvas>
                        <p>Choose Color</p>
                        <div style="display:inline-block;width:15px;height:15px;background:green;border:2px solid;" class="colorbtn" id="green" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:blue;border:2px solid;" class="colorbtn" id="blue" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:red;border:2px solid;" class="colorbtn" id="red" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:yellow;border:2px solid;" class="colorbtn" id="yellow" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:orange;border:2px solid;" class="colorbtn" id="orange" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:black;border:2px solid;" class="colorbtn" id="black" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <div style="display:inline-block;width:15px;height:15px;background:white;border:2px solid;" class="colorbtn" id="white" onclick="color(this);$('.colorbtn').css('border','2px solid black');$(this).css('border','2px solid blue')"></div>
                        <img id="canvasimg" style="top:10%;left:52%;" style="display:none;">
                        <input type="button" value="save" id="btn" size="30" onclick="save()" style="top:55%;left:10%;">
                        <input type="button" value="clear" id="clr" size="23" onclick="erase()" style="top:55%;left:15%;">
                    `);
                    init();
                }, 1000);
                
                /*base_image = new Image();
                base_image.src = URL.createObjectURL(image[0]);
                //rescale image
                base_image.onload = function(){
                    ctx.drawImage(base_image, 0, 0, 400, 400);
                    base_image.src = canvas.toDataURL();
                }*/
                imgs++;
            });

            $('#print').click(function(){
                print();
            });
        });        
        var canvas, ctx, flag = false,
            prevX = 0,
            currX = 0,
            prevY = 0,
            currY = 0,
            dot_flag = false;

        var x = "black",
            y = 20;
        
        function init() {
            canvas = document.getElementById('can');
            ctx = canvas.getContext("2d");
            w = canvas.width;
            h = canvas.height;
            console.log(w, h);
        
            canvas.addEventListener("mousemove", function (e) {
                findxy('move', e)
            }, false);
            canvas.addEventListener("mousedown", function (e) {
                findxy('down', e)
            }, false);
            canvas.addEventListener("mouseup", function (e) {
                findxy('up', e)
            }, false);
            canvas.addEventListener("mouseout", function (e) {
                findxy('out', e)
            }, false);
        }
        
        function color(obj) {
            switch (obj.id) {
                case "green":
                    x = "green";
                    break;
                case "blue":
                    x = "blue";
                    break;
                case "red":
                    x = "red";
                    break;
                case "yellow":
                    x = "yellow";
                    break;
                case "orange":
                    x = "orange";
                    break;
                case "black":
                    x = "black";
                    break;
                case "white":
                    x = "white";
                    break;
            }
            if (x == "white") y = 14;
            else y = 2;
        
        }
        
        function draw() {
            ctx.beginPath(); // Start a new drawing path
            ctx.arc(currX, currY, 10, 10, Math.PI * 2, true); // Draw a circle with radius 1 at current coordinates
            ctx.fillStyle = x; // Set the fill color (adjust 'x' for desired color)
            ctx.fill(); // Fill the circle
            ctx.closePath(); 
        }
        
        function erase() {
            var m = confirm("Want to clear");
            if (m) {
                ctx.clearRect(0, 0, w, h);
                document.getElementById("canvasimg").style.display = "none";
            }
        }
        
        function save() {
            document.getElementById("canvasimg").style.border = "2px solid";
            var dataURL = canvas.toDataURL();
            document.getElementById("canvasimg").src = dataURL;
            document.getElementById("canvasimg").style.display = "inline";
        }
        
        function findxy(res, e) {
            if (res == 'down') {
                prevX = currX;
                prevY = currY;
                currX = e.clientX - canvas.offsetLeft;
                currY = e.clientY - canvas.offsetTop-60;
        
                flag = true;
                dot_flag = true;
                if (dot_flag) {
                    ctx.beginPath();
                    ctx.fillStyle = x;
                    ctx.fillRect(currX, currY, 2, 2);
                    ctx.closePath();
                    dot_flag = false;
                }
            }
            if (res == 'up' || res == "out") {
                flag = false;
            }
            if (res == 'move') {
                if (flag) {
                    prevX = currX;
                    prevY = currY;
                    currX = e.clientX - canvas.offsetLeft;
                    currY = e.clientY - canvas.offsetTop-60;
                    draw();
                }
            }
        }

        function print(){
            var canvas = document.getElementById('can');
            var dataURL = canvas.toDataURL();
            console.log(dataURL);
            $('#imgmask').attr('src', dataURL);
        }
    </script>
@endsection