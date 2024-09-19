<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\Weather;

class AutomatedWeatherQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:automated-weather-query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('AutomatedWeatherQuery command started.');

        try {
            $users = User::all();
            foreach($users as $user){

            $apiKey = config('services.openweathermap.key');

            $city = $user->default_city;

            $geoResponse = Http::get("http://api.openweathermap.org/geo/1.0/direct", [
                'q' => $city,
                'limit' => 1,
                'appid' => $apiKey
            ]);

            if ($geoResponse->successful() && count($geoResponse->json()) > 0) {
                $geoData = $geoResponse->json()[0];
                $latitude = $geoData['lat'];
                $longitude = $geoData['lon'];
            } else {
                Log::error('No se pudo obtener la ubicación de la ciudad ingresada.');
            }

            $weatherResponse = Http::get("http://api.openweathermap.org/data/2.5/weather", [
                'lat' => $latitude,
                'lon' => $longitude,
                'appid' => $apiKey,
                'units' => 'metric',
                'lang' => 'es'
            ]);

            if ($weatherResponse->successful()) {
                $weatherData = $weatherResponse->json();

                $weather = Weather::create([
                    'city' => $city,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'temperature' => $weatherData['main']['temp'],
                    'weather' => $weatherData['weather'][0]['description'],
                    'icon' => $weatherData['weather'][0]['icon'],
                    'type' => 'Automatizada',
                    'user_id' => $user->id,
                ]);
                Log::info('Registro climatológiaco automatizado guardado de manera exitosa.');
            } else {
                Log::error('No se pudo obtener los datos climatológicos.');
            }
        }
        } catch (\Exception $e) {
            Log::error('Error in AutomatedWeatherQuery: ' . $e->getMessage());
        }

        Log::info('AutomatedWeatherQuery command finished.');
    }
}
