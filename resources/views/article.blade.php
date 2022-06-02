@extends('layouts.app')
@section('content')
    <section style="width: 75%; margin: 20px auto 0;">
        @if($city)
            <h1 style="font-size:3rem; font-weight: 700" class="text-center mb-4 mt-2">{{$city->name}}</h1>
            <div class="d-flex flex-column flex-md-row">
                <div class="w-100 w-md-50">
                    <div
                        style="display:flex; justify-content: space-around; align-items: center;margin-bottom: 20px;height:100px">
                        <h1 class="text-bold" style="font-size: 1.5rem;margin-bottom: 20px">
                            OpenWeather</h1>
                        <div style="display:flex; flex-direction: column; align-items: center">
                            <img src="http://openweathermap.org/img/wn/{{$openWeather->icon}}@2x.png" alt="">
                            <p>{{$openWeather->description}}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width:50%">Temperature</th>
                                <td style="width:50%">{{$openWeather->temp - 273.15}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Feels like</th>
                                <td style="width:50%">{{$openWeather->temp_feels_like - 273.15}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Atmospheric pressure</th>
                                <td style="width:50%">{{$openWeather->pressure}}hPa</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Humidity</th>
                                <td style="width:50%">{{$openWeather->humidity}}%</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Visibility</th>
                                <td style="width:50%">{{$openWeather->visibility}} meter(s)</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind speed</th>
                                <td style="width:50%">{{$openWeather->wind_speed}} m/s</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind direction</th>
                                <td style="width:50%">{{$openWeather->wind_direction}}°</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-100 w-md-50">
                    <div
                        style="display:flex; justify-content: space-around; align-items: center;margin-bottom: 20px;height:100px;">
                        <h1 class="text-bold" style="font-size: 1.5rem;margin-bottom: 20px">Akkuweather</h1>
                        <div style="display:flex; flex-direction: column; align-items: center">
                            @if ($accuWeather->icon > 9)
                                <img
                                    src="https://developer.accuweather.com/sites/default/files/{{$accuWeather->icon}}-s.png"
                                    alt="">
                            @else
                                <img
                                    src="https://developer.accuweather.com/sites/default/files/0{{$accuWeather->icon}}-s.png"
                                    alt="">
                            @endif
                            <p>{{$accuWeather->title}}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width:50%">Temperature</th>
                                <td style="width:50%">{{$accuWeather->temp}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Feels like</th>
                                <td style="width:50%">{{$accuWeather->temp_feels_like}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Humidity</th>
                                <td style="width:50%">{{$accuWeather->humidity}}%</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Visibility</th>
                                <td style="width:50%">{{$accuWeather->visibility}} km(s)</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind speed</th>
                                <td style="width:50%">{{$accuWeather->wind_speed}} km/h</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind direction</th>
                                <td style="width:50%">{{$accuWeather->wind_direction}}°</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="w-100 w-md-50">
                    <div
                        style="display:flex; justify-content: space-around; align-items: center;margin-bottom: 20px;height:100px;">
                        <h1 class="text-bold" style="font-size: 1.5rem;margin-bottom: 20px">Weather Api</h1>
                        <div style="display:flex; flex-direction: column; align-items: center">
                            <img
                                src="{{$weatherApi->icon}}"
                                alt="">
                            <p>{{$weatherApi->title}}</p>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th scope="row" style="width:50%">Temperature</th>
                                <td style="width:50%">{{$weatherApi->temp}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Feels like</th>
                                <td style="width:50%">{{$weatherApi->temp_feels_like}}°C</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Atmospheric pressure</th>
                                <td style="width:50%">{{$weatherApi->pressure}}hPa</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Humidity</th>
                                <td style="width:50%">{{$weatherApi->humidity}}%</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Visibility</th>
                                <td style="width:50%">{{$weatherApi->visibility}} km(s)</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind speed</th>
                                <td style="width:50%">{{$weatherApi->wind_speed}} km/h</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width:50%">Wind direction</th>
                                <td style="width:50%">{{$weatherApi->wind_direction}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="w-100 mt-2">
                @if($city->treePollen->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%;font-size: 1.4rem; color:#BDF516">Tree pollen</th>
                                <th scope="col" style="width:35%">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->treePollen as $data)
                                <tr>
                                    <th scope="row">{{$data->title}}</th>
                                    <td>{{$data->tree_level}}</td>
                                    <td><a href="{{route('tree.view',$data)}}">Read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($city->grassPollen->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%;font-size: 1.4rem; color: #DAEE01">Grass pollen</th>
                                <th scope="col" style="width:35%">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->grassPollen as $data)
                                <tr>
                                    <th scope="row">{{$data->title}}</th>
                                    <td>{{$data->grass_level}}</td>
                                    <td><a href="{{route('grass.view',$data)}}">Read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($city->ragweedPollen->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%;font-size: 1.4rem;color:#e2f516">Ragweed pollen</th>
                                <th scope="col" style="width:35%">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->ragweedPollen as $data)
                                <tr>
                                    <th scope="row">{{$data->title}}</th>
                                    <td>{{$data->ragweed_level}}</td>
                                    <td><a href="{{route('ragweed.view',$data)}}">Read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($city->dust->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%;font-size: 1.4rem;color:#ccfb5d">Dust and danger</th>
                                <th scope="col" style="width:35%">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->dust as $data)
                                <tr>
                                    <th scope="row">{{$data->title}}</th>
                                    <td>{{$data->dd_level}}</td>
                                    <td><a href="{{route('dust.view',$data)}}">Read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if($city->mold->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%;font-size: 1.4rem;color:#bce954">Mold</th>
                                <th scope="col" style="width:35%">Level</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->mold as $data)
                                <tr>
                                    <th scope="row">{{$data->title}}</th>
                                    <td>{{$data->mold_level}}</td>
                                    <td><a href="{{route('mold.view',$data)}}">Read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        @endif

        @if($articles->isNotEmpty())
            <h2 class="text-bold" style="font-size: 1.3rem;margin-top:40px; margin-bottom: 20px;">Articles</h2>
            <div
                class="d-flex flex-column flex-md-row align-content-center flex-wrap articles-wrapper"
            >
                @foreach($articles as $key => $article)
                    <a href="{{route('article.view',$article)}}" class="card text-center mb-4 ml-md-2 aaaa">
                        <img class="card-img-top"
                             style="object-fit:contain; max-width: 300px; display: block;margin: 0 auto"
                             src="{{$article->image}}"
                             alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">{{$article->title}}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
        <div style="margin-top:40px">
            {{$articles->links()}}
        </div>
    </section>
@endsection
