<?php

namespace App\Http\Controllers;

use App\Traits\HandlesWeatherRequests;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    use HandlesWeatherRequests;

    public function showWeather(Request $request)
    {
        $city = $request->input('city', 'Cali, CO');
        $latitude = $request->input('latitude', 3.4516);
        $longitude = $request->input('longitude', -76.5320);

        [$lat, $lon] = $this->getCoordinates($city, $latitude, $longitude, env('OPENWEATHERMAP_KEY'));

        $weatherData = $this->fetchWeatherData($lat, $lon, env('OPENWEATHERMAP_KEY'));

        if ($weatherData) {
            return view('welcome', [
                'city' => $city,
                'temperature' => $weatherData['main']['temp'],
                'weatherCondition' => $weatherData['weather'][0]['description'],
                'iconCode' => $weatherData['weather'][0]['icon']
            ]);
        } else {
            return view('welcome', [
                'error' => 'No se pudo obtener el clima'
            ]);
        }
    }
}
