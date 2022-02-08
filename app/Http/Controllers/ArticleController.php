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
        $weather = null;
        if ($name) {
            $city = City::with(['treePollen', 'grassPollen', 'ragweedPollen', 'mold', 'dust'])
                ->where('name', $name)->orWhere('alt_name', $name)->first();
        }

        if ($city) {
            $articles = Article::where('city_id', $city->id)->paginate(3);
            $weather = Weather::where('city_id', $city->id)
                ->where('time', date('Y-m-d H') . '-00-00')
                ->first();
            if(!$weather){
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
                $weather = Weather::create($data);
            }
        } else {
            $articles = Article::paginate(12);
        }
        return view('article', compact('articles', 'city', 'weather'));
    }

    public function view(Article $article)
    {
        return view('article_view', compact('article'));
    }

}
