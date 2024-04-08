<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class UsageController extends Controller
{
    public function addToMetrics($user,$ip,$route){
        $document = file_get_contents('/var/www/public/metrics/metrics.json');
        //decodificamos el archivo json a un array
        $json = json_decode($document, true);
        if($json == null){
            $json = array();
        }
        if(empty($json[$user])){
            $json[$user] = array();
        }
        if(empty($json[$user]['ip'][$ip])){
            $json[$user]['ip'][$ip] = array();
        }
        if(empty($json[$user]['ip'][$ip][$route])){
            $json[$user]['ip'][$ip][$route] = 1;
        }else{
            $json[$user]['ip'][$ip][$route] = $json[$user]['ip'][$ip][$route] + 1;
        }
        if(empty($json[$user]['api'][$route]['dates'][date('Ymd')])){
            $json[$user]['api'][$route]['dates'][date('Ymd')] = 1;
        }else{
            $json[$user]['api'][$route]['dates'][date('Ymd')] = $json[$user]['api'][$route]['dates'][date('Ymd')] + 1;
        }
        if(empty($json[$user]['api'][$route]['total'])){
            $json[$user]['api'][$route]['total'] = 1;
        }else{
            $json[$user]['api'][$route]['total'] = $json[$user]['api'][$route]['total'] + 1;
        }
        if(empty($json[$user]['total'])){
            $json[$user]['total'] = 1;
        }else{
            $json[$user]['total'] = $json[$user]['total'] + 1;
        }
        //codificamos el array a json
        $json = json_encode($json);
        //escribimos el json en el archivo
        file_put_contents('/var/www/public/metrics/metrics.json', $json);
    }
}