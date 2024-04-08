<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UsageController;

class SDController extends Controller
{
    public function txt2img(Request $request){
        $usage = new UsageController();
        $usage->addToMetrics(Auth::User()->id, $request->ip(), 'txt2img');
        $sendData = $this->buildTxt2ImgRequest(
            $request->prompt, 
            $request->negative_prompt, 
            $request->batch_size??1, 
            $request->cfg??7, 
            $request->steps??25, 
            $request->sampler??'DPM++ 2M Karras', 
            $request->height??512, 
            $request->width??512);

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
          CURLOPT_POSTFIELDS => $sendData,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        return response()->json($response, 200);
    }

    public function img2img(Request $request){
      $usage = new UsageController();
      $usage->addToMetrics(Auth::User()->id, $request->ip(), 'img2img');
      $base64 = base64_encode(file_get_contents($request->file('image')->path()));
      $sendData = $this->buildImg2ImgRequest(
          $request->prompt, 
          $request->negative_prompt, 
          $base64, 
          $request->denoising_strength??0.32, 
          $request->batch_size??1, 
          $request->cfg??7, 
          $request->steps??25, 
          $request->sampler??'DPM++ 2M Karras', 
          $request->height??512, 
          $request->width??512);

      $curl = curl_init();

      curl_setopt_array($curl, array(
        CURLOPT_URL => 'http://alexdlhh.ddns.net:1234/sdapi/v1/txt2img',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $sendData,
        CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json'
        ),
      ));

      $response = curl_exec($curl);

      curl_close($curl);

      return response()->json($response, 200);
  }

    /**
     * Construye el JSON para la petición de txt2img
     * @param string $prompt
     * @param string $negative_prompt
     * @param int $batch_size
     * @param int $cfg
     * @param int $steps
     * @param string $sampler
     * @param int $height
     * @param int $width
     * @return string
     */
    public function buildTxt2ImgRequest($prompt, $negative_prompt, $batch_size=1, $cfg=7, $steps=20, $sampler='DPM++ 2M Karras', $height=512, $width=512){
        $return = '{"alwayson_scripts": {"API payload": {"args": []}, "AnimateDiff": {"args": [{"batch_size": 16, "closed_loop": "R-P", "enable": false, "format": ["GIF", "PNG"], "fps": 8, "interp": "Off", "interp_x": 10, "last_frame": null, "latent_power": 1, "latent_power_last": 1, "latent_scale": 32, "latent_scale_last": 32, "loop_number": 0, "model": "mm_sd_v15_v2.ckpt", "overlap": -1, "request_id": "", "stride": 1, "video_length": 0, "video_path": "", "video_source": null}]}, "ControlNet": {"args": [{"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}]}, "CreaPrompt": {"args": [false, "", "", [], false]}, "Depth Library": {"args": []}, "Extra options": {"args": []}, "Hypertile": {"args": []}, "Refiner": {"args": [false, "", 0.8]}, "Seed": {"args": [-1, false, -1, 0, 0, 0]}}, "batch_size": '.$batch_size.', "cfg_scale": "'.$cfg.'", "comments": {}, "disable_extra_networks": false, "do_not_save_grid": false, "do_not_save_samples": false, "enable_hr": false, "height": '.$height.', "hr_negative_prompt": "", "hr_prompt": "", "hr_resize_x": 0, "hr_resize_y": 0, "hr_scale": 2, "hr_second_pass_steps": 0, "hr_upscaler": "Latent", "n_iter": 1, "negative_prompt": "'.$negative_prompt.'", "override_settings": {}, "override_settings_restore_afterwards": true, "prompt": "'.$prompt.'", "restore_faces": false, "s_churn": 0.0, "s_min_uncond": 0.0, "s_noise": 1.0, "s_tmax": null, "s_tmin": 0.0, "sampler_name": "'.$sampler.'","script_args": [], "script_name": null, "seed": -1, "seed_enable_extras": true, "seed_resize_from_h": -1, "seed_resize_from_w": -1, "steps": '.$steps.', "styles": [], "subseed": -1, "subseed_strength": 0, "tiling": false, "width": '.$width.'}';
        return $return;
    }

    /**
     * Construye el JSON para la petición de img2img
     * @param string $prompt
     * @param string $negative_prompt
     * @param string $base64
     * @param float $denoising_strength
     * @param int $batch_size
     * @param int $cfg
     * @param int $steps
     * @param string $sampler
     * @param int $height
     * @param int $width
     * @return string
     */
    public function buildImg2ImgRequest($prompt, $negative_prompt, $base64, $denoising_strength=0.32,$batch_size=1, $cfg=7, $steps=20, $sampler='DPM++ 2M Karras', $height=512, $width=512){
        $return = '{"alwayson_scripts": {"API payload": {"args": []}, "AnimateDiff": {"args": [{"batch_size": 16, "closed_loop": "R-P", "enable": false, "format": ["GIF", "PNG"], "fps": 8, "interp": "Off", "interp_x": 10, "last_frame": null, "latent_power": 1, "latent_power_last": 1, "latent_scale": 32, "latent_scale_last": 32, "loop_number": 0, "model": "mm_sd_v15_v2.ckpt", "overlap": -1, "request_id": "", "stride": 1, "video_length": 0, "video_path": "", "video_source": null}]}, "ControlNet": {"args": [{"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}, {"advanced_weighting": null, "batch_images": "", "control_mode": "Balanced", "enabled": false, "guidance_end": 1, "guidance_start": 0, "hr_option": "Both", "image": null, "inpaint_crop_input_image": false, "input_mode": "simple", "is_ui": true, "loopback": false, "low_vram": false, "model": "None", "module": "none", "output_dir": "", "pixel_perfect": false, "processor_res": -1, "resize_mode": "Crop and Resize", "save_detected_map": true, "threshold_a": -1, "threshold_b": -1, "weight": 1}]}, "CreaPrompt": {"args": [false, "", "", [], false]}, "Depth Library": {"args": []}, "Extra options": {"args": []}, "Hypertile": {"args": []}, "Refiner": {"args": [false, "", 0.8]}, "Seed": {"args": [-1, false, -1, 0, 0, 0]}}, "batch_size": '.$batch_size.', "cfg_scale": '.$cfg.', "comments": {}, "denoising_strength": '.$denoising_strength.', "disable_extra_networks": false, "do_not_save_grid": false, "do_not_save_samples": false, "height": '.$height.', "image_cfg_scale": 1.5, "init_images": ["'.$base64.'"], "initial_noise_multiplier": 1.0, "inpaint_full_res": 0, "inpaint_full_res_padding": 32, "inpainting_fill": 1, "inpainting_mask_invert": 0, "mask_blur": 4, "mask_blur_x": 4, "mask_blur_y": 4, "n_iter": 1, "negative_prompt": "'.$negative_prompt.'", "override_settings": {}, "override_settings_restore_afterwards": true, "prompt": "'.$prompt.'", "resize_mode": 0, "restore_faces": false, "s_churn": 0.0, "s_min_uncond": 0.0, "s_noise": 1.0, "s_tmax": null, "s_tmin": 0.0, "sampler_name": "'.$sampler.'", "script_args": [], "script_name": null, "seed": -1, "seed_enable_extras": true, "seed_resize_from_h": -1, "seed_resize_from_w": -1, "steps": '.$steps.', "styles": [], "subseed": -1, "subseed_strength": 0, "tiling": false, "width": '.$width.'}';
        return $return;
    }
}