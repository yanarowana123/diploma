<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <link rel="stylesheet" href="{{asset('/css/adminlte.min.css')}}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">


    <!-- Scripts -->
{{--    <script src="{{ asset('js/app.js') }}" defer></script>--}}

    <style>
        .aa {
            color: royalblue;
        }

        .menu__item:hover {
            color: royalblue;
        }

        @media (min-width: 768px) {
            .w-md-50 {
                width: 50% !important;
            }
        }
    </style>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen">
{{--            @include('layouts.navigation')--}}

<!-- Page Heading -->
    <header class="bg-white shadow" style="position: relative;z-index:1000">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <a href="{{route('home')}}" class="menu__item mr-2
{{request()->route()->named('home')?'aa':''}}
                ">Home</a>
            <a href="{{route('article.page')}}" class="menu__item
{{request()->route()->named('article.page') || request()->route()->named('article.view') || request()->route()->named('article.city')?'aa':''}}
                ">Articles</a>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</div>
@stack('scripts')
</body>
</html>
