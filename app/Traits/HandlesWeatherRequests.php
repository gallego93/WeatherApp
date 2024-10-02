<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait HandlesWeatherRequests
{
    protected function getCoordinates($city, $latitude, $longitude, $apiKey): array
    {
        if ($city) {
            $geoResponse = Http::get(env('GEO_API_URL'), [
                'q' => $city,
                'limit' => 1,
                'appid' => $apiKey
            ]);

            if ($geoResponse->successful() && count($geoResponse->json()) > 0) {
                return [$geoResponse->json()[0]['lat'], $geoResponse->json()[0]['lon']];
            }
        }

        return [$latitude, $longitude];
    }

    protected function fetchWeatherData(float $latitude, float $longitude, string $apiKey): ?array
    {
        $weatherResponse = Http::get(env('WEATHER_API_URL'), [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => $apiKey,
            'units' => 'metric',
            'lang' => 'es'
        ]);

        return $weatherResponse->successful() ? $weatherResponse->json() : null;
    }
}
