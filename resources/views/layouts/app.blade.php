<html lang="{{app()->getLocale()}}">
    <head>
        <meta charset="utf-8" >
        <meta http-equiv="X-UA-Compatible" content="IE=edge" >
        <meta name="viewport" content="width=device-width, initial-scale=1 ">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title','laraBBS')-{{ setting('site_name','laravel进阶') }}</title>
        <meta name="description" content="@yield('description',setting('seo_description','Laravel爱好者论坛'))"/>
        <meta name="keywords" content="@yield('keywords', setting('seo_keyword','Laravel爱好者论坛')  )"/>
        <link rel="stylesheet" href="{{asset('css/app.css')}}" />
        @yield('styles')
    </head>
    <body>
        <div id="app" class="{{ route_class() }}-page">
            @include('layouts._header')
            <div class="container">
                @include('layouts._message')
                @yield('content')
            </div>
            @include('layouts._footer')
        </div>

        @if(app()->isLocal())
            @include('sudosu::user-selector')
        @endif
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
    </body>
</html>