@extends('layouts.app')
@section('content')
    <div id="map"></div>

@endsection

@push('scripts')
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet'/>
    <?php
    $ak = config('weather.api_key')
    ?>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        #map {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        #marker {
            width: 100px;
            height: 100px;
            color: green;
            border-radius: 50%;
            cursor: pointer;
        }

        .mapboxgl-popup {
            max-width: 75% !important;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }

        .mapboxgl-popup-content {
            width: 100%;
        }
    </style>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>

    <script>

        mapboxgl.accessToken = 'pk.eyJ1IjoieWFuYXJvd2FuYTEyMyIsImEiOiJja3o3ODBsdzYwajE3Mm9ueHYwZnQ0OXhkIn0.WIDzfwgQYgs7f8dHmkWyKw';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [71.446, 51.1801],
            zoom: 4.3
        });


        map.on('style.load', function () {
            map.on('click', function (e) {
                var coordinates = e.lngLat;

                let lon = Math.round(coordinates.lng * 100) / 100;
                let lat = Math.round(coordinates.lat * 100) / 100;
                let url = `/weather?lat=${lat}&lon=${lon}`;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`Request failed with status ${response.status}`)
                        }
                        return response.json()
                    })
                    .then(data => {

                        let openWeather = data.openWeather;

                        let accuWeather = null
                        let accuIcon = '';
                        if (data.accu) {
                            accuWeather = data.accu[0];
                            if (accuWeather.WeatherIcon > 9) {
                                accuIcon = `https://developer.accuweather.com/sites/default/files/${accuWeather.WeatherIcon}-s.png`;
                            } else {
                                accuIcon = `https://developer.accuweather.com/sites/default/files/0${accuWeather.WeatherIcon}-s.png`;
                            }
                        }

                        let weatherApiTemp = null;
                        let weatherApiText = null;
                        let weatherApiIcon = null;
                        if (data.weatherApi) {
                            weatherApiTemp = data.weatherApi.current.temp_c
                            weatherApiText = data.weatherApi.current.condition.text
                            weatherApiIcon = data.weatherApi.current.condition.icon
                        }
                        let temp = kelvinToCelsius(openWeather.main.temp);

                        let weatherIcon = `http://openweathermap.org/img/wn/${openWeather.weather[0].icon}@2x.png`;

                        let weatherTitle = openWeather.weather[0].main;

                        new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(`<div> <p class="text-bold" style="font-size: 1.2rem">${openWeather.name}</p><br>
<div class="d-flex">
<div class="mr-1">
<p class="text-bold">OpenWeather</p>
<br>
${weatherTitle}
<img src="${weatherIcon}">
Temperature: ${temp}°C <br>
</div>
<div class="mr-1">
<p class="text-bold">WeatherApi</p>
<br>
${weatherApiText ? weatherApiText : 'Service is Unavailable'}
<img src="${weatherApiIcon}">
Temperature: ${weatherApiTemp ? weatherApiTemp : 'Service is Unavailable'}°C <br>
</div>
<div>
<p class="text-bold">AccuWeather</p>
<br>
${accuWeather ? accuWeather.WeatherText : 'Service is Unavailable'}
<img src="${accuIcon}">
Temperature: ${accuWeather ? accuWeather.Temperature.Metric.Value : 'Service is Unavailable'}°C <br>
</div>
</div>
</div>
<br>
<a href="/${openWeather.name}/article" style="text-decoration: underline">More info</a></div>`)
                            .addTo(map);
                    })
            });

        });

        const kelvinToCelsius = (temp) => ((temp - 273.15).toFixed(2));

    </script>
@endpush
