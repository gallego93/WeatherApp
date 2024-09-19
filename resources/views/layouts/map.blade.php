<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('Geolocation Map') }}</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
            width: 50%;
        }
    </style>
</head>
<body>
    <h1>{{ __('Geolocation Map') }}</h1>
    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var latitude = {{ $weather->latitude }};
        var longitude = {{ $weather->longitude }};

        // Inicializar el mapa
        var map = L.map('map').setView([latitude, longitude], 13);

        // Cargar capas del mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Añadir marcador
        var marker = L.marker([latitude, longitude]).addTo(map)
            .bindPopup('{{ __('Location at the time of the consultation') }}')
            .openPopup();
    </script>
</body>
</html>
