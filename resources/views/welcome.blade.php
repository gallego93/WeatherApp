<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        /* ! tailwindcss v3.2.4 | MIT License | https://tailwindcss.com */
        *,
        ::after,
        ::before {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb
        }

        ::after,
        ::before {
            --tw-content: ''
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .relative {
            position: relative
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline
        }

        .flex {
            display: flex
        }

        .justify-center {
            justify-content: center
        }

        .items-center {
            align-items: center
        }

        .min-h-screen {
            min-height: 100vh
        }

        .bg-dots-darker {
            background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E")
        }

        .bg-center {
            background-position: center
        }

        .bg-gray-100 {
            --tw-bg-opacity: 1;
            background-color: rgb(243 244 246 / var(--tw-bg-opacity))
        }

        .selection\:bg-red-500 *::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:bg-red-500::selection {
            --tw-bg-opacity: 1;
            background-color: rgb(239 68 68 / var(--tw-bg-opacity))
        }

        .selection\:text-white *::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .selection\:text-white::selection {
            --tw-text-opacity: 1;
            color: rgb(255 255 255 / var(--tw-text-opacity))
        }

        .p-6 {
            padding: 1.5rem
        }


        .text-right {
            text-align: right
        }

        .z-10 {
            z-index: 10
        }

        .font-semibold {
            font-weight: 600
        }

        .text-gray-600 {
            --tw-text-opacity: 1;
            color: rgb(75 85 99 / var(--tw-text-opacity))
        }

        .hover\:text-gray-900:hover {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        .hover\:text-gray-700:hover {
            --tw-text-opacity: 1;
            color: rgb(55 65 81 / var(--tw-text-opacity))
        }

        .text-gray-900 {
            --tw-text-opacity: 1;
            color: rgb(17 24 39 / var(--tw-text-opacity))
        }

        /* Estilos generales para el contenedor de información del clima */
        .weather-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.3);
            max-width: 400px;
            margin: 40px auto;
            font-family: 'Arial', sans-serif;
        }

        /* Título principal de la ciudad */
        #city-name {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        /* Fecha actual */
        #current-date {
            font-size: 16px;
            color: #777;
            margin-bottom: 5px;
        }

        /* Hora actualizada en tiempo real */
        #current-time {
            font-size: 16px;
            color: #777;
            margin-bottom: 20px;
        }

        /* Título del clima */
        #weather-title {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
        }

        /* Temperatura actual */
        #temperature {
            font-size: 20px;
            font-weight: bold;
            color: #FF5722;
            margin-bottom: 20px;
        }

        /* Contenedor para la imagen del clima */
        .weather-image {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        /* Estilos para la imagen del clima */
        .weather-image img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        /* Ajustes de estilo responsivo */
        @media (max-width: 768px) {
            .weather-container {
                max-width: 90%;
                padding: 20px;
            }

            #city-name {
                font-size: 24px;
            }

            #weather-title {
                font-size: 18px;
            }

            #temperature {
                font-size: 18px;
            }

            .weather-image img {
                width: 120px;
                height: 120px;
            }
        }

        /*Fin Weather */

        @media (prefers-reduced-motion: no-preference) {
            .motion-safe\:hover\:scale-\[1\.01\]:hover {
                --tw-scale-x: 1.01;
                --tw-scale-y: 1.01;
                transform: translate(var(--tw-translate-x), var(--tw-translate-y)) rotate(var(--tw-rotate)) skewX(var(--tw-skew-x)) skewY(var(--tw-skew-y)) scaleX(var(--tw-scale-x)) scaleY(var(--tw-scale-y))
            }
        }

        @media (min-width: 640px) {
            .sm\:fixed {
                position: fixed
            }

            .sm\:top-0 {
                top: 0px
            }

            .sm\:right-0 {
                right: 0px
            }

            .sm\:ml-0 {
                margin-left: 0px
            }

            .sm\:flex {
                display: flex
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-center {
                justify-content: center
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width: 768px) {
            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width: 1024px) {
            .lg\:gap-8 {
                gap: 2rem
            }

            .lg\:p-8 {
                padding: 2rem
            }
        }
    </style>
</head>

<body class="antialiased">
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 selection:bg-red-500 selection:text-white">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif

        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="flex justify-center">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </div>
            <br>
            <!-- -->
            <div class="weather-container">
                <div class="weather-info">
                    <h1 id="city-name">Cargando ciudad...</h1>
                    <p id="current-date">Cargando fecha...</p>
                    <p id="current-time">Cargando hora...</p>
                    <h2 id="weather-title">Clima Actual</h2>
                    <p id="temperature">Cargando temperatura...</p>
                </div>
                <div class="weather-image">
                    <img id="weather-img" src="" alt="Condición del clima" style="display: none;">
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weatherTitle = document.getElementById('weather-title');
            const temperatureElement = document.getElementById('temperature');
            const cityNameElement = document.getElementById('city-name');
            const dateElement = document.getElementById('current-date');
            const timeElement = document.getElementById('current-time');
            const weatherImg = document.getElementById('weather-img');

            const apiKey =
                '{{ config('services.openweathermap.key') }}';
            const ciudad = 'Cali, CO';
            const apiUrl =
                `https://api.openweathermap.org/data/2.5/weather?q=${ciudad}&appid=${apiKey}&units=metric&lang=es`;

            function updateTime() {
                const now = new Date();
                const optionsDate = {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                };
                const optionsTime = {
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit'
                };

                dateElement.textContent = now.toLocaleDateString('es-ES', optionsDate);
                timeElement.textContent = now.toLocaleTimeString('es-ES', optionsTime);
            }

            function showWeatherImage(iconCode) {
                const iconUrl = `http://openweathermap.org/img/wn/${iconCode}@2x.png`;
                weatherImg.src = iconUrl;
                weatherImg.style.display = 'block';
            }

            async function fetchWeatherData() {
                try {
                    const response = await fetch(apiUrl);
                    const data = await response.json();
                    const temperature = data.main.temp;
                    const weatherCondition = data.weather[0].description;
                    const cityName = data.name;
                    const iconCode = data.weather[0].icon;

                    temperatureElement.textContent = `Temperatura: ${temperature}°C`;
                    cityNameElement.textContent = `Ciudad: ${cityName}`;
                    weatherTitle.textContent = `Clima Actual: ${weatherCondition}`;

                    updateTime();

                    showWeatherImage(iconCode);
                } catch (error) {
                    console.error('Error obteniendo datos del clima:', error);
                    cityNameElement.textContent = 'Error obteniendo datos de la ciudad';
                    temperatureElement.textContent = '---';
                    weatherTitle.textContent = '---';
                    weatherImg.style.display = 'none';
                }
            }

            fetchWeatherData();

            setInterval(updateTime, 1000);
        });
    </script>
</body>

</html>
