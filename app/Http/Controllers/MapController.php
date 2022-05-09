<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Weather;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('map');
    }

    public function getWeatherInfo(Request $request): JsonResponse
    {
        $lat = $request->lat;
        $lon = $request->lon;

        $city = City::where('lon', '>=', $lon - 0.5)
            ->where('lon', '<=', $lon + 0.5)
            ->where('lat', '>=', $lat - 0.5)
            ->where('lat', '<=', $lat + 0.5)
            ->first();

        $data = [
            'openWeather' => $this->getOpenWeather($city, $lat, $lon),
            'accu' => $this->getAkkuWeather($city, $lat, $lon),
            'weatherApi' => $this->getWeatherApi($city, $lat, $lon),
        ];

        return response()->json($data);
    }

    private function getWeatherApi(?City $city, $lat, $lon)
    {
        if ($city) {
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::WEATHER_API)
                ->first();

            if ($weather) {
                return [
                    'current' => [
                        'temp_c' => $weather->temp,
                        'condition' => [
                            'text' => $weather->title,
                            'icon' => $weather->icon
                        ]
                    ]
                ];
            }
        }

        $weatherApiResponse = null;
        $weatherApi = 'http://api.weatherapi.com/v1/current.json?key=' . config('weather.WEATHER_KEY')
            . "&q=$lat,$lon&aqi=no";

        try {
            $weatherApiResponse = Http::get($weatherApi)->json();
        } catch (\Exception $exception) {
        }

        if ($city) {
            $weatherApiData = [
                'time' => date('Y-m-d H') . '-00-00',
                'temp' => $weatherApiResponse['current']['temp_c'],
                'temp_feels_like' => $weatherApiResponse['current']['feelslike_c'],
                'title' => $weatherApiResponse['current']['condition']['text'],
                'icon' => $weatherApiResponse['current']['condition']['icon'],
                'type' => Weather::WEATHER_API,
                'city_id' => $city->id,
                'wind_direction' => $weatherApiResponse['current']['wind_dir'],
                'wind_speed' => $weatherApiResponse['current']['wind_kph'],
                'pressure' => $weatherApiResponse['current']['pressure_mb'],
                'humidity' => $weatherApiResponse['current']['humidity'],
                'visibility' => $weatherApiResponse['current']['vis_km']

            ];
            Weather::create($weatherApiData);
        }

        return $weatherApiResponse;
    }


    private function getOpenWeather(?City $city, $lat, $lon)
    {
        if ($city) {
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::OPEN_WEATHER)
                ->first();

            if ($weather) {
                $openWeather = [
                    'main' => [
                        'temp' => $weather->temp
                    ],
                    'weather' => [
                        [
                            'main' => $weather->title,
                            'description' => $weather->description,
                            'icon' => $weather->icon
                        ],
                    ],
                    'wind' => [
                        'speed' => $weather->wind_speed],
                    'name' => $weather->city->name];

                return $openWeather;
            }
        }

        $apiKey = config('weather.api_key');
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey";
        $openWeatherResponse = Http::get($url);
        if ($city) {
            $openWeatherData = [
                'time' => date('Y-m-d H') . '-00-00',
                'temp' => $openWeatherResponse->json()['main']['temp'],
                'temp_feels_like' => $openWeatherResponse->json()['main']['feels_like'],
                'pressure' => $openWeatherResponse->json()['main']['pressure'],
                'humidity' => $openWeatherResponse->json()['main']['humidity'],
                'title' => $openWeatherResponse->json()['weather'][0]['main'],
                'description' => $openWeatherResponse->json()['weather'][0]['description'],
                'icon' => $openWeatherResponse->json()['weather'][0]['icon'],
                'wind_speed' => $openWeatherResponse->json()['wind']['speed'],
                'wind_direction' => $openWeatherResponse->json()['wind']['deg'],
                'visibility' => $openWeatherResponse->json()['visibility'],
                'city_id' => $city->id,
                'name' => $city->name
            ];
            Weather::create($openWeatherData);
        }

        return [
            'main' => [
                'temp' => $openWeatherResponse->json()['main']['temp']
            ],
            'weather' => [
                [
                    'main' => $openWeatherResponse->json()['weather'][0]['main'],
                    'description' => $openWeatherResponse->json()['weather'][0]['description'],
                    'icon' => $openWeatherResponse->json()['weather'][0]['icon'],
                ],
            ],
            'wind' => [
                'speed' => $openWeatherResponse->json()['wind']['speed']],
            'name' => $openWeatherResponse->json()['name']];
    }

    private function getAkkuWeather(?City $city, $lat, $lon)
    {
        if ($city) {
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::AKKU)
                ->first();

            if ($weather) {
                return [
                    [
                        'WeatherIcon' => $weather->icon,
                        'Temperature' => [
                            'Metric' => [
                                'Value' => $weather->temp
                            ],
                        ],
                        'WeatherText' => $weather->title,
                        'type' => Weather::AKKU
                    ]
                ];
            }
        }

        $accuWeatherCity = 'http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey='
            . config('weather.ACCUWEATHER_KEY') . "&q=$lat,$lon";
        $accuResponse = null;

        try {
            $response = Http::get($accuWeatherCity);
            $cityKey = $response->json()['Key'];
            $accuWeatherUrl = "http://dataservice.accuweather.com/forecasts/v1/hourly/1hour/$cityKey?apikey=" . config('weather.ACCUWEATHER_KEY') . "&details=true" . "&metric=true";;
            $accuResponse = Http::get($accuWeatherUrl)->json();
        } catch (\Exception $exception) {
        }

        if ($city) {
            $accuData = [
                'time' => date('Y-m-d H') . '-00-00',
                'temp' => $accuResponse[0]['Temperature']['Value'],
                'temp_feels_like' => $accuResponse[0]['RealFeelTemperatureShade']['Value'],
                'title' => $accuResponse[0]['IconPhrase'],
                'icon' => $accuResponse[0]['WeatherIcon'],
                'city_id' => $city->id,
                'type' => Weather::AKKU,
                'wind_direction' => $accuResponse[0]['Wind']['Direction']['Degrees'],
                'wind_speed' => $accuResponse[0]['Wind']['Speed']['Value'],
                'humidity' => $accuResponse[0]['RelativeHumidity'],
                'visibility' => $accuResponse[0]['Visibility']['Value'],
            ];
            Weather::create($accuData);
        }

        return $accuResponse;
    }
}
