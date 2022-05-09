<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\City;
use App\Models\Weather;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Http;

class ArticleController extends Controller
{
    public function articlesPage($name = null): Factory|View|Application
    {
        $city = null;
        $openWeather = null;
        $accuWeather = null;
        $weatherApi = null;
        if ($name) {
            $city = City::with(['treePollen', 'grassPollen', 'ragweedPollen', 'mold', 'dust'])
                ->where('name', $name)->orWhere('alt_name', $name)->first();
        }

        if ($city) {
            $articles = Article::where('city_id', $city->id)->paginate(3);
            $openWeather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::OPEN_WEATHER)
                ->first();

            if (!$openWeather) {
                $apiKey = config('weather.api_key');
                $url = "https://api.openweathermap.org/data/2.5/weather?lat=$city->lat&lon=$city->lon&appid=$apiKey";
                $response = Http::get($url);

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
                $openWeather = Weather::create($data);
            }

            $accuWeather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::AKKU)
                ->first();

            if (!$accuWeather) {
                $accuWeatherCity = 'http://dataservice.accuweather.com/locations/v1/cities/geoposition/search?apikey='
                    . config('weather.ACCUWEATHER_KEY') . "&q=$city->lat,$city->lon";
                $accuResponse = null;

                try {
                    $response = Http::get($accuWeatherCity);
                    $cityKey = $response->json()['Key'];
                    $accuWeatherUrl = "http://dataservice.accuweather.com/forecasts/v1/hourly/1hour/$cityKey?apikey=" . config('weather.ACCUWEATHER_KEY') . "&details=true" . "&metric=true";;
                    $accuResponse = Http::get($accuWeatherUrl)->json();

                    $accuData = [
                        'time' => date('Y-m-d H') . '-00-00',
                        'temp' => $accuResponse[0]['Temperature']['Value'],
                        'temp_feels_like' => $accuResponse[0]['RealFeelTemperatureShade']['Value'],
                        'title' => $accuResponse[0]['IconPhrase'],
                        'icon' => $accuResponse[0]['WeatherIcon'],
                        'city_id' => $city->id,
                        'type' => Weather::AKKU,
                        'wind_direction' => $accuResponse[0]['Wind']['Direction']['Degrees'],
                        'wind_speed' =>$accuResponse[0]['Wind']['Speed']['Value'],
                        'humidity' => $accuResponse[0]['RelativeHumidity'],
                        'visibility' => $accuResponse[0]['Visibility']['Value'],
                    ];
                    $accuWeather = Weather::create($accuData);
                } catch (\Exception $exception) {
                }
            }

            $weatherApi = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->where('type', Weather::WEATHER_API)
                ->first();

            if (!$weatherApi) {
                $weatherApiResponse = null;
                $weatherApi = 'http://api.weatherapi.com/v1/current.json?key=' . config('weather.WEATHER_KEY')
                    . "&q=$city->lat,$city->lon&aqi=no";

                try {
                    $weatherApiResponse = Http::get($weatherApi)->json();
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
                    $weatherApi = Weather::create($weatherApiData);
                } catch (\Exception $exception) {
                }
            }
        } else {
            $articles = Article::paginate(12);
        }

        return view('article', compact('articles', 'city', 'openWeather', 'accuWeather', 'weatherApi'));
    }

    public function view(Article $article)
    {
        return view('article_view', compact('article'));
    }

}
