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


        $accuWeatherCity = 'http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey='
            . config('weather.ACCUWEATHER_KEY') . "&q=$lat,$lon";
        $accuResponse = null;
        $weatherApiResponse = null;
        $weatherApi = 'http://api.weatherapi.com/v1/current.json?key=' . config('weather.WEATHER_KEY')
            . "&q=$lat,$lon&aqi=no";
        try {
            $response = Http::get($accuWeatherCity);
            $cityKey = $response->json()['Key'];
            $accuWeatherUrl = "http://dataservice.accuweather.com/currentconditions/v1/$cityKey?apikey=" . config('weather.ACCUWEATHER_KEY');
            $accuResponse = Http::get($accuWeatherUrl)->json();
        } catch (\Exception $exception) {
        }

        try{
            $weatherApiResponse = Http::get($weatherApi)->json();
        } catch (\Exception $exception) {
        }

        if ($city) {
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
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

                $data = [
                    'openWeather' => $openWeather,
                    'accu' => $accuResponse,
                    'weatherApi' => $weatherApiResponse
                ];
                return response()->json($data);
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

            $openWeatherData = [
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
                'name' => $city->name];

            $data = [
                'openWeather' => $openWeatherData,
                'accu' => $accuResponse,
                'weatherApi' => $weatherApiResponse
            ];

            return response()->json($data);
        }

        $data = [
            'openWeather' => $openWeatherResponse->json(),
            'accu' => $accuResponse,
            'weatherApi' => $weatherApiResponse
        ];

        return response()->json($data);
    }

}
