<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Weathers')}}
        </h2>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ __('New Registration')}}</h2>
            <form method="POST" action="{{ route('weathers.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="w-full">
                        <label for="city" class="block mb-2 text-sm font-medium text-gray-900">{{ __('City')}}</label>
                        <input type="text" name="city" id="city"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Ciudad" value="{{ old('city') }}">
                    </div>
                    <div class="w-full">
                        <label for="temperature"
                            class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Temperature')}} </label>
                        <input type="text" name="temperature" id="temperature"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Temperatura" value="{{ old('temperature') }}" readonly>
                    </div>
                    <div class="w-full">
                        <label for="weather" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Weather Status')}} </label>
                        <input type="text" name="weather" id="weather"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Estado del Clima" value="{{ old('weather') }}" readonly>
                    </div>
                    <div class="w-full">
                        <label for="icon" class="block mb-2 text-sm font-medium text-gray-900"> {{ __('Icon Of Climate')}} </label>
                        <img id="weather-icon" alt="Icono del Clima" class="block w-16 h-16">
                    </div>
                    <div class="w-full">
                        <input type="hidden" name="latitude" id="latitude">
                    </div>
                    <div class="w-full">
                        <input type="hidden" name="longitude" id="longitude">
                    </div>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2.5 px-5 mt-4 sm:mt-6 rounded">
                    {{ __('Send')}}
                </button>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('city').addEventListener('input', function() {
            const cityName = this.value;

            if (cityName.length > 2) {
                fetch(
                        `http://api.openweathermap.org/data/2.5/weather?q=${cityName}&units=metric&appid={{ config('services.openweathermap.key') }}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.cod === 200) {
                            const temperature = data.main.temp;
                            const weatherState = data.weather[0].description;
                            const weatherIcon = data.weather[0].icon;

                            document.getElementById('temperature').value = temperature + '°C';
                            document.getElementById('weather').value = weatherState;
                            document.getElementById('weather-icon').src =
                                `http://openweathermap.org/img/wn/${weatherIcon}.png`;
                        } else {
                            console.error('{{ __('Could not obtain weather data for the city entered.')}}');
                            document.getElementById('temperature').value = '';
                            document.getElementById('weather').value = '';
                            document.getElementById('weather-icon').src = '';
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los datos del clima:', error);
                        document.getElementById('temperature').value = '';
                        document.getElementById('weather').value = '';
                        document.getElementById('weather-icon').src = '';
                    });
            }
        });

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;

                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;

                fetch(
                        `http://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longitude}&units=metric&appid={{ config('services.openweathermap.key') }}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            const cityName = data.name;
                            const temperature = data.main.temp;
                            const weatherState = data.weather[0].description;
                            const weatherIcon = data.weather[0].icon;
                            document.getElementById('city').value = cityName;
                            document.getElementById('temperature').value = temperature + '°C';
                            document.getElementById('weather').value = weatherState;
                            document.getElementById('weather-icon').src =
                                `http://openweathermap.org/img/wn/${weatherIcon}.png`;
                        } else {
                            console.error('{{ __('Climate data could not be obtained.')}}');
                        }
                    })
                    .catch(error => {
                        console.error('{{ __('Error getting weather data:')}}', error);
                    });
            }, function(error) {
                console.error("{{ __('Error obtaining location:')}}", error);
            });
        } else {
            alert('{{ __('Geolocation is not supported by this browser.')}}');
        }
    </script>
</x-app-layout>
