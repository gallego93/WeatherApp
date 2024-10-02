<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeatherRequest;
use App\Models\Weather;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HandlesWeatherRequests;

class WeatherController extends Controller
{
    use HandlesWeatherRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 20);
        $search = $request->input('search');

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $weathers = Weather::WithSearch($search)->paginate($perPage);
        } else {
            $weathers = Weather::where('user_id', $user->id)
                ->WithSearch($search)
                ->paginate($perPage);
        }

        return view('weathers.index', compact('weathers', 'search', 'perPage'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('weathers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WeatherRequest $request)
    {
        [$latitude, $longitude] = $this->getCoordinates($request->city, $request->latitude, $request->longitude, env('OPENWEATHERMAP_KEY'));

        if ($latitude === null || $longitude === null) {
            return back()->with('error', 'No se pudo obtener la ubicación de la ciudad ingresada.');
        }

        $weatherData = $this->fetchWeatherData($latitude, $longitude, env('OPENWEATHERMAP_KEY'));

        if ($weatherData) {
            Weather::create([
                'city' => $weatherData['name'],
                'latitude' => $latitude,
                'longitude' => $longitude,
                'temperature' => $weatherData['main']['temp'],
                'weather' => $weatherData['weather'][0]['description'],
                'icon' => $weatherData['weather'][0]['icon'],
                'type' => 'Manual',
                'user_id' => Auth::id(),
            ]);

            return redirect()->route('weathers.index')->with('success', 'Registro guardado de manera exitosa!');
        }

        return back()->with('error', 'No se pudo obtener los datos climatológicos.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $weather = Weather::find($id);
        return view('weathers.show', compact('weather'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $weather = Weather::find($id)->delete();
        return back()->with('success', 'Registro eliminado de manera exitosa!');
    }
}
