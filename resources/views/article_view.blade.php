@extends('layouts.app')
@section('content')
    <section style="width: 75%; margin: 0 auto;margin-top: 20px;">
        <a class="card text-center"
           style="">
            <img class="card-img-top" style="max-width:500px;display: block;margin: 0 auto"
                 src="{{$article->image}}"
                 alt="Card image cap">
            <div class="card-body">
                <h1 style="font-size: 2.5rem;margin: 10px 0">{{$article->title}}</h1>
                <div>
                    {!! $article->content !!}
                </div>
            </div>
        </a>
    </section>
@endsection
