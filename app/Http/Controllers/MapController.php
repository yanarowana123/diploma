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


        if ($city) {
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->first();

            if ($weather) {
                $data = [
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

                return response()->json($data);
            }
        }


        $apiKey = config('weather.api_key');
        $url = "https://api.openweathermap.org/data/2.5/weather?lat=$lat&lon=$lon&appid=$apiKey";
        $response = Http::get($url);

        if ($city) {
            $data = [
                'time' => date('Y-m-d H') . '-00-00',
                'temp' => $response->json()['main']['temp'],
                'temp_feels_like' => $response->json()['main']['feels_like'],
                'pressure' => $response->json()['main']['pressure'],
                'humidity' => $response->json()['main']['humidity'],
                'title' => $response->json()['weather'][0]['main'],
                'description' => $response->json()['weather'][0]['description'],
                'icon' => $response->json()['weather'][0]['icon'],
                'wind_speed' => $response->json()['wind']['speed'],
                'wind_direction' => $response->json()['wind']['deg'],
                'visibility' => $response->json()['visibility'],
                'city_id' => $city->id,
                'name' => $city->name
            ];
            Weather::create($data);

            $data = [
                'main' => [
                    'temp' => $response->json()['main']['temp']
                ],
                'weather' => [
                    [
                        'main' => $response->json()['weather'][0]['main'],
                        'description' => $response->json()['weather'][0]['description'],
                        'icon' => $response->json()['weather'][0]['icon'],
                    ],
                ],
                'wind' => [
                    'speed' => $response->json()['wind']['speed']],
                'name' => $city->name];
            return response()->json($data);
        }

        return response()->json($response->json());
    }
}
