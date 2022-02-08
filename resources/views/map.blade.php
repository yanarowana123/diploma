@extends('layouts.app')
@section('content')
    <div id="map"></div>

@endsection

@push('scripts')
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet'/>

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
            max-width: 400px;
            font: 12px/20px 'Helvetica Neue', Arial, Helvetica, sans-serif;
        }
    </style>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>

    <script>

        // const coords = {
        //     ''
        // }

        mapboxgl.accessToken = 'pk.eyJ1IjoieWFuYXJvd2FuYTEyMyIsImEiOiJja3o3ODBsdzYwajE3Mm9ueHYwZnQ0OXhkIn0.WIDzfwgQYgs7f8dHmkWyKw';
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [71.446, 51.1801],
            zoom: 4.3
        });

        // map.scrollZoom.disable();


        // create the popup
        // const popup = new mapboxgl.Popup({offset: 25}).setText(
        //     'Construction on the Washington Monument began in 1848.'
        // );
        //
        // const monument = [71.446, 51.1801];


        // // create DOM element for the marker
        // const el = document.createElement('div');
        // el.id = 'marker';

        // // create the marker
        // new mapboxgl.Marker(el)
        //     .setLngLat(monument)
        //     .setPopup(popup) // sets a popup on this marker
        //     .addTo(map);


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
                        let temp = kelvinToCelsius(data.main.temp);

                        let weatherDescription = data.weather[0].description;
                        let weatherIcon = `http://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;

                        let windSpeed = data.wind.speed;

                        let weatherTitle = data.weather[0].main;

                        new mapboxgl.Popup()
                            .setLngLat(coordinates)
                            .setHTML(`City: ${data.name}<br>
${weatherTitle} <br>
<img src="${weatherIcon}">
Temperature: ${temp}°C <br>
<br>
<a href="/${data.name}/article" style="text-decoration: underline">More info</a>`)
                            .addTo(map);
                    })
            });

        });

        const kelvinToCelsius = (temp) => (temp - 273.15);

    </script>
@endpush
