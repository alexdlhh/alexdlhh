<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editor de imágenes</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
  <nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Editor de imágenes</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
    </div>
    <div class="nav-content">
      <ul class="tabs">
        <li class="tab"><a href="#subir-imagen">Subir imagen</a></li>
        <li class="tab"><a href="#herramientas">Herramientas</a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <div class="col s12">
      <?php

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://alexdlhh.ddns.net:7860/sdapi/v1/txt2img',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>'{"alwayson_scripts": {"API payload": {"args": []}, "AnimateDiff": {"args": [{"batch_size": 16, "closed_loop": "R-P", "enable": false, "format": ["GIF", "PNG"], "fps": 8, "interp": "Off", "interp_x": 10, "last_frame": null, "latent_power": 1, "latent_power_last": 1, "latent_scale": 32, "latent_scale_last": 32, "loop_number": 0, "model": "mm_sd_v15_v2.ckpt", "overlap": -1, "request_id": "", "stride": 1, "video_length": 0, "video_path": "", "video_source": null}]}, "ControlNet": {"args": [{"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}]}, "CreaPrompt": {"args": [false, "", "", [], false]}, "Depth Library": {"args": []}, "Extra options": {"args": []}, "Hypertile": {"args": []}, "Refiner": {"args": [false, "", 0.8]}, "Seed": {"args": [-1, false, -1, 0, 0, 0]}}, "batch_size": 1, "cfg_scale": 7, "comments": {}, "disable_extra_networks": false, "do_not_save_grid": false, "do_not_save_samples": false, "enable_hr": false, "height": 512, "hr_negative_prompt": "", "hr_prompt": "", "hr_resize_x": 0, "hr_resize_y": 0, "hr_scale": 2, "hr_second_pass_steps": 0, "hr_upscaler": "Latent", "n_iter": 1, "negative_prompt": "", "override_settings": {}, "override_settings_restore_afterwards": true, "prompt": "space art", "restore_faces": false, "s_churn": 0.0, "s_min_uncond": 0.0, "s_noise": 1.0, "s_tmax": null, "s_tmin": 0.0, "sampler_name": "DPM++ 2M Karras", "script_args": [], "script_name": null, "seed": -1, "seed_enable_extras": true, "seed_resize_from_h": -1, "seed_resize_from_w": -1, "steps": 20, "styles": [], "subseed": -1, "subseed_strength": 0, "tiling": false, "width": 512}',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
        $decoded = json_decode($response, true);
        $images = $decoded['images'];
        if(!empty($images)){
          foreach($images as $image){
            ?>
            <div class="row">
              <div class="col s6">
                <p>{{$image}}</p>
              </div>
            </div>
            <?php
            echo '<img src="data:image/png;base64,'.$image.'">';
          }
        }
        else{
          echo '<p>No se han generado imágenes</p>';
        }
      ?>
      </div>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.collapsible');
      var instances = M.Collapsible.init(elems);
    });
  </script>
</body>
</html>