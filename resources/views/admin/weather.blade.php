@extends('admin.layouts.app')

@section('content')
    <div>

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between mt-3">
                    <h2>Weather</h2>
                    {{--                    <a href="{{route('admin.article.create')}}" class="btn btn-success mb-2">Add</a>--}}
                </div>
            </div>
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th scope="col">City</th>
                            <th scope="col">Time</th>
                            <th scope="col">description</th>
                            <th scope="col">Temp</th>
                            <th scope="col">Feels_like</th>
                            <th scope="col">pressure</th>
                            <th scope="col">humidity</th>
                            <th scope="col">visibility</th>
                            <th scope="col">wind_speed</th>
                            <th scope="col">wind_direction</th>
                        </tr>
                        </thead>
                        <tbody class="">
                        @foreach($weathers as $index=>$weather)
                            <tr>
                                <td>{{$weather->city->name}}</td>
                                <td>{{$weather->time}}</td>
                                <td>{{$weather->description}}</td>
                                <td>{{$weather->temp}}</td>
                                <td>{{$weather->temp_feels_like}}</td>
                                <td>{{$weather->pressure}}</td>
                                <td>{{$weather->humidity}}</td>
                                <td>{{$weather->visibility}}</td>
                                <td>{{$weather->wind_speed}}</td>
                                <td>{{$weather->wind_direction}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
            <div class="card-footer">
                {{ $weathers->links() }}
            </div>
        </div>
    </div>
@endsection
