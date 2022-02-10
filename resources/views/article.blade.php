@extends('layouts.app')
@section('content')
    <section style="width: 75%; margin: 20px auto 0;">
        @if($city)
            <div style="display:flex;">
                <div style="width: 45%;margin-right: 40px">
                    <div style="display:flex; justify-content: space-around; align-items: center;margin-bottom: 20px">
                        <h1 class="text-bold" style="font-size: 1.5rem;margin-bottom: 20px">{{$city->name}}</h1>

                        <div style="display:flex; flex-direction: column; align-items: center">
                            <img src="http://openweathermap.org/img/wn/{{$weather->icon}}@2x.png" alt="">
                            <p>{{$weather->description}}</p>
                        </div>
                    </div>

                    <table class="table">
                        <tbody>
                        <tr>
                            <th scope="row" style="width:50%">Temperature</th>
                            <td style="width:50%">{{$weather->temp - 273.15}}°C</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Feels like</th>
                            <td style="width:50%">{{$weather->temp_feels_like - 273.15}}°C</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Atmospheric pressure</th>
                            <td style="width:50%">{{$weather->pressure}}hPa</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Humidity</th>
                            <td style="width:50%">{{$weather->humidity}}%</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Visibility</th>
                            <td style="width:50%">{{$weather->visibility}} meter(s)</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Wind speed</th>
                            <td style="width:50%">{{$weather->wind_speed}} m/s</td>
                        </tr>
                        <tr>
                            <th scope="row" style="width:50%">Wind direction</th>
                            <td style="width:50%">{{$weather->wind_direction}}°</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div style="width: 50%;">
                    @if($city->treePollen->isNotEmpty())
                        {{--                <h2 class="text-bold" style="font-size: 1.3rem">Tree pollen</h2>--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%">Tree pollen</th>
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
                    @endif

                    @if($city->grassPollen->isNotEmpty())
                        {{--                <h2 class="text-bold" style="font-size: 1.3rem">Grass pollen</h2>--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%">Grass pollen</th>
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
                    @endif

                    @if($city->ragweedPollen->isNotEmpty())
                        {{--                <h2 class="text-bold" style="font-size: 1.3rem">Ragweed pollen</h2>--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%">Ragweed pollen</th>
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
                    @endif

                    @if($city->dust->isNotEmpty())
                        {{--                <h2 class="text-bold" style="font-size: 1.3rem">Dust and danger</h2>--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%">Dust and danger</th>
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
                    @endif

                    @if($city->mold->isNotEmpty())
                        {{--                <h2 class="text-bold" style="font-size: 1.3rem">Mold</h2>--}}
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" style="width:50%">Mold</th>
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
                    @endif
                </div>
            </div>

        @endif

        @if($articles->isNotEmpty())
            <h2 class="text-bold" style="font-size: 1.3rem;margin-top:40px; margin-bottom: 20px;">Articles</h2>
            <div style="display: flex; align-content:center;flex-wrap: wrap">
                @foreach($articles as $key => $article)
                    <a href="{{route('article.view',$article)}}" class="card text-center"
                       style="width: 33%; margin: 0 auto; margin-bottom: 10px">
                        <img class="card-img-top" style="object-fit:contain; width: 300px; display: block;margin: 0 auto"
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