<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apiary;
use App\Models\User;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules;



class WeatherController extends Controller
{

public function index()
{
    $app_key = config('openweather.api_key');
    $city = "Geneva";
    $country = "CH";
    $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=metric&appid=".$app_key;
    $data = file_get_contents($url);
    $data = json_decode($data, true);
    //dd($url);

    return $data;
}

}